<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('groups_name',255)->default('');
            $table->string('icon',255)->default('');
            $table->string('notice',255)->default('')->default('群公告');
            $table->string('intro',255)->default('')->comment('群简介');
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
        Schema::dropIfExists('groups');
    }
}
