<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Pjm_fidusia List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>Id Pbr Fidusia</th>
		<th>Id Objek</th>
		<th>Id Pnr Fidusia</th>
		<th>Tanggal Buat</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($pjm_fidusia_data as $pjm_fidusia)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pjm_fidusia->id ?></td>
		      <td><?php echo $pjm_fidusia->id_pbr_fidusia ?></td>
		      <td><?php echo $pjm_fidusia->id_objek ?></td>
		      <td><?php echo $pjm_fidusia->id_pnr_fidusia ?></td>
		      <td><?php echo $pjm_fidusia->tanggal_buat ?></td>
		      <td><?php echo $pjm_fidusia->status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>