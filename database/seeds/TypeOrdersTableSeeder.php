<?php

use App\TypeOrder;
use Illuminate\Database\Seeder;

class TypeOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOrder::create(
            [
            'name' => 'Domicilio',
            'image' => 'img/type-orders/repartidor.png',
            ]
        );

        TypeOrder::create(
            [
            'name' => 'Recogida',
            'image' => 'img/type-orders/restaurante.png',
            ]
        );
    }
}
