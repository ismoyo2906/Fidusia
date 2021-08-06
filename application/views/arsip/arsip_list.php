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
                <?php echo anchor(site_url('arsip/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('arsip/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('arsip/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Pemberi</th>
		    <th>Nama Penerima</th>
		    <th>Nama Arsip</th>
		    <th>Link Arsip</th>
		    <th>Tanggal Input</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>