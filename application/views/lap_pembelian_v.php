<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-book"></i> Laporan Pembelian</h3>


		</div>
		<ul class="breadcrumb">
			<li><a href="#" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
			<li><a href="#"> Laporan </a><span class="divider"><i class="icon-angle-right"></i></span></li>
			<li class="active"> Laporan Pembelian</li>
		</ul>
	</div>
</div>


<div class="row-fluid">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-container">
				<form action="<?=base_url().$post_url;?>" method="post" class="form-horizontal" target="_blank">
					<div class="control-group">
						<label class="control-label"> <b style="font-size: 14px;"> Unit </b> </label>
						<div class="controls">
							<div class="input-append" style="width: 50%;">
								<input style="width: 90%; background: #FFF;" type="text" id="unit_txt" name="unit_txt" value="<?=$user->NAMA_UNIT;?>" readonly>
								<input style="width: 90%;" type="hidden" id="unit" name="unit" value="<?=$user->UNIT;?>">
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label"> <b style="font-size: 14px;"> Filter </b> </label>
						<div class="controls">
							<label class="radio inline">
							<input onclick="isfilter();" type="radio" checked="" value="Harian" id="harian" name="filter">
								Harian </label>
							<label class="radio inline">
							<input onclick="isfilter();" type="radio" value="Bulanan" id="bulanan" name="filter">
							Bulanan </label>
						</div>
					</div>

					<div class="control-group harian">
						<label class="control-label"> <b style="font-size: 14px;"> Tanggal </b> </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-calendar"></i></span>
								<input type="text" name="tgl" id="reservation" value=""/>
							</div>
						</div>
					</div>

					<div class="control-group bulanan" style="display:none;">
						<label class="control-label"> <b style="font-size: 14px;"> Bulan </b> </label>
						<div class="controls">
							<select class="span4" name="bulan">
								<option <?PHP if(date('m') == '01' ){ echo "selected"; } ?> value="01"> Januari </option>
								<option <?PHP if(date('m') == '02' ){ echo "selected"; } ?> value="02"> Februari </option>
								<option <?PHP if(date('m') == '03' ){ echo "selected"; } ?> value="03"> Maret </option>
								<option <?PHP if(date('m') == '04' ){ echo "selected"; } ?> value="04"> April </option>
								<option <?PHP if(date('m') == '05' ){ echo "selected"; } ?> value="05"> Mei </option>
								<option <?PHP if(date('m') == '06' ){ echo "selected"; } ?> value="06"> Juni </option>
								<option <?PHP if(date('m') == '07' ){ echo "selected"; } ?> value="07"> Juli </option>
								<option <?PHP if(date('m') == '08' ){ echo "selected"; } ?> value="08"> Agustus </option>
								<option <?PHP if(date('m') == '09' ){ echo "selected"; } ?> value="09"> September </option>
								<option <?PHP if(date('m') == '10' ){ echo "selected"; } ?> value="10"> Oktober </option>
								<option <?PHP if(date('m') == '11' ){ echo "selected"; } ?> value="11"> November </option>
								<option <?PHP if(date('m') == '12' ){ echo "selected"; } ?> value="12"> Desember </option>

							</select>
						</div>
					</div>

					<div class="control-group bulanan" style="display:none;">
						<label class="control-label"> <b style="font-size: 14px;"> Tahun </b> </label>
						<div class="controls">
							<select class="span4" name="tahun">
								<option <?PHP if(date('Y') == '2016' ){ echo "selected"; } ?> value="2016"> 2016 </option>
								<option <?PHP if(date('Y') == '2017' ){ echo "selected"; } ?> value="2017"> 2017 </option>
								<option <?PHP if(date('Y') == '2018' ){ echo "selected"; } ?> value="2018"> 2018 </option>
								<option <?PHP if(date('Y') == '2019' ){ echo "selected"; } ?> value="2019"> 2019 </option>
								<option <?PHP if(date('Y') == '2020' ){ echo "selected"; } ?> value="2020"> 2020 </option>
							</select>
						</div>

					</div>

					<div class="form-actions">
						<input type="submit" value="Cetak PDF" name="pdf" class="btn btn-danger">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Cetak Excel" name="excel" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function isfilter(){

	if($("#harian").is(':checked')){
	    $('.harian').show(); 
	    $('.bulanan').hide(); 
	} 

	if($("#bulanan").is(':checked')){
	    $('.harian').hide(); 
	    $('.bulanan').show();  
	} 
}

</script>