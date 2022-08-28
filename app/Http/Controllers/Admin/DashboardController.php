<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kelas = Kelas::get();
        $config = [
            'title' => 'Dashboard '.auth()->user()->level->level.' Pages',
            'count' => [
                'siswa' => Siswa::get()->count(),
                'guru' => User::where('active','1')->whereHas('level', function($query){
                    $query->where('slug','guru');
                })->get()->count(),
                'kelas' => $kelas->count()
            ],
            'kelas' => $kelas
        ];
        return view('admin.dashboard.index', $config);
    }
}
