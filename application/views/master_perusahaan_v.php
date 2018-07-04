<?PHP
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style type="text/css">
.recent_add td{
	background: #CDE69C;
}

#tes td {
	vertical-align: middle;
}
</style>
<input id="tr_utama_count_trans" value="1" type="hidden"/>
<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-user"></i>  Pengaturan Akun </h3>

		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#">Pengaturan</a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Pengaturan Akun  </li>
		</ul>
	</div>
</div>

<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>" enctype="multipart/form-data">
<div class="row-fluid" id="edit_data">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> Informasi Akun </h3>
			</div>

			<div class="widget-container">	
      <div class="row-fluid">			
					<div class="span6">
          <h3 class=" page-header"> <i class="icon-camera-retro"></i> LOGO PERUSAHAAN <b></b> </h3>
                <form method="post" action="<?=base_url();?>beranda_c" enctype="multipart/form-data">
                <div style="padding: 10px; margin-bottom: 20px;">
                    <div class="control-group">
                        <label class="control-label">  </label>
                        <div class="controls">
                                <img src="<?=$base_url2;?>files/def_pic.png" style="height: 200px; width: 300px;">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"> </label>
                        <div class="controls">                          
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input span3">
                                        <i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-info btn-file"><span class="fileupload-new">Ganti Logo</span><span class="fileupload-exists">Ganti Logo</span>
                                    <input type="file" name="userfile[]" onchange="$('#panel_simpan_logo').show();" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel_simpan_logo" class="control-group" style="display: none;">
                        <label class="control-label"> </label>
                        <div class="controls">                          
                           <input type="submit" name="ganti_logo" value="SIMPAN LOGO" class="btn btn-success" />
                        </div>
                    </div>
                </div>
                </form>
              </div>
              <div class="span6">
                <h3 class=" page-header"> <i class="icon-picture"></i> BACKGROUND DIVISI <b></b> </h3>
                <form method="post" action="<?=base_url();?>beranda_c" enctype="multipart/form-data">
                <div style="padding: 10px; margin-bottom: 20px;">
                    <div class="control-group">
                        <label class="control-label">  </label>
                        <div class="controls">
                            
                                <img src="<?=$base_url2;?>files/def_pic.png" style="height: 200px; width: 300px;">
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"> </label>
                        <div class="controls">                          
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input span3">
                                        <i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-info btn-file"><span class="fileupload-new">Ganti Background</span><span class="fileupload-exists">Ganti Background</span>
                                    <input type="file" name="userfile[]" onchange="$('#panel_simpan_background').show();" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel_simpan_background" class="control-group" style="display: none;">
                        <label class="control-label"> </label>
                        <div class="controls">                          
                           <input type="submit" name="ganti_background" value="SIMPAN BACKGROUND" class="btn btn-success" />
                        </div>
                    </div>
                </div>
                </form>
              </div>
            </div>

			</div>
		</div>
	</div>


</div>

<div class="row-fluid" id="edit_data">
  <div class="span12">
    <div class="content-widgets light-gray">
      <div class="widget-head blue">
        <h3> Rekening Perusahaan </h3>
      </div>

      <div class="widget-container">  
        <div class="row-fluid" id="view_data">
            <div class="span12">
              <button type="button" class="btn btn-info view_data" onclick="tambah_klik();" style="float: right;"> 
                <i class="icon-plus" style="color: #FFF; font-size: 16px; left: 0; position: relative; top: 2px;"></i> TAMBAH REKENING BANK
              </button>
              <br>
              <br>
              <div class="content-widgets light-gray">
                <div class="widget-container">
                  <table class="responsive table table-striped table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th align="center"> NO </th>
                        <th align="center"> NAMA BANK </th>            
                        <th align="center"> NOMOR REKENING </th>            
                        <th align="center"> ATAS NAMA </th>            
                        <th align="center"> AKSI </th>
                      </tr>           
                    </thead>
                    <tbody id="tes">
                      <?PHP 
                      $no = 0;
                      foreach ($dt as $key => $row) { 
                        $no++;
                      ?>
                      <tr>
                        <td align="center" style="text-align: center;"> <?=$no;?> </td>
                        <td> <?=$row->NAMA_BANK;?> </td>
                        <td> <?=$row->NOMOR_REKENING;?> </td>
                        <td> <?=$row->ATAS_NAMA;?> </td>
                        <td><button style="padding: 2px 10px;"  onclick="update_klik(<?=$row->ID;?>);" type="button" class="btn btn-small btn-warning"> 
                          Ubah 
                          </button>
                          <button style="padding: 2px 10px;"  onclick="$('#dialog-btn').click(); $('#id_hapus').val('<?=$row->ID;?>');" type="button" class="btn btn-small btn-danger"> 
                          Hapus
                          </button>
                        </td>
                        

                      
                      </tr>
                      <?PHP } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>


