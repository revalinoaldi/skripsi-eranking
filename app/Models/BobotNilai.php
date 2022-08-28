<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BobotNilai extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];
    protected $table = 'bobot_nilai';


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

    public function detail_penilaian_semester()
    {
        return $this->hasMany(DetailPenilaianSemester::class);
    }
}
