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
        Schema::create('akuns', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['admin'])->default('admin');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('umur');
            $table->enum('jk', ['L', 'P']);
            $table->foreignId('akun_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tess', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_tes');
            $table->string('institusi')->nullable();
            $table->decimal('tungkai_kanan', 5, 2);
            $table->decimal('tungkai_kiri', 5, 2);
            $table->string('keterangan')->nullable();
            $table->decimal('selisih_anterior', 5, 2);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('data_kanans', function (Blueprint $table) {
            $table->id();
            $table->decimal('a1', 5, 2);
            $table->decimal('a2', 5, 2);
            $table->decimal('a3', 5, 2);
            $table->decimal('am1', 5, 2);
            $table->decimal('am2', 5, 2);
            $table->decimal('am3', 5, 2);
            $table->decimal('m1', 5, 2);
            $table->decimal('m2', 5, 2);
            $table->decimal('m3', 5, 2);
            $table->decimal('pm1', 5, 2);
            $table->decimal('pm2', 5, 2);
            $table->decimal('pm3', 5, 2);
            $table->decimal('p1', 5, 2);
            $table->decimal('p2', 5, 2);
            $table->decimal('p3', 5, 2);
            $table->decimal('pl1', 5, 2);
            $table->decimal('pl2', 5, 2);
            $table->decimal('pl3', 5, 2);
            $table->decimal('l1', 5, 2);
            $table->decimal('l2', 5, 2);
            $table->decimal('l3', 5, 2);
            $table->decimal('al1', 5, 2);
            $table->decimal('al2', 5, 2);
            $table->decimal('al3', 5, 2);
            $table->foreignId('tes_id')->constrained('tess')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('data_kiris', function (Blueprint $table) {
            $table->id();
            $table->decimal('a1', 5, 2);
            $table->decimal('a2', 5, 2);
            $table->decimal('a3', 5, 2);
            $table->decimal('am1', 5, 2);
            $table->decimal('am2', 5, 2);
            $table->decimal('am3', 5, 2);
            $table->decimal('m1', 5, 2);
            $table->decimal('m2', 5, 2);
            $table->decimal('m3', 5, 2);
            $table->decimal('pm1', 5, 2);
            $table->decimal('pm2', 5, 2);
            $table->decimal('pm3', 5, 2);
            $table->decimal('p1', 5, 2);
            $table->decimal('p2', 5, 2);
            $table->decimal('p3', 5, 2);
            $table->decimal('pl1', 5, 2);
            $table->decimal('pl2', 5, 2);
            $table->decimal('pl3', 5, 2);
            $table->decimal('l1', 5, 2);
            $table->decimal('l2', 5, 2);
            $table->decimal('l3', 5, 2);
            $table->decimal('al1', 5, 2);
            $table->decimal('al2', 5, 2);
            $table->decimal('al3', 5, 2);
            $table->foreignId('tes_id')->constrained('tess')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('normalisasis', function (Blueprint $table) {
            $table->id();
            $table->decimal('a_ka', 5, 2);
            $table->decimal('a_ki', 5, 2);
            $table->decimal('am_ka', 5, 2);
            $table->decimal('am_ki', 5, 2);
            $table->decimal('m_ka', 5, 2);
            $table->decimal('m_ki', 5, 2);
            $table->decimal('pm_ka', 5, 2);
            $table->decimal('pm_ki', 5, 2);
            $table->decimal('p_ka', 5, 2);
            $table->decimal('p_ki', 5, 2);
            $table->decimal('pl_ka', 5, 2);
            $table->decimal('pl_ki', 5, 2);
            $table->decimal('l_ka', 5, 2);
            $table->decimal('l_ki', 5, 2);
            $table->decimal('al_ka', 5, 2);
            $table->decimal('al_ki', 5, 2);
            $table->foreignId('tes_id')->constrained('tess')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('composite_scores', function (Blueprint $table) {
            $table->id();
            $table->decimal('a_ka', 5, 2);
            $table->decimal('a_ki', 5, 2);
            $table->decimal('am_ka', 5, 2);
            $table->decimal('am_ki', 5, 2);
            $table->decimal('m_ka', 5, 2);
            $table->decimal('m_ki', 5, 2);
            $table->decimal('pm_ka', 5, 2);
            $table->decimal('pm_ki', 5, 2);
            $table->decimal('p_ka', 5, 2);
            $table->decimal('p_ki', 5, 2);
            $table->decimal('pl_ka', 5, 2);
            $table->decimal('pl_ki', 5, 2);
            $table->decimal('l_ka', 5, 2);
            $table->decimal('l_ki', 5, 2);
            $table->decimal('al_ka', 5, 2);
            $table->decimal('al_ki', 5, 2);
            $table->string('csl');
            $table->string('csr');
            $table->foreignId('tes_id')->constrained('tess')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composite_scores');
        Schema::dropIfExists('normalisasis');
        Schema::dropIfExists('data_kalans');
        Schema::dropIfExists('data_kiris');
        Schema::dropIfExists('data_kanans');
        Schema::dropIfExists('tess');
        Schema::dropIfExists('users');
        Schema::dropIfExists('akuns');
    }
};
