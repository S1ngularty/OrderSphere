<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('fname');
            $table->string('lname');
            $table->integer('age');
            $table->enum('gender',['male','female']);
            $table->string('address');
            $table->string('contact');
            $table->string('pfp')->nullable();
            $table->timestamps();

            $table->unique(['fname','lname']);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
