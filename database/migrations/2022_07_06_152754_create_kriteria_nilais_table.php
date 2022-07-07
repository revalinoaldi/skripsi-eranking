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
        Schema::create('kriteria_nilai', function (Blueprint $table) {
            $table->id();
            $table->string('kode',3);
            $table->string('keterangan');
            $table->string('slug');
            $table->string('bobot');
            $table->float('bobotnilai')->default(0.0);
            $table->unsignedBigInteger('jenis_id');

            $table->foreign('jenis_id')
                ->references('id')
                ->on('jenis')
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
        Schema::table('kriteria_nilai', function (Blueprint $table) {
            $table->dropForeign('jenis_id');
        });
        Schema::dropIfExists('kriteria_nilai');
    }
};
