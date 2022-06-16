<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserChatMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_chat_message', function (Blueprint $table) {
            $table->id();
            $table->integer('chat_id');
            $table->integer('user_id');
            $table->integer('to_id');
            $table->string('content',255);
            $table->tinyInteger('msg_type')->default(1);
            $table->integer('created_at',false,true)->default(0);
            $table->integer('updated_at',false,true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_chat_message');
    }
}
