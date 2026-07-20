<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "User 1 cached presence: ";
var_dump(Illuminate\Support\Facades\Cache::get('online_user_1'));

echo "User 2 cached presence: ";
var_dump(Illuminate\Support\Facades\Cache::get('online_user_2'));

echo "User 3 cached presence: ";
var_dump(Illuminate\Support\Facades\Cache::get('online_user_3'));

echo "\nAll cache table entries count:\n";
try {
    echo "Count: " . Illuminate\Support\Facades\DB::table('cache')->count() . "\n";
    print_r(Illuminate\Support\Facades\DB::table('cache')->get()->toArray());
} catch (\Exception $e) {
    echo "Error querying cache table: " . $e->getMessage() . "\n";
}
