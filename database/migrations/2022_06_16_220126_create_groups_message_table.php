<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_message', function (Blueprint $table) {
            $table->id();
            $table->integer('groups_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->string('content',255)->default('');
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
        Schema::dropIfExists('groups_message');
    }
}
