<?php

namespace App\Http\Controllers;

use App\Models\mapels;
use App\Models\smt;
use App\Models\trx_mapel;
use App\Models\mst_siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumMapel = mapels::count();
        $jumSis = mst_siswa::count();

        return view('dashboard', compact(['jumMapel', 'jumSis']));
    }

    public function inputSiswa()
    {
        return view('admin/formInput');
    }

    public function save(Request $request)
    {
        $simpan = new mst_siswa;
        $simpan->nama = $request->input('nsis');
        $simpan->kls = $request->input('kls');
        $simpan->almt = $request->input('almt');
        $simpan->na = $request->input('Na');
        $simpan->ni = $request->input('Ni');
        $simpan->pa = $request->input('Pa');
        $simpan->pi = $request->input('Pi');
        $simpan->hp = $request->input('hp');
        $simpan->save();

        return back();
    }
}
