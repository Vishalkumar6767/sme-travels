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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('address');
            $table->string('mobile_1');
            $table->string('mobile_2');
            $table->string('mobile_3');
            $table->string('office_no');
            $table->string('email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('linkdin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
