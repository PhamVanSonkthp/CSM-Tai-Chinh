<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lends', function (Blueprint $table) {
            $table->id();
            $table->integer('interval');
            $table->float('interest_rate');
            $table->bigInteger('user_id')->index();
            $table->string('purpose');
            $table->string('name_friend');
            $table->string('phone_friend');
            $table->string('name');
            $table->string('identity_card_number');
            $table->date('date_of_birth');
            $table->string('address');
            $table->bigInteger('education_level_id');
            $table->bigInteger('middle_income_id');
            $table->bigInteger('married_status_id');
            $table->string('work');
            $table->bigInteger('bank_id');
            $table->string('bank_number');
            $table->string('bank_name');
            $table->bigInteger('lend_money');
            $table->string('sign_image_name');
            $table->string('sign_image_path');
            $table->bigInteger('admin_id')->index();
            $table->bigInteger('lend_status_id')->default(1);
            $table->string('phone');
            $table->string('feature_image_name');
            $table->string('feature_image_path');
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
        Schema::dropIfExists('lends');
    }
}
