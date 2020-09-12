<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" id="departmentName">Departement </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <input type="number" id="Id" hidden>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="row mt--2">
    <div class="col-md-12">
      <div class="card full-height">
        <div class="card-body">

          <div class="card-title">Kelola Departemen</div>
          <div class="card-category" >Silahkan lakukan pengelolaan identitas departemen </div>
          <br>

          <div class="row">
            <div class="col-md-5">
              <div class="form-group ">
                <label>Nama Departemen</label>
                <input class="form-control" type="text" id="Name" >
              </div>

              <div class="form-group ">
                <label>Nama General Manager</label>
                <br>
                <select class="js-example-basic-single" id="GeneralManagerId" style="width:340px">
                </select>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group ">
                <label>Deskripsi</label>
                <textarea class="form-control" type="text" id="Description" rows="5"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-success" onclick="updateSelectedDepartment()">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>

</div>
