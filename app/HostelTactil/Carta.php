<?php

namespace App\HostelTactil;

use App\ConfigGeneral;

class Carta extends HostelTactil
{
    protected static function endpoint()
    {
        return "carta/" . ConfigGeneral::first()->hosteltactil_idlocal;
    }
}
