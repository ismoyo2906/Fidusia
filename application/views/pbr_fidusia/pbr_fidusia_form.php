    <body>
        <h2 style="margin-top:0px"><?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
		<div class="form-group">
		 <label>Nama Pemberi</label>
			<select class="form-control" name="groups" id="groups">
            <?php 

            foreach($groups as $row)
            { 
              echo '<option value="'.$row->id.'">'.$row->nama_user.' ('.$row->id.')</option>';
            }
            ?>
            </select>
		</div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('pbr_nama') ?></label>
            <input type="text" class="form-control" name="pbr_nama" id="pbr_nama" placeholder="Nama" value="<?php echo $pbr_nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('pbr_alamat') ?></label>
            <input type="text" class="form-control" name="pbr_alamat" id="pbr_alamat" placeholder="Alamat" value="<?php echo $pbr_alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">NIK <?php echo form_error('pbr_nik') ?></label>
            <input type="text" maxlength="16" class="form-control" name="pbr_nik" id="pbr_nik" placeholder="NIK" value="<?php echo $pbr_nik; ?>" />
        </div>
		<div class="form-group">
		<label for="enum">Jenis Kelamin<?php echo form_error('pbr_jengkel') ?></label>
      <select name="pbr_jengkel" id="pbr_jengkel" class="form-control" autofocus style="height: 45px;">
          <option value="Pria">Pria</option>
          <option value="Wanita">Wanita</option>
      </select>
	  </div>
	    <div class="form-group">
            <label for="varchar">Nomor Telp <?php echo form_error('pbr_nmr_kontak') ?></label>
            <input type="tel" maxlength="14" class="form-control" name="pbr_nmr_kontak" id="pbr_nmr_kontak" placeholder="No Tlpn" value="<?php echo $pbr_nmr_kontak; ?>" />
        </div>
	    <input type="hidden" name="id_pbr_fidusia" value="<?php echo $id_pbr_fidusia; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pbr_fidusia') ?>" class="btn btn-default">Cancel</a>
	</form>