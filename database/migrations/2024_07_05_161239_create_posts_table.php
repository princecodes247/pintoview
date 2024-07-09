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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('content');
            $table->string('password')->nullable();
            $table->timestamp('expiration_time')->nullable();
            $table->integer('view_limit')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_hidden')->default(false);
            $table->timestamp('hidden_until')->nullable();
            $table->unsignedBigInteger('template_id')->nullable();
            $table->string('short_link')->unique();
            $table->timestamps();

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
        Schema::dropIfExists('posts');
    }
};
