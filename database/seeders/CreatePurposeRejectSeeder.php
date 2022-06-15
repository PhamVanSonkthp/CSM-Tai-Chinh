<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Logo;
use App\Models\Permission;
use App\Models\PurposeReject;
use App\Models\Slider;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreatePurposeRejectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurposeReject::insert([
            [
                "name" => "Sai thông tin liên kết ví",
            ],
            [
                "name" => "Rút tiền sai phạm hợp đồng",
            ],
            [
                "name" => "Đóng băng cờ bạc",
            ],
            [
                "name" => "Điểm tín dụng chưa đủ",
            ],
            [
                "name" => "Hồ sơ bất cập",
            ],
            [
                "name" => "Đóng băng khoản vay",
            ],
        ]);
    }
}
