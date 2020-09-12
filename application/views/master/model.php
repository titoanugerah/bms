<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-Models-left align-Models-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Model Asset</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewModelModal()" data-toggle="modal" data-target="#addModelModal">Tambah Model Asset Baru</button>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <!-- <div class="row mt--2" id='itemList'>

  </div> -->
  <div class="card">

    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
        <a class="nav-link active show" data-toggle="tab" href="#all">Semua</a>
      </div>
    </div>

    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="all">

          <table  class="display datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Nama Perangkat</th>
                <th>Spesifikasi</th>
                <th>Tanggal</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="allData">
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="detailModelModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Model</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="form-group col-md-6">
                <label>Jenis Perangkat</label>
                <select class="form-control select2modal" id="detailItemId" style="width:225px" required>

                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Nama Model</label>
                <input type="text" class="form-control" id="detailName" required>
                <input type="text" class="form-control" id="detailId" hidden>
              </div>

              <div class="form-group col-md-8">
                <label>Spesifikasi</label>
                <textarea  rows="2" class="form-control" id="detailDescription"></textarea>
                <label>Keterangan</label>
                <textarea  rows="2" class="form-control" id="detailRemark"></textarea>
              </div>
              <div class="form-group col-md-4">
                <div class="input-file input-file-image" >
                  <label>Gambar</label>
                  <img class="img-upload-preview" width="300" src="http://placehold.it/300x300" alt="preview" onclick="$('#fileUpload1').click()" id="detailImage">
                  <input type="file" class="form-control form-control-file" id="fileUpload1" name="fileUpload1" accept="image/*" required="">
                </div>
              </div>
            </div>
          </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="updateModel()">Simpan</button>
              <button type="button" class="btn btn-danger" onclick="deleteModel()">Hapus</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>

    </div>
  </div>
</div>

<div class="modal fade" id="addModelModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Model Asset</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewModelTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverModelTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan sebelumnya</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewModelTab">
            <form role="form" method="post" enctype="multipart/form-data">

            <div class="row">
              <div class="form-group col-md-6">
                <label>Jenis Perangkat</label>
                <select class="form-control select2addmodal" id="addItemId" style="width:225px" required>

                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Nama Model</label>
                <input type="text" class="form-control" id="addName" required>
              </div>

              <div class="form-group col-md-8">
                <label>Spesifikasi</label>
                <textarea  rows="2" class="form-control" id="addDescription"></textarea>
                <label>Keterangan</label>
                <textarea  rows="2" class="form-control" id="addRemark"></textarea>
              </div>

              <div class="form-group col-md-4">
                <div class="input-file input-file-image">
                  <label>Gambar</label>
                  <img class="img-upload-preview" width="300" src="http://placehold.it/300x300" alt="preview" onclick="$('#fileUpload').click()">
                  <input type="file" class="form-control form-control-file" id="fileUpload" name="fileUpload" accept="image/*" required="">
                </div>
              </div>
            </div>
          </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addModel()">Buat Model Baru</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>

          <div class="tab-pane" id="recoverModelTab">
            <div class="form-group">
              <label>Model</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverModelId" style="width:440px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverModel()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
