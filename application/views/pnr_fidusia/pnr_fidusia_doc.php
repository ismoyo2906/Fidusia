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
        <h2>Pnr_fidusia List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Pnr Nama</th>
		<th>Pnr Alamat</th>
		<th>Pnr Nik</th>
		<th>Pnr Jengkel</th>
		<th>Pnr Nmr Kontak</th>
		
            </tr><?php
            foreach ($pnr_fidusia_data as $pnr_fidusia)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pnr_fidusia->pnr_nama ?></td>
		      <td><?php echo $pnr_fidusia->pnr_alamat ?></td>
		      <td><?php echo $pnr_fidusia->pnr_nik ?></td>
		      <td><?php echo $pnr_fidusia->pnr_jengkel ?></td>
		      <td><?php echo $pnr_fidusia->pnr_nmr_kontak ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>