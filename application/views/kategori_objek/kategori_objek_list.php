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
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Kategori</th>
		    <th>Jenis Kategori</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>