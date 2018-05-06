<?PHP 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style type="text/css">

input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
}

</style>

<?PHP 
$no_transaksi = 1;
if($no_trx->NEXT != "" || $no_trx->NEXT != null ){
    $no_transaksi = $no_trx->NEXT+1;
}
?>

<form class="" method="post" action="<?=base_url().$post_url;?>" onsubmit = "return cek_simpan();";>


<input type="hidden" id="total_kredit_all" name="total_kredit_all" value="0">
<input type="hidden" name="kode_akun_hutang" id="kode_akun_hutang" value="">
<input type="hidden" name="kode_akun_pajak" id="kode_akun_pajak" value="">

<div class="row-fluid ">
    <div class="span12">
        <div class="primary-head">
            <h3 class="page-header"> <i class="icon-plus-sign"></i> Pelunasan Piutang </h3>
        </div>

        <ul class="breadcrumb">
            <li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
            <li><a href="#">Input Akuntansi</a><span class="divider"><i class="icon-angle-right"></i></span></li>
            <li class="active"> Pelunasan Piutang </li>
        </ul>
    </div>
</div>

<div class="row-fluid form-horizontal" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
    <div>
        <div class="span6">
            <div class="control-group" style="display: none;">
                <label class="control-label"> <b style="font-size: 14px;"> Unit </b> </label>
                <div class="controls">
                    <div class="input-append">
                        <input style="width: 90%;" type="text" id="unit_txt" name="unit_txt" value="<?=$user->NAMA_UNIT;?>" readonly>
                        <input style="width: 90%;" type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>">
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"> <b style="font-size: 14px;"> No. Piutang </b> </label>
                <div class="controls">
                    <div class="input-append">
                        <input style="width: 90%;" type="text" id="no_hutang" name="no_hutang" value="PIU<?=$no_transaksi;?>" readonly>
                        <input style="width: 90%;" type="hidden" id="no_hutang2" name="no_hutang2" value="<?=$no_transaksi;?>" readonly>
                    </div>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label"> <b style="font-size: 14px;"> No. Bukti Kas </b> </label>
                <div class="controls">
                    <div class="input-append">
                        <input type="text" id="no_bukti" name="no_bukti" readonly style="background:#FFF;">
                        <button onclick="show_pop_no_bukti();" type="button" class="btn">Cari</button>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"> <b style="font-size: 14px;"> Tanggal Cek </b> </label>
                    <div class="controls">
                        <div id="datetimepicker1" class="input-append date ">
                            <input style="background:#FFF;" value="<?=date('d-m-Y');?>" readonly name="tgl_cek" id="tgl_cek" onclick="$('#add_on_pick').click();" data-format="dd-MM-yyyy" type="text"><span class="add-on "><i id="add_on_pick" data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                        </div>
                    </div>
            </div>  

            <div class="control-group">
                <label class="control-label"> <b style="font-size: 14px;"> Atas Nama </b> </label>
                <div class="controls">
                    <div class="input-append">
                        <input style="background:#FFF;" type="hidden" id="id_atas_nama" name="id_atas_nama" value="" readonly>
                        <input style="background:#FFF;" type="text" id="atas_nama" name="atas_nama" value="" readonly>
                    </div>
                </div>
            </div>
                    
        </div>
        
        <div class="span6">
            <div class="control-group" style="margin-left: 10px;">
                <label class="control-label"> <b style="font-size: 14px;"> Uraian </b> </label>
                <div class="controls">
                    <textarea rows="4" id="uraian" name="uraian" required="" style="resize:none; height: 87px; width: 80%;"></textarea>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="margin-bottom: 15px; display: none;" class="span4">
    <div class="controls">
        <label class="checkbox" style="font-size: 16px;">
        <input type="checkbox" checked name="is_showed" id="is_showed" value="" onclick="show_detail();">
        Tampilkan Detail </label>
    </div>
</div>

<div class="row-fluid" style="background: #F5EADA;">
    <div class="span3" style="margin-left: 20px;">
        <div class="control-group">
                <label class="control-label"> <b style="font-size: 14px;"> Kas / Bank </b> </label>
                <div class="controls">
                    <select  data-placeholder="Pilih ..." class="chzn-select" tabindex="2" style="width:400px;" id="kode_akun_add" name="kode_akun_add">
                        <?PHP foreach ($get_list_akun_all as $key => $akun_all) { ?>
                            <option value="<?=$akun_all->KODE_AKUN;?>"> <?=$akun_all->KODE_AKUN;?> - <?=$akun_all->NAMA_AKUN;?></option>
                        <?PHP } ?>              
                    </select>
                </div>
        </div>
    </div>

    <div class="span3">
        <div class="control-group">
            <label class="control-label"> <b style="font-size: 14px;"> Nominal </b> </label>
            <div class="controls">
                <div class="input-append">
                    <input style="width: 100%;" onkeyup="FormatCurrency(this);" type="text" id="nominal" name="nominal" value="">
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="span2"  style="margin-top: 20px;">
        <button style="width: 100%;" onclick="add_row();" class="btn btn-info" type="button"> <i class="icon-plus"></i> Tambah </button>
    </div> -->
