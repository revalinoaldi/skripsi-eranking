<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest();

        if(@request('level')){
            $user->whereHas('level', function(Builder $query){
                $query->where('slug', request('level'));
            });
        }

        $config = [
            'title' => 'User Pengguna '.auth()->user()->level->level.' Pages',
            'data' => [
                'user' => $user->get(),
                'level' => Level::get()
            ]
        ];
        return view('admin.user.index', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = [
            'title' => 'Form Input User '.auth()->user()->level->level.' Pages',
            'data' => [
                'level' => Level::get()
            ]
        ];
        return view('admin.user.form', $config);
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
            'nama_user' => 'required|min:3',
            'username' => 'required|min:6|unique:users,username',
            'email' => 'required|email:dns,rfc|unique:users,email|min:10',
            'alamat' => 'required|min:5',
            'no_telp' => 'required',
            'password' => 'required|min:8',
            'level_id' => 'required',
        ]);

        $valid['password'] = Hash::make($valid['password']);

        $is_success = User::create($valid);
        if ($is_success) {
            return redirect('/admin/user')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Insert Data User Pengguna!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect('/admin/user/create')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Insert Data User Pengguna! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $config = [
            'title' => 'Form Input Users '.auth()->user()->level->level.' Pages',
            'data' => [
                'user' => $user,
                'level' => Level::get()
            ]
        ];
        return view('admin.user.form', $config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $valid = $request->validate([
            'nama_user' => 'required|min:3',
            'username' => 'required|min:6',
            'email' => 'required|email:dns,rfc|min:10',
            'alamat' => 'required|min:5',
            'no_telp' => 'required',
            'password' => 'required|min:8',
            'level_id' => 'required',
        ]);

        if($request->username != $user->username){
            return redirect("/admin/user/{$user->username}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data User Pengguna! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }

        $valid['password'] = Hash::make($valid['password']);
        $is_success = User::where('id', $user->id)->update($valid);
        if ($is_success) {
            return redirect('/admin/user')->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                <p><strong>Successfull!</strong> Successfull Update Data User Pengguna!</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }else{
            return redirect("/admin/user/{$user->username}/edit")->with('notif','
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                <p><strong>Errror!</strong> Error Update Data User Pengguna! Silahkan Coba Kembali.</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $is_success = User::destroy($user->id);
        if ($is_success) {
            return redirect('/admin/siswa')->with('notif','
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-check"></i> Successfull Delete!</h4>
                Data User : '. $user->nama_user .' Berhasil di Delete dari Record!
            </div>');
        }else{
            return redirect("/admin/siswa")->with('notif','
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-ban"></i> Unsuccessful Delete !</h4>
                Data User : '. $user->nama_user .' Gagal di Delete dari Record, silahkan periksa kembali!
            </div>');
        }
    }
}
