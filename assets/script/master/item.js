$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailItemModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addItemModal')
  });
  getItem();

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
  getItem();
  $("#keyword").val();
})

function detailItem(id) {
  $("#detailItemModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      Id : id
    },
    url: "api/getDetailItem",
    success: function(result) {
      console.log(result);
      $("#editId").val(result.detail.Id);
      $('#editName').val(result.detail.Name);
      $('#editRemark').val(result.detail.Remark);

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addNewItemModal() {
  $("#addItemModal").modal('show');
}

function addItem() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Name : $("#addName").val(),
       Remark : $("#addRemark").val(),
    },
    url: "api/addItem",
    success: function(result) {
      $("#addItemModal").modal('hide');
      console.log(result);
      notify(result.icon, result.title, result.content, result.status);
      getItem();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function getItem(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getItem",
    success: function(result) {
      console.log(result);
      var html = "";
      var html2 = "";
      result.item.forEach(function(data){
        if (data.IsExist==1) {
          html =
          '<tr>' +
          '<td>'+data.Id+'</td>' +
          '<td>'+data.Name+'</td>' +
          '<td>'+data.Remark+'</td>' +
          '<td>'+data.create_date+'</td>' +
          '<td> <button class="btn btn-primary" onclick="detailItem('+data.Id+')">Detail</button></td>' +
          '</tr>' + html;
        } else {
          html2 = html2 + '<option value="'+data.Id+'">'+data.Name+'</option>';
        }
      });
      $("#allData").html(html);
      $("#recoverItemId").html(html2);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function deleteItem() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#editId").val(),
    },
    url: "api/deleteItem",
    success: function(result) {
      console.log(result);
      $("#detailItemModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getItem();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function updateItem() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#editId").val(),
       Name : $("#editName").val(),
       Remark : $("#editRemark").val()
    },
    url: "api/updateItem",
    success: function(result) {
      console.log(result);
      $("#detailItemModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getItem();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}


function recoverItem() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#recoverItemId").val(),
    },
    url: "api/recoverItem",
    success: function(result) {
      console.log(result);
      $("#addItemModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getItem();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}
