       <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
		 <?php
			foreach ($user as $u) {?> <p hidden><?php echo $u->nama_user;?><p><?php }?>
        <table class="table table-bordered table-striped" id="">
            <thead>
                <tr>
                    <th width="80px">No</th>
					<th>Pemberi</th>
					<th>Namaa</th>
					<th>Status</th>
					<th>Tanggal Input</th>
                </tr>
            </thead>
			<tbody>
				<?php
				$no = 1;
				foreach($pjm_fidusia as $pjm){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $pjm->pbr_nama; ?></td>
					<td><?php echo $pjm->pnr_nama; ?></td>
					<td><?php echo $pjm->status; ?></td>
					<td><?php echo $pjm->tanggal_buat; ?></td>
					</form>
				<td>
				<?php } ?>
			</tbody>
        </table>