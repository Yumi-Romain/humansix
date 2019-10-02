<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'admin',
            'password' => hash('sha256', 'S3cr3T+'),
            'api_token' => bin2hex(openssl_random_pseudo_bytes(32))
        ]);
    }
}
