$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailModelModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addModelModal')
  });
  getModel();
});

setTimeout(function(){
  $('.datatable').DataTable({
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
  'copy', 'csv', 'excel', 'pdf', 'print']  
  });
}, 600)

$("#keyword").on('change', function(){
  getModel();
  $("#keyword").val();
})

function uploadFile(type, id, object) {
  console.log("try upload");
  var fd = new FormData();
  var files = $('#'+object)[0].files[0];
  fd.append('file',files);
  $.ajax({
    url: 'api/uploadFile/'+type+'/'+id,
    type: 'post',
    data: fd,
    contentType: false,
    processData: false,
    success: function(response){
      console.log('upload',response);
      getModel();
    },
    error: function(result){
      console.log('error', result);
      alert('error');
    }
  });
}

function detailModel(id) {
  $("#detailModelModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      Id : id
    },
    url: "api/getDetailModel",
    success: function(result) {
      var html1 = '<option value="0">Silahkan Pilih</option>';
      var html2 = '<option value="0">Silahkan Pilih</option>';
      console.log(result);
      $("#detailId").val(result.detail.Id);
      $('#detailName').val(result.detail.Name);
      $('#detailRemark').val(result.detail.Remark);
      $("#detailDescription").val(result.detail.Description);
      $('#detailImage').attr('src', 'assets/picture/'+result.detail.Image);
      result.item.forEach(function(data){
        if (data.Id == result.detail.ItemId) {
          html1 = html1 +  '<option value="'+data.Id+'" selected>'+data.Name+'</option>';
        } else {
          html1 = html1 +  '<option value="'+data.Id+'" >'+data.Name+'</option>';
        }
      });

      $('#detailItemId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addNewModelModal() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/getNewModel",
    success: function(result) {
      console.log(result);
      var html1 = '<option value="0">Silahkan Pilih</option>';
      var html2 = '<option value="0">Silahkan Pilih</option>';
      result.item.forEach(function(data) {
        if (data.IsExist==1) {
          html1 = html1 + '<option value="'+data.Id+'">'+data.Name+'</option>';
        }
      });

      $('#addItemId').html(html1);
      $("#addModelModal").modal('show');

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addModel() {
  if (($('#addItemId').val()!=0) && $('#addName').val()!="" && $('#addDescription').val()!="") {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         Name : $("#addName").val(),
         Remark : $("#addRemark").val(),
         Description : $("#addDescription").val(),
         ItemId : $("#addItemId").val()
      },
      url: "api/addModel",
      success: function(result) {
        $("#addModelModal").modal('hide');
        notify(result.icon, result.title, result.content, result.status);
        uploadFile('Model', result.id , 'fileUpload');
        getModel();
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
      }
    });
  } else {
    notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, mohon lengkapi semua kolom ', 'danger');
  }
}

function getModel(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getModel",
    success: function(result) {
      console.log(result);
      var html = "";
      var html2 = "";
      result.model.forEach(function(data){
        if (data.IsExist==1) {
          html =
          '<tr>' +
          '<td>'+data.Id+'</td>' +
          '<td>'+data.Name+'</td>' +
          '<td>'+data.Item+'</td>' +
          '<td>'+data.Description+'</td>' +
          '<td>'+data.CreateDate+'</td>' +
          '<td> <button class="btn btn-primary" onclick="detailModel('+data.Id+')">Detail</button></td>' +
          '</tr>' + html;
        } else {
          html2 = html2 + '<option value="'+data.Id+'">'+data.Name+'</option>';
        }
      });
      $("#allData").html(html);
      $("#recoverModelId").html(html2);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function deleteModel() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#detailId").val(),
    },
    url: "api/deleteModel",
    success: function(result) {
      console.log(result);
      $("#detailModelModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getModel();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function updateModel() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#detailId").val(),
       Name : $("#detailName").val(),
       Remark : $("#detailRemark").val()
    },
    url: "api/updateModel",
    success: function(result) {
      console.log(result);
      $("#detailModelModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      if ($('#fileUpload1').val()!="") {
        console.log("uploading");
        uploadFile('Model', $('#detailId').val(), 'fileUpload1');
      }
      getModel();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}


function recoverModel() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#recoverModelId").val(),
    },
    url: "api/recoverModel",
    success: function(result) {
      console.log(result);
      $("#addModelModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getModel();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}
