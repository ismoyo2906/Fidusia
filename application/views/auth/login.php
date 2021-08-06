  <body class="text-center">
    <form class="form-signin" action="<?= base_url('index.php/auth/loginForm') ?>" method="post">
      <img src="<?php echo base_url('assets/image/Logo Perusahaan.jpeg')?>" style="height:auto; width:260px;">
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
        <?php } else if($msg = $this->session->flashdata('success_login')){ ?>
          <div class="row">
              <div class="col-md-12">
                <div class="alert alert-success text-center">
                    <?= $msg ?>
                </div>
              </div>
          </div>
        <?php } ?>
      <input name="username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
	  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	  <a href="company" class="btn btn-lg btn-primary btn-block">Back</a>
      <a href="<?php echo base_url('auth/register') ?>" class="float-left mt-1">Register</a>