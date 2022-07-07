<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama_siswa');
            $table->string('alternatif')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('no_telp');
            $table->string('alamat');
            $table->year('tahun_masuk');
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan']);
            $table->string('avatar');
            $table->unsignedBigInteger('kelas_id');

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign('kelas_id');
        });

        Schema::dropIfExists('siswa');
    }
};
