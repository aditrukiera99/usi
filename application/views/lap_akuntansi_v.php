<div class="row" id="form_divisi" >
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Laporan Akuntansi </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" target="_blank" class="form-horizontal" method="post" action="<?=base_url();?>lap_akuntansi_c">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Bulan</label>
							<div class="col-md-4">
								<select name="bulan" class="form-control">
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
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Tahun</label>
							<div class="col-md-3">
								<select name="tahun" class="form-control">
									<option <?PHP if(date('Y') == '2016' ){ echo "selected"; } ?> value="2016"> 2016 </option>
									<option <?PHP if(date('Y') == '2017' ){ echo "selected"; } ?> value="2017"> 2017 </option>
									<option <?PHP if(date('Y') == '2018' ){ echo "selected"; } ?> value="2018"> 2018 </option>
									<option <?PHP if(date('Y') == '2019' ){ echo "selected"; } ?> value="2019"> 2019 </option>
									<option <?PHP if(date('Y') == '2020' ){ echo "selected"; } ?> value="2020"> 2020 </option>									
								</select>	
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Pilih Laporan</label>
							<div class="col-md-3">
								<select name="lap" class="form-control">
									<option value="JU">Jurnal Umum</option>
									<option value="JS">Jurnal Sementara</option>
									<option value="JF">Jurnal Final</option>
									<option value="BUKUBESAR">Buku Besar</option>
									<option value="NERACA">Neraca</option>
									<option value="LABARUGI">Laba Rugi</option>
									
								</select>	
							</div>
						</div>
						
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<input type="submit" value="Cetak Laporan" class="btn blue" name="cetak" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>