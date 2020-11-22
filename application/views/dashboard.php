<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Dashboard </h2>
      </div>
    </div>
  </div>
</div>



<div class="page-inner mt--5" >


  <!-- <div class="row mt--2" id="issueList">

  </div> -->

  <div class="row mt--2">
      <div class="col-md-12">
        <img class="card-img-top" src="<?php echo base_url('./assets/picture/wallpaper.jpg'); ?>" alt="" style="width:950px;">
      <br><br>
      </div>


    <div class="col-md-8">
      <div class="row">

        <div class="card full-height  col-md-12">
          <div class="card-header">
            <div class="card-title">Rekap Laporan Masalah</div>
              <table  class="display datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pelapor</th>
                    <th>Judul Masalah</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody id="issueData">
                </tbody>
              </table>          
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stats card-primary card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-users"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Total Laporan</p>
                            <h4 class="card-title total">1,294</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>


        <div class="card card-stats card-success card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-users"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Total Selesai</p>
                            <h4 class="card-title fixed">1,294</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>


        <div class="card card-stats card-danger card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-users"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Total Belum selesai</p>
                            <h4 class="card-title unfixed">1,294</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
      </div>




      <div class="col-md-12" <?php if($this->session->userdata['roleId']!=2){echo 'hidden';}?>>
      <div class="row">

        <div class="card full-height  col-md-12">
          <div class="card-header">
            <div class="card-title">Rekap Aktifitas Staf</div>
              <table  class="display datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Aplikasi</th>
                    <th>Dataset</th>
                    <th>Catridge</th>
                    <th>Volume</th>
                  </tr>
                </thead>
                <tbody id="test">
                <?php foreach($performance as $item) : ?>
                <tr>
                    <td><?php echo $item->id;?></td>
                    <td><?php echo $item->date;?></td>
                    <td><?php echo $item->user;?></td>
                    <td><?php echo $item->job;?></td>
                    <td><?php echo $item->dataset;?></td>
                    <td><?php echo $item->catridge;?></td>
                    <td><?php echo $item->remark;?></td>
                  </tr>
                <?php endforeach; ?>

                </tbody>
              </table>          
          </div>
        </div>
      </div>
    </div>
</div>
