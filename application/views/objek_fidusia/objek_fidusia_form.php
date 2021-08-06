<?php validation_errors('<p style="color:red;">','</p>');?>

<?php
	if($this->session->flashdata())
	{
		echo "<div class='alert alert-danger alert-massage'>";
		echo $this->session->flashdata('alert');
		echo "</div>";
	}
?>
        <h2 style="margin-top:0px"></h2>
        <form action="<?php echo base_url().'objek_fidusia/create_action' ?>" method="post" enctype="multipart/form-data">
		<div class="form-group" id="id_pbr_fidusia">
		 <label>Nama Pemberi</label>
			<select class="form-control" name="id_pbr_fidusia" id="id_pbr_fidusia">
				<?php foreach($pbr_fidusia as $pf){ ?>
				<option value="<?php echo $pf->id_pbr_fidusia;?>"><?php echo $pf->pbr_nama;?></option>
				<?php } ?>
			</select>
		</div>
	    <div class="form-group">
		<label>Kategori</label>
			<select class="form-control" name="id_kategori" id="id_kategori">
				<?php foreach($kategori_objek as $ko){ ?>
				<option value="<?php echo $ko->id_kategori;?>"><?php echo $ko->jenis_kategori;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
		<label for="enum">Jenis Kategori</label>
		<select name="jenis_kategori" id="jk" class="form-control" autofocus>
          <option value="Serial Nomor" id="sn">Serial Nomor</option>
          <option value="Tidak Berserial Nomor" id="tbn" hidden>Tidak Berserial Nomor</option>
		</select>
        </div>
		<div class="form-group" id="merk_objek">
			<label>Merk</label>
			<input type="text" name="merk_objek" class="form-control" placeholder="Yamaha/Honda" value="">
			<?php echo form_error('merk_objek'); ?>
		</div>
		<div class="form-group" id="tipe_objek">
			<label>Tipe</label>
			<input type="text" name="tipe_objek" class="form-control" value="-">
			<?php echo form_error('tipe_objek'); ?>
		</div>
		<div class="form-group" id="tahun_objek">
			<label>Tahun</label>
			<input type="text" name="tahun_objek" class="form-control" value="-">
			<?php echo form_error('tahun_objek'); ?>
		</div>
		<div class="form-group" id="norak_objek">
			<label>No Rangka</label>
			<input type="text" name="norak_objek" class="form-control" value="-">
			<?php echo form_error('norak_objek'); ?>
		</div>
		<div class="form-group" id="nomes_objek">
			<label>No Mesin</label>
			<input type="text" name="nomes_objek" class="form-control" value="-">
			<?php echo form_error('nomes_objek'); ?>
		</div>
		<div class="form-group" id="warna_objek">
			<label>Warna</label>
			<input type="text" name="warna_objek" class="form-control" value="-">
			<?php echo form_error('warna_objek'); ?>
		</div>
		<div class="form-group" id="bukti_objek">
			<label>Bukti</label>
			<input type="file" name="bukti_objek" class="form-control" accept="image/*">
			<?php echo form_error('bukti_objek'); ?>
		</div>
		<div class="form-group" id="nilai_objek">
			<label>Nilai</label>
			<input type="text" name="nilai_objek" class="form-control">
			<?php echo form_error('nilai_objek'); ?>
		</div>
		<div class="form-group" id="nilai_penjaminan">
			<label>Nilai Penjaminan</label>
			<input type="text" name="nilai_penjaminan" class="form-control">
			<?php echo form_error('nilai_penjaminan'); ?>
		</div>
	    <div class="form-group" id="jangka_waktu">
		<label>Jangka Waktu</label>
			<select name="jangka_waktu" class="form-control" autofocus>
				<option value="6 Bulan" id="6b">6 Bulan</option>
				<option value="12 Bulan" id="12b">12 Bulan</option>
				<option value="24 Bulan" id="24b">24 Bulan</option>
			</select>
			<?php echo form_error('jangka_waktu'); ?>
		</div>
		<div class="form-group" id="Keterangan">
			<label>Keterangan</label>
			<input type="text" name="Keterangan" class="form-control" value="-">
			<?php echo form_error('Keterangan'); ?>
		</div>
	    <input type="submit" value="Create" class="btn btn-primary"> 
	    <a href="<?php echo site_url('objek_fidusia') ?>" class="btn btn-default">Cancel</a>
	</form>