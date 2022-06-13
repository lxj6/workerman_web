<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirendGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firend_group', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('group_name')->default('');
            $table->tinyInteger('is_default')->default(1);
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
        Schema::dropIfExists('firend_group');
    }
}