</div>



<div class="row-fluid" style="background: #F5EADA; padding-top: 15px; padding-bottom: 15px;">
    <div class="span12">
        <div class="widget-head blue">
            <h3> Data Transaksi </h3>
        </div>

        <table class="stat-table table table-hover">
            <thead>
                <tr>
                    <th align="center"> No </th>
                    <th align="center"> Keterangan </th>
                    <th align="center"> Nilai </th>
                </tr>                       
            </thead>
            <tbody id="tes" style="font-size: 13px;">
                <tr> <td colspan="3" align="center"> <b> </b> </td> </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td style="background:#F1F1F1;" align="center"> <b> TOTAL </b> </td>
                    <td style="background:#F1F1F1;" align="right">  </td>
                    <td style="background:#F1F1F1;" align="right"> <b style="font-size: 13px;" id="tot_kredit_txt"> 0 </b> </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="row-fluid" id="view_data">
    <div class="span12">
        <div class="content-widgets light-gray">
            <div class="widget-head orange">
                <h3> </h3>
            </div>
            <div class="widget-container">
                <div class="form-actions">
                    <center>
                    <input type="hidden" name="total_all" id="total_all" value="" />
                    <button class="btn" onclick="window.location='<?=base_url();?>input_jurnal_bayar_kas_c' " type="button"> Batal dan Kembali </button>
                    <input type="submit" value="Simpan Transaksi" name="simpan" class="btn btn-success">
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
<script type="text/javascript">
function show_pop_no_bukti(id){
    get_popup_no_bukti();
    ajax_no_bukti();
}

function get_popup_no_bukti(){
    var base_url = '<?php echo $base_url2; ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang" id="search_koang" class="form-control" value="" placeholder="Cari No. Bukti...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>NO</th>'+
                '                        <th style="white-space:nowrap;">NO BUKTI KAS</th>'+
                '                        <th>ATAS NAMA</th>'+
                '                        <th>NILAI</th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_no_bukti(){
    var keyword = $('#search_koang').val();
    $.ajax({
        url : '<?php echo base_url(); ?>input_jurnal_bayar_kas_c/get_no_bukti',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;

                isine += '<tr onclick="get_transaksi(\'' +res.NO_VOUCHER+ '\', \'' +res.NO_BUKTI+ '\');" style="cursor:pointer;">'+
                            '<td align="center">'+no+'</td>'+
                            '<td align="center">'+res.NO_VOUCHER+'</td>'+
                            '<td align="center">'+res.KONTAK+'</td>'+
                            '<td align="center">'+res.KREDIT+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
                isine = "<tr><td colspan='4' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang').off('keyup').keyup(function(){
                ajax_no_bukti();
            });
        }
    });
}

function get_transaksi(no_voucher , no_bukti){

    $('#tes_row').html('');
    $('#tot_kredit_txt').html(0);
    $.ajax({
        url : '<?php echo base_url(); ?>input_jurnal_bayar_kas_c/get_transaksi',
        type : "POST",
        dataType : "json",
        data : {
            no_bukti : no_bukti,
            no_voucher : no_voucher,
        },
        success : function(res){
            $('#no_bukti').val(no_voucher);
            $('#uraian').val(res.URAIAN);
            $('#id_atas_nama').val(res.ID_KONTAK);
            $('#atas_nama').val(res.KONTAK);
            $('#nominal').val(NumberToMoney(res.KREDIT).split('.00').join(''));
            $('#tot_kredit_txt').html(NumberToMoney(res.KREDIT));
            $('#tgl').val(res.TGL);

            // get_hitungan_hutang(no_voucher);

            $('#search_koang').val("");
            $('#popup_koang').css('display','none');
            $('#popup_koang').hide();

            get_transaksi_detail(no_voucher);

        }
    });


}

function get_transaksi_detail(no_voucher){
    $.ajax({
        url : '<?php echo base_url(); ?>input_jurnal_bayar_kas_c/get_transaksi_detail',
        type : "POST",
        dataType : "json",
        data : {
            no_voucher : no_voucher
        },
        success : function(result){
            var isine = '';
            var no = 0;
            $.each(result,function(i,res){
                no++;
                isine += '<tr>'+
                            '<td style="text-align:center;">'+no+'</td>'+
                            '<td style="text-align:left;">'+res.KET+'</td>'+
                            '<td style="text-align:right;">'+NumberToMoney(res.DEBET).split('.00').join('')+'</td>'+
                        '</tr>';
            });
            $('#tes').html(isine); 
        }
    });
}

