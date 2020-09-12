<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-assets-left align-assets-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Pemindahan Asset</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-border btn-white btn-round" onclick="addRequestAssetForm()" data-toggle="modal" data-target="#addAssetRequestModal" name="button" <?php if($this->session->userdata('Role')!='PIC Asset'){ echo 'hidden';} ?>>Ajukan Permohonan Asset</button>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="card">

    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
        <a class="nav-link active show" data-toggle="tab" href="#all">Semua</a>
        <a class="nav-link" data-toggle="tab" href="#requested">Diajukan</a>
        <a class="nav-link" data-toggle="tab" href="#declined">Ditolak</a>
        <a class="nav-link" data-toggle="tab" href="#used">Digunakan</a>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-body">

      <div class="tab-content">

        <div class="tab-pane active" id="all">
          <table  class="display datatable" style="width:100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Perangkat</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Opsi</th>

              </tr>
            </thead>
            <tbody id="allData">

            </tbody>
          </table>

        </div>
        <div class="tab-pane" id="requested">
          <table  class="display datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Perangkat</th>
                <th>Tujuan</th>
                <th>Opsi</th>

              </tr>
            </thead>
            <tbody id="requestedData">

            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="declined">
          <table  class="display datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Perangkat</th>
                <th>Tujuan</th>
                <th>Opsi</th>

              </tr>
            </thead>
            <tbody id="declinedData">

            </tbody>
          </table>
        </div>

        <div class="tab-pane" id="used">
          <table  class="display datatable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Perangkat</th>
                <th>Tujuan</th>
                <th>Opsi</th>

              </tr>
            </thead>
            <tbody id="usedData">

            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="selectAssetRequestModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Pilih Asset untuk User</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-info">
          <p id='userExpectation'></p>
        </div>

        <div class="form-group col-md-4">
          <label>Model Tersedia</label>
          <input type="text" id="editAssetRequestId" hidden>
          <select class="form-control select2modals" id="selectModelRequestId" style="width:430px">
            <option value="0" >Silahkan Pilih</option>
          </select>
        </div>

        <div class="form-group col-md-4">
          <label>Asset</label>
          <select class="form-control select2modals" id="selectAssetId" style="width:430px">
            <option value="0" >Silahkan Pilih</option>
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" onclick="selectAssetRequest()" class="btn btn-primary">Pilih</button>
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="addAssetRequestModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Pesan Asset Baru</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addAssetOrderRequestTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user-plus mr-0"></i> Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#recoverAssetRequestTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Pulihkan sebelumnya</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addAssetOrderRequestTab">
            <div class="row">

              <div class="form-group col-md-4">
                <label>Jenis Perangkat</label>
                <select class="form-control select2addmodal" id="addItemId" style="width:150px">
                  <option value="0" >Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label>Jumlah</label>
                <input class="form-control" type="number" id="addQty" value="0">
              </div>

              <div class="form-group col-md-4">
                <label>Pengguna</label>
                <input class="form-control" type="text" id="addUserName" value="">
              </div>
              

              <div class="form-group col-md-12">
                <label>Model</label>
                <select class="form-control select2addmodal" id="addModelId" style="width:475px">
                  <option value="0" deselect>Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Spesifikasi yang Diinginkan</label>
                <textarea id="addRemark" rows="2" class="form-control"></textarea>
              </div>


              <div class="form-group col-md-6">
                <label>Tujuan Penggunaan</label>
                <textarea id="addPurpose" rows="2" class="form-control"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="addAssetRequest()">Pesan Asset Baru</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>

          <div class="tab-pane" id="recoverAssetRequestTab">
            <div class="form-group">
              <label>Pulihkan pesanan terhapus</label>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <select class="form-control select2addmodal" id="recoverAssetRequestId" style="width:440px">

              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="recoverAsset()">Pulihkan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="detailAssetRequestModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Permintaan Asset</h4>
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
            <div class="row" style="height:300px; overflow-y:scroll">

              <div class="form-group col-md-4">
                <label>Jenis Perangkat</label>
                <input type="text" id="editId" hidden>
                <select class="form-control select2modal" id="editItemId" style="width:150px">
                  <option value="0" >Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-8">
                <label>Model yang Diinginkan</label>
                <select class="form-control select2modal" id="editModelId" style="width:300px">
                  <option value="0" deselect>Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label>PIC</label>
                <input type="text" id="editFullname" class="form-control">
              </div>

              <div class="form-group col-md-4">
                <label>Pengguna</label>
                <input type="text" id="editUserName" class="form-control">
              </div>

              <div class="form-group col-md-4">
                <label>Departemen</label>
                <input type="text" id="editDepartment" class="form-control">
              </div>


              <div class="form-group col-md-6">
                <label>Keterangan</label>
                <textarea id="editRemark" rows="2" class="form-control"></textarea>
              </div>

              <div class="form-group col-md-6">
                <label>Tujuan </label>
                <textarea id="editPurpose" rows="2" class="form-control"></textarea>
              </div>

              <div class="form-group col-md-12" style="height:250px; overflow-y:scroll" >
                <div id="logData">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="requestTransferToISP()" id="requestTransferToISPBtn" >Ajukan pengembalian asset</button>
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
</div>
