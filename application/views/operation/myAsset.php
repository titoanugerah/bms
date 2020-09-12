<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-assets-left align-assets-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Asset Saya</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addRequestAssetForm()" data-toggle="modal" data-target="#addAssetRequestModal" >Pesan Asset Baru</button>
      </div>
    </div>
  </div>
</div>
<div class="page-inner mt--5">
  <div class="card">

    <div class="nav-scroller">
      <div class="nav nav-tabs nav-line nav-color-secondary d-flex align-items-center justify-contents-center w-100">
        <a class="nav-link active show" data-toggle="tab" href="#requested" <?php if(!($this->session->userdata('Role')=="ITPIC" || $this->session->userdata('Role')=="ITAdmin" || ($this->session->userdata('Role')=="Manager" && $this->session->userdata('DepartmentId')==1))) ?>>Dipesan</a>
        <a class="nav-link" data-toggle="tab" href="#used">Digunakan</a>
      </div>
    </div>
  </div>


  <div class="tab-content">

    <div class="tab-pane active" id="requested">
      <div id="requestedData" class="row">


      </div>
    </div>
    <div class="tab-pane" id="used">

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

        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#detailTab" data-toggle="tab" aria-expanded="true"><i class="fab fa-readme mr-0"></i> Detail</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#logTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Riwayat Asset</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="detailTab">
            <div class="row">

              <div class="form-group col-md-4">
                <label>Jenis Perangkat</label>
                <input type="text" id="editId" hidden>
                <select class="form-control select2modal" id="editItemId" style="width:150px">
                  <option value="0" >Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-8">
                <label>Produk yang Diinginkan</label>
                <select class="form-control select2modal" id="editModelId" style="width:300px">
                  <option value="0" deselect>Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Pengguna</label>
                <input type="text" id="editFullname" class="form-control">
              </div>

              <div class="form-group col-md-6">
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


            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="btnUpdate" onclick="updateAsset()" hidden>Simpan</button>
              <button type="button" class="btn btn-success" id="btnReceive" onclick="confirmReceived()" hidden> Sudah Diterima</button>
              <button type="button" class="btn btn-success" id="btnReturn" onclick="transferToISP()" hidden> Kembalikan Ke ISP</button>
              <button type="button" class="btn btn-danger" id="btnDelete" onclick="deleteAsset()" <?php if($this->session->userdata['RoleId']!=3){echo 'hidden';} ?>>Hapus</button>
              <button type="button" class="btn btn-warning" id="btnFollowUpSuperior" onclick="followUpSuperior()" <?php if($this->session->userdata['RoleId']!=3){echo 'hidden';} ?>>Follow up atasan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>
          <div class="tab-pane" id="logTab">
            <div style="height:250px; overflow-y:scroll" id="logData">
            </div>
          </div>
        </div>
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

              <div class="form-group col-md-8">
                <label>Jenis Perangkat</label>
                <select class="form-control select2addmodal" id="addItemId" style="width:300px">
                  <option value="0" >Silahkan Pilih</option>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label>Jumlah</label>
                <input class="form-control" type="number" id="addQty" value="0">
              </div>

              <div class="form-group col-md-12">
                <label>Produk Yang Diinginkan</label>
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
