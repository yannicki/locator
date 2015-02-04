<?php
namespace CCM\LocatorBundle\Locator;

class GooglePlaceLocator implements LocatorInterface {

    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function searchByKeyword($query)
    {
        $urlEncodedQuery = urlencode($query);

        $url = sprintf('https://maps.googleapis.com/maps/api/place/textsearch/json?query=%s&key=%s', $urlEncodedQuery, $this->key);

        $result = json_decode(file_get_contents($url), true);

        return array_map(function($result) {
            return [
                'name' => $result['name'],
                'adress' => $result['formatted_address'],
                'source' => 'Google'
            ];
        }, $result['results']);



    }

}