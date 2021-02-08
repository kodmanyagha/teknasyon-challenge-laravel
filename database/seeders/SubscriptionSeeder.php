<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $operationSystems = ['android', 'ios'];
        $appIds           = Application::pluck('id')->toArray();
        $time             = DatabaseSeeder::milliseconds();
        $lastInserted     = 0;
        $saveItems        = [];

        for ($i = 1; $i <= UserSeeder::$MAX_INSERT; $i++) {
            if ((DatabaseSeeder::milliseconds() - $time) >= 1000) {
                $inserted = $i - $lastInserted;
                echo "i: $i, inserted: $inserted" . PHP_EOL;

                $lastInserted = $i;
                $time         = DatabaseSeeder::milliseconds();
            }
            $os    = $operationSystems[array_rand($operationSystems, 1)];
            $appId = $appIds[array_rand($appIds, 1)];

            $saveItems[] = [
                "user_id"          => $i,
                "application_id"   => $appId,
                "operation_system" => $os,
                "receipt"          => md5($i . microtime(true) . $appId . $os),
                "status"           => 'active',
                "expire_date"      => date('Y-m-d H:i:s')
            ];

            if ($i > 0 && ($i % 1000 == 0) || $i == (UserSeeder::$MAX_INSERT - 1)) {
                Subscription::insert($saveItems);
                $saveItems = [];
            }
        }
    }
}
