<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPenilaianSemester;
use App\Models\Kelas;
use App\Models\PenilaianSemester;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use PDF;

class RankingSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::leftJoin('detail_penilaian_semester', function($query){
            $query->on('siswa.id', '=', 'detail_penilaian_semester.siswa_id')
            ->orderBy('created_at', 'DESC');
        })
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id');

        if(@request('kelas')){
            $siswa->whereHas('kelas', function(Builder $query){
                $query->where('slug', request('kelas'));
            });
        }

        $config = [
            'title' => 'Penilaian Semester '.auth()->user()->level->level.' Pages',
            'data' => [
                'siswa' => $siswa
                            ->orderBy('total_rata_rata', 'DESC')
                            ->orderBy('nama_kelas', 'DESC')->get(),
                'kelas' => Kelas::get()
            ]
        ];
        return view('admin.penilaian.ranking', $config);
    }

    public function exportExcel(Request $request)
    {
        $dataModul = [];
        $title = '';
        if($request->modul == "siswa"){
            $dataModul = Siswa::latest();

            if(@$request->kelas){
                $dataModul->whereHas('kelas', function(Builder $query) use ($request){
                    $query->where('slug', $request->kelas);
                });
            }
            $title = "Export Siswa.xlxs";
        }elseif($request->modul == "siswa-berprestasi"){

        }elseif($request->modul == "guru"){

        }

    }

    public function exportPdf(Request $request)
    {
        $dataModul = [];
        $title = '';
        if($request->modul == "siswa"){
            $dataModul = Siswa::latest();

            if(@$request->kelas){
                $dataModul->whereHas('kelas', function(Builder $query) use ($request){
                    $query->where('slug', $request->kelas);
                });
            }

            $title = 'Data Siswa Periode '.date('Y');
            $config = [
                'title' => $title,
                'data' => [
                    'siswa' => $dataModul->get()
                ]
            ];

            $pdf = PDF::loadView('exports.pdf.siswa', $config);
            return $pdf->download('Export Siswa.pdf');
        }elseif($request->modul == "siswa-berprestasi"){

            $siswa = Siswa::leftJoin('detail_penilaian_semester', function($query){
                $query->on('siswa.id', '=', 'detail_penilaian_semester.siswa_id')
                ->orderBy('created_at', 'DESC');
            })
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id');

            if(@$request->kelas){
                $siswa->whereHas('kelas', function(Builder $query) use ($request){
                    $query->where('slug', $request->kelas);
                });
            }

            $config = [
                'title' => 'Siswa Berprestasi Periode ' . date('Y'),
                'data' => [
                    'siswa' => $siswa
                                ->limit(10)
                                ->orderBy('total_rata_rata', 'DESC')
                                ->get(),
                ]
            ];

            $pdf = PDF::loadView('exports.pdf.siswaBerprestasi', $config);
            return $pdf->download('Export Siswa Berprestasi.pdf');
        }elseif($request->modul == "guru"){

        }


    }
}
