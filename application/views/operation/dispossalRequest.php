<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-assets-left align-assets-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Pemusnahan Asset</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
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
        <a class="nav-link" data-toggle="tab" href="#dispossed">Dimusnahkan</a>
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
                <th>Perangkat</th>
                <th>SN</th>
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
                <th>Perangkat</th>
                <th>SN</th>
                <th>Status</th>
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
                <th>Perangkat</th>
                <th>SN</th>
                <th>Status</th>
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
                <th>Perangkat</th>
                <th>SN</th>
                <th>Status</th>
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
            <div class="row" style="height:250px; overflow-y:scroll">

      
              <div class="form-group col-md-12">
                <label>Keterangan</label>
                <textarea id="editRemark" rows="2" class="form-control"></textarea>
              </div>


              <div class="form-group col-md-12" style="height:250px; overflow-y:scroll">
                <div  id="logData">
              </div>
            </div>
            <div class="modal-footer">
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
