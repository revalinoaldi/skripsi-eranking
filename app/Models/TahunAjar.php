<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TahunAjar extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $table = 'tahun_ajar';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'tahun_ajar'
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
}
