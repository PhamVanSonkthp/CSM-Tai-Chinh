<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Logo;
use App\Models\Permission;
use App\Models\RequestPaymentWallet;
use App\Models\Slider;
use App\Models\StatusRequestPaymentWallet;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateRequestPaymentWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestPaymentWallet::create(
            [
                "money" => "30000000",
                "user_id" => "3",
            ],
        );
    }
}
