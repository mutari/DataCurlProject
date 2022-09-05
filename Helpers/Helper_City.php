<?php

class Helper_City {

    static function  getCityByName(string $name, bool $jsonResponse = false): string
    {
        $cityId = Helper_Curl::curl("https://api.teleport.org/api/cities/?search=$name"); // get city id / url

        $href = $cityId->_embedded->{'city:search-results'}[0]->{'_links'}->{'city:item'}->href;

        $cityInfo = Helper_Curl::curl($href); // get city information from city id / url
        $encodedData = json_encode($cityInfo);

        if($jsonResponse)
            return $encodedData;

        $lat = $cityInfo->location->latlon->latitude;
        $long = $cityInfo->location->latlon->longitude;

        // return HTML

        return <<<EOD
            <div class="card-body">
                
                <h1>$cityInfo->full_name</h1>
                <h4>$cityInfo->name</h4>
                
                <div>
                    <span>Population</span>
                    <span>$cityInfo->population</span>
                </div>
                
                <a target="_blank" href="https://www.google.se/maps/@$lat,$long,11z?hl=sv">Google maps</a>
                
                <details>
                    <summary>Clean response JSON</summary>
                    <code>$encodedData</code>
                </details>
                
            </div>
            
        EOD;
    }

}