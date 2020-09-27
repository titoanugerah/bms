<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold" >Pelaporan Masalah </h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="addNewIssueForm()">Tambah Laporan Baru</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5" >
  <!-- <div class="row mt--2" id="issueList">

  </div> -->

  <div class="row mt--2">
    <div class="col-md-12">
      <div class="row">

        <div class="card full-height  col-md-12">
          <div class="card-header">
            <div class="card-title">Rekap Laporan Masalah</div>
              <table  class="display datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pelapor</th>
                    <th>Judul Masalah</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody id="issueData">
                </tbody>
              </table>          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addIssueModal" issue="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Tambah Laporan Masalah</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">       
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Judul </label>
              <input type="text" class="form-control" id="addName" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea type="text" class="form-control" id="addDetail" required></textarea>
            </div>
          </div>
          
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="addIssue()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detailIssueModal" issue="dialog">
  <!-- <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4>Detail Issue</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Issue</label>
              <input type="text" class="form-control" id="editName" required>
              <input type="text" class="form-control" id="editId" hidden>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Job/Aplikasi</label>
              <br>
              <select class="form-control select2modal" id="editJobId" style="width:200px">
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteIssue()">Hapus</button>
          <button type="button" class="btn btn-primary" onclick="updateIssue()">Simpan</button>
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
        </div>
      </div>        
    </div>
  </div> -->
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
            <a class="nav-link active" href="#addLogTab" data-toggle="tab" aria-expanded="true"><i class="fa fa-plus mr-0"></i> Tambah Log Baru</a>
          </li>
          <li class="step" style="width: 50%;">
            <a class="nav-link" href="#detailLogTab" data-toggle="tab"><i class="fas fa-list mr-2"></i> Detail</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="addLogTab">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2modal" id="addStatusId" style="width:200px">
                  </select>
                  <input type="text" class="form-control" id="editId" hidden>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>PIC</label>
                  <input type="text" class="form-control" id="user" value="<?php echo $this->session->userdata('name') ?>">
                </div>
              </div>
              
              <div class="col-md-12">
                <div class="form-group">
                  <label id="remarkLabel"></label>
                  <br>
                  <textarea type="text" class="form-control remarkInput" id="editRemark"></textarea>  
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="updateIssue()">Simpan</button>
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Kembali</button>
            </div>
          </div>  
          <div class="tab-pane" id="detailLogTab">
            <div class="row" style=" height:200px;overflow-y:scroll;">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Judul</label>
                  <input type="text" class="form-control" id="editName">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pelapor</label>
                  <input type="text" class="form-control" id="editUser">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="text" class="form-control" id="editDate">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Detail Masalah</label>
                  <textarea type="text" class="form-control" id="editDetail"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Akar Masalah</label>
                  <textarea type="text" class="form-control" id="editRootCause"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Penyelesaian</label>
                  <textarea type="text" class="form-control" id="editCountermeasure"></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Status Terakhir</label>
                  <input type="text" class="form-control" id="editStatus">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>PIC</label>
                  <input type="text" class="form-control" id="editPIC">
                </div>
              </div>
              <div id="logData">
              
              </div>
            </div>
          </div>
      </div>        
    </div>
  </div>
</div>
