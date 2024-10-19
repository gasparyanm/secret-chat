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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('recipient');
            $table->timestamp('expires_at')->nullable();
            $table->string('decryption_key');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            // Add unique index on recipient and decryption_key
            $table->unique(['recipient', 'decryption_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
