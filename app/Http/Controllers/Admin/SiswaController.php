<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiswaValidation;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::latest();

        if(@request('kelas')){
            $siswa->whereHas('kelas', function(Builder $query){
                $query->where('slug', request('kelas'));
            });
        }

        $config = [
            'title' => 'Siswa '.auth()->user()->level->level.' Pages',
            'data' => [
                'siswa' => $siswa->get(),
                'kelas' => Kelas::get()
            ],
        ];

        return view('admin.siswa.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Input Siswa '.auth()->user()->level->level.' Pages',
            'data' => [
                'kelas' => Kelas::get()
            ]
        ];
        return view('admin.siswa.form', $config);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaValidation $request)
    {
        $valid = $request->validated();

        $getCek = explode(' ', $valid['nama_siswa']);
        $valid['alternatif'] = '';
        foreach ($getCek as $key => $val) {
            $valid['alternatif'] .= substr($val, 0, 1);
        }
        $valid['alternatif'] .= substr($valid['nis'], (int)(strlen($valid['nis'])-3), (int)(strlen($valid['nis'])));
        // dd($valid);
        $is_success = Siswa::create($valid);
        if ($is_success) {
            return redirect('/admin/siswa')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data Siswa!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/siswa/create')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data Siswa! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $config = [
            'title' => 'Form Input Siswa '.auth()->user()->level->level.' Pages',
            'data' => [
                'siswa' => $siswa,
                'kelas' => Kelas::get()
            ]
        ];
        return view('admin.siswa.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $valid = $request->validate([
            'nama_siswa' => 'required|string|min:3',
            'no_telp' => 'required|min:11',
            'alamat' => 'required|string|min:5',
            'tahun_masuk' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required'
        ]);

        $valid['nis'] = $request->nis;

        $getCek = explode(' ', $valid['nama_siswa']);
        $valid['alternatif'] = '';
        foreach ($getCek as $key => $val) {
            $valid['alternatif'] .= substr($val, 0, 1);
        }
        $valid['alternatif'] .= substr($valid['nis'], (int)(strlen($valid['nis'])-3), (int)(strlen($valid['nis'])));

        if($valid['nis'] != $siswa->nis){
            return redirect("/admin/siswa/{$siswa->nis}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data Siswa! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }

        $is_success = Siswa::where('nis', $siswa->nis)->update($valid);
        if ($is_success) {
            return redirect('/admin/siswa')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Update Data Siswa : '. $valid['nama_siswa'] .'!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect("/admin/siswa/{$siswa->nis}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data Siswa! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $is_success = Siswa::destroy($siswa->id);
        if ($is_success) {
            return redirect('/admin/siswa')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data Siswa : '. $siswa->nama_siswa .' Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/siswa")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete !</h4>
                Data Siswa : '. $siswa->nama_siswa .' Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
