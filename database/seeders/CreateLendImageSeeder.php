<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Lend;
use App\Models\LendImage;
use App\Models\Logo;
use App\Models\Permission;
use App\Models\Slider;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateLendImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LendImage::insert([
            [
                "lend_id" => "1",
                "image_name" => "Ảnh trước CMND",
                "image_path" => "/storage/lend/PhPmo7ppH6yf5gzkAN9G.png",
            ],
            [
                "lend_id" => "1",
                "image_name" => "Ảnh sau CMND",
                "image_path" => "/storage/lend/PhPmo7ppH6yf5gzkAN9G.png",
            ],
        ]);
    }
}
