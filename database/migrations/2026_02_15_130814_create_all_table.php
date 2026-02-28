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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('nama')->unique();
            $table->string('umur');
            $table->enum('jk', ['L', 'P']);
            $table->string('institusi')->nullable();
            $table->decimal('panjang_tungkai', 5,2);
            $table->string('keterangan')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tess', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tes');
            $table->integer('composite_score');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('datas', function (Blueprint $table) {
            $table->id();
            $table->char('putaran', 2);
            $table->decimal('a_ka', 5,2);
            $table->decimal('a_ki', 5,2);
            $table->decimal('am_ka', 5,2);
            $table->decimal('am_ki', 5,2);
            $table->decimal('m_ka', 5,2);
            $table->decimal('m_ki', 5,2);
            $table->decimal('pm_ka', 5,2);
            $table->decimal('pm_ki', 5,2);
            $table->decimal('p_ka', 5,2);
            $table->decimal('p_ki', 5,2);
            $table->decimal('pl_ka', 5,2);
            $table->decimal('pl_ki', 5,2);
            $table->decimal('l_ka', 5,2);
            $table->decimal('l_ki', 5,2);
            $table->decimal('al_ka', 5,2);
            $table->decimal('al_ki', 5,2);
            $table->foreignId('tes_id')->constrained('tess')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('hasil_normalisasis', function (Blueprint $table) {
            $table->id();
            $table->decimal('a_ka', 5,2);
            $table->decimal('a_ki', 5,2);
            $table->decimal('am_ka', 5,2);
            $table->decimal('am_ki', 5,2);
            $table->decimal('m_ka', 5,2);
            $table->decimal('m_ki', 5,2);
            $table->decimal('pm_ka', 5,2);
            $table->decimal('pm_ki', 5,2);
            $table->decimal('p_ka', 5,2);
            $table->decimal('p_ki', 5,2);
            $table->decimal('pl_ka', 5,2);
            $table->decimal('pl_ki', 5,2);
            $table->decimal('l_ka', 5,2);
            $table->decimal('l_ki', 5,2);
            $table->decimal('al_ka', 5,2);
            $table->decimal('al_ki', 5,2);
            $table->foreignId('tes_id')->constrained('tess')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_normalisasis');
        Schema::dropIfExists('datas');
        Schema::dropIfExists('tess');
        Schema::dropIfExists('users');
    }
};
