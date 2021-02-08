<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static $MAX_INSERT = 1000000;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $time         = DatabaseSeeder::milliseconds();
        $lastInserted = 0;
        $password     = Hash::make("123456");
        $saveItems    = [];

        for ($i = 1; $i <= self::$MAX_INSERT; $i++) {
            if ((DatabaseSeeder::milliseconds() - $time) >= 1000) {
                $inserted = $i - $lastInserted;
                echo "i: $i, inserted: $inserted" . PHP_EOL;

                $lastInserted = $i;
                $time         = DatabaseSeeder::milliseconds();
            }

            $saveItems[] = [
                "firstname"  => "Test $i",
                "lastname"   => "User",
                "email"      => "test_$i@example.com",
                "password"   => $password,
                "user_token" => md5("test_$i@example.com"),
            ];

            if ($i > 0 && ($i % 1000 == 0) || $i == (self::$MAX_INSERT - 1)) {
                User::insert($saveItems);
                $saveItems = [];
            }
        }
    }
}
