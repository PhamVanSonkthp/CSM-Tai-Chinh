<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Logo;
use App\Models\Permission;
use App\Models\Slider;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateEducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EducationLevel::insert([
            [
                "name" => "Trung học phổ thông",
            ],
            [
                "name" => "Đại học",
            ]
        ]);
    }
}
