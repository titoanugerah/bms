<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" id="departmentName">Departemen </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewDepartmentModal()">Tambah Departemen Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="departmentList">

  </div>
</div>


<div class="modal fade" id="detailDepartmentModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Departemen</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <ul class="wizard-menu nav nav-pills nav-primary" hidden>
            <li class="step" style="width: 50%;">
              <a class="nav-link active" href="#departmentInformation" data-toggle="tab" aria-expanded="true"><i class="fas fa-info-circle mr-0"></i> Informasi Umum</a>
            </li>
            <li class="step" style="width: 50%;">
              <a class="nav-link" href="#departmentMember" data-toggle="tab"><i class="fa fa-users mr-2"></i>Anggota Departemen</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="departmentInformation">
              <div class="row" style="height:250px; overflow-y:scroll">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama Departemen</label>
                    <input type="text" class="form-control" id="editName" required>
                    <input type="text" class="form-control" id="editId" hidden>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label>Deskripsi</label>
                  <textarea  rows="2" class="form-control" id="editDescription"></textarea>
                </div>
                <div class="form-group col-md-12" style="height:250px; overflow-y:scroll">
                <label>Data Member</label>
                <div class="card-list" id="memberList">


                </div>
              </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateDepartment()">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="deleteDepartment()">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              </div>
            </div>
            <div class="tab-pane" id="departmentMember">
              
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="addDepartmentModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Departemen</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewDepartmentTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Tambah Departemen Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverDepartmentTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan Departemen</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewDepartmentTab">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Departemen</label>
                  <input type="text" class="form-control" id="addName" required>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label>Deskripsi</label>
                <textarea  rows="2" class="form-control" id="addDescription"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addDepartment()">Buat Departemen Baru</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>

          </div>
          <div class="tab-pane" id="recoverDepartmentTab">
            <div class="form-group">
              <label>Departemen</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverDepartmentId" style="width:360px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverDepartment()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
