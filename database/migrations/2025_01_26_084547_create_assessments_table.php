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
        Schema::create('assessments', function (Blueprint $table) {
		$table->id();
		$table->foreignId('user_id')->constrained()->onDelete('cascade'); 
		$table->date('assessment_date');
		$table->string('qualification');
		$table->string('no_of_pax');
		$table->enum('training_status', ['scholar','non-scholar'])->default('scholar');
		$table->enum('status', ['pending','return','approved'])->default('pending');
		$table->string('type_of_scholar');
		$table->timestamp('update_awareness')->nullable();
		$table->string('eltt');
		$table->string('rfftp');
		$table->string('oropfafns');
		$table->string('sopcctvr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};