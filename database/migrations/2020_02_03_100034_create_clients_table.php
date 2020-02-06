<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cid');
            $table->string('phone1');
            $table->string('phone2')->default('')->nullable();
            $table->string('comment')->default('')->nullable();
            $table->string('qrcode');
            $table->boolean('s1')->default(0)->nullable();
            $table->boolean('s2')->default(0)->nullable();
            $table->boolean('s3')->default(0)->nullable();
            $table->boolean('s4')->default(0)->nullable();
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
        Schema::dropIfExists('clients');
    }
}
