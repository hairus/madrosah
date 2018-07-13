@extends('layouts.app')
@section('content')
    <div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <center>
                <h4>KARTU LAPORAN MURID BULANAN</h4>
                <h4>MADRASAH DINIYAH AWWALIYAH</h4>
                <h4>"DARUL MUSTAFA"</h4>
            </center>
            <?php
                echo date('Y-m-d');
            ?>
            <div class="x_title">
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <li> a. Absensi
                <section class="content invoice">
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Nama
                            <address>
                                <strong>{{ $siswa->nama }}</strong>
                                <br>kelas {{$siswa->kls}}
                            </address>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 table">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    @for($x = 1; $x <= $tanggal; $x++)
                                    <th>{{ $x }}</th>
                                    @endfor
                                    <th>S</th>
                                    <th>I</th>
                                    <th>A</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                        foreach ($try as $trys)
                                            {
                                                if($trys == null)
                                                    {
                                                        echo '<td>L</td>';
                                                    }
                                                    else{
                                                        echo '<td>'.$trys->ket.'</td>';
                                                    }
                                            }
                                    ?>
                                    <td>{{ $sakit }}</td>
                                    <td>{{ $ijin }}</td>
                                    <td>{{ $alpa }}</td>
                                </tr>

                                </tbody>
                            </table>
                            Keterangan
                            H   : HADIR
                            L   : LIBUR
                            A   : ALPA
                            S   : SAKIT
                            I   : IJIN
                        </div>
                    </div>
       </div>
            <li> b. Kegiatan di Rumah
                <div class="col-xs-12 table">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Sholat 5 waktu</th>
                            <th>Membaca Al-Qur'an</th>
                            <th>Akhlaq Terhadap Orang Tua</th>
                            <th>Sopan Santun di Rumah</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>.........</td>
                            <td>.........</td>
                            <td>.........</td>
                            <td>.........</td>
                        </tr>
                        </tbody>
                    </table>
                    Keterangan
                    <i>mohon di isi dengan Huruf </i>
                    A   : Sangat Baik
                    B   : Baik
                    C   : Cukup
                    D   : Kurang
                    E   : Kurang Baik
                </div>
                <table class="table-bordered" border="5">
                    <thead>
                    <tr>
                        <td colspan="4">Masukan Orang tua</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>......................................................................</td>
                    </tr><tr>
                        <td>......................................................................</td>
                    </tr><tr>
                        <td>......................................................................</td>
                    </tr><tr>
                        <td>......................................................................</td>
                    </tr><tr>
                        <td>......................................................................</td>
                    </tr>
                    </tbody>
                </table>
            <table class="table-bordered" border="5">
                <thead>
                <th colspan="2"><center>Mengetahui</center></th>
                </thead>
                <tbody>
                <td>
                    <center>Wali Murid</center>
                    <br>
                    <br>
                    <br>
                    <br>
                    (..................)
                </td>
                <td>
                    <center>Wali Kelas</center>
                    <br>
                    <br>
                    <br>
                    <br>
                    (..................)
                </td>
                </tbody>
            </table>

                <h6>* Mohon kartu ini di kumpulkan kembali sebelum tanggal 15 setiap Bulan</h6>
            </div>

    </div>
</div>
@endsection