        <h2 style="margin-top:0px"><?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Penerima <?php echo form_error('pnr_nama') ?></label>
            <input type="text" class="form-control" name="pnr_nama" id="pnr_nama" placeholder="Nama" value="<?php echo $pnr_nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('pnr_alamat') ?></label>
            <input type="text" class="form-control" name="pnr_alamat" id="pnr_alamat" placeholder="Alamat" value="<?php echo $pnr_alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">NIK <?php echo form_error('pnr_nik') ?></label>
            <input type="text" class="form-control" maxlength="16" name="pnr_nik" id="pnr_nik" placeholder="NIK" value="<?php echo $pnr_nik; ?>" />
        </div>
		<div class="form-group">
		<label for="enum">Jenis Kelamin<?php echo form_error('pnr_jengkel') ?></label>
      <select name="pnr_jengkel" id="pnr_jengkel" class="form-control" autofocus style="height: 45px;">
          <option value="Pria">Pria</option>
          <option value="Wanita">Wanita</option>
      </select>
	  </div>
	    <div class="form-group">
            <label for="varchar">No Telp <?php echo form_error('pnr_nmr_kontak') ?></label>
            <input type="tel" maxlength="14" class="form-control" name="pnr_nmr_kontak" id="pnr_nmr_kontak" placeholder="No Telp" value="<?php echo $pnr_nmr_kontak; ?>" />
        </div>
	    <input type="hidden" name="id_pnr_fidusia" value="<?php echo $id_pnr_fidusia; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pnr_fidusia') ?>" class="btn btn-default">Cancel</a>
	</form>
