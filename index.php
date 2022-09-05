<?php

require_once 'Helpers/Helpers.php';

$countrys = Helper_Country::getAllCountrys();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/apps/public/script/script.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body class="container">
        <div class="row justify-content-center">

            <form class="row g-3 col justify-content-center">
                <input type="hidden" name="type" value="city">

                <div class="col-auto">
                    <label for="city_name" class="visually-hidden">City</label>
                    <input type="text" class="form-control" name="city_name" id="city_name" placeholder="City">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Sök</button>
                </div>
            </form>

            <form class="row g-3 col justify-content-center">
                <input type="hidden" name="type" value="country">

                <div class="col-auto">
                    <label for="city_name" class="visually-hidden">Country</label>
                    <select class="form-select" name="country_name" id="country_name">
                        <?php foreach ($countrys as $country) { ?>
                            <option value="<?=substr_replace(explode('iso_alpha2:', $country->href)[1], "", -1)?>"><?=$country->name?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Sök</button>
                </div>
            </form>

        </div>

        <div class="output card"></div>
    </body>
</html>
