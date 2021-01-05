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
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->tinyInteger('type')->index();
            $table->tinyInteger('provider_type')->nullable()->index();
            $table->text('bio')->nullable();
            $table->string('work_time')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('app_locale')->default('en');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
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
