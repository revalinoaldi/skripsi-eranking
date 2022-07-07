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
        Schema::create('detail_penilaian_semester', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penilaian_semester_id');
            $table->unsignedBigInteger('siswa_id');
            $table->float('total_rata_rata')->nullable();
            $table->unsignedBigInteger('bobot_nilai_id')->nullable();

            $table->foreign('penilaian_semester_id')
                ->references('id')
                ->on('penilaian_semester')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('bobot_nilai_id')
                ->references('id')
                ->on('bobot_nilai')
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
        Schema::table('detail_penilaian_semester', function (Blueprint $table) {
            $table->dropForeign('penilaian_semester_id');
            $table->dropForeign('siswa_id');
            $table->dropForeign('bobot_nilai_id');
        });
        Schema::dropIfExists('detail_penilaian_semester');
    }
};
