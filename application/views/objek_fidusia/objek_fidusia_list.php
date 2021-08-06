        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('create_kategori'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('kategori_objek/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('kategori_objek/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable1">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Kategori</th>
		    <th>Jenis Kategori</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>

        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('objek_fidusia/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('objek_fidusia/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('objek_fidusia/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable2">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Pemeberi</th>
		    <th>Jenis</th>
		    <th>Merk</th>
		    <th>Tipe</th>
		    <th>Tahun</th>
		    <th>No Rangka</th>
		    <th>No Mesin</th>
		    <th>Warna</th>
		    <th>Bukti</th>
		    <th>Nilai</th>
		    <th>Nilai Penjaminan</th>
		    <th>Jangka Waktu</th>
		    <th>Keterangan</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
        </table>