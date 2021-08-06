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
        <h2>Pbr_fidusia List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>Pbr Nama</th>
		<th>Pbr Alamat</th>
		<th>Pbr Nik</th>
		<th>Pbr Jengkel</th>
		<th>Pbr Nmr Kontak</th>
		
            </tr><?php
            foreach ($pbr_fidusia_data as $pbr_fidusia)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pbr_fidusia->id ?></td>
		      <td><?php echo $pbr_fidusia->pbr_nama ?></td>
		      <td><?php echo $pbr_fidusia->pbr_alamat ?></td>
		      <td><?php echo $pbr_fidusia->pbr_nik ?></td>
		      <td><?php echo $pbr_fidusia->pbr_jengkel ?></td>
		      <td><?php echo $pbr_fidusia->pbr_nmr_kontak ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>