<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('identity_card_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('password');
            $table->bigInteger('user_status_id')->default(1);
            $table->bigInteger('education_level_id')->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->bigInteger('middle_income_id')->default(0);
            $table->bigInteger('married_status_id')->default(0);
            $table->string('work')->nullable();
            $table->bigInteger('wallet')->default(0);
            $table->integer('payment_status_id')->default(1);
            $table->string('telegram_support')->nullable();
            $table->string('fb_id')->nullable();
            $table->integer('max_client_day')->default(0);
            $table->string('otp')->nullable();
            $table->string('purpose')->nullable();
            $table->string('name_friend')->nullable();
            $table->string('phone_friend')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->bigInteger('bank_id')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
