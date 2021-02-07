<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $time         = DatabaseSeeder::milliseconds();
        $maxInsert    = 10000;
        $lastInserted = 0;
        $password     = Hash::make("123456");
        $saveItems    = [];

        for ($i = 0; $i < $maxInsert; $i++) {
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

            if ($i > 0 && ($i % 1000 == 0) || $i == ($maxInsert - 1)) {
                User::insert($saveItems);
                $saveItems = [];
            }
        }
    }
}
