<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaianSemester extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'detail_penilaian_semester';

    public function penilaian_semester()
    {
        return $this->belongsTo(PenilaianSemester::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function bobot_nilai()
    {
        return $this->belongsTo(BobotNilai::class);
    }

    public function detail_kriteria_penilaian_semester()
    {
        return $this->hasMany(DetailKriteriaPenilaianSemester::class);
    }
}
