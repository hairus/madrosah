<?php

namespace App\Http\Controllers;

use Excel;
use App\User;
use Carbon\Carbon;
use App\Models\ket;
use App\Models\smt;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\mapels;
use App\Models\trx_absen;
use App\Models\trx_nilai;
use App\Models\trx_mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if(isset($request->kelas))
        {
            $siswa = siswa::where('kls', $request->kelas)->OrderBy('nis', 'asc')->get();
        }

        $kelas = Kelas::all();

        return view('admin/formAb', compact('kelas', 'siswa'));
    }

    public function saveA(Request $request)
    {
        /*cek dulu di table absen ada data atau tidak di tanggal sekarang*/
        $smt = smt::select('id')->where('flag',1)->first();
        $cekAbsen = DB::table('trx_absen')
            ->where('kelas_id', $request->input('kelas_id'))
            ->whereMonth('created_at', date('m'))
            ->whereDay('created_at', date('d'))
            ->count();
        /*-----------------------------------------------------------------*/
        /*simpan jika tidak ada data */
       if($cekAbsen == 0)
       {
           /*cek ada berapa siswa yang ada id mst_siswa karena akan melakukan looping untuk penyimpanan*/

           $siswa = DB::table('mst_siswa')
               ->where('kls', $request->input('kelas_id'))
               ->get();
           foreach ($siswa as $siswas)
           {
               $data [] = array(
                   'nis'        => $request->input('nis'.$siswas->nis),
                   'kelas_id'   => $request->input('kelas_id'),
                   'ket'        => $request->input('radio'.$siswas->nis),
                   'ta'         => $smt->id,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
               );
           }
           $simpan = DB::table('trx_absen')->insert($data);
           return redirect('/admin/absen')->with('status', 'Penyimpanan berhasil');

       }
       else
       {
           return redirect('/admin/absen')->with('error', 'Penyimpanan Gagal');
       }

    }

    public function cek()
    {
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // jumlah hari saat ini


    }

    public function listSiswa(Request $request)
    {
        $kelas = DB::table('mst_kelas')->get();
        if(isset($_GET['kelas']))
        {
            $siswa = DB::table('mst_siswa')
                ->where('kls', $request->kelas)
                ->get();
        }

        return view('/admin/listSiswa', compact('kelas', 'siswa'));
    }

    public function cetak($id)
    {
        $siswa = DB::table('mst_siswa')
            ->where('id', $id)
            ->first();
        /*convert id siswa ke nis di table trx_absen*/
        $con = DB::table('trx_absen')
            ->where('nis', $siswa->nis)
            ->first();

        /* menghitung jumlah hari dalam bulan ini dengan menggunakan coding di bawah ini*/
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        /* pengambilan absen di database dengan bulan sekrang /
            -> ada berapa hari di bulan sekrang ?
            -> coding pertama di bawah ini adalah logika dimmana nis di bawah berada di hari apa saja
            -> tapi ingat dari kodingan tersebut masih berbentuk array
        */

        for($x = 1; $x <= $tanggal; $x++)
        {
            $absen[] = array(DB::table('trx_absen')
                ->whereDay('created_at', $x)
                ->whereMonth('created_at', date('m'))
                ->where('nis', $siswa->nis)
                ->first());
        }
        /*
         * karena data berbentuk arraya maka harus di pecah lagi contoh seperti ini
         */
            for($y = 0; $y < $tanggal; $y++)
            {
                $test[] = $absen[$y][0];
            }
        $try = $test;

        /*
         * menghitung jumlah sakit ijin dan alpa
         */
        $sakit = DB::table('trx_absen')
            ->where('nis', $con->nis)
            ->where('ket', '2')
            ->whereMonth('created_at', date('m'))
            ->count();

        $ijin = DB::table('trx_absen')
            ->where('nis', $con->nis)
            ->where('ket', '3')
            ->whereMonth('created_at', date('m'))
            ->count();

        $alpa = DB::table('trx_absen')
            ->where('nis', $con->nis)
            ->where('ket', '4')
            ->whereMonth('created_at', date('m'))
            ->count();


        return view('/admin/cetak', compact('siswa', 'tanggal', 'try', 'sakit', 'ijin', 'alpa'));
    }

    public function kelas()
    {
        $kelas = Kelas::all();
        $mapel = mapels::all();
        $smt = smt::where('flag', 1)->first();

        return view('/admin/kelas', compact('kelas', 'mapel', 'smt'));
    }

    public function inputNilai(Request $request)
    {

        $cek = trx_nilai::select('id')->where([
            ['mapel_id', $request->mapel],
            ['kelas_id',$request->kelas],
            ['smt',$request->smt]
        ])->count();
        if($cek > 1){
            $datas = trx_nilai::select('id', 'nis', 'nilai', 'kelas_id', 'mapel_id')->where([
                ['kelas_id', $request->kelas],
                ['mapel_id', $request->mapel],
                ['smt',$request->smt]
            ])->get();

            return view('admin.updateNilai', compact('datas'));
        }
        $siswa = siswa::select('nis', 'nama', 'kls')->where('kls', $request->kelas)->get();
        $mapel = mapels::where('id', $request->mapel)->first();
        $smt = smt::where('flag', 1)->first();

        return view('/admin/formIN', compact('siswa', 'mapel', 'smt'));
    }

    public function simNilai(Request $request)
    {
        $siswa = siswa::select('nis', 'nama', 'kls')->where([
            ['kls', $request->kelas]
        ])->get();

        $cekNilai = trx_nilai::where([
            ['mapel_id', $request->mapel],
            ['kelas_id', $request->kelas],
            ['smt', $request->smt],
        ])->count();

        if ($cekNilai == 0) {
            foreach ($siswa as $sis) {
                $data[] = array(
                    'mapel_id' => $request->mapel,
                    'kelas_id' => $request->kelas,
                    'nilai' => $request->input('nilai' . $sis->nis),
                    'nis' => $request->input('nis' . $sis->nis),
                    'smt' => $request->smt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }
            $save = DB::table('trx_nilai')->insert($data);
            return redirect('/admin/kelas')->with('status', 'Penyimpanan Berhasil');
        } else {
            return redirect('/admin/kelas')->with('error', 'Maaf kelas dan Mapel Sudah di Input');
        }
    }

    public function indexKM()
    {
        $kelas = Kelas::all();
        $mapel = mapels::all();

        return view('/admin/indexKM', compact('kelas', 'mapel'));
    }

    public function editNi(Request $request)
    {
        $cekData = trx_nilai::where([
            ['mapel_id', $request->mapel],
            ['kelas_id', $request->kelas]
        ])->count();
        if($cekData > 1){
            $edit = trx_nilai::where([
                ['mapel_id', $request->mapel],
                ['kelas_id', $request->kelas]
            ])->get();

            $mapel = mapels::where('id', $request->mapel)->first();

            return view('admin/edit', compact('edit', 'mapel'));
        }else{
            return redirect('admin/kelas')->with('error', 'Maaf kelas dan Mapel Tersebut Belum ada Data');
        }
    }

    public function updateNilai(Request $request)
    {
        $kelas = siswa::select('nis')->where('kls', $request->kelas)->get();

        foreach($kelas as $data){
            DB::table('trx_nilai')
                ->where('kelas_id', $request->kelas)
                ->where('mapel_id', $request->mapel)
                ->where('nis', $request->input('nis'.$data->nis))
                ->update([
                    'nilai' => $request->input('nilai'.$data->nis),
                    'updated_at' => Carbon::now()
                ]);
        }

        return redirect('/admin/kelas')->with('status', 'Perubahan Nilai Berhasil');
    }
    public function edata($id)
    {
        $trx_nilai = trx_nilai::select('nilai', 'nis', 'mapel_id', 'id')->where('id', $id)->first();

        return view('admin.editNilai', compact('trx_nilai'));
    }

    public function tester()
    {
        $sis = siswa::with(['kelas' => function($query){
            $query->select('id');
        }])->where('nis', 155)->toSql();
        dd($sis);
    }

    public function luki()
    {
        $tanggal1 = date('Y-m-d');
        $tanggal2 = $tanggal1;
        $tanggal3 = date('d-m-Y');
        dd($tanggal3);
    }

    public function update(Request $request)
    {

        $simpan = trx_nilai::find($request->id);
        $simpan->nilai= $request->nilai;
        $simpan->save();

        return back()->with('status', 'Penyimpanan sukses');
    }

    public function formSmt()
    {
        $smt = smt::all();

        return view('admin.formSmt', compact('smt'));
    }

    public function updatesmt(Request $request)
    {
            $default = DB::table('smt')
                        ->update([
                           'flag' => 0
                        ]);
            if($default == TRUE)
            {
                DB::table('smt')
                    ->where('id', $request->smt)
                    ->update([
                        'flag' => 1
                    ]);

            }

        return redirect('/admin/smt')->with('status', 'Perubahan Nilai Berhasil');
    }

    public function export()
    {
        $nilai = trx_nilai::select('nis', 'mapel_id', 'kelas_id', 'nilai', 'smt')->where([
            ['smt', 1],
            ['mapel_id', 1]
        ])->get();
        return Excel::create('nilai_export', function($excel) use ($nilai){
            $excel->sheet('mysheet', function($sheet) use ($nilai){
                $sheet->fromArray($nilai);
            });
        })->download('xls');
    }

    public function formImport()
    {
        return view('admin.import');
    }

    public function import(Request $request)
    {
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()){
                foreach($data as $key => $value){
                    $simpan = new trx_nilai();
                    $simpan->nis = $value->nis;
                    $simpan->nilai = $value->nilai;
                    $simpan->mapel_id = $value->mapel_id;
                    $simpan->kelas_id = $value->kelas_id;
                    $simpan->smt = $value->smt;
                    $simpan->save();
                }
            }
        }
        return back();
    }

    public function showForm($id)
    {
        $now = trx_absen::select('nis', 'ket', 'kelas_id')->where('nis', $id)->whereDate('created_at', Carbon::today())->first();
        $ket = ket::all();

        
        return view('admin.formEdit', compact('now', 'ket'));
    }

    public function updateNow (Request $request)
    {
        $request->validate([
            'ket' => 'required|numeric',
        ]);
        DB::table('trx_absen')
            ->where('nis', $request->nis)
            ->whereDay('created_at', date('d'))
            ->update([
                'ket'=> $request->ket,
                'updated_at' => Carbon::now()
            ]);

        return back()->with('status', 'Edit Sukses');
    }

    public function formTgl($id)
    {
        $idSiswa = $id;
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        return view('admin.formTgl', compact('tanggal', 'idSiswa'));
    }

    public function updateTgl(Request $request)
    {

        $tgl = $request->tgl;
        $bln = $request->bln;
        $nis = $request->nis;
        $now = trx_absen::where('nis', $request->nis)->whereDay('created_at', $request->tgl)->whereMonth('created_at', $request->bln)->first();
        if($now == false)
        {
            return back()->with('status', 'Perubahan Nilai Berhasil');
        }
        $ket = ket::all();
        

        return view('admin.editTgl', compact('now','ket','tgl', 'bln'));
    }

    public function updateTgl1(Request $request)
    {
        $update = DB::table('trx_absen')
            ->where('nis', $request->nis)
            ->whereDay('created_at', $request->tgl)
            ->whereMonth('created_at', $request->bln)
            ->update([
                'ket'=> $request->ket,
                'updated_at'=> Carbon::now(),
            ]);

        return redirect('/admin/laporan')->with('status', 'Edit Berhasil');
    }

    public function addIndex()
    {
        return view('admin.addIndex');
    }

    public function simAdd(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $simpan = new user;
        $simpan->name = $request->nama;
        $simpan->password = bcrypt($request->password);
        $simpan->email = $request->email;
        $simpan->status = 1;
        $simpan->save();

        return back()->with('status','Penambahan user sukses');
    }

    public function showuser()
    {
        $user = user::all();

        return view('admin.showUser', compact('user'));
    }

}
