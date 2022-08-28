<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKriteriaPenilaianSemester extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'detail_kriteria_penilaian_semester';

    public function detail_penilaian_semester()
    {
        return $this->belongsTo(DetailPenilaianSemester::class);
    }

    public function kriteria_nilai()
    {
        return $this->belongsTo(KriteriaNilai::class);
    }
}
