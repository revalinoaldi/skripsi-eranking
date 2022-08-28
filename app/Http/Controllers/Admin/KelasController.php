<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = [
            'title' => 'Kelas '.auth()->user()->level->level.' Pages',
            'data' => [
                'kelas' => Kelas::orderBy('nama_kelas', 'ASC')->get(),
            ]
        ];
        return view('admin.kelas.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Kelas '.auth()->user()->level->level.' Pages',
            'data' => [

            ]
        ];
        return view('admin.kelas.form', $config);
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
            'nama_kelas' => 'required',
        ]);

        $valid['slug'] = SlugService::createSlug(Kelas::class, 'slug', $valid['nama_kelas']);
        $is_success = Kelas::create($valid);
        if ($is_success) {
            return redirect('/admin/kelas')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Tahun Ajaran!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/kelas/create')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data Tahun Ajaran! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kela)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        $config = [
            'title' => 'Form Kelas '.auth()->user()->level->level.' Pages',
            'data' => [
                'kelas' => $kela
            ]
        ];
        return view('admin.kelas.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $valid = $request->validate([
            'nama_kelas' => 'required',
        ]);

        $valid['slug'] = SlugService::createSlug(Kelas::class, 'slug', $valid['nama_kelas']);
        $is_success = Kelas::where('id', $kela->id)->update($valid);
        if ($is_success) {
            return redirect('/admin/kelas')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Update Data Kelas!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect("/admin/kelas/{$kela->slug}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data Kelas! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        $is_success = Kelas::destroy($kela->id);
        if ($is_success) {
            return redirect('/admin/kelas')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Kelas : '. $kela->nama_kelas .' Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/kelas")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete !</h4>
                Data Kelas : '. $kela->nama_kelas .' Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
