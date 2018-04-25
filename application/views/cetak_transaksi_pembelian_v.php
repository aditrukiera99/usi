<link href="css/styles.css" rel="stylesheet">
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

.main-wrapper{
	background: #FFF !important;
}
</style>
	<?PHP 
	$sess_user = $this->session->userdata('masuk_akuntansi');
	$id_klien = $sess_user['id_klien'];
	$id_user = $sess_user['id'];
	$user = $this->master_model_m->get_user_info($id_user);
	?>
	<div class="row-fluid ">
		<div class="span6">
			<div class="primary-head">
				<h3 class="page-header"> <i class="icon-print"></i>  Print Transaksi Pembelian </h3>
				<button style="margin-top: -10px; margin-bottom: 13px;" onclick="window.location='<?=base_url();?>transaksi_pembelian_c'" type="button" class="btn btn-danger">
					<i class="icon-arrow-left"></i> Kembali 
				</button>

				<button style="margin-top: -23px;margin-left: 15px;" class="btn btn-info" onclick="printDiv('printableArea')" ><i class="icon-print"></i> Print </button>
			</div>
		</div>

	</div>

	<div id="printableArea">

	<div class="row-fluid">
	<div style="float: left; width: 50%;">
		<ul class="invoice-info">
			<li><label style="width: 25%;">No. Faktur Pembelian</label> <?=$dt->NO_BUKTI;?></li>
			<li><label style="width: 25%;">Nama Supplier</label> <?=$dt->PELANGGAN;?> </li>
			<br>
			<li><label style="width: 25%;">Tgl. Transaksi</label> <?=$dt->TGL_TRX;?></li>
			<li><label style="width: 25%;">Mata Uang / N.Tukar </label> IDR / 1</li>
			<li><label style="width: 25%;">Status </label> PROSES</li>
			<br>
			<li><label style="width: 25%;">FOB </label> : </li>
			<br>
			<li><label style="width: 25%;">Keterangan </label> <br> <?=$dt->MEMO;?></li>
		</ul>
	</div>
	<div class="" style="float: right; width: 50%;">
		<ul class="invoice-info">
			<li><label style="width: 25%;"><b>Tgl. Cetak</b></label> <b><?=date('d/m/Y');?></b></li>
			<br>
			<li><label style="width: 25%;">Tipe Pembayaran </label> TUNAI</li>
			<li><label style="width: 25%;">Lokasi </label> <?=$user->NAMA_UNIT;?> </li>
			<li><label style="width: 25%;">Dibuat Oleh </label> <?=$user->NAMA;?> </li>
			<li><label style="width: 25%;">Status </label> : </li>
			<li><label style="width: 25%;">Pembayaran Kurir </label> : </li>
		</ul>
	</div>
	</div>
	<br>
	<div class="row-fluid">
	<div class="span12">
		<table class="">
			<thead>
			<tr>
				<th class="invoice-id">
					 No
				</th>
				<th class="invoice-date">
					 Kode
				</th>
				<th class="invoice-date">
					 Nama Barang
				</th>
				<th class="invoice-qty">
					Jumlah
				</th>
				<th class="invoice-qty">
					Satuan
				</th>
				<th class="invoice-unit">
					Harga
				</th>
				<th class="invoice-amount">
					Sub Total
				</th>
			</tr>
			</thead>
			<tbody>
			<?PHP 
			$no = 0;
			foreach ($dt_detail as $key => $row) {
				$no++;
			?>
			<tr>
				<td class="invoice-type">
					<?=$no;?>
				</td>
				<td class="invoice-type">
					 <?=$row->KODE_PRODUK;?>
				</td>
				<td class="invoice-type">
					 <?=$row->NAMA_PRODUK;?>
				</td>
				<td class="invoice-qty">
					 <?=$row->QTY;?>
				</td>
				<td class="invoice-qty">
					<?=$row->SATUAN;?>
				</td>
				<td class="invoice-unit">
					<?=number_format($row->HARGA_SATUAN);?>
				</td>
				<td class="invoice-amount">
					<?=number_format($row->TOTAL);?>
				</td>
			</tr>			
			<?PHP } ?>

			<tr class="invoice-cal">
				<td colspan="5">
					<span class="amount-due">Total Jumlah</span>
				</td>
				<td>
					<span class="amount-due"><?=number_format($dt->TOTAL);?></span>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	</div>
	</div>
	</div>

<input type="hidden" id="tmp_row" value="120"/>

<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>