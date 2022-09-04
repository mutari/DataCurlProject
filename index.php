<?php
//echo Helper_City::getCityIdByName('Halmstad');
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/apps/public/script/script.js"></script>
        <title>Document</title>
    </head>
    <body>
        <div>

            <div>

                <form>
                    <input type="hidden" name="type" id="type" value="city">

                    <div>
                        <label for="city_name">city</label>
                        <input type="text" name="city_name" id="city_name">
                    </div>

                    <button type="submit">sök</button>
                </form>

                <div class="output">

                </div>

            </div>

        </div>
    </body>
</html>
