<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSemester extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'penilaian_semester';

    public function getRouteKeyName()
    {
        return 'kode_penilaian';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tahun_ajar()
    {
        return $this->belongsTo(TahunAjar::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function detail_penilaian_semester()
    {
        return $this->hasMany(DetailPenilaianSemester::class);
    }
}
