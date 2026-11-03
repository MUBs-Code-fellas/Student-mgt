<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('title');
            $t->text('description')->nullable();
            $t->unsignedTinyInteger('credits')->default(3);
            $t->foreignId('lecturer_id')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};
