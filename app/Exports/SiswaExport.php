<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection
{
    protected $slug;
    public function __construct($slug = '') {
        $this->slug = $slug;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dataModul = Siswa::latest();

        if(@$this->slug){
            $dataModul->whereHas('kelas', function(Builder $query){
                $query->where('slug', $this->slug);
            });
        }
        return $dataModul;
    }
}
