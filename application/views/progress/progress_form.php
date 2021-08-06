<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Progress <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id <?php echo form_error('id') ?></label>
            <input type="text" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Pjm Fidusia <?php echo form_error('id_pjm_fidusia') ?></label>
            <input type="text" class="form-control" name="id_pjm_fidusia" id="id_pjm_fidusia" placeholder="Id Pjm Fidusia" value="<?php echo $id_pjm_fidusia; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Pbr Fidusia <?php echo form_error('id_pbr_fidusia') ?></label>
            <input type="text" class="form-control" name="id_pbr_fidusia" id="id_pbr_fidusia" placeholder="Id Pbr Fidusia" value="<?php echo $id_pbr_fidusia; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Pnr Fidusia <?php echo form_error('id_pnr_fidusia') ?></label>
            <input type="text" class="form-control" name="id_pnr_fidusia" id="id_pnr_fidusia" placeholder="Id Pnr Fidusia" value="<?php echo $id_pnr_fidusia; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Tanggal Input <?php echo form_error('tanggal_input') ?></label>
            <input type="text" class="form-control" name="tanggal_input" id="tanggal_input" placeholder="Tanggal Input" value="<?php echo $tanggal_input; ?>" />
        </div>
	    <input type="hidden" name="id_progress" value="<?php echo $id_progress; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('progress') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>