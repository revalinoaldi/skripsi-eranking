<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'siswa';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function detail_penilaian_semester()
    {
        return $this->hasOne(DetailPenilaianSemester::class)->latest()->orderBy('total_rata_rata');
    }

    public function getRouteKeyName()
    {
        return 'nis';
    }
}
