<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Jenis extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];
    protected $table = 'jenis';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'jenis'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function kriteria_nilai()
    {
        return $this->hasMany(KriteriaNilai::class);
    }
}
