<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\EducationLevel;
use App\Models\GenderUser;
use App\Models\Lend;
use App\Models\Logo;
use App\Models\Permission;
use App\Models\Slider;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateLendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lend::insert([
            [
                "interval" => "12",
                "interest_rate" => "1",
                "user_id" => "2",
                "purpose" => "Vay tiền test",
                "name_friend" => "name_friend",
                "phone_friend" => "phone_friend",
                "name" => "name",
                "identity_card_number" => "identity_card_number",
                "date_of_birth" => now(),
                "address" => "address",
                "education_level_id" => "1",
                "middle_income_id" => "1",
                "married_status_id" => "1",
                "work" => "work",
                "bank_id" => "1",
                "bank_number" => "bank_number",
                "bank_name" => "bank_name",
                "lend_money" => "30000000",
                "sign_image_name" => "sign_image_name",
                "sign_image_path" => "sign_image_path",
                "admin_id" => "1",
                "lend_status_id" => "1",
                "phone" => "phone",
                "feature_image_name" => "Ảnh",
                "feature_image_path" => "/storage/lend/PhPmo7ppH6yf5gzkAN9G.png",
                "created_at" => now(),
            ],
        ]);
    }
}
