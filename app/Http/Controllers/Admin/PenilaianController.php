<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\KriteriaNilai;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = [
            'title' => 'Kriteria Penilaian '.auth()->user()->level->level.' Pages',
            'data' => [
                'kriteria' => KriteriaNilai::get()
            ]
        ];
        return view('admin.kriteria.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Kriteria Penilaian '.auth()->user()->level->level.' Pages',
            'data' => [
                'jenis' => Jenis::get()
            ]
        ];
        return view('admin.kriteria.form', $config);
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
            'kode' => 'required|unique:kriteria_nilai,kode',
            'keterangan' => 'required|min:3',
            'bobot' => 'required|integer',
            'jenis_id' => 'required',
        ]);

        $valid['slug'] = SlugService::createSlug(KriteriaNilai::class, 'slug', $valid['keterangan']);
        $valid['bobotnilai'] = (float)($valid['bobot']/100);
        $is_success = KriteriaNilai::create($valid);
        if ($is_success) {
            return redirect('/admin/kriteria/penilaian')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Kriteria Penilaian!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/kriteria/penilaian/create')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data Kriteria Penilaian! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KriteriaNilai  $kriteriaNilai
     * @return \Illuminate\Http\Response
     */
    public function show(KriteriaNilai $kriteriaNilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KriteriaNilai  $kriteriaNilai
     * @return \Illuminate\Http\Response
     */
    public function edit(KriteriaNilai $penilaian)
    {
        $config = [
            'title' => 'Form Kriteria Penilaian '.auth()->user()->level->level.' Pages',
            'data' => [
                'jenis' => Jenis::get(),
                'kriteria' => $penilaian
            ]
        ];

        return view('admin.kriteria.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KriteriaNilai  $kriteriaNilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KriteriaNilai $penilaian)
    {
        $valid = $request->validate([
            'kode' => 'required',
            'keterangan' => 'required|min:3',
            'bobot' => 'required|integer',
            'jenis_id' => 'required',
        ]);

        $valid['slug'] = SlugService::createSlug(KriteriaNilai::class, 'slug', $valid['keterangan']);
        $valid['bobotnilai'] = (float)($valid['bobot']/100);

        $is_success = KriteriaNilai::where('id', $penilaian->id)->update($valid);

        if ($is_success) {
            return redirect('/admin/kriteria/penilaian')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Update Data Kriteria Penilaian!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect("/admin/kriteria/penilaian/{$penilaian->slug}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data Kriteria Penilaian! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KriteriaNilai  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(KriteriaNilai $penilaian)
    {
        $is_success = KriteriaNilai::destroy($penilaian->id);
        if ($is_success) {
            return redirect('/admin/kriteria/penilaian')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Kriteria : '. $penilaian->keterangan .' Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/kriteria/penilaian")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete !</h4>
                Data Kriteria : '. $penilaian->keterangan .' Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
