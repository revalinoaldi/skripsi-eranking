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
        Schema::create('detail_kriteria_penilaian_semester', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dt_nilai_smt_id');
            $table->unsignedBigInteger('kriteria_nilai_id');
            $table->integer('skor')->nullable();
            $table->float('sub_skor')->nullable();

            $table->foreign('dt_nilai_smt_id')
                ->references('id')
                ->on('detail_penilaian_semester')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreign('kriteria_nilai_id')
                ->references('id')
                ->on('kriteria_nilai')
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
        Schema::table('detail_kriteria_penilaian_semester', function (Blueprint $table) {
            $table->dropForeign('dt_nilai_smt_id');
            $table->dropForeign('kriteria_nilai_id');
        });
        Schema::dropIfExists('detail_kriteria_penilaian_semester');
    }
};
