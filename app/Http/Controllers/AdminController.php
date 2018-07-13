<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\mapels;
use App\Models\siswa;
use App\Models\trx_mapel;
use App\Models\trx_nilai;
use Carbon\Carbon;
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
            ->where('ket', 'S')
            ->whereMonth('created_at', date('m'))
            ->count();

        $ijin = DB::table('trx_absen')
            ->where('nis', $con->nis)
            ->where('ket', 'I')
            ->whereMonth('created_at', date('m'))
            ->count();

        $alpa = DB::table('trx_absen')
            ->where('nis', $con->nis)
            ->where('ket', 'A')
            ->whereMonth('created_at', date('m'))
            ->count();


        return view('/admin/cetak', compact('siswa', 'tanggal', 'try', 'sakit', 'ijin', 'alpa'));
    }

    public function kelas()
    {
        $kelas = Kelas::all();
        $mapel = mapels::all();

        return view('/admin/kelas', compact('kelas', 'mapel'));
    }

    public function inputNilai(Request $request)
    {
        $siswa = siswa::select('nis', 'nama', 'kls')->where('kls', $request->kelas)->get();
        $mapel = mapels::where('id', $request->mapel)->first();

        return view('/admin/formIN', compact('siswa', 'mapel'));
    }

    public function simNilai(Request $request)
    {
        $siswa = siswa::select('nis', 'nama', 'kls')->where([
            ['kls', $request->kelas]
        ])->get();

        $cekNilai = trx_nilai::where([
            ['mapel_id', $request->mapel],
            ['kelas_id', $request->kelas]
        ])->count();

        if ($cekNilai == 0) {
            foreach ($siswa as $sis) {
                $data[] = array(
                    'mapel_id' => $request->mapel,
                    'kelas_id' => $request->kelas,
                    'nilai' => $request->input('nilai' . $sis->nis),
                    'nis' => $request->input('nis' . $sis->nis),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }
            $save = DB::table('trx_nilai')->insert($data);
            return redirect('admin/kelas')->with('status', 'Penyimpanan Berhasil');
        } else {
            return redirect('admin/kelas')->with('error', 'Maaf kelas dan Mapel Sudah di Input');
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
    public function edata($id)
    {
        $collection = trx_nilai::all();

        $nis = $collection->groupBy('nis');
    }

}
