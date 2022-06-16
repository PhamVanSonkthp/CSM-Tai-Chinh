<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'identity_card_number' => 'identity_card_number',
                'phone' => '000333111',
                'email' => 'admin',
                'date_of_birth' => '1999/04/18',
                'password' => '$2y$10$sr.4gc0Gpv.t5nvrFA3maOJI/dTS3SNL1fKC7SvGfuGdQlOHffBAy',
                'is_admin'=> 2,
                'education_level_id'=> 1,
                'married_status_id'=> 1,
                'work'=> 'work',
                'telegram_support'=> 'telegram1',
            ],
            [
                'name' => 'user',
                'identity_card_number' => 'identity_card_number',
                'phone' => '000333111',
                'email' => 'user',
                'date_of_birth' => '1999/04/18',
                'password' => '$2y$10$sr.4gc0Gpv.t5nvrFA3maOJI/dTS3SNL1fKC7SvGfuGdQlOHffBAy',
                'is_admin'=> 0,
                'education_level_id'=> 1,
                'married_status_id'=> 1,
                'work'=> 'work',
                'telegram_support'=> null,
            ],
        ]);

    }
}
