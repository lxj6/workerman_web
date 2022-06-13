<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirendRequestRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firend_request_record', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->integer('to_id');
            $table->string('apply')->default('');
            $table->tinyInteger('state')->default(0)->comment('状态 -1-拒绝 0-未处理 1-同意');
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
        Schema::dropIfExists('firend_request_record');
    }
}
