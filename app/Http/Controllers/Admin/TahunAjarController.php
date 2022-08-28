<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = [
            'title' => 'Tahun Ajar '.auth()->user()->level->level.' Pages',
            'data' => [
                'tahunajar' => TahunAjar::orderBy('tahun_ajar', 'DESC')->get(),
            ]
        ];
        return view('admin.tahunajar.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Tahun Ajar '.auth()->user()->level->level.' Pages',
            'data' => [

            ]
        ];
        return view('admin.tahunajar.form', $config);
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
            'tahun_ajar' => 'required',
        ]);

        $valid['slug'] = SlugService::createSlug(TahunAjar::class, 'slug', $valid['tahun_ajar']);
        $is_success = TahunAjar::create($valid);
        if ($is_success) {
            return redirect('/admin/tahun-ajar')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Tahun Ajaran!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/tahun-ajar/create')->with('notif','
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
     * @param  \App\Models\TahunAjar  $tahun_ajar
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAjar $tahun_ajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAjar  $tahun_ajar
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAjar $tahun_ajar)
    {
        $config = [
            'title' => 'Form Tahun Ajar '.auth()->user()->level->level.' Pages',
            'data' => [
                'tahunajar' => $tahun_ajar
            ]
        ];
        return view('admin.tahunajar.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAjar  $tahun_ajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjar $tahun_ajar)
    {
        $valid = $request->validate([
            'tahun_ajar' => 'required',
        ]);

        $valid['slug'] = SlugService::createSlug(TahunAjar::class, 'slug', $valid['tahun_ajar']);
        $is_success = TahunAjar::create($valid);
        if ($is_success) {
            return redirect('/admin/tahun-ajar')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Tahun Ajaran!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect("/admin/tahun-ajar/{$tahun_ajar->slug}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data Tahun Ajaran! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAjar  $tahun_ajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAjar $tahun_ajar)
    {
        $is_success = TahunAjar::destroy($tahun_ajar->id);
        if ($is_success) {
            return redirect('/admin/tahun-ajar')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Tahun Ajaran : '. $tahun_ajar->tahun_ajar .' Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/tahun-ajar")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete !</h4>
                Data Tahun Ajaran : '. $tahun_ajar->tahun_ajar .' Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
