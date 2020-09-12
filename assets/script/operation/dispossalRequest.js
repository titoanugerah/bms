$(document).ready(function(){
  $('.select2modal').select2({
    dropdownParent: $('#detailAssetRequestModal'),
    "scrollY": 200,
    "scrollX": true
  });
  $('.select2modals').select2({
    dropdownParent: $('#selectAssetRequestModal'),
    "scrollY": 200,
    "scrollX": true
  });
  $('.select2addmodal').select2({
    dropdownParent: $('#addAssetRequestModal')
  });

  getDispossalRequest();
});

setTimeout(function(){
  $('.datatable').DataTable({
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
  'copy', 'csv', 'excel', 'pdf', 'print']  
  });
}, 600)


$('#addItemId').on('change', function(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#addItemId option:selected").text()
    },
    url: "api/getModel",
    success: function(result) {
      console.log(result);
      var html = '<option value="0" >Silahkan Pilih</option>';
      result.model.forEach(function(data){
        if (data.IsExist == 1) {
          html = html + '<option value="'+data.Id+'" > '+ data.Name+' ('+data.Description+') </option>';
        }
      });
      $('#addModelId').html(html);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
});

$("#keyword").on('change', function(){
  getDispossalRequest();
});



function getDispossalRequest() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getDispossalRequest",
    success: function(result) {
      console.log(result);
      var html1 = '';
      var html2 = '';
      var html3 = '';
      var html4 = '';
      var html5 = '<option value = "0"> silahkan pilih </option>';
      var no=1;
      var session = result.session;
      result.request.forEach(function(data){
        var additionalButton = '';
        if ((session.RoleId == 2 && data.Status==3) || (session.RoleId == 3 && data.Status==5)) {
          additionalButton = '<button class="btn btn-sm btn-info" onclick="approveRequest('+data.Id+')"><i class="fas fa-check mr-0"></i></button> &nbsp;&nbsp;&nbsp;  <button class="btn btn-danger btn-sm" onclick="rejectRequest('+data.Id+')"><i class="fas fa-times mr-0"></i></button> &nbsp;&nbsp;&nbsp; ';
        } else if ( (session.RoleId == 1 && data.Status==7)) {
          additionalButton = '<button class="btn btn-sm btn-info" onclick="approveRequest('+data.Id+')"><i class="fas fa-check mr-0"></i></button> &nbsp;&nbsp;&nbsp;';
        }

        html1 =
        '<tr>' +
        '<td>'+no+'</td>' +
        '<td>'+data.Item+'</td>' +
        '<td>'+data.SN+'</td>' +
        '<td>'+getStatusMessage(data.Status)+'</td>' +
        '<td><div class="row">'+additionalButton+'<button class="btn btn-warning btn-sm" onclick="detailRequest('+data.Id+')"><i class="fas fa-eye"></i></button></div></td>' +
        '</tr>' + html1;
        no++;

          if (data.Status >= 3 && data.Status < 8 && data.Status%2==0) {

          html3 =
          '<tr>' +
          '<td>'+no+'</td>' +
          '<td>'+data.Item+'</td>' +
          '<td>'+data.SN+'</td>' +
          '<td>'+getStatusMessage(data.Status)+'</td>' +
          '<td><div class="row">'+additionalButton+'<button class="btn btn-warning btn-sm" onclick="detailRequest('+data.Id+')"><i class="fas fa-eye"></i></button></div></td>' +
          '</tr>' + html3;
          no++;
        }  else if (data.Status >= 3 && data.Status < 8 && data.Status%2==1) {
          html2 =
          '<tr>' +
          '<td>'+no+'</td>' +
          '<td>'+data.Item+'</td>' +
          '<td>'+data.SN+'</td>' +
          '<td>'+getStatusMessage(data.Status)+'</td>' +
          '<td><div class="row">'+additionalButton+'<button class="btn btn-warning btn-sm" onclick="detailRequest('+data.Id+')"><i class="fas fa-eye"></i></button></div></td>' +
          '</tr>' + html2;
          no++;
        }  else if (data.Status == 8 ) {
          html4 =
          '<tr>' +
          '<td>'+no+'</td>' +
          '<td>'+data.Item+'</td>' +
          '<td>'+data.SN+'</td>' +
          '<td>'+getStatusMessage(data.Status)+'</td>' +
          '<td><div class="row">'+additionalButton+'<button class="btn btn-warning btn-sm" onclick="detailRequest('+data.Id+')"><i class="fas fa-eye"></i></button></div></td>' +
          '</tr>' + html4;
          no++;
        }

      });
          $('#allData').html(html1);
          $('#requestedData').html(html2);
          $('#declinedData').html(html3);
          $('#usedData').html(html4);
          $('#recoverAssetRequestId').html(html5);

        },
        error: function(result) {
          console.log(result);
          notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
        }
      });
    }

    function detailRequest(id) {
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          Id : id
        },
        url: "api/getDetailAsset",
        success: function(result) {
          console.log(result);
          var html1 = "<option value='0' >Silahkan Pilih</option>";
          var html2 = "<option value='0' >Silahkan Pilih</option>";
          var html3 = "";
          $('#editId').val(result.detail.Id);
          $('#editRemark').val(result.detail.Remark);
          $('#editPurpose').val(result.detail.Purpose);
          $('#editFullname').val(result.detail.User);
          $('#editDepartment').val(result.detail.Department);
          result.item.forEach(function(data){
            if (data.Id == result.detail.ItemId) {
              html1 = html1 + "<option value="+data.Id+" selected>"+data.Name+"</option>";
            } else {
              html1 = html1 + "<option value="+data.Id+" >"+data.Name+"</option>";
            }
          });
          result.model.forEach(function(data){
            if (data.Id == result.detail.ModelExpectation) {
              html2 = html2 + "<option value="+data.Id+" selected>"+data.Name+"</option>";
            } else {
              html2 = html2 + "<option value="+data.Id+" >"+data.Name+"</option>";
            }
          });
          if (result.detail.Status>6 && result.detail.Status<9) {
            $('#btnFollowUpSuperior').attr('hidden', 'true');
            $('#btnDelete').attr('hidden', 'true');
            $('#editItemId').attr('disabled', 'true');
            $('#editSN').attr('disabled', 'true');
            $('#editPrice').attr('disabled', 'true');
            $('#editRemark').attr('disabled', 'true');
            $('#editModelId').attr('disabled', 'true');
          }
          if (result.detail.Status == 12 && result.detail.Type==0) {
//            $('#requestTransferToISPBtn').attr('hidden', 'false');
          }

          result.log.forEach(function(data){
            html3 =
            '<div class="card card-secondary">' +
              '<div class="card-header">' +
                data.DateTime +
              '</div>' +
              '<div class="card-body">' +
                data.Description +
              '</div>' +
            '</div>' + html3;
          });

          $('#editItemId').html(html1);
          $('#editModelId').html(html2);
          $('#logData').html(html3);
          $('#detailAssetRequestModal').modal('show');
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
        }
      });
    }

    function approveRequest(id) {
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          Id : id
        },
        url: "api/approveDispossalRequest",
        success: function(result) {
          console.log(result);
          notify('fas fa-bell', result.title, result.content , result.status);
          getDispossalRequest();
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
        }
      });
    }

    function rejectRequest(id) {
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          Id : id
        },
        url: "api/rejectDispossalRequest",
        success: function(result) {
          console.log(result);
          notify('fas fa-bell', result.title, result.content , result.status);
          getDispossalRequest();
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
        }
      });
    }


    function getStatusMessage(code) {
      if (code==3){
      return 'Diajukan oleh IT Asset';
      } else if (code==4){
        return 'Ditolak oleh Mgr IT Asset';
      } else if (code==5){
        return 'Disetujui oleh Mgr IT Asset';
      } else if (code==6){
        return 'Ditolak oleh GM IT Asset';
      } else if (code==7){
        return 'Disetujui oleh GM IT Asset';
      } else if (code==8){
        return 'Berhasil dimusnahkan';
      } 
    }
