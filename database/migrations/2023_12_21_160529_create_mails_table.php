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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Mailbox::class);
            $table->string('uid');
            $table->string('subject');
            $table->mediumText('body');
            $table->fullText('body');
            $table->string('from');
            $table->string('from_hash');
            $table->string('from_name');
            $table->string('to');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
