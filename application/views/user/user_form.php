        <h2 style="margin-top:0px"><?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama User <?php echo form_error('nama_user') ?></label>
            <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama User" value="<?php echo $nama_user; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
			</br>
			<label for="varchar">Confrim Password <?php echo form_error('confrim_password') ?></label>
			<input type="password" class="form-control" name="confrim_password" id="confrim_password" placeholder="Confrim password" value="<?php echo $password; ?>" />
        </div>
		</br>
		<label for="enum">Role <?php echo form_error('role') ?></label>
		<select name="role" id="role" class="form-control" autofocus style="height: 45px;">
			<option id="us" value="User">User</option>
			<option id="sa" value="Staff Akta">Staff Akta</option>
		</select>
		</br>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
	</form>