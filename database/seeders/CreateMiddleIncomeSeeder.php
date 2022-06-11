<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Logo;
use App\Models\MiddleIncome;
use App\Models\Permission;
use App\Models\Slider;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateMiddleIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MiddleIncome::insert([
            [
                "name" => "5 - 10 Triệu",
            ],
            [
                "name" => "10 - 20 Triệu",
            ],
            [
                "name" => "> 20 Triệu",
            ]
        ]);
    }
}
