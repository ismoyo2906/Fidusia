        <h2 style="margin-top:0px"><?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
		<label for="enum">Kategori</label>
		<select name="kategori" id="kategori" class="form-control" autofocus style="height: 45px;">
          <option value="">Kategori</option>
          <option value="Serial Nomor" id="sn">Serial Nomor</option>
          <option value="Tidak Berserial Nomor" id="tbn" hidden>Tidak Berserial Nomor</option>
		</select>
		<br>
		<label for="enum">Jenis Kategori</label>
		<select name="jenis_kategori" id="jk" class="form-control" autofocus style="height: 45px;">
          <option value="">Jenis Kategori</option>
          <option value="Kendaraan R4" id="r4">Kendaraan R4</option>
          <option value="Kendaraan R2" id="r2">Kendaraan R2</option>
		</select>
		</br>
	    <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('objek_fidusia') ?>" class="btn btn-default">Cancel</a>
	</form>
