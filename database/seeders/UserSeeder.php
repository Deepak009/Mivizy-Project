<?php

namespace Database\Seeders;

use DB;
use Hash;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Services\UserService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user_service = app(UserService::class);
        // Read JSON file
        $json = file_get_contents(__DIR__.'/../json/users.json');
	    //Decode JSON
        $payloads = json_decode($json, true);
        foreach ($payloads as $payload) {
            $user = $user_service->storeUser($payload, Role::ADMIN);
        }
    }
}
