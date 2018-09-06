<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuickBloxUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_blox_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('chat_id')->nullable();
            $table->string('phone')->nullable();
            $table->json('custom')->nullable();
            $table->text('tags')->nullable();

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
        Schema::dropIfExists('quick_blox_users');
    }
}
