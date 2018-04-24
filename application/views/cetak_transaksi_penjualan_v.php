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
	
	<div class="row-fluid ">
		<div class="span6">
			<div class="primary-head">
				<h3 class="page-header"> <i class="icon-print"></i>  Print Transaksi Penjualan </h3>
				<button style="margin-top: -10px; margin-bottom: 13px;" onclick="window.location='<?=base_url();?>transaksi_penjualan_c'" type="button" class="btn btn-danger">
					<i class="icon-arrow-left"></i> Kembali 
				</button>

				<button style="margin-top: -23px;margin-left: 15px;" class="btn btn-info" onclick="printDiv('printableArea')" ><i class="icon-print"></i> Print </button>
			</div>
		</div>

	</div>

	<div id="printableArea">
	<div class="row-fluid">
			<div class="span6">					
				<h4>Penjualan Kepada </h4>
				<address>
				<strong><?=$dt->PELANGGAN;?>.</strong><br>
				 <?=$dt->ALAMAT;?><br>
				<abbr title="Phone">P:</abbr> <?=$dt->NO_TELP;?> </address>
			</div>
		                        
	</div>
	<br>
	<div class="row-fluid">
	<div class="span6">
		<ul class="invoice-info">
			<li><label>Invoice ID</label> #<?=$dt->ID;?></li>
			<li><label>PO Number</label> <?=$dt->NO_BUKTI;?></li>
			<li><label>Issue Date</label> <?=$dt->TGL_TRX;?></li>
			<li><label>Subject</label> <strong><?=$dt->MEMO;?></strong></li>
		</ul>
	</div>
	<div class="span6" style="display: none;">
		<h4>Invoice To</h4>
		<address>
		<strong>Trenza, soft.</strong><br>
		 125 Eskaton Garden, Suite 100<br>
		 San Francisco, CA 94107<br>
		<abbr title="Phone">P:</abbr> (123) 456-7890 </address>
	</div>
	</div>
	<br>
	<div class="row-fluid">
	<div class="span12">
		<table class="table paper-table">
			<thead>
			<tr>
				<th class="invoice-id">
					 #
				</th>
				<th class="invoice-date">
					 Item
				</th>
				<th class="invoice-qty">
					Quantity
				</th>
				<th class="invoice-unit">
					Harga
				</th>
				<th class="invoice-amount">
					Total
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
					 <?=$row->NAMA_PRODUK;?>
				</td>
				<td class="invoice-qty">
					 <?=$row->QTY;?> <?=$row->SATUAN;?>
				</td>
				<td class="invoice-unit">
					 Rp <?=number_format($row->HARGA_SATUAN);?>
				</td>
				<td class="invoice-amount">
					 Rp <?=number_format($row->TOTAL);?>
				</td>
			</tr>
			
			<?PHP } ?>
			<tr class="invoice-cal">
				<td colspan="4">
					<span class="amount-due">Sub Total</span>
				</td>
				<td>
					<span class="amount-due">Rp <?=number_format($dt->TOTAL);?></span>
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