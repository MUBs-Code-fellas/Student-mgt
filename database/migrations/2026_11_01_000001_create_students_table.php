<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->string('student_number')->unique();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('phone')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('students'); }
};
