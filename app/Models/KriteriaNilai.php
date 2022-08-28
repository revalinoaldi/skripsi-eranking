<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class KriteriaNilai extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $table = 'kriteria_nilai';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'keterangan'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function detail_kriteria_penilaian_semester()
    {
        return $this->hasMany(DetailKriteriaPenilaianSemester::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
}
