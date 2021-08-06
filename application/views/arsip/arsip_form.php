        <h2 style="margin-top:0px"><?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
		<div class="form-group">
		 <label>Nama Pemberi</label>
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
		 <label>Nama Penerima</label>
			<select class="form-control" name="groups2" id="groups2">
            <?php 

            foreach($groups2 as $row)
            { 
              echo '<option value="'.$row->id_pnr_fidusia.'">'.$row->pnr_nama.' ('.$row->id_pnr_fidusia.')</option>';
            }
            ?>
            </select>
		</div>
	    <div class="form-group">
            <label for="varchar">Nama Arsip <?php echo form_error('nama_arsip') ?></label>
            <input type="text" class="form-control" name="nama_arsip" id="nama_arsip" placeholder="Nama Arsip" value="<?php echo $nama_arsip; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Link Arsip <?php echo form_error('link_arsip') ?></label>
            <input type="text" class="form-control" name="link_arsip" id="link_arsip" placeholder="Link Arsip" value="<?php echo $link_arsip; ?>" />
        </div>
	    <input type="hidden" name="id_arsip" value="<?php echo $id_arsip; ?>" /> 
		<input type="hidden" class="form-control" name="tgl_input_arsip" id="tgl_input_arsip" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H.i.s') ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('arsip') ?>" class="btn btn-default">Cancel</a>
	</form>