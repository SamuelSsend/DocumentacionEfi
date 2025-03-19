<?php

namespace App\Console\Commands;

use App\Alimento;
use App\Combinado;
use App\ConfigGeneral;
use App\HostelTactil\Carta;
use App\MenuComida;
use App\Subproducto;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SincronizarCarta extends Command
{
    protected $signature = 'efipos:sync-carta';
    protected $description = 'Sincroniza la carta';

    private $combinadosId = [];
    private $alimentosActivadosId = [];
    private $subProductosActivadosId = [];

    public function handle()
    {
        $carta = Carta::get();
        Log::info("Iniciando el procesamiento de categorías.");
        $this->processCategorias($carta['categorias']);
        Log::info("Procesamiento de categorías completado.");

        Log::info("Iniciando el procesamiento de secciones.");
        $this->processSecciones($carta['secciones']);
        Log::info("Procesamiento de secciones completado."); 
    
        Log::info("Iniciando el procesamiento de multiplicidades.");
        $this->processMultiplicidad($carta['categorias'], $carta['secciones']);
        Log::info("Procesamiento de multiplicidades completado.");

        // Desactivar los alimentos y subproductos que no se sincronizaron
        Alimento::whereNotIn('id', $this->alimentosActivadosId)->update(['estado' => 'Baja', 'activo_hosteltactil' => false]);
        Subproducto::whereNotIn('id', $this->subProductosActivadosId)->update(['estado' => 'Baja', 'activo_hosteltactil' => false]);

        // Eliminar los combinados que no se sincronizaron
        DB::table('combinado_subproducto')->whereNotIn('combinado_id', $this->combinadosId)->delete();
        DB::table('alimento_combinado')->whereNotIn('combinado_id', $this->combinadosId)->delete();
        Combinado::whereNotIn('id', $this->combinadosId)->delete();


        file_put_contents(storage_path('hosteltactil_ultima_sync.txt'), date('d/m/Y H:i:s'));
        Log::info("Sincronización completada. Archivo de sincronización actualizado.");
    }

    protected function processMultiplicidad(array $categorias, array $secciones)
    {
        foreach ($categorias as $categoria) {
            foreach ($categoria['productos'] as $producto) {
                $this->processProducto($producto, $secciones);
            }
        }
    }

    protected function processProducto($producto, $secciones)
    {
        if (isset($producto['menusecciones']) && is_array($producto['menusecciones'])) {
            foreach ($producto['menusecciones'] as $menuseccion) {
                // Procesar la multiplicidad
                $multiplicidad = $menuseccion['multiplicidad'] ?? 1;
                Log::info("Alimento ID: {$producto['id']}, Combinado ID: {$menuseccion['id']}, Multiplicidad: {$multiplicidad}");
                DB::table('alimento_combinado')->updateOrInsert(
                    ['alimento_id' => $producto['id'], 'combinado_id' => $menuseccion['id']],
                    ['multiplicidad' => $multiplicidad]
                );

                // Procesar subproductos dentro de cada menusección
                $seccion = array_filter(
                    $secciones, function ($sec) use ($menuseccion) {
                        return $sec['id'] == $menuseccion['idseccionmenu'];
                    }
                );

                if (!empty($seccion)) {
                    $sec = array_values($seccion)[0];
                    foreach ($sec['productos'] as $prod) {
                        DB::table('subproducto_combinado')->insertOrIgnore(
                            [
                            'padre_producto_id' => $producto['id'],
                            'menuseccion_id' => $menuseccion['nombre'],
                            'subproducto_id' => $prod['id'],
                            'created_at' => now(),
                            'updated_at' => now()
                            ]
                        );

                        // Verificar y procesar subproductos de segundo nivel
                        if (isset($prod['subproductos']) && is_array($prod['subproductos'])) {
                                $this->processSubProductos($prod, $secciones);
                        }
                    }
                }
            }
        }
    }

    protected function processSubProductos($producto, $secciones)
    {
        if (isset($producto['menusecciones']) && is_array($producto['menusecciones'])) {
            foreach ($producto['menusecciones'] as $menuseccion) {
                $seccion = array_filter(
                    $secciones, function ($sec) use ($menuseccion) {
                        return $sec['id'] == $menuseccion['idseccionmenu'];
                    }
                );

                if (!empty($seccion)) {
                    $sec = array_values($seccion)[0];
                    foreach ($sec['productos'] as $prod) {
                        DB::table('subproducto_combinado')->insertOrIgnore(
                            [
                            'padre_producto_id' => $producto['id'],
                            'menuseccion_id' => $menuseccion['nombre'],
                            'subproducto_id' => $prod['id'],
                            'created_at' => now(),
                            'updated_at' => now()
                            ]
                        );

                        // Verificar si el subproducto tiene subproductos de segundo nivel
                        if (isset($prod['subproductos']) && is_array($prod['subproductos'])) {
                                $this->processSubProductos($prod, $secciones);
                        }
                    }
                } else {
                    Log::warning("No se encontró la sección para el subproducto ID: " . $producto['id']);
                }
            }
        } else {
            Log::warning("No se encontraron menusecciones para el subproducto ID: " . $producto['id']);
        }
    }
    
    //antiguo codigo

    protected function processCategorias(array $categorias)
    {
        collect($categorias)->each(
            function ($categoriaArray) {
                $categoria = $this->createOrUpdateCategoria($categoriaArray);

                $this->createOrUpdateAlimentos($categoriaArray['productos'], $categoria);
            }
        );
    }

    protected function createOrUpdateCategoria(array $data): MenuComida
    {
        return MenuComida::updateOrCreate(
            ['id' => $data['id']],
            ['titulo' => $data['nombre'], 'activo_hosteltactil' => 1]
        );
    }

    protected function createOrUpdateAlimentos(array $productos, MenuComida $categoria)
    {
        collect($productos)
            ->filter(
                function ($productoArray) {
                    return $productoArray['nombre'] != '';
                }
            )
            ->each(
                function ($productoArray) use ($categoria) {
                    $alimento = $this->createOrUpdateAlimento($productoArray, $categoria);
                    $this->alimentosActivadosId[] = $alimento->id;
                }
            );
    }

    protected function createOrUpdateAlimento(array $data, MenuComida $categoria): Alimento
    {
        $alimento = Alimento::firstOrNew(['id' => $data['id']]);
        $values = [
            'categoria_id' => $categoria->id,
            'categoria' => $categoria->titulo,
            'titulo' => $data['nombre'],
            'descripcion_hosteltactil' => $data['descripcion'],
            'precio' => $data['tarifa'. ConfigGeneral::first()->hosteltactil_tarifa],
            'activo_hosteltactil' => $data['activo'],
        ];

        if (!$alimento->exists) {
            $values = array_merge(
                $values, [
                'portada' => "",
                'oferta' => 0,
                'estado' => 'Disponible',
                'descripcion_manual' => ''
                ]
            );
        }

        $alimento->fill($values)->save();

        collect($data['menusecciones'])->each(
            function ($menuSeccionArray) use ($alimento) {
                $alimento->combinados()->syncWithoutDetaching($menuSeccionArray['idseccionmenu']);
            }
        );

        return $alimento;
    }

    protected function processSecciones(array $secciones)
    {
        collect($secciones)->each(
            function ($seccionArray) {
                $combinado = $this->createOrUpdateCombinado($seccionArray);
                $subproductos = $this->createOrUpdateSubproductos($seccionArray['productos']);

                $combinado->subproductos()->sync($subproductos->pluck('id'));

                $this->combinadosId[] = $combinado->id;
            }
        );
    }

    protected function createOrUpdateCombinado(array $data): Combinado
    {
        return Combinado::updateOrCreate(
            ['id' => $data['id']],
            ['nombrecombi' => $data['nombre']]
        );
    }

    protected function createOrUpdateSubproductos(array $productos): Collection
    {
        return collect($productos)->map(
            function ($productoArray) {
                $subproducto = $this->createOrUpdateSubproducto($productoArray);
                $this->subProductosActivadosId[] = $subproducto->id;

                return $subproducto;
            }
        );
    }

    protected function createOrUpdateSubproducto(array $data): Subproducto
    {
        $subproducto = Subproducto::firstOrNew(['id' => $data['id']]);
        $titulo = Alimento::where('id', $data['id'])->value('titulo');
        //         Log::info($titulo);
        $values = [
            'precio' => $data['suplemento'],
            'nombre' => $titulo,
        ];

        if (!$subproducto->exists) {
            $values['estado'] = 'Baja';
        }

        $subproducto->fill($values)->save();

        return $subproducto;
    }
}
