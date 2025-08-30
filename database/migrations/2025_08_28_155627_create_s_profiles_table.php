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
        Schema::create('sprofiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // foreign key
            $table->integer('Index_no');
            $table->string('Name');
            $table->string('Faculty');
        $table->string('Department');
        $table->string('Address');
        $table->string('Blood_Group');
        $table->string('Medical_Condition');
        $table->string('Telephone');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_profiles');
    }
};
