<?php

namespace App\Http\Controllers;

use DB;
use App\Models\smt;
use App\Models\kep;
use Carbon\Carbon;
use App\Models\siswa;
use App\Models\Kelas;
use App\Models\mapels;
use App\Models\trx_absen;
use App\Models\mst_siswa;
use App\Models\MapelKelas;
use App\Models\trx_nilai;
use App\Models\SIA;
use Illuminate\Http\Request;

class raporController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('rapor.Ckelas');
    }

    public function showSiswa(Request $request)
    {
        //dd($request);
        $nilai = trx_nilai::where([
            ['kelas_id', $request->kelas],
            ['smt', $request->smt]
        ])->get();

        return view('rapor.show', compact('nilai'));
    }

    public function cover($nis)
    {

        $siswa = siswa::where('nis', $nis)->first();

        return view('rapor.cover', compact('siswa'));
    }

    public function petunjuk()
    {
        return view('rapor.petunjuk');
    }

    public function nilai($nis)
    {
        $smt = smt::where('flag', 1)->first();
        $siswa = mst_siswa::where('nis', $nis)->first();
        $kls = mst_siswa::select('kls')->where('nis', $nis)->first();
		
		$mapel = MapelKelas::where([
            ['kelas_id', $kls->kls],
            ['smt', $smt->smt]
        ])->get();
        $nilai = trx_nilai::where([
            ['nis', $nis],
            ['smt', $smt->smt]
        ])->get();

        $rata = trx_nilai::where([
            ['smt', $smt->smt],
            ['kelas_id', $kls->kls]
        ])->get();

        $kep = kep::where([
            ['kelas_id', $kls->kls],
            ['nis', $nis]
        ])->first();

        $total = trx_nilai::select('nilai', 'mapel_id')->where('nis',$nis)->sum('nilai');
        $totalRata = trx_nilai::select('nilai')->where([
            ['kelas_id', $kls->kls],
            ['smt', $smt->smt]
        ])->avg('nilai');
        
        $sakit = SIA::select('sakit')->where('nis', $nis)->sum('sakit');
        $ijin = SIA::select('ijin')->where('nis', $nis)->sum('ijin');
        $alpa = SIA::select('alpha')->where('nis', $nis)->sum('alpha');
        
        // $sakit = trx_absen::where([
        //     ['ta', $smt->id],
        //     ['nis', $nis],
        //     ['ket', 2],
        // ])->count();

        // $ijin = trx_absen::where([
        //     ['ta', $smt->id],
        //     ['nis', $nis],
        //     ['ket', 3],
        // ])->count();

        // $alpa = trx_absen::where([
        //     ['ta', $smt->id],
        //     ['nis', $nis],
        //     ['ket', 4],
        // ])->count();

        return view('rapor.nilai', compact('mapel', 'nilai', 'rata', 'smt', 'siswa', 'total','totalRata','kep','sakit', 'ijin', 'alpa'));
    }

    public function keterangan($nis)
    {
        $bio = mst_siswa::where('nis', $nis)->first();
        return view('rapor.keterangan', compact('bio'));
    }

    public function kep()
    {
        $kelas = Kelas::all();
        $mapel = mapels::all();
        $smt = smt::where('flag', 1)->first();

        return view('rapor.kelas', compact('kelas', 'mapel', 'smt'));
    }

    public function formKep(Request $request)
    {
        $smt = smt::where('flag',1)->first();
        $jum = kep::select('id')->where([
            ['kelas_id', $request->kelas],
            ['smt', $smt->smt]
        ])->count();
        if($jum > 1) {
            $nilaiKep = kep::where([
                ['kelas_id',$request->kelas],
                ['smt',$request->smt]
            ])->get();
            return view('rapor.updateKep', compact('nilaiKep'));
        }else{
            $siswa = mst_siswa::where('kls', $request->kelas)->get();
            return view('rapor.formKep', compact('siswa'));
        }
    }

    public function simKep(Request $request)
    {
            $smt = smt::where('flag',1)->first();
            $siswa = mst_siswa::where('kls', $request->kelas)->get();
            foreach($siswa as $data){
                $simpan[] = array(
                    'nis'          => $request->input('nis'.$data->nis),
                    'kelakuan'     => $request->input('kelakuan'.$data->nis),
                    'kerajinan'    => $request->input('kerajinan'.$data->nis),
                    'kebersihan'   => $request->input('kebersihan'.$data->nis),
                    'kelas_id'     => $request->kelas,
                    'smt'          => $smt->smt,
                    'created_at'   => Carbon::now(),
                    'updated_at'   => Carbon::now()
                );
            }
            $save = DB::table('kep')->insert($simpan);

            return redirect('/rapor/kep')->with('status', 'Penyimpanan Kepribadian Berhasil');
    }

    public function update(Request $request)
    {
        $siswa = mst_siswa::where('kls', $request->kelas)->get();
        foreach($siswa as $data){
            $update = kep::where('nis', $request->input('nis'.$data->nis))->first();
            $update->kelakuan = $request->input('kelakuan'.$data->nis);
            $update->kerajinan = $request->input('kerajinan'.$data->nis);
            $update->kebersihan = $request->input('kebersihan'.$data->nis);
            $update->save();
        }
        return redirect('/rapor/kep')->with('status', 'Pengeditan Kepribadian Berhasil');
    }

    public function formSia()
    {
        $kelas = Kelas::all();

        return view('rapor.formKelas', compact('kelas'));
    }

    public function saveSIA(Request $request)
    {
        //dd($request);
        $kelas = mst_siswa::where('kls', $request->kelas)->get();
        $smt = smt::where('flag', 1)->first();
        
        return view('rapor.inputSIA', compact('kelas', 'smt'));
    }

    public function simSIA(Request $request)
    {
        //dd($request);
        $siswa_kelas = mst_siswa::where('kls', $request->kelas)->get();
        foreach($siswa_kelas as $data){
            $simpan = SIA::updateOrCreate(
                [
                    /* ini acuannya data atau primary key */
                    'nis'       => $data->nis,
                    'kelas_id'  => $request->input('kelas'),
                    'smt_id'    => $request->smt
                ],
                [
                    /* ini adalah data yang akan di update jika tidak maka akan di save */
                    'sakit' => $request->input('sakit'.$data->nis),
                    'ijin'  => $request->input('ijin'.$data->nis),
                    'alpha' => $request->input('alpha'.$data->nis),
                ]
            );
        }

        return redirect('/rapor/sia');
    }
}
