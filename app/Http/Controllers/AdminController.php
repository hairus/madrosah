<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
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
           DB::table('trx_absen')->insert($data);

           return back();
       }
       else
       {
           return back();
       }

    }

    public function cek()
    {
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // jumlah hari saat ini

        for($x = 1; $x <= $tanggal; $x++)
        {
            echo $x. ' ';
        }
    }
}
