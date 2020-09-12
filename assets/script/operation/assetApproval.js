$(document).ready(function(){
  $('.select2modal').select2({
    dropdownParent: $('#detailRequestModal')
  });

  getAssetApproval();
});

setTimeout(function(){
  $('.datatable').DataTable({
    dom: 'Bfrtip',
    buttons: [
  //     {
  //     extend: 'excel',
  //     text: 'Save current page',
  //     exportOptions: {
  //         modifier: {
  //             page: 'current'
  //         }
  //     }
  // }
  'copy', 'csv', 'excel', 'pdf', 'print']  
  });
}, 600)


$("#keyword").on('change', function(){
  getAssetApproval();
});

function approveRequest(id) {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      Id : id
    },
    url: "api/approveRequest",
    success: function(result) {
      console.log(result);
      notify('fas fa-check', result.title, result.content, result.status);
      getAssetApproval();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });

}

function approveAllRequest() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/approveAllRequest",
    success: function(result) {
      console.log(result);
      notify('fas fa-check', result.title, result.content, result.status);
      getAssetApproval();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });

}

function getAssetApproval() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getAssetApproval",
    success: function(result) {
      console.log(result);
      var html2 = '';
      var no=1;
      result.request.forEach(function(data){
        html2 = html2 +
        '<tr>' +
        '<td>'+no+'</td>' +
        '<td>'+data.Brand+'</td>' +
        '<td>'+data.Model+'</td>' +
        '<td>'+(data.Remark)+'</td>' +
        '<td><div class="row"> <button class="btn btn-sm btn-info" onclick="approveRequest('+data.Id+')"><i class="fas fa-check mr-0"></i></button> &nbsp;&nbsp;&nbsp;  <button class="btn btn-danger btn-sm" onclick="rejectRequest('+data.Id+')"><i class="fas fa-times mr-0"></i></button></div></td>' +
        '</tr>';
        no++;
      });
      $('#allData').html(html2);
      // var html = '<option value="0" >Silahkan Pilih</option>';
      // result.model.forEach(function(data){
      //   if (data.IsExist == 1) {
      //     html = html + '<option value="'+data.Id+'" >'+data.Brand + " " +data.Name+'</option>';
      //   }
      // });
      // $('#addModelId').html(html);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}


function numberWithCommas(x) {
  var parts = x.toString().split(".");
  parts[0]=parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
  return parts.join(",");
}