function show_detail(){
    if($("#is_showed").is(':checked')){
        $('#detail_view').show(); 
    } else {
        $('#detail_view').hide(); 
    }
}

function add_row(){
    var no_bukti  = $('#no_trx_akun').val();
    var no_akun  = $('#kode_akun_add').val();
    var kredit = $('#kredit_add').val();

    if(no_bukti == ""){
        alert("Silahkan pilih nomor bukti terlebih dahulu");
    } else {

        if(kredit == ""){
            alert('Mohon isikan nilai debet atau kredit');
        } else {


        kredit = kredit.split(',').join('');


        var i = $('.tr_row').length + 1;
        $.ajax({
            url : '<?php echo base_url(); ?>input_jurnal_bayar_kas_c/get_kode_akun_rinci',
            type : "POST",
            dataType : "json",
            data : {
                no_akun : no_akun,
            },
            success : function(result){
                $isi = 
                 "<tr class='tr_row' id='tr_"+i+"'>"+
                    "<td style='background:#FFF; text-align:center'><input type='hidden' name='kode_akun_row[]' value='"+no_akun+"'/> "+no_akun+"</td>"+
                    "<td style='background:#FFF; text-align:left'>"+result.NAMA_AKUN+"</td>"+
                    "<td style='background:#FFF; text-align:right;'> <input type='hidden' class='kre_row' name='kredit_row[]' value='"+kredit+"'/>"+NumberToMoney(kredit).split('.00').join('')+"</td>"+
                    "<td style='background:#FFF; text-align:center;'> <button onclick='hapus_row("+i+");' type='button' class='btn btn-danger'> Hapus </button> </td>"+
                 "</tr>";

             $('#tes_row').append($isi);
             hitung_total_row();

             $('#kredit_add').val("");

            }
        });

        }
    }
}

function hitung_total_row(){

    var tot_kre = 0;
    $(".kre_row").each(function(idx, elm) {
        var tot2 = elm.value.split(',').join('');
        if(tot2 > 0){
            tot_kre += parseFloat(tot2);
        }
    });



    $('#total_kredit_all').val(tot_kre);
    $('#tot_kredit_txt').html(NumberToMoney(tot_kre).split('.00').join(''));
}

function cek_simpan () {

    $nilai_hutang_usaha = parseFloat($('#hutang_usaha').val().split(',').join(''));
    $nilai_hutang_lain  = parseFloat($('#hutang_lain').val().split(',').join(''));
    $nilai_pajak        = parseFloat($('#nilai_pajak').val().split(',').join(''));
    $bayar_untuk        = $('#pembayaran_untuk').val();
    $total_nilai        = parseFloat($('#total_kredit_all').val());

    $kon = false;

    if($total_nilai == 0){
        alert('Mohon isikan nominal pembayaran terlebih dahulu');
        $kon = false;
    } else {
        if($bayar_untuk == 'hutang_usaha'){
            if($nilai_hutang_usaha == 0){
                alert('Hutang Usaha 0, tidak perlu untuk melakukan pembayaran untuk ini.');
                $kon = false;
            } else {
                if($nilai_hutang_usaha < $total_nilai){
                    alert('Nominal pembayaran tidak boleh lebih besar daripada nilai hutang usaha');
                    $kon = false;
                } else {
                    $kon = true;
                }
            }

        } else if($bayar_untuk == 'hutang_lainnya'){
            if($nilai_hutang_lain == 0){
                alert('Hutang Lainnya 0, tidak perlu untuk melakukan pembayaran untuk ini.');
                $kon = false;
            } else {
                if($nilai_hutang_lain < $total_nilai){
                    alert('Nominal pembayaran tidak boleh lebih besar daripada nilai hutang lainnya');
                    $kon = false;
                } else {
                    $kon = true;
                }
            }
        } else if($bayar_untuk == 'pajak'){
            if($nilai_pajak == 0){
                alert('Pajak 0, tidak perlu untuk melakukan pembayaran untuk ini.');
                $kon = false;
            } else {
                if($nilai_pajak < $total_nilai){
                    alert('Nominal pembayaran tidak boleh lebih besar daripada nilai pajak');
                    $kon = false;
                } else {
                    $kon = true;
                }
            }
        }
    }

    return $kon;
}

function hapus_row (id) {
    $('#tr_'+id).remove();
    hitung_total_row();
}


</script>