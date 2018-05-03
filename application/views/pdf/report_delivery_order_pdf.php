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
          <td colspan="2" style="border: 1px solid black;font-size: 20px;">
            <p align="left" style="margin: 10px;">
              PT UNITED SHIPING INDONESIA
            <br>JL.Gondosuli No.8 RT.005 RW. 006 , Ketabang
            <br>Katabang - Genteng Surabaya
            <br>Telp (031) 5471.841, Fax.031.5471. 841
            <br>NPWP 02.622.627 - 4.611.000
          </p>
          </td>

          <td  style="border: 1px solid black;font-size: 20px;">
            <p align="left" style="margin: 10px;">
              DELIVERY OREDER
            <br>
            <br>No.DO
            <br>TGL.DO
            <br>NO.SO
            
          </p>
          </td>   



          <td  style="border: 1px solid black;">
            <p align="right" style="margin: 10px;">
              <img src="usi.jpg" width="180px" height="120px">
          </p>
          </td>

        </tr>

        <tr>
          
          <td style="border: 0px solid black;">Ship to</td>
          <td style="border: 0px solid black;">PT.Putra Perkasa Abadi</td>
          <td style="border: 0px solid black;">Sold to</td>
          <td style="border: 0px solid black;">PT.Putra Perkasa Abadi</td>
        </tr>

        <tr>
          
          <td style="border: 0px solid black;">Alamat</td>
          <td style="border: 0px solid black;">Desa Jembayaan Kec.Loa Kulo</td>
          <td style="border: 0px solid black;">Alamat</td>
          <td style="border: 0px solid black;">Jakarta</td>
        </tr>

        <tr>
          
          <td style="border: 0px solid black;">No. Pelanggan</td>
          <td style="border: 0px solid black;">Kab.Kutai Kartanegara</td>
          <td style="border: 0px solid black;">No. Pelanggan</td>
          <td style="border: 0px solid black;"> - </td>
        </tr>
        <tr>
          
          <td style="border: 0px solid black;">N.P.W.P</td>
          <td style="border: 0px solid black;">-</td>
          <td style="border: 0px solid black;">N.P.W.P</td>
          <td style="border: 0px solid black;">- </td>
        
</tr>

      </tbody>
    </table>

 <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>

<tr>
          <td style="border: 1px solid black;">Tanggal berlaku</td>
          <td style="border: 1px solid black;">Produk</td>
          <td style="border: 1px solid black;">Kwantitas</td>
</tr>
<tr>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;">Solar</td>
          <td style="border: 1px solid black;"></td>
</tr>
<tr>
          <td colspan="3" style="border: 1px solid black;">Terbilang : </td>
     
</tr>

</tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>

<tr>
          <td style="border: 1px solid black;">Dikirim Dengan</td>
          <td style="border: 1px solid black;">Truck / Kapal</td>
          <td style="border: 1px solid black;">Segel Atas :</td>
          <td style="border: 1px solid black;">Meter Awal :</td>
</tr>
<tr>
          <td style="border: 1px solid black;">Dikirim Dengan</td>
          <td style="border: 1px solid black;">Truck / Kapal</td>
          <td style="border: 1px solid black;">Segel Atas :</td>
          <td style="border: 1px solid black;">Meter Awal :</td>
</tr>
<tr>
          <td style="border: 1px solid black;">Dikirim Dengan</td>
          <td style="border: 1px solid black;">Truck / Kapal</td>
          <td style="border: 1px solid black;">Segel Atas :</td>
          <td style="border: 1px solid black;">Meter Awal :</td>
</tr>
<tr>
          <td colspan="4" style="border: 1px solid black;">Dikirim Dengan</td>
</tr>
<tr>
          <td style="border: 1px solid black;">Distribusi</td>
          <td style="border: 1px solid black;">Mengetahui</td>
          <td style="border: 1px solid black;">Penerima</td>
          <td style="border: 1px solid black;">Pengemudi</td>
</tr>
<tr>
          <td style="border: 1px solid black;"> -<br>-<br>-<br>- </td>
          <td style="border: 1px solid black;"> -<br>-<br>-<br>- </td>
          <td style="border: 1px solid black;"> -<br>-<br>-<br>- </td>
          <td style="border: 1px solid black;"> -<br>-<br>-<br>- </td>
</tr>

</tbody>
    </table>

<table style="border-collapse: collapse; width: 100%; text-align:center; font-size: 80%;">
      <tbody>

<tr>
          <td style="border: 0px solid black;">1.Lembar Asli Putih untuk Customer</td>
          <td style="border: 0px solid black;">1.Lembar Asli Putih untuk Customer</td>
</tr>

<tr>
          <td style="border: 0px solid black;">1.Lembar Asli Putih untuk Customer</td>
          <td style="border: 0px solid black;">1.Lembar Asli Putih untuk Customer</td>
</tr>

</tbody>
    </table>



    <div style="clear:both"></div>
    <br>
   
  </body>

