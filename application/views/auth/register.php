  <body class="text-center">
    <form class="form-signin" action="<?= base_url('index.php/auth/registerForm') ?>" method="post">
	<img src="<?php echo base_url('assets/image/Logo Perusahaan.jpeg')?>" style="height:auto; width:260px;">
      <h1 class="h3 mb-3 font-weight-normal">Registration</h1>
        <?php
        $errors = $this->session->flashdata('errors');
        if(!empty($errors)){
        ?>
          <div class="row">
              <div class="col-md-12">
              <div class="alert alert-danger text-center">
                  <?php foreach($errors as $key=>$error){ ?>
                  <?php echo "$error<br>"; ?>
                  <?php } ?>
              </div>
              </div>
          </div>
        <?php
        }
        if($msg = $this->session->flashdata('error_login')){ ?>
          <div class="row">
              <div class="col-md-12">
                <div class="alert alert-danger text-center">
                    <?= $msg ?>
                </div>
              </div>
          </div>
        <?php } ?>
      <input name="nama_user" type="text" class="form-control" placeholder="Full Name" required autofocus>
      <div style="margin-top:10px"></div>
      <input name="username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
      <div style="margin-top:10px"></div>
     <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div style="margin-top:10px"></div>
	  <input name="confrim_password" type="password" id="inputPassword" class="form-control" placeholder="Confrim Password" required>
      <select name="role" id="" class="form-control" autofocus style="height: 45px;">
          <option value="">Role</option>
          <option value="Notaris">Notaris</option>
          <option value="Staff Akta">Staff Akta</option>
          <option value="User">User</option>
      </select>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <a href="<?= base_url('index.php/auth') ?>" class="float-left mt-1">Login</a>