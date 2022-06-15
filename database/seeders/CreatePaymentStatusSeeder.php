<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Logo;
use App\Models\PaymentStatus;
use App\Models\Permission;
use App\Models\PurposeReject;
use App\Models\Slider;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreatePaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::insert([
            [
                "name" => "Không thể rút",
            ],
            [
                "name" => "Có thể rút",
            ],
        ]);
    }
}
