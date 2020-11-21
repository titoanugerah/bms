<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Dataset </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
      <a href="<?php echo base_url('api/dataset/download'); ?>" class="btn btn-white btn-border btn-round mr-2" >Download Rekap </a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewDatasetForm()">Tambah Dataset Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="datasetList">

  </div>
</div>

<div class="modal fade" id="addDatasetModal" dataset="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Dataset</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Tambah Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewTab">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Dataset</label>
                  <input type="text" class="form-control" id="addName" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Job/Aplikasi</label>
                  <br>
                  <select class="form-control select2addmodal" id="addJobId" style="width:200px">
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addDataset()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>

          </div>
          <div class="tab-pane" id="recoverTab">
            <div class="form-group">
              <label>Dataset</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverDatasetId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverDataset()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailDatasetModal" dataset="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Dataset</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Dataset</label>
              <input type="text" class="form-control" id="editName" required>
              <input type="text" class="form-control" id="editId" hidden>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Job/Aplikasi</label>
              <br>
              <select class="form-control select2modal" id="editJobId" style="width:200px">
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteDataset()">Hapus</button>
          <button type="button" class="btn btn-primary" onclick="updateDataset()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div>
</div>
