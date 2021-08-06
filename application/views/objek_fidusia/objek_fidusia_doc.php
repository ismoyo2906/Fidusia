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
        <h2>Objek_fidusia List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Pbr Fidusia</th>
		<th>Id Kategori</th>
		<th>Merk Objek</th>
		<th>Tipe Objek</th>
		<th>Tahun Objek</th>
		<th>Norak Objek</th>
		<th>Nomes Objek</th>
		<th>Warna Objek</th>
		<th>Bukti Objek</th>
		<th>Nilai Objek</th>
		<th>Nilai Penjaminan</th>
		<th>Jangka Waktu</th>
		<th>Keterangan</th>
		
            </tr><?php
            foreach ($objek_fidusia_data as $objek_fidusia)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $objek_fidusia->id_pbr_fidusia ?></td>
		      <td><?php echo $objek_fidusia->id_kategori ?></td>
		      <td><?php echo $objek_fidusia->merk_objek ?></td>
		      <td><?php echo $objek_fidusia->tipe_objek ?></td>
		      <td><?php echo $objek_fidusia->tahun_objek ?></td>
		      <td><?php echo $objek_fidusia->norak_objek ?></td>
		      <td><?php echo $objek_fidusia->nomes_objek ?></td>
		      <td><?php echo $objek_fidusia->warna_objek ?></td>
		      <td><?php echo $objek_fidusia->bukti_objek ?></td>
		      <td><?php echo $objek_fidusia->nilai_objek ?></td>
		      <td><?php echo $objek_fidusia->nilai_penjaminan ?></td>
		      <td><?php echo $objek_fidusia->jangka_waktu ?></td>
		      <td><?php echo $objek_fidusia->Keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>