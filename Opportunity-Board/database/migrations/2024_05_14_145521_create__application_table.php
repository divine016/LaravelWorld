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
        Schema::create('_application', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('purpose');
            $table->string('link');
            $table->string('email');

            $table->string('phone');

            $table->string('opportunity_id');
            $table->string('creator_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_application');
    }
};
