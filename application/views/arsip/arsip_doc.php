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
        <h2>Arsip List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>Id Pbr Fidusia</th>
		<th>Id Pnr Fidusia</th>
		<th>Nama Arsip</th>
		<th>Link Arsip</th>
		<th>Tgl Input Arsip</th>
		
            </tr><?php
            foreach ($arsip_data as $arsip)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $arsip->id_pbr_fidusia ?></td>
		      <td><?php echo $arsip->id_pnr_fidusia ?></td>
		      <td><?php echo $arsip->nama_arsip ?></td>
		      <td><?php echo $arsip->link_arsip ?></td>
		      <td><?php echo $arsip->tgl_input_arsip ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>