</div>

<!-- <div class="form-actions" style="padding-left: 0;">
	<center>
	<input type="submit" class="btn btn-success" name="simpan" value="Simpan">
	<button type="button" onclick="window.location='<?=base_url();?>pengaturan_akun_c';" class="btn"> Batal </button>
	</center>
</div> -->

</form>

<div class="row-fluid" id="add_data" style="display:none;">
  <div class="span12">
    <div class="content-widgets light-gray">
      <div class="widget-head blue">
        <h3> <i class="icon-plus"></i> Tambah Rekening Bank </h3>
      </div>
      <div class="widget-container">
        <form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
          <div class="control-group">
            <label class="control-label"> Nama Bank </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="nama_bank" style="font-size: 14px;">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label"> Rekening Bank </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="rekening_bank" style="font-size: 14px;">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label"> Atas Nama </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="atas_nama" style="font-size: 14px;">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label"> Cabang </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="cabang" style="font-size: 14px;">
            </div>
          </div>

          <div class="form-actions">
            
            <input type="submit" class="btn btn-info" name="simpan_bank" value="SIMPAN REKENING">
            
            <button type="button" onclick="batal_klik();" class="btn"> BATAL </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row-fluid" id="ubah_data" style="display:none;">
  <div class="span12">
    <div class="content-widgets light-gray">
      <div class="widget-head blue">
        <h3> <i class="icon-plus"></i> Ubah Rekening Bank </h3>
      </div>
      <div class="widget-container">
        <form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
          <div class="control-group">
            <label class="control-label"> Nama Bank </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="nama_bank" id="nama_bank_ed" style="font-size: 14px;">
              <input type="hidden" class="span6" value="" name="id_bank" id="id_ed" style="font-size: 14px;">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label"> Rekening Bank </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="rekening_bank" id="rekening_bank_ed" style="font-size: 14px;">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label"> Atas Nama </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="atas_nama" id="atas_nama_ed" style="font-size: 14px;">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label"> Cabang </label>
            <div class="controls">
              <input required type="text" class="span6" value="" name="cabang" id="cabang_ed" style="font-size: 14px;">
            </div>
          </div>

          <div class="form-actions">
            
            <input type="submit" class="btn btn-info" name="update_bank" value="SIMPAN REKENING">
            
            <button type="button" onclick="batal_klik_update();" class="btn"> BATAL </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">



