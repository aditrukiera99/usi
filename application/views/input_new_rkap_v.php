<div class="row-fluid ">
	<div class="span12">
		<div class="primary-head">
			<h3 class="page-header"> <i class="icon-plus"></i> Input RKAP unit <b><?=$user->NAMA_UNIT;?></b>  </h3>
		</div>
	</div>
</div>

<?PHP if($msg == 11){ ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i><strong>Sukses!</strong> RKAP telah berhasil disimpan.
</div>
<?PHP } ?>

<div class="row-fluid">
	<div class="span12">
		<div class="content-widgets light-gray">
			<div class="widget-head blue">
				<h3> Form RKAP </h3>
			</div>
			<div class="widget-container">
				<form class="form-horizontal" method="post" action="<?=base_url().$post_url;?>">
					<div class="control-group">
                        <label class="control-label"> <b style="font-size: 14px;"> Pilih Kode Akun </b> </label>
                        <div class="controls">
                            <select  required  class="chzn-select" tabindex="1" style="width:100%;" name="kode_akun" id="kode_akun">
                               <?PHP foreach ($list_akun as $key => $row) {
	                               if($row->SUB == ''){
	                               echo "<option value='".$row->KODE_AKUN."'>".$row->KODE_AKUN." : ".$row->NAMA_AKUN."</option>";
	                               } else {
	                               echo "<option value='".$row->KODE_AKUN.".".$row->SUB."'>".$row->KODE_AKUN.".".$row->SUB." : ".$row->NAMA_AKUN."</option>";
	                               }
                               } 
                               ?>           
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
						<label class="control-label"> <b style="font-size: 14px;">TAHUN</b> </label>
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

					<hr>
					<div class="row-fluid">
						<div class="span1"></div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label"> JANUARI </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="januari">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> FEBRUARI </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="februari">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> MARET </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="maret">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> APRIL </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="april">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> MEI </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="mei">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> JUNI </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="juni">
								</div>
							</div>
						</div>

						<div class="span4">
							<div class="control-group">
								<label class="control-label"> JULI </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="juli">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> AGUSTUS </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="agustus">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> SEPTEMBER </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="september">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> OKTOBER </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="oktober">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> NOVEMBER </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="november">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label"> DESEMBER </label>
								<div class="controls">
									<input type="text" required class="span12 bln_rkap" onchange="hitung_total_rkap();" onkeyup="FormatCurrency(this);" value="" name="desember">
								</div>
							</div>
						</div>
					</div>

					<hr>

					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label"> <b style="font-size: 14px;"> TOTAL RKAP </b> </label>
								<div class="controls">
									<input style="background: #FFF; font-weight: bold; font-size: 13px;" type="text" readonly class="span12" value="" name="total_rkap" id="total_rkap">
								</div>
							</div>
						</div>
					</div>

					<div class="form-actions">
						<input type="submit" class="btn btn-info" name="simpan" value="SIMPAN RKAP">
						<a href="<?=base_url();?>input_rkap_c" class="btn"> BATAL DAN KEMBALI </a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function hitung_total_rkap() {
		var sum = 0;
		$('.bln_rkap').each(function(){
			var a = $(this).val();
			if(a == null || a == ""){
				a = '0';
			}
			a = a.split(',').join('');
		    sum += parseFloat(a);
		});
		$('#total_rkap').val(NumberToMoney(sum).split('.00').join(''));
	}
</script>