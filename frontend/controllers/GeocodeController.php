<?php
namespace frontend\controllers;
use frontend\components\AbstractSecuredController;
use GuzzleHttp\Client;

class GeocodeController extends AbstractSecuredController
{
    public function actionIndex($address = 'Новосибирск, Красный проспект')
    {
        $client = new Client([
            'base_uri' => 'https://geocode-maps.yandex.ru/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', '1.x', ['query' => [
            'geocode' => $address, 
            'apikey' => 'e666f398-c983-4bde-8f14-e3fec900592a',
            'format' => 'json',
            ]
        ]);

        return $response->getBody();
    }
}