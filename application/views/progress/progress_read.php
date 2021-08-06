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
        <h2 style="margin-top:0px">Progress Read</h2>
        <table class="table">
	    <tr><td>Id</td><td><?php echo $id; ?></td></tr>
	    <tr><td>Id Pjm Fidusia</td><td><?php echo $id_pjm_fidusia; ?></td></tr>
	    <tr><td>Id Pbr Fidusia</td><td><?php echo $id_pbr_fidusia; ?></td></tr>
	    <tr><td>Id Pnr Fidusia</td><td><?php echo $id_pnr_fidusia; ?></td></tr>
	    <tr><td>Tanggal Input</td><td><?php echo $tanggal_input; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('progress') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>