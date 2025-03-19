<?php

namespace App\Resolvers;

use App\Services\StripeService;
use Exception;
use App\TypeOrder;

class TypeOrderResolver
{
    protected $typeOrders;

    public function __construct()
    {
        $this->typeOrders = TypeOrder::all();
    }

    public function resolveService($typeOrderId)
    {
        //        $name = strtolower($this->typeOrders->firstWhere('id', $typeOrderId)->name);
        //
        //        $service = config("services.{$name}.class");
        //
        //
        //        if ($service) {
        //            return resolve($service);
        //        }

        return resolve(StripeService::class);

        throw new Exception('The selected payment platform is not in the configuration');
    }
}
