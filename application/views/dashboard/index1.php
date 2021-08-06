<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   <meta name="description" content="Tutorial Codeigniter Membuat Hak Akses Menggunakan Jquery dan Mysql">
    <meta name="author" content="Ilmucoding">
    <title>List Category</title>   <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5">
<div class="col-md-12 justify-align-center">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            List all Category
                            <div class="float-right">
                                <a href="<?= base_url('index.php/auth/logout') ?>" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                        <div class="card-body">
                             
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;">No</th>
                                            <th>Nama</th>
                                           <th style="width: 30%;">Status</th>
                                           <th style="width: 25%;" id="btn-action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach($categories->result() as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->name ?></td>
                                            <td><?= $data->status ?></td>
                                            <td class="td-btn">
                                                <a href="" class="btn btn-info">
                                                    Detail
                                                </a>
                                                <a href="" class="btn btn-success">
                                                    Edit
                                                </a>
                                                <a href="" class="btn btn-danger">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
</div>
<script>
 
<?php if($this->session->userdata('role') == "Staff Akta"){ ?>
 
  $(document).ready(function(){
 
    $(".btn-danger").remove();
 
  });
 
<?php } else if($this->session->userdata('role') == "User"){ ?>
 
  $(document).ready(function(){
 
    $("#btn-action").remove();
 
    $(".td-btn").remove();
 
  });
 
<?php } else {}; ?>
 
</script>
</body>
</html>