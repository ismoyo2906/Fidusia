      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">	
              <h3><?php echo $this->dashboard_model->get_data('pjm_fidusia')->num_rows();?></h3>

              <p>Akta</p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="create_akta" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		
        <div class="col-lg-3 col-xs-6" id="ofs">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $this->dashboard_model->get_data('objek_fidusia')->num_rows();?></h3>

              <p>Objek</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-archive"></i>
            </div>
            <a href="objek" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6" id="pfs">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $this->dashboard_model->get_data('pbr_fidusia')->num_rows();?></h3>

              <p>Pemberi Fidusia</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="pbr" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6" id="pns">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?php echo $this->dashboard_model->get_data('pnr_fidusia')->num_rows();?></h3>

              <p>Penerima Kuasa Leasing</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-walk"></i>
            </div>
            <a href="pnr" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
            <!-- /.box-body -->
          </div>