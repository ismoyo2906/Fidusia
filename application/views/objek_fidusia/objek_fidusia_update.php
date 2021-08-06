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
        <form action="<?php echo base_url().'objek_fidusia/update_action' ?>" method="post" enctype="multipart/form-data">
		<div class="form-group" id="id_pbr_fidusia">
		<?php foreach($objek_fidusia as $of){ ?>
		 <label>Nama Pemberi</label>
		 <input type="hidden" name="id" value="<?php echo $of->id_objek; ?>">
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
          <option value="Tidak Berserial Nomor" id="tbn">Tidak Berserial Nomor</option>
		</select>
        </div>
		<div class="form-group" id="merk_objek">
			<label>Merk / Nama Hewan</label>
			<input type="text" id="merk_objek" name="merk_objek" value="<?php echo $of->merk_objek;?>" class="form-control" placeholder="Yamaha/Honda/Sapi" value="">
			<?php echo form_error('merk_objek'); ?>
		</div>
		<div class="form-group" id="tipe_objek">
			<label>Tipe</label>
			<input type="text" id="tipe_objek" name="tipe_objek" value="<?php echo $of->tipe_objek;?>" class="form-control" value="-">
			<?php echo form_error('tipe_objek'); ?>
		</div>
		<div class="form-group" id="tahun_objek">
			<label>Tahun</label>
			<input type="text" id="tahun_objek" name="tahun_objek" value="<?php echo $of->tahun_objek;?>" class="form-control" value="-">
			<?php echo form_error('tahun_objek'); ?>
		</div>
		<div class="form-group" id="norak_objek">
			<label>No Rangka</label>
			<input type="text" id="norak_objek" name="norak_objek" value="<?php echo $of->norak_objek;?>" class="form-control" value="-">
			<?php echo form_error('norak_objek'); ?>
		</div>
		<div class="form-group" id="nomes_objek">
			<label>No Mesin</label>
			<input type="text" id="nomes_objek" name="nomes_objek" value="<?php echo $of->nomes_objek;?>" class="form-control" value="-">
			<?php echo form_error('nomes_objek'); ?>
		</div>
		<div class="form-group" id="warna_objek">
			<label>Warna</label>
			<input type="text" id="warna_objek" name="warna_objek" value="<?php echo $of->warna_objek;?>" class="form-control" value="-">
			<?php echo form_error('warna_objek'); ?>
		</div>
		<div class="form-group" id="bukti_objek">
			<label>Bukti</label>
			</br>
			<?php
				if(isset($of->bukti_objek)){
				echo '<input type="hidden" name="old_pict" value="'.$of->bukti_objek.'">';
				echo '<img src="'.base_url().'assets/upload/objek/'.$of->bukti_objek.'" width="30%">';
				}
			?></br></br>
			<input type="file" name="bukti_objek" value="<?php echo $of->bukti_objek;?>" class="form-control" accept="image/*">
			<?php echo form_error('bukti_objek'); ?>
		</div>
		<div class="form-group" id="nilai_objek">
			<label>Nilai</label>
			<input type="text" id="nilai_objek" name="nilai_objek" value="<?php echo $of->nilai_objek;?>" class="form-control">
			<?php echo form_error('nilai_objek'); ?>
		</div>
		<div class="form-group" id="nilai_penjaminan">
			<label>Nilai Penjaminan</label>
			<input type="text" id="nilai_penjaminan" name="nilai_penjaminan" value="<?php echo $of->nilai_penjaminan;?>" class="form-control">
			<?php echo form_error('nilai_penjaminan'); ?>
		</div>
	    <div class="form-group" id="jangka_waktu">
		<label>Jangka Waktu</label>
			<select name="jangka_waktu" value="<?php echo $of->jangka_waktu;?>" class="form-control" autofocus>
				<option value="6 Bulan" id="6b">6 Bulan</option>
				<option value="12 Bulan" id="12b">12 Bulan</option>
				<option value="24 Bulan" id="24b">24 Bulan</option>
			</select>
			<?php echo form_error('jangka_waktu'); ?>
		</div>
		<div class="form-group" id="Keterangan">
			<label>Keterangan</label>
			<input type="text" id="Keterangan" name="Keterangan" value="<?php echo $of->Keterangan;?>" class="form-control" value="-">
			<?php echo form_error('Keterangan'); ?>
		</div>
	    <input type="submit" value="Create" class="btn btn-primary"> 
	    <a href="<?php echo site_url('objek_fidusia') ?>" class="btn btn-default">Cancel</a>
	<?php } ?>
	</form>