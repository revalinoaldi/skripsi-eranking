<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Kelas extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $table = 'kelas';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_kelas'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function penilaian_semester()
    {
        return $this->hasMany(PenilaianSemester::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
