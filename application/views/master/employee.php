<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" id="divisonName">Pengguna </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addEmployeeModal()">Tambah Pengguna Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="employeeList">

  </div>
</div>

<div class="modal fade" id="detailEmployeeModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4 id="detailEmployeeFullname">Detail Pengguna</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-8">
              <label>Email</label>
              <input type="text" class="form-control" id="detailEmployeeId"  hidden>
              <input type="email" class="form-control" id="detailEmployeeEmail" placeholder="contoh@gmail.com" required>
            </div>
            <div class="form-group col-md-4">
              <label>Ext</label>
              <input type="text" class="form-control" id="detailEmployeeExt" placeholder="XXXX" required>
            </div>
            <div class="form-group col-md-6">
              <label>Hak Akses</label>
              <br>
              <select class="form-control select2addmodal2" id="detailEmployeeRole" style="width:200px;">
                <option value="0">Silahkan Pilih</option>
                <!-- <option value="1">Staf</option> -->
                <option value="4" >IT Asset</option>
                <option value="2" >PIC Asset</option>
                <option value="5" >Manager IT Asset</option>
                <option value="6" >GM IT Asset</option>
                <option value="7" >Manager User</option>
<!-- perlu direvisi akun -->
              </select>
            </div>

            <div class="form-group col-md-6" id="detailDepartmentDiv">
              <label>Department</label>
                <select class="form-control select2addmodal2" id="detailEmployeeDepartmentId" style="width:200px">
              </select>
            </div>

          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" onclick="deleteEmployee()" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-primary" onclick="updateEmployee()">Simpan</button>
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addEmployeeModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Pengguna Baru</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <ul class="wizard-menu nav nav-pills nav-primary">
            <li class="step" style="width: 50%;">
              <a class="nav-link active" href="#addNewEmployeeTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Tambah Pengguna Baru</a>
            </li>
            <li class="step" style="width: 50%;">
              <a class="nav-link" href="#recoverEmployeeTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan Pengguna</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="addNewEmployeeTab">
              <div class="row">
                <div class="form-group col-md-8">
                  <label>Email</label>
                  <input type="email" class="form-control" id="addEmployeeEmail" placeholder="contoh@gmail.com" required>
                </div>
                <div class="form-group col-md-4">
                  <label>Ext</label>
                  <input type="text" class="form-control" id="addEmployeeExt" placeholder="XXXX" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Hak Akses</label>
                  <br>
                  <select class="form-control select2addmodal" id="addEmployeeRole" style="width:200px;">
                    <!-- <option value="0">Silahkan Pilih</option> -->
                    <!-- <option value="1">Staf</option> -->
                    <!-- <option value="1">IT Asset</option>
                    <option value="2" >Manager IT Asset</option>
                    <option value="3" >GM IT Asset</option>
                    <option value="4" >PIC Asset</option>
                    <option value="5" >Manager PIC Asset</option>
                    <option value="6" >Manager PIC Asset</option> -->
    <!-- perlu direvisi akun -->
                  </select>
                </div>

                <div class="form-group col-md-6" id="departmentDiv">
                  <label>Department</label>
                  <select class="form-control select2addmodal" id="addEmployeeDepartmentId" style="width:200px">

                  </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addEmployee()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              </div>
            </div>
            <div class="tab-pane" id="recoverEmployeeTab">
                <div class="form-group">
                  <label>Pengguna</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <select class="form-control select2addmodal" id="recoverEmployeeId" style="width:360px">

                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="recoverEmployee()">Pulihkan</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
          </div>
        </div>


      </form>
    </div>
  </div>
</div>
