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
        Schema::create('surat_disposisis', function (Blueprint $table) {

            $table->id();
        
            $table->foreignId('surat_id')
                ->constrained()
                ->cascadeOnDelete();
        
            $table->foreignId('from_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
        
            $table->foreignId('to_user_id')
                ->constrained('users')
                ->cascadeOnDelete();
        
            $table->enum('status',[
                'menunggu',
                'diteruskan',
                'revisi',
                'ditolak',
                'disetujui'
            ])->default('menunggu');
        
            $table->text('catatan')->nullable();
        
            $table->timestamp('dibaca_pada')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_disposisis');
    }
};
