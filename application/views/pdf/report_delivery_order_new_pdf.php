<?PHP  

$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<style type="text/css">
    
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 18mm;
        padding-top: 8mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
  
</style>


<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>



<body class="body">
    
  <div style="clear: both;"></div>
  <br>
  <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>
      
        <tr>
          <td colspan="2" style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;font-size: 15px;">
            <p align="left" style="margin: 10px;">
              PT UNITED SHIPING INDONESIA
            <br>JL.Gondosuli No.8 RT.005 RW. 006 , Ketabang
            <br>Katabang - Genteng Surabaya
            <br>Telp (031) 5471.841, Fax.031.5471. 841
            <br>NPWP 02.622.627 - 4.611.000
          </p>
          </td>

          <td  style="border-top: 1px solid black;border-bottom: 1px solid black;font-size: 15px;">
            <p align="left" style="margin: 10px;">
              DELIVERY OREDER
            <br>
            <br>No.DO
            <br>TGL.DO
            <br>NO.SO
            
          </p>
          </td>   



          <td  style="border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
            <p align="right" style="margin: 10px;">
              <img src="<?=$base_url2;?>assets/img/usi Uk kecil.png" width="180px" height="120px">
          </p>
          </td>

        </tr>

        <tr>
          
          <td style="border: 0px solid black;text-align: left;border-left: 1px solid black;padding-left: 5px;">Ship to</td>
          <td style="border: 0px solid black;text-align: left;">PT.Putra Perkasa Abadi</td>
          <td style="border: 0px solid black;text-align: left;">Sold to</td>
          <td style="border: 0px solid black;text-align: left;border-right: 1px solid black;">PT.Putra Perkasa Abadi</td>
        </tr>

        <tr>
          
          <td style="border: 0px solid black;text-align: left;border-left: 1px solid black;padding-left: 5px;">Alamat</td>
          <td style="border: 0px solid black;text-align: left;">Desa Jembayaan Kec.Loa Kulo</td>
          <td style="border: 0px solid black;text-align: left;">Alamat</td>
          <td style="border: 0px solid black;text-align: left;border-right: 1px solid black;">Jakarta</td>
        </tr>

        <tr>
          
          <td style="border: 0px solid black;text-align: left;border-left: 1px solid black;padding-left: 5px;">No. Pelanggan</td>
          <td style="border: 0px solid black;text-align: left;">Kab.Kutai Kartanegara</td>
          <td style="border: 0px solid black;text-align: left;">No. Pelanggan</td>
          <td style="border: 0px solid black;text-align: left;border-right: 1px solid black;"> - </td>
        </tr>
        <tr>
          
          <td style="border: 0px solid black;text-align: left;border-left: 1px solid black;padding-left: 5px;">N.P.W.P</td>
          <td style="border: 0px solid black;text-align: left;">-</td>
          <td style="border: 0px solid black;text-align: left;">N.P.W.P</td>
          <td style="border: 0px solid black;text-align: left;border-right: 1px solid black;">- </td>
        
</tr>

      </tbody>
    </table>

 <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>

<tr>
          <td style="border: 1px solid black;width: 35%;">Tanggal berlaku</td>
          <td style="border: 1px solid black;width: 30%;">Produk</td>
          <td style="border: 1px solid black;width: 30%;">Kwantitas</td>
</tr>
<tr>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;">Solar</td>
          <td style="border: 1px solid black;"></td>
</tr>
<tr>
          <td colspan="3" style="border: 1px solid black;text-align: left;padding-left: 5px;">Terbilang : </td>
     
</tr>

</tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>

<tr>
          <td style="border: 1px solid black;width: 15%;text-align: left;padding-left: 5px;">Dikirim Dengan</td>
          <td style="border: 1px solid black;width: 20%;text-align: center;padding-left: 5px;">Truck / Kapal</td>
          <td style="border: 1px solid black;width: 30%;text-align: left;padding-left: 5px;">Segel Atas :</td>
          <td style="border: 1px solid black;width: 30%;text-align: left;padding-left: 5px;">Meter Awal :</td>
</tr>
<tr>
          <td style="border: 1px solid black;text-align: left;padding-left: 5px;">No Kendaraan</td>
          <td style="border: 1px solid black;text-align: center;padding-left: 5px;"></td>
          <td style="border: 1px solid black;text-align: left;padding-left: 5px;">Segel Bawah :</td>
          <td style="border: 1px solid black;text-align: left;padding-left: 5px;">Meter Akhir :</td>
</tr>
<tr>
          <td style="border: 1px solid black;text-align: left;padding-left: 5px;">Nama Kapal</td>
          <td style="border: 1px solid black;text-align: center;padding-left: 5px;"></td>
          <td style="border: 1px solid black;text-align: left;padding-left: 5px;">Temperatur :</td>
          <td style="border: 1px solid black;text-align: left;padding-left: 5px;">SG Meter :</td>
</tr>
<tr>
          <td colspan="4" style="border: 1px solid black;text-align: left;padding-left: 5px;">Keterangan</td>
</tr>
<tr>
          <td style="border: 1px solid black;">Distribusi</td>
          <td style="border: 1px solid black;">Mengetahui</td>
          <td style="border: 1px solid black;">Penerima</td>
          <td style="border: 1px solid black;">Pengemudi</td>
</tr>
<tr>
          <td style="border: 1px solid black;"> <br><br><br> </td>
          <td style="border: 1px solid black;"> <br><br><br> </td>
          <td style="border: 1px solid black;"> <br><br><br> </td>
          <td style="border: 1px solid black;"> <br><br><br> </td>
</tr>

</tbody>
    </table>

<table style="border-collapse: collapse; width: 100%; font-size: 80%;">
      <tbody>

<tr>
          <td style="border: 0px solid black;">1.Lembar Asli Putih untuk Customer</td>
          <td style="border: 0px solid black;">3.Lembar warna hijau untuk agen</td>
</tr>

<tr>
          <td style="border: 0px solid black;">2.Lembar warna merah untuk transportir</td>
          <td style="border: 0px solid black;">4.Lembar warna kuning untuk file</td>
</tr>

</tbody>
    </table>



    <div style="clear:both"></div>
    <br>
   
  </body>