var MD5 = function (string) {

   function RotateLeft(lValue, iShiftBits) {
           return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
   }

   function AddUnsigned(lX,lY) {
           var lX4,lY4,lX8,lY8,lResult;
           lX8 = (lX & 0x80000000);
           lY8 = (lY & 0x80000000);
           lX4 = (lX & 0x40000000);
           lY4 = (lY & 0x40000000);
           lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
           if (lX4 & lY4) {
                   return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
           }
           if (lX4 | lY4) {
                   if (lResult & 0x40000000) {
                           return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
                   } else {
                           return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
                   }
           } else {
                   return (lResult ^ lX8 ^ lY8);
           }
   }

   function F(x,y,z) { return (x & y) | ((~x) & z); }
   function G(x,y,z) { return (x & z) | (y & (~z)); }
   function H(x,y,z) { return (x ^ y ^ z); }
   function I(x,y,z) { return (y ^ (x | (~z))); }

   function FF(a,b,c,d,x,s,ac) {
           a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
           return AddUnsigned(RotateLeft(a, s), b);
   };

   function GG(a,b,c,d,x,s,ac) {
           a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
           return AddUnsigned(RotateLeft(a, s), b);
   };

   function HH(a,b,c,d,x,s,ac) {
           a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
           return AddUnsigned(RotateLeft(a, s), b);
   };

   function II(a,b,c,d,x,s,ac) {
           a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
           return AddUnsigned(RotateLeft(a, s), b);
   };

   function ConvertToWordArray(string) {
           var lWordCount;
           var lMessageLength = string.length;
           var lNumberOfWords_temp1=lMessageLength + 8;
           var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
           var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
           var lWordArray=Array(lNumberOfWords-1);
           var lBytePosition = 0;
           var lByteCount = 0;
           while ( lByteCount < lMessageLength ) {
                   lWordCount = (lByteCount-(lByteCount % 4))/4;
                   lBytePosition = (lByteCount % 4)*8;
                   lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
                   lByteCount++;
           }
           lWordCount = (lByteCount-(lByteCount % 4))/4;
           lBytePosition = (lByteCount % 4)*8;
           lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
           lWordArray[lNumberOfWords-2] = lMessageLength<<3;
           lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
           return lWordArray;
   };

   function WordToHex(lValue) {
           var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
           for (lCount = 0;lCount<=3;lCount++) {
                   lByte = (lValue>>>(lCount*8)) & 255;
                   WordToHexValue_temp = "0" + lByte.toString(16);
                   WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
           }
           return WordToHexValue;
   };

   function Utf8Encode(string) {
           string = string.replace(/\r\n/g,"\n");
           var utftext = "";

           for (var n = 0; n < string.length; n++) {

                   var c = string.charCodeAt(n);

                   if (c < 128) {
                           utftext += String.fromCharCode(c);
                   }
                   else if((c > 127) && (c < 2048)) {
                           utftext += String.fromCharCode((c >> 6) | 192);
                           utftext += String.fromCharCode((c & 63) | 128);
                   }
                   else {
                           utftext += String.fromCharCode((c >> 12) | 224);
                           utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                           utftext += String.fromCharCode((c & 63) | 128);
                   }

           }

           return utftext;
   };

   var x=Array();
   var k,AA,BB,CC,DD,a,b,c,d;
   var S11=7, S12=12, S13=17, S14=22;
   var S21=5, S22=9 , S23=14, S24=20;
   var S31=4, S32=11, S33=16, S34=23;
   var S41=6, S42=10, S43=15, S44=21;

   string = Utf8Encode(string);

   x = ConvertToWordArray(string);

   a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;

   for (k=0;k<x.length;k+=16) {
           AA=a; BB=b; CC=c; DD=d;
           a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
           d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
           c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
           b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
           a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
           d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
           c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
           b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
           a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
           d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
           c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
           b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
           a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
           d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
           c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
           b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
           a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
           d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
           c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
           b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
           a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
           d=GG(d,a,b,c,x[k+10],S22,0x2441453);
           c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
           b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
           a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
           d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
           c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
           b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
           a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
           d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
           c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
           b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
           a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
           d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
           c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
           b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
           a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
           d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
           c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
           b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
           a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
           d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
           c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
           b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
           a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
           d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
           c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
           b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
           a=II(a,b,c,d,x[k+0], S41,0xF4292244);
           d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
           c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
           b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
           a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
           d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
           c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
           b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
           a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
           d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
           c=II(c,d,a,b,x[k+6], S43,0xA3014314);
           b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
           a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
           d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
           c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
           b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
           a=AddUnsigned(a,AA);
           b=AddUnsigned(b,BB);
           c=AddUnsigned(c,CC);
           d=AddUnsigned(d,DD);
   		}

   	var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);

   	return temp.toLowerCase();
}

function ganti_pass() {
	$('#is_ganti').val(1);
	$('#ganti_password_btn').hide();
	$('.ganti_on').show();

	$("#pass_lama").attr('required', '');
	$("#pass_baru1").attr('required', '');
	$("#pass_baru2").attr('required', '');
}

function batal_ganti_pass(){
	$('#is_ganti').val(0);
	$('.ganti_on').hide();
	$('#ganti_password_btn').show();

	$("#pass_lama").removeAttr('required');
	$("#pass_baru1").removeAttr('required');
	$("#pass_baru2").removeAttr('required');
}

function tambah_trans() {
  // var value =$('#copy_select').html();
  var jml_tr = $('#tr_utama_count_trans').val();
  var i = parseInt(jml_tr) + 1;

  var coa = $('#copy_ag').html();

  $isi_1 = 
  '<tr id="tr3_'+i+'">'+
  '<td>'+
  '<input type="text" name="rekening[]" id="reken_'+i+'" class="span12">'+
  '</td>'+

  '<td class="center" style="background:#FFF; text-align:center;">'+
    '<button style="width: 50%;" onclick="hapus_row_trans('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
  '</td>'+
  '</tr>';

  $('#transpor_data').append($isi_1);
  $('#tr_utama_count_trans').val(i);

}

function hapus_row_trans (id) {
  $('#tr3_'+id).remove();
}

function tambah_klik(){
  $('#view_data').hide();
  $('#add_data').fadeIn('slow');
}

function update_klik(id_pel){
  $('#view_data').hide();
  $('#ubah_data').fadeIn('slow');

  $.ajax({
    url : '<?php echo base_url(); ?>master_perusahaan_c/get_master',
    data : {id_pel:id_pel},
    type : "GET",
    dataType : "json",
    success : function(result){
      

      $('#nama_bank_ed').val(result.NAMA_BANK);
      $('#rekening_bank_ed').val(result.NOMOR_REKENING);
      $('#atas_nama_ed').val(result.ATAS_NAMA);
      $('#cabang_ed').val(result.CABANG);
      $('#id_ed').val(result.ID);

      
      
    }
  });
}

function batal_klik(){
  $('#add_data').hide();
  $('#view_data').fadeIn('slow');
}

function batal_klik_update(){
  $('#ubah_data').hide();
  $('#view_data').fadeIn('slow');
}

</script>