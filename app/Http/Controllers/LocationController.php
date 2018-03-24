<?php

namespace App\Http\Controllers;

class LocationController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function show()
    {
        $data = [
            'homeMobileCountryCode' => 310,
            'homeMobileNetworkCode' => 260,
            'radioType'             => "gsm",
            'carrier'               => "T-Mobile",
            'cellTowers' => [
                'cellId'            => 39627456,
                'locationAreaCode'  => 40495,
                'mobileCountryCode' => 310,
                'mobileNetworkCode' => 260,
                'age'               => 0,
                'signalStrength'    => -95,
            ],
            'wifiAccessPoints' => [
                [
                    'macAddress'        => "01:23:45:67:89:AB",
                    'signalStrength'    => 8,
                    'age'               => 0,
                    'channel'           => 8,
                    'signalToNoiseRatio'=> -65,
                ],
                [
                    'macAddress'        => "01:23:45:67:89:AC",
                    'signalStrength'    => 4,
                    'age'               => 0,
                ],
            ],
        ];

        $location =  json_decode(\GoogleMaps::load('geolocate')
            ->setParam($data)
            ->get());

        return view('location');
        //return view('location', ['lat' => $location->location->lat, 'lng' => $location->location->lng]);
    }
}