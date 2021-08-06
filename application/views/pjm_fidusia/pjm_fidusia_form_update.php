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
			<select class="form-control" name="groups1" id="groups1">
            <?php 

            foreach($groups1 as $row)
            { 
              echo '<option value="'.$row->id_pbr_fidusia.'">'.$row->pbr_nama.' ('.$row->id_pbr_fidusia.')</option>';
            }
            ?>
            </select>
        </div>
	    <div class="form-group">
        <label>Objek</label>
			<select class="form-control" name="groups2" id="groups2">
            <?php 

            foreach($groups2 as $row)
            { 
              echo '<option value="'.$row->id_objek.'">'.$row->merk_objek.'-'.$row->tipe_objek.' ('.$row->id_objek.')</option>';
            }
            ?>
            </select>
        </div>
	    <div class="form-group">
		<label>Nama Penerima</label>
			<select class="form-control" name="groups3" id="groups3">
            <?php 

            foreach($groups3 as $row)
            { 
              echo '<option value="'.$row->id_pnr_fidusia.'">'.$row->pnr_nama.' ('.$row->id_pnr_fidusia.')</option>';
            }
            ?>
            </select>
        </div>
	    <div class="form-group">
        <label for="enum">Status <?php echo form_error('status') ?></label>
		<select name="status" id="status" class="form-control" autofocus style="height: 45px;">
			<option value="Draf Minuta">Draf Minuta</option>
			<option value="Review">Review</option>
			<option value="Salinan">Salinan</option>
			<option value="Daftar Online">Daftar Online</option>
			<option value="Selesai">Selesai</option>
		</select>
        </div>
	    <input type="" name="id_pjm_fidusia" placeholder="<?php echo $id_pjm_fidusia; ?>" value="<?php echo $id_pjm_fidusia; ?>" />
	    <input type="" name="id_pjm_fidusia" placeholder="<?php echo $id_pjm_fidusia; ?>" value="<?php echo $id_pjm_fidusia; ?>" />
		<input type="hidden" class="form-control" name="tanggal_buat" id="tanggal_buat" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H.i.s') ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pjm_fidusia') ?>" class="btn btn-default">Cancel</a>
	</form>
