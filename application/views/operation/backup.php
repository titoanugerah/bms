<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Backup </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="downloadReportForm()">Download Aktivitas Laporan</button>

      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <div class="row mt--2" id="backupList">

  </div>
</div>



<div class="modal fade" id="detailBackupModal" backup="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Backup Detail</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <ul class="wizard-menu nav nav-pills nav-primary">
          <li class="step" style="width: 50%;">
            <a class="nav-link active" href="#addNewTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-plus mr-0"></i> Tambah Rekaman Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#historyTab" data-toggle="tab"><i class="fas fa-undo mr-2"></i> Histori </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addNewTab">


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Cartridge</label>
                  <select class="form-control select2modal" id="editCartridgeId" style="width:200px">
                  </select>
                  <input type="text" class="form-control" id="editId" hidden>
                  <input type="text" class="form-control" id="editName" hidden>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Dataset</label>
                  <br>
                  <select class="form-control select2modal" id="editDatasetId" style="width:200px">
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Volume</label>
                  <br>
                  <input type="text" class="form-control" id="editRemark">
                </div>
              </div>
              <div class="col-md-4">
                <label> </label>
                <div class="form-group">
                  <button class="btn btn-success" onclick="addBackupActivity()">Tambah</button>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group ">
                  <label>Data Backup</label>
                  <div class="card-list" style="height:150px; overflow-y:scroll" id="backupJobList">
                  </div>
                </div>
              </div>  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="deleteBackup()">Hapus</button>
              <button type="button" class="btn btn-primary" onclick="updateBackup()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>  
          <div class="tab-pane" id="historyTab">
          <table  class="display datatable">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Cartridge</th>
                <th>Dataset</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody id="backupData">
            </tbody>
          </table>

          </div>        
      
        </div>        
      </div>        
    </div>
  </div>
</div>


<div class="modal fade" id="detailHistoryModal" backup="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Backup Detail</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">                
        <input type="date" id="dateHistory" hidden>
        <input type="text" id="jobIdHistory" hidden>
        <table  class="display datatable">
          <thead>
            <tr>
              <th>Dataset</th>
              <th>Cartridge</th>
              <th>Volume</th>
              <th>PIC</th>
            </tr>
          </thead>
          <tbody id="historyData">
          </tbody>
        </table>          
      </div>
      <div class="modal-footer">
          <a type="button" href="" id="downloadBtn" class="btn btn-primary">Download Excel </a>      
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
        
    </div>
  </div>
</div>

<div class="modal fade" id="downloadReportModal" backup="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Download Laporan Aktivitas</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Awal</label>
            <br>
            <input type="date" id="startDate" class="form-control" >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Akhir</label>
            <br>
            <input type="date" id="endDate" class="form-control" >
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <a type="button" href="" id="downloadBtn2" class="btn btn-primary">Download Excel </a>      
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
        
    </div>
  </div>
</div>