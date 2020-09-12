<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Profil</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row mt--2">
    <div class="col-md-12">
      <div class="row">

      <div class="card full-height  col-md-9">
        <div class="card-header">
          <div class="card-title">Identitas Pengguna</div>
          <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">

          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" id="Id" value="<?php echo $this->session->userdata['Fullname'] ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" class="form-control" id="Email" value="<?php echo $this->session->userdata['Email'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Posisi</label>
                <input type="text" class="form-control" id="Role" value="<?php echo $this->session->userdata['Role'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Departemen</label>
                <input type="text" class="form-control" id="Department" value="<?php echo $this->session->userdata['Department'] ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Ext</label>
                <input type="text" class="form-control" id="Ext" value="<?php echo $this->session->userdata['Ext'] ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <center>
            Foto Profil
          </center>
        </div>
        <div class="card-body">
          <center>
            <div class="avatar avatar-xxl">
              <img src="<?php echo $this->session->userdata['Image']; ?>" alt="..." class="avatar-img rounded-circle">
              <br><br>
              <h4><?php echo $this->session->userdata['Fullname']; ?></h4>
              <p><?php echo $this->session->userdata['Department']; ?></p>
            </div>
          </center></div>
        </div>
      </div>
    </div>

    </div>
  </div>

</div>
