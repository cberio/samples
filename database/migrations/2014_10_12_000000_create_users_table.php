<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_lozic_users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('email');
            $table->string('password')->nullable();
            $table->tinyInteger('device_type')->nullable(); // 1 for AOS, 4 for IOS
            $table->boolean('authentication_type')->default(1); // 1 for password verification, 0 for access token
            $table->text('registration_id')->nullable();
            $table->boolean('push_notification_format')->default(0); // 0 for (GCM/APN), 1 for PhoneGap
            $table->string('contact_number', 25)->nullable();
            $table->boolean('unread_count_type')->default(0); // 0 : do not show unread badge on app icon,
                                                                      // 1 : show unread badge on app icon
            $table->uuid('key')->nullable();
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
        Schema::dropIfExists('app_lozic_users');
    }
}
