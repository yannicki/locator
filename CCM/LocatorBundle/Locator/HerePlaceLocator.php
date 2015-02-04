<?php
namespace CCM\LocatorBundle\Locator;

class HerePlaceLocator implements LocatorInterface {

    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function searchByKeyword($query)
    {
        $urlEncodedQuery = urlencode($query);

        $url = sprintf('http://places.cit.api.here.com/places/v1/discover/search?at=48.85031735791848,2.3450558593746678&app_id=DemoAppId01082013GAL&app_code=AJKnXv84fjrb0KIHawS0Tg&q=%s', $urlEncodedQuery, $this->key);

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