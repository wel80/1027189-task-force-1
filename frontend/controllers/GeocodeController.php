<?php
namespace frontend\controllers;
use frontend\components\AbstractSecuredController;
use GuzzleHttp\Client;

class GeocodeController extends AbstractSecuredController
{
    public function actionIndex($address)
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

        $geo = json_decode($response->getBody());
        $addressObjArray = $geo->response->GeoObjectCollection->featureMember;

        $result = array();
        foreach($addressObjArray as $oneAddressObj){
            $resultObj = new \stdClass();
            $resultObj->name = $oneAddressObj->GeoObject->name . ', ' . $oneAddressObj->GeoObject->description;
            $coordinates = explode(" ", $oneAddressObj->GeoObject->Point->pos);
            $resultObj->longitude = $coordinates[0];
            $resultObj->latitude = $coordinates[1];
            //$resultObj->point = $oneAddressObj->GeoObject->Point->pos;
            $result[] = $resultObj;
        }
        return $this->asJson($result);
        //return $this->$result;
        //var_dump($result);
    }
}