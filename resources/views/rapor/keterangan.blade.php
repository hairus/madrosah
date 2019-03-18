<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<style>
table {
    border-collapse: collapse;
}

#border {
    border: 1px solid black;
}
</style>
<br><br><br><br><br><br>
<table width="100%">
  <tbody>
    <tr>
      <td colspan="4" align="center"><strong>KETERANGAN DATA DIRI MURID</strong></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="3%">1.</td>
      <td width="31%">Nama Murid</td>
      <td width="1%">:</td>
      <td width="65%">{{ $bio->nama }}</td>
    </tr>
    <tr>
      <td>2.</td>
      <td>Nomor Induk</td>
      <td>:</td>
      <td>{{ $bio->nis }}</td>
    </tr>
    <tr>
      <td>3.</td>
      <td>Tempat, Tanggal Lahir</td>
      <td>:</td>
      <td>{{ $bio->ttl }}</td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>{{ $bio->jenis }}</td>
    </tr>
    <tr>
      <td>5.</td>
      <td>Anak Ke_dari_</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>6.</td>
      <td>Alamat Murid</td>
      <td>:</td>
      <td>{{ $bio->almt }}</td>
    </tr>
    <tr>
      <td>7.</td>
      <td>Nama Orang Tua</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>a. Ayah</td>
      <td>:</td>
      <td>{{ $bio->wali }}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>b. Ibu</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>c. Agama Orang Tua</td>
      <td>:</td>
      <td>Islam</td>
    </tr>
    <tr>
      <td>8.</td>
      <td>Alamat Orang Tua</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>a. Ayah</td>
      <td>:</td>
      <td>{{ $bio->almt }}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>b. ibu</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>9.</td>
      <td>Pekerjaan Orang Tua</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>a. Ayah</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>b. Ibu</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>10.</td>
      <td>Nama Wali</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>11.</td>
      <td>Agama Wali</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>12.</td>
      <td>Pekerjaan Wali</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>13</td>
      <td>Telepon Orang Tua/ Wali</td>
      <td>:</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td><table width="24%" height="117" border="1" align="center" bordercolor="#352929">
        <tbody>
          <tr>
            <td id="border" colspan="2" align="center">Pas foto hitam putih/warna</td>
          </tr>
        </tbody>
      </table></td>
      <td><table width="83%">
        <tbody>
          <tr>
            <td>Sumenep, 30 Juli 2018</td>
          </tr>
          <tr>
            <td align="center"><p>Kepala Madrasah Diniyah Takmiliyah</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p><u><strong>MUH. ABDUL MUN IM, S.PdI</strong></u></p></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>