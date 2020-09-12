<div class="panel-header bg-primary-gradient">
  <div class="page-inner py-5">
    <div class="d-flex align-brands-left align-brands-md-center flex-column flex-md-row">
      <div>
        <h2 class="text-white pb-2 fw-bold">Permohonan Asset</h2>
      </div>
      <div class="ml-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-white btn-border btn-round mr-2" hidden>Manage</a>
        <button type="button" class="btn btn-white btn-border btn-round mr-2" onclick="approveAllRequest()" >Setujui semua permintaan</button>
      </div>
    </div>
  </div>
</div>

<div class="page-inner mt--5">
  <div class="card">
    <div class="card-header">
      Rekap Permintaan Pengadaan Asset Baru
    </div>
    <div class="card-body">
      <table  class="display datatable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Keterangan</th>
            <th>Opsi</th>

          </tr>
        </thead>
        <tbody id="allData">

        </tbody>
      </table>
    </div>
  </div>
</div>
