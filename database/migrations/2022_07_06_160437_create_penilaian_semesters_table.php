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
        Schema::create('penilaian_semester', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penilaian',10)->unique();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajar_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tahun_ajar_id')
                ->references('id')
                ->on('tahun_ajar')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::table('penilaian_semester', function (Blueprint $table) {
            $table->dropForeign('kelas_id');
            $table->dropForeign('tahun_ajar_id');
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('penilaian_semester');
    }
};
