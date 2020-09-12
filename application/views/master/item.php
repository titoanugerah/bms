<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Jenis Perangkat Aset</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewItemModal()">Tambah Jenis Perangkat Baru</button>
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
                <th>Nama Perangkat</th>
                <th>Deskripsi</th>
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

<div class="modal fade" id="detailItemModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Item</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label>Nama Jenis Aset</label>
            <input type="text" class="form-control" id="editName" required>
            <input type="text" class="form-control" id="editId" hidden>
          </div>
          <div class="form-group ">
            <label>Keterangan</label>
            <textarea  rows="2" class="form-control" id="editRemark"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updateItem()">Simpan</button>
            <button type="button" class="btn btn-danger" onclick="deleteItem()">Hapus</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addItemModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Jenis Perangkat</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewItemTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverItemTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan sebelumnya</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewItemTab">
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Jenis Aset</label>
                <input type="text" class="form-control" id="addName" required>
              </div>
              <div class="form-group ">
                <label>Keterangan</label>
                <textarea  rows="2" class="form-control" id="addRemark"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addItem()">Buat Jenis Perangkat Baru</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>

          <div class="tab-pane" id="recoverItemTab">
            <div class="form-group">
              <label>Jenis Perangkat</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverItemId" style="width:440px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverItem()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
