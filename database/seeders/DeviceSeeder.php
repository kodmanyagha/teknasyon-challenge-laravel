<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $langs            = ['tr', 'en', 'de', 'nl'];
        $operationSystems = ['android', 'ios'];
        $appIds           = Application::pluck('id')->toArray();
        $maxUserId        = User::orderBy('id', 'desc')->limit(1)->first()->id;
        $time             = DatabaseSeeder::milliseconds();
        $maxInsert        = 100000;
        $lastInserted     = 0;
        $saveItems        = [];

        for ($i = 0; $i < $maxInsert; $i++) {
            if ((DatabaseSeeder::milliseconds() - $time) >= 1000) {
                $inserted = $i - $lastInserted;
                echo "i: $i, inserted: $inserted" . PHP_EOL;

                $lastInserted = $i;
                $time         = DatabaseSeeder::milliseconds();
            }

            $lang  = $langs[array_rand($langs, 1)];
            $os    = $operationSystems[array_rand($operationSystems, 1)];
            $appId = $appIds[array_rand($appIds, 1)];

            $saveItems[] = [
                "user_id"          => ($i <= $maxUserId) ? $i : null,
                "application_id"   => $appId,
                "uid"              => md5(microtime(true) . $lang . $appId . $os . $i),
                "language"         => $lang,
                "operation_system" => $os,
                "client_token"     => md5(microtime(true) . $appId . $lang . $os . $i),
            ];

            if ($i > 0 && ($i % 1000 == 0) || $i == ($maxInsert - 1)) {
                Device::insert($saveItems);
                $saveItems = [];
            }
        }
    }
}
