<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-assets-left align-assets-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Asset</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="registerAssetForm()" data-toggle="modal" data-target="#registerAssetModal" <?php if($this->session->userdata('Role')!='IT Asset'){echo 'hidden';} ?>>Registrasi Asset Baru</button>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="dispossalAssetModal()" data-toggle="modal" data-target="#disposalAssetModal" <?php if($this->session->userdata('Role')!='IT Asset'){echo 'hidden';} ?>>Musnahkan Asset</button>

      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="card">

    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
        <a class="nav-link active show" data-toggle="tab" href="#all">Semua</a>
        <a class="nav-link" data-toggle="tab" href="#transfer" <?php if($this->session->userdata('DepartmentId')!=2){echo 'hidden';}?>>Dipindah</a>
        <a class="nav-link" data-toggle="tab" href="#disposal" <?php if($this->session->userdata('DepartmentId')!=2){echo 'hidden';}?>>Dimusnahkan</a>
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
                <th>Nomor PO</th>
                <th>SN</th>
                <th>PIC</th>
                <th>Tanggal</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="allData">
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="transfer">
          <table  class="display datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Nomor PO</th>
                <th>SN</th>
                <th>PIC</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="transferData">
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="disposal">
          <table  class="display datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Nomor PO</th>
                <th>SN</th>
                <th>PIC</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="disposalData">
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="detailAssetModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Aset</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <ul class="wizard-menu nav nav-pills nav-primary" hidden>
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#detailTab" data-toggle="tab" aria-expanded="true"><i class="fab fa-readme mr-0"></i> Detail</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#logTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Riwayat Asset</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="detailTab">
            <div class="row" style="height:250px; overflow-y:scroll" >

              <div class="form-group col-md-4">
                <label>Jenis Perangkat</label>
                <input type="text" id="editId" hidden>
                <select class="form-control select2modal" id="editItemId" style="width:150px">
                  <option value="0" >Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-8">
                <label>Model</label>
                <select class="form-control select2modal" id="editModelId" style="width:300px">
                  <option value="0" deselect>Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Durasi Pemakaian</label>
                <input type="text" class="form-control" id="editDuration" disabled>
              </div>

              <div class="form-group col-md-6">
                <label>Nomor Registrasi</label>
                <input type="text" class="form-control" id="editRegNumber" disabled>
              </div>

              <div class="form-group col-md-6">
                <label>Nomor Seri</label>
                <input type="text" class="form-control" id="editSN" >
              </div>
              <div class="form-group col-md-6">
                <label>PO</label>
                <input type="text" class="form-control" id="editPO" >
              </div>

              <div class="form-group col-md-6">
                <label>Pengguna Asset</label>
                <input type="text" class="form-control" id="editUserId" value="Belum Digunakan">
              </div>
              <div class="form-group col-md-6">
                <label>Departement</label>
                <input type="text" class="form-control" id="editDepartment" value="Belum Digunakan">
              </div>


              <div class="form-group col-md-6">
                <label>Keterangan</label>
                <textarea id="editRemark" rows="2" class="form-control"></textarea>
              </div>
              <div class="form-group col-md-6">
                <img src="" style="max-width:200px; max-height:200px;" id="editPicture">
              </div>

            <div class="form-group col-md-12">            
              <div style="height:250px;overflow-y:scroll" id="logData">
            </div>
            </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="btnUpdate" onclick="updateAsset()" <?php if(!($this->session->userdata['RoleId']>=3||$this->session->userdata['RoleId']<=4)){echo 'hidden';} ?>>Simpan</button>
              <button type="button" class="btn btn-danger" id="btnDelete" onclick="deleteAsset()" <?php if($this->session->userdata['RoleId']!=3){echo 'hidden';} ?>>Hapus</button>
              <button type="button" class="btn btn-warning" id="btnFollowUpSuperior" onclick="followUpSuperior()" <?php if($this->session->userdata['RoleId']!=3){echo 'hidden';} ?>>Follow up atasan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>
          <div class="tab-pane" id="logTab">
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="disposalAssetModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Musnahkan Asset</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Musnahkan asset</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <select class="form-control select2dispossemodal" id="dispossalAssetId" style="width:440px">

          </select>
        </div>
        <div class="form-group">
          <label for="">Penyebab pemusnahan </label>
          <textarea id="dispossalRemark" rows="2" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="requestDispossal()">Musnahkan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="registerAssetModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Registrasi Asset Baru</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-12">
            <label>Produk</label>
            <select class="form-control select2regmodal" id="regModelId" style="width:475px">
              <option value="0" deselect>Silahkan Pilih</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Nomor PO</label>
            <input type="text" class="form-control" id="regPO" >
          </div>
          <div class="form-group col-md-8">
            <label>Nomor Serial</label>
            <div class="row">
              <input type="text" class="form-control col-md-8" id="regSN" >
              <button type="button" class="btn btn-success" onclick="addAsset()">Tambah</button>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label>Daftar Asset</label>
            <div class="card-list" style="height:150px; overflow-y:scroll" id="assetList">


            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="registerAsset()">Register Asset Baru</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>



      </div>
    </div>
  </div>
</div>
