$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailDepartmentModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addDepartmentModal')
  });
  getDepartment();
});

function detailDepartment(id) {
  $("#detailDepartmentModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      Id : id
    },
    url: "api/getDetailDepartment",
    success: function(result) {
      var html = "";
      var html1 = "";
      var html2 = "";
      var html3 = "";
      var role = "";
      console.log(result);
      $("#editId").val(result.detail.Id);
      $('#editName').val(result.detail.Name);
      $('#editDescription').val(result.detail.Description);

      result.member.forEach(function(data){
        if (data.Role<=4) {
          role = "Staf"
        } else if(data.Role==5) {
          role = "Manager"
        } else if(data.Role==6) {
          return;
        }
        html1 = html1 +
        '<div class="item-list">'+
          '<div class="avatar">' +
            '<img src="'+data.Image+'" class="avatar-img rounded-circle">' +
          '</div>' +
          '<div class="info-user ml-3">' +
            '<div class="username">' + data.Fullname + '</div>' +
            '<div class="status">' + data.Email + '</div>' +
          '</div>' +
          role +
        '</div>';
      });
      result.employee.forEach(function(data){
        if (data.IsExist==1) {
          if (data.Id == result.detail.AdminId) {
            html3 = html3 + '<option value="'+data.Id+'" selected>'+data.Fullname+'</option>';

          } else {
            html3 = html3 + '<option value="'+data.Id+'">'+data.Fullname+'</option>';
          }
        }
      });
      result.generalmanager.forEach(function(data){
        if (data.Id == result.detail.GeneralManagerId && data.IsExist == 1) {
          html2 = html2 + '<option value="'+data.Id+'" selected>'+data.Fullname+'</option>';
        } else if (data.IsExist == 0) {
          return;
        } else {
          html2 = html2 + '<option value="'+data.Id+'">'+data.Fullname+'</option>';
        }

      });
      $("#memberList").html(html1);
      $("#editGeneralManagerId").html(html2);
      $('#editAdminId').html(html3);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

$("#keyword").on('change', function(){
  getDepartment();
  $("#keyword").val();
})

function updateDepartment(){

  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#editId").val(),
       Name : $("#editName").val(),
       Description : $("#editDescription").val(),
       DepartmentId : $("#editDepartmentId").val(),
       GeneralManagerId : $("#editGeneralManagerId").val(),
       AdminId : $('#editAdminId').val()
    },
    url: "api/updateDepartment",
    success: function(result) {
      $("#detailDepartmentModal").modal('hide');
      getDepartment();
      notify('fa fa-bell', result.title, result.content, result.status);
    },
    error: function(result) {
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function getDepartment(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getDepartment",
    success: function(result) {
      var html = "";
      var html2 = "";
      result.department.forEach(function(data){
        if (data.IsExist==1) {
          html = html + '<div class="col-sm-6 col-md-4">' +
            '<div class="card card-stats card-round" onclick="detailDepartment('+data.Id+')">' +
              '<div class="card-body ">' +
                '<div class="row align-items-center">' +
                  '<div class="col-icon">' +
                    '<div class="icon-big text-center icon-primary bubble-shadow-small">' +
                      '<i class="flaticon-users"></i>' +
                    '</div>' +
                  '</div>' +
                  '<div class="col col-stats ml-3 ml-sm-0">' +
                    '<div class="numbers">' +
                      '<p class="card-category">IEI</p>' +
                      '<h4 class="card-title">'+data.Name+'</h4>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>' +
          '</div>';
        } else {
          html2 = html2 + '<option value="'+data.Id+'">'+data.Name+'</option>';

        }
      });
      $("#departmentList").html(html);
      $("#recoverDepartmentId").html(html2);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addNewDepartmentModal() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/getEmployee",
    success: function(result) {
      $("#addDepartmentModal").modal('show');
      var html = '<option value="0" >Silahkan Pilih</option>';
      var html2 = '<option value="0" >Silahkan Pilih</option>';

      result.employee.forEach(function(data){
        if (data.IsExist == 1) {
          html2 = html2 + '<option value="'+data.Id+'">'+data.Fullname+'</option>';
        } else {
          return;
        }
      });

      $("#addGeneralManagerId").html(html2);
      $("#addAdminId").html(html2);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addDepartment() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Name : $("#addName").val(),
       Description : $("#addDescription").val(),
    },
    url: "api/addDepartment",
    success: function(result) {
      $("#addDepartmentModal").modal('hide');
      console.log(result);
      notify(result.icon, result.title, result.content, result.status);
      getDepartment();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function deleteDepartment() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#editId").val(),
    },
    url: "api/deleteDepartment",
    success: function(result) {
      $("#detailDepartmentModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getDepartment();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function recoverDepartment() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       Id : $("#recoverDepartmentId").val(),
    },
    url: "api/recoverDepartment",
    success: function(result) {
      console.log(result);
      $("#addDepartmentModal").modal('hide');
      notify(result.icon, result.title, result.content, result.status);
      getDepartment();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
