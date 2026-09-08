<?php
//masukan libary DpmPDF
ob_start();
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//instansiasi objek Dompdf
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama'] ?? '', ENT_QUOTES, 'UTF-8');
    $nis = htmlspecialchars($_POST['nis'] ?? '', ENT_QUOTES, 'UTF-8');
    $kelas = htmlspecialchars($_POST['kelas'] ?? '', ENT_QUOTES, 'UTF-8');
    $alasan = htmlspecialchars($_POST['alasan'] ?? '', ENT_QUOTES, 'UTF-8');
    $keterangan = htmlspecialchars($_POST['keterangan'] ?? '', ENT_QUOTES, 'UTF-8');

    $tgl_mulai = date('d-m-Y', strtotime($_POST['tgl_mulai'] ?? 'now'));
    $tgl_selesai = date('d-m-Y', strtotime($_POST['tgl_selesai'] ?? 'now'));
    $tgl_sekarang = date('d-m-Y');


  //template halaman pdf
  $html = '
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>
      body{
        font-family:"Times New Roman";
        font-size: 12pt;
        margin: 20px;
      }

      .kop{
          font-family: "Century Gothic";
          text-align: center;
          border-bottom: 3px double #000;
          padding-bottom: 10px;
          margin-bottom: 20px;
      }
      
      .kop h2{
      margin: 0;
      font-size: 10pt;
      }

      .kop p{
      margin 2px;
      }
      
      .title{
      text-align: center;
      font-weight: bold;
      text-decoration: underline;
      margin-bottom: 25px;
      }

      .content{
      line-height: 1.6;
      text-align: justify;
      }

      .table-data{
          margin: 15px 0 15px 30px;
          width: 100%;
      }

      .table-data td{
          padding: 40px 0;
          vertical-align: top;
      }

      .ttd-container{
          width: 100%;
          margin-top: 50px;
      }

      .ttd-box{
          float: right;
          width: 200px;
          text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="kop">
         <h2>SMK Texmaco Semarang</h2>
         <p>Jl. Raya Mangkang Kulon | Telp: (024) 223-8889</p>
    </div>

    <div class="title">Surat Izin Meninggalkan Kelas</div>

    <div class="content">
         <p>Yang bertanda tangan di bawah ini:</p>
         <table class="table-data">
           <tr>
             <td width="130">Nama</td>
             <td>:</td>
             <td><b>' .$nama.'</b></td>
           </tr>
           <tr>
             <td width="130">Nis</td>
             <td width="15">:</td>
             <td><b>' .$nis.'</b></td>
           </tr>
           <tr>
             <td>Kelas</td>
             <td>:</td>
             <td><b>' .$kelas.'</b></td>
           </tr>
          </table>
          
          <p>Bermaksud untuk mengajukan izin meninggalkan kelas 
              pada tanggal <b>' .$tgl_mulai. '</b>
              sampai dengan  <b>' .$tgl_selesai. '</b>
              dikarenakan <b>' .$alasan. '</b>
          </p>
          ' .($keterangan ? '<p>Detail keterangan: ' .$keterangan. '</p>' : '').' 
          <p>Demikian surat pengajuan surat izin ini saya buat. 
          Atas perhatian dan pengertian Bapak/Ibu, saya ucapkan terima kasih.
          </p>
    </div>
    <div class="ttd-container">
         <div class="ttd-box">
         <p>Semarang, '.$tgl_sekarang.'<br>Hormat saya,</p>
         <br><br><br>
         <p><b>('. $nama . ')</b><p/>
      </div>
    </div>
  </body>
  </html>
  
  ';

//3. Konfigurasi dan Insialisasi Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); //memungkinkan load gambar eksternal jika ada
$dompdf = new Dompdf($options);

//4. Render HTML ke PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4' , 'portrait');
$dompdf->render();

ob_end_clean();

//5. Stream PDF ke Browser
$dompdf->stream("Surat_Izin_" . str_replace(' ', '_' , $nama) . ".pdf", ["Attachment" => false]);

}
?>
