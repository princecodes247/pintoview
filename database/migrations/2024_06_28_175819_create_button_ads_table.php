<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('button_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('placement', ['top', 'bottom']);
            $table->longText('direct_link')->nullable();
            $table->boolean('is_paused')->default(false);
            $table->timestamps();
             
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('button_ads');
    }
};
