<?php

namespace App\HostelTactil;

use App\ConfigGeneral;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

abstract class HostelTactil
{
    abstract protected static function endpoint();

    public static function get()
    {
        try {
            $config = ConfigGeneral::first();

            $client = new Client();
            $uri = $config->hosteltactil_api . "/" . static::endpoint();

            $response = $client->get(
                $uri, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $config->hosteltactil_token,
                    'Accept' => 'application/json',
                    'IDLocal' => $config->hosteltactil_idlocal
                ]
                ]
            );
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            Log::error('Failed fetching data from the API');
            Log::error($e);
            return false;
        }
    }
}
