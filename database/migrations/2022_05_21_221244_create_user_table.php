<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('user_name','20');
            $table->string('password','60');
            $table->string('chat_id','20')->default('');
            $table->string('phone','11')->default('');
            $table->integer('created_at',false,true)->default(0);
            $table->integer('updated_at',false,true)->default(0);
            $table->index('phone');
            $table->index('chat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
