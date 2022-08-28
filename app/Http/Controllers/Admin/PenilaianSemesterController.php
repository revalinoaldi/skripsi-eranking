<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailKriteriaPenilaianSemester;
use App\Models\DetailPenilaianSemester;
use App\Models\Kelas;
use App\Models\KriteriaNilai;
use App\Models\PenilaianSemester;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PenilaianSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penilaian = PenilaianSemester::latest();

        if(@request('kelas')){
            $penilaian->whereHas('kelas', function(Builder $query){
                $query->where('slug', request('kelas'));
            });
        }

        $config = [
            'title' => 'Penilaian Semester '.auth()->user()->level->level.' Pages',
            'data' => [
                'penilaian' => $penilaian->get(),
            ]
        ];
        return view('admin.penilaian.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Input Penilaian Semester '.auth()->user()->level->level.' Pages',
            'data' => [
                'kelas' => Kelas::get(),
                'tahun_ajar' => TahunAjar::latest()->get(),
                'user' => User::where('active', '1')->whereHas('level', function(Builder $query){
                    $query->where('slug', 'guru');
                })->get()
            ]
        ];
        return view('admin.penilaian.form', $config);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'kode_penilaian' => 'required|min:6|unique:penilaian_semester,kode_penilaian',
            'kelas_id' => 'required',
            'tahun_ajar_id' => 'required',
            'user_id' => 'required',
        ]);

        // Checking duplicate class and year of semester
        $where = [
            'kelas_id' => $valid['kelas_id'],
            'tahun_ajar_id' => $valid['tahun_ajar_id'],
        ];

        $check = PenilaianSemester::where($where)->count();
        if($check >= 1){
            return redirect('/admin/penilaian/kelas/create')->with('notif','
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Kelas pada Tahun Ajaran yang sama telah terdaftar! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
        // End Checking duplicate class and year of semester

        $is_success = PenilaianSemester::create($valid);
        if ($is_success) {
            return redirect('/admin/penilaian/kelas')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Kelas Penilaian!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/penilaian/kelas/create')->with('notif','
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data Kelas Penilaian! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenilaianSemester  $kela
     * @return \Illuminate\Http\Response
     */
    public function show(PenilaianSemester $kela)
    {
        $config = [
            'title' => 'Penilaian Semester Perkelas '.auth()->user()->level->level.' Pages',
            'data' => [
                'penilaian' => $kela,
                'siswa' => Siswa::where('kelas_id', $kela->kelas_id)->get(),
                'kriteria' => KriteriaNilai::get()
            ]
        ];

        return view('admin.penilaian.penilaian', $config);
    }

    public function penilaianSiswa(Request $request, PenilaianSemester $kela)
    {
        $normalisasiMatrix = [];
        $data = [];
        foreach ($request->item as $valItem) {

            foreach ($valItem['kriteria'] as $key => $val) {
                $normalisasiMatrix[$key] = (int)(@$normalisasiMatrix[$key] ? $normalisasiMatrix[$key] : 0)+pow($val['skor'], 2);
            }
        }

        foreach ($normalisasiMatrix as $key => $value) {
            $normalisasiMatrix[$key] = (float)number_format(sqrt($value), 2);
        }

        foreach ($request->item as $item => $valItem) {
            $data[$item] = [
                'penilaian_semester_id' => $request->kode,
                'siswa_id' => $valItem['siswa_id'],
                'total_rata_rata' => 0
            ];
            $subData = [];
            foreach ($valItem['kriteria'] as $key => $val) {
                $bobot = KriteriaNilai::where('id',$val['id'])->first()->toArray();
                $subData[] = [
                    'dt_nilai_smt_id' => 1,
                    'kriteria_nilai_id' => $val['id'],
                    'skor' => $val['skor'],
                    'jenis' => $val['jenis'],
                    'sub_skor' => (float)((float)number_format(sqrt(($val['skor']/$normalisasiMatrix[$key])), 2)*$bobot['bobot'])                ];
            }

            foreach ($subData as $sub) {
                if($sub['jenis'] == "benefit"){
                    $data[$item]['total_rata_rata'] += $sub['sub_skor'];
                }else{
                    $data[$item]['total_rata_rata'] -= $sub['sub_skor'];
                }
            }

            $data[$item]['kriteria'] = $subData;
        }
        // dd($data);

        foreach ($data as $dataKey) {
            $forDetailPenilaian = Arr::except($dataKey, 'kriteria');

            $checkSiswa = DetailPenilaianSemester::where('siswa_id', $forDetailPenilaian['siswa_id'])->where('total_rata_rata', '<>', NULL)->count();
            if($checkSiswa < 1){
                $insDetailPenilaian = DetailPenilaianSemester::create($forDetailPenilaian);

                $forDetailKriteriaPenilaian = Arr::only($dataKey, 'kriteria');
                foreach ($forDetailKriteriaPenilaian['kriteria'] as $kriteria) {
                    $forDataKriteria = Arr::except($kriteria, 'jenis');
                    $forDataKriteria['dt_nilai_smt_id'] = $insDetailPenilaian->id;
                    DetailKriteriaPenilaianSemester::create($forDataKriteria);
                }
            }
        }

        return redirect('/admin/penilaian/kelas')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Penilaian untuk Siswa!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenilaianSemester  $kela
     * @return \Illuminate\Http\Response
     */
    public function edit(PenilaianSemester $kela)
    {
        $config = [
            'title' => 'Form Input Penilaian Semester '.auth()->user()->level->level.' Pages',
            'data' => [
                'kelas' => Kelas::get(),
                'tahun_ajar' => TahunAjar::latest()->get(),
                'user' => User::where('active', '1')->whereHas('level', function(Builder $query){
                    $query->where('slug', 'guru');
                })->get(),
                'penilaian' => $kela
            ]
        ];
        return view('admin.penilaian.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenilaianSemester  $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenilaianSemester $kela)
    {
        $valid = $request->validate([
            'kelas_id' => 'required',
            'tahun_ajar_id' => 'required',
            'user_id' => 'required',
        ]);

        // Checking duplicate class and year of semester
        $where = [
            'kelas_id' => $valid['kelas_id'],
            'tahun_ajar_id' => $valid['tahun_ajar_id'],
        ];

        $check = PenilaianSemester::where($where)->count();
        if($check >= 1){
            return redirect('/admin/penilaian/kelas/create')->with('notif','
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Kelas pada Tahun Ajaran yang sama telah terdaftar! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }elseif($kela->kode_penilaian != $request->kode_penilaian){
            return redirect('/admin/penilaian/kelas/create')->with('notif','
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Data yang akan di update tidak sinkron! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
        // End Checking duplicate class and year of semester

        $is_success = PenilaianSemester::where('id', $kela->id)->update($valid);
        if ($is_success) {
            return redirect('/admin/penilaian/kelas')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Update Data Kelas Penilaian!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/penilaian/kelas/create')->with('notif','
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data Kelas Penilaian! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenilaianSemester  $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenilaianSemester $kela)
    {
        //
    }
}
