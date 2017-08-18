<?php

namespace AppBundle\Service;

/**
 * Class DistanceCalculator
 * @author Arofikin Aleksandr <sashaaro@gmail.com>
 *
 * @TODO remove static
 */
class DistanceCalculator
{
    const EARTH_RADIUS = 6371;

    public static function resolveCoordinates($address)
    {
        $url = 'http://maps.google.com/maps/api/geocode/json?address='.urlencode($address);
        $response = file_get_contents($url);

        $data = json_decode($response);
        if ($data->status == "OK") {
            $location = $data->results[0]->geometry->location;
            return [
                'lat' => $location->lat,
                'lng' => $location->lng,
            ];
        } else {
            throw new \InvalidArgumentException('Address does\'t exist');
        }
    }

    /**
     * @param $fromLat
     * @param $fromLon
     * @param $toLat
     * @param $toLon
     * @return float
     */
    public static function calculate($fromLat, $fromLon, $toLat, $toLon)
    {
        $dLat = deg2rad($toLat - $fromLat);
        $dLon = deg2rad($toLon - $fromLon);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($fromLat)) * cos(deg2rad($toLat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = self::EARTH_RADIUS * $c;

        return round($d, 2);
    }
}