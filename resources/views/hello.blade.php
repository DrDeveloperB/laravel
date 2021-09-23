<?php
echo 'Nice to meet you';
echo '<br>';

echo "<xmp>";
print_r(env('BUGSNAG_API_KEY'));
echo "</xmp>";

echo "<xmp>";
print_r(config('database.default'));
echo "</xmp>";

echo "<xmp>";
print_r(config('database.connections.mysql'));
echo "</xmp>";

echo "<xmp>";
print_r(session()->all());
echo "</xmp>";

echo "<xmp>";
print_r(session()->get('_token'));
echo "</xmp>";

echo "<xmp>";
print_r(app('env'));
echo "</xmp>";

//if (session()->get('_token') === 'lxoJeFCwqi3ls6K2dEVfN0qlDIMBIOzsnFahwT8V') {
//    echo "<xmp>";
//    print_r('token is true');
//    echo "</xmp>";
//
//    app('env');
//}
//
//echo "<xmp>";
//print_r(env('APP_ENV'));
//echo "</xmp>";

