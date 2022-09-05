<?php

class Helper_Country {

    static function getCountryByCountryID(string $countryId): string {

        $country = Helper_Curl::curl("https://api.teleport.org/api/countries/iso_alpha2:$countryId/");
        $divisions = Helper_Curl::curl("https://api.teleport.org/api/countries/iso_alpha2:$countryId/admin1_divisions/");
        $divisions = $divisions->_links->{'a1:items'};
        $salaries = Helper_Curl::curl("https://api.teleport.org/api/countries/iso_alpha2:$countryId/salaries/");

        $encodedData = json_encode($country);

        $population = number_format($country->population, 0, '.', ',');

        //generate division html
        $divisionsHtml = "";
        foreach ($divisions as $division) {
            $divisionsHtml .= "
                <div>
                    <span>
                        $division->name
                    </span>
                </div>  
            ";
        }

        //generate salaries html
        $salariesHtml = "";
        foreach ($salaries->salaries as $salary) {
            $jobName = $salary->job->title;
            $salaryPer = $salary->salary_percentiles;
            $per_25 = number_format($salaryPer->percentile_25, 0, '.', ',');
            $per_50 = number_format($salaryPer->percentile_50, 0, '.', ',');
            $per_75 = number_format($salaryPer->percentile_75, 0, '.', ',');
            $salariesHtml .= "
                <details class='card p-2 m-2'>
                    <summary>$jobName</summary>
                    <div class='p-2'>
                        <div>
                            <span class='text-danger'>25%:</span> 
                            <span>$per_25$</span>      
                        </div>
                        <div>
                            <span class='text-danger'>50%:</span> 
                            <span>$per_50$</span>      
                        </div>
                        <div>
                            <span class='text-danger'>75%:</span> 
                            <span>$per_75$</span>      
                        </div>   
                    </div>
                </details>  
            ";
        }



        return <<<EOD
            <div class="card-body row">
                
                <div class="col-8">
                    <h1>$country->name</h1>
                    
                    <div>
                        <span>Population: </span>
                        <span>$population</span>
                    </div>
                    
                    <div>
                        <span>Currency: </span>
                        <span>$country->currency_code</span>          
                    </div>
                    
                    <details>
                        <summary>Salaries</summary>
                        <div>
                            $salariesHtml
                        </div>
                    </details>
                    
                    <details>
                        <summary>Clean response JSON</summary>
                        <code>$encodedData</code>
                    </details>
                </div>
                
                <div class="col-4 text-end">
                    <h3>County</h3>
                    $divisionsHtml
                </div>
                
            </div>
            
        EOD;
    }

    static function getAllCountrys(): array {
        $countrys = Helper_Curl::curl("https://api.teleport.org/api/countries/");

        return $countrys->_links->{'country:items'};
    }

}