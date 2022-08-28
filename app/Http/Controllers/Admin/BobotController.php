<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BobotNilai;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = [
            'title' => 'Bobot Penilaian '.auth()->user()->level->level.' Pages',
            'data' => [
                'bobot' => BobotNilai::get(),
            ]
        ];
        return view('admin.bobot.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Bobot Penilaian '.auth()->user()->level->level.' Pages',
            'data' => [

            ]
        ];
        return view('admin.bobot.form', $config);
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
            'keterangan' => 'required|min:3',
            'min_nilai' => 'required|integer'
        ]);

        $valid['slug'] = SlugService::createSlug(BobotNilai::class, 'slug', $valid['keterangan']);
        $is_success = BobotNilai::create($valid);
        if ($is_success) {
            return redirect('/admin/kriteria/bobot')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Kriteria Bobot!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/kriteria/bobot/create')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data Kriteria Bobot! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BobotNilai  $bobot
     * @return \Illuminate\Http\Response
     */
    public function show(BobotNilai $bobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BobotNilai  $bobot
     * @return \Illuminate\Http\Response
     */
    public function edit(BobotNilai $bobot)
    {
        $config = [
            'title' => 'Form Kriteria Penilaian '.auth()->user()->level->level.' Pages',
            'data' => [
                'bobot' => $bobot,
            ]
        ];
        return view('admin.bobot.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BobotNilai  $bobot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BobotNilai $bobot)
    {
        $valid = $request->validate([
            'keterangan' => 'required|min:3',
            'min_nilai' => 'required|integer'
        ]);

        $valid['slug'] = SlugService::createSlug(BobotNilai::class, 'slug', $valid['keterangan']);
        $is_success = BobotNilai::where('id', $bobot->id)->update($valid);
        if ($is_success) {
            return redirect('/admin/kriteria/bobot')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Update Data Kriteria Bobot!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect("/admin/kriteria/bobot/{$bobot->slug}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data Kriteria Bobot! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BobotNilai  $bobot
     * @return \Illuminate\Http\Response
     */
    public function destroy(BobotNilai $bobot)
    {
        $is_success = BobotNilai::destroy($bobot->id);
        if ($is_success) {
            return redirect('/admin/kriteria/bobot')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Bobot Penilaian : '. $bobot->keterangan .' Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/kriteria/bobot")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete !</h4>
                Data Bobot Penilaian : '. $bobot->keterangan .' Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
