$(document).ready(function(){
  $('.select2addmodal').select2({
      dropdownParent: $('#addEmployeeModal')
  });
  $('.select2addmodal2').select2({
      dropdownParent: $('#detailEmployeeModal')
  });

  getEmployee();
});

$('#keyword').on('change', function(){
  getEmployee();
  $('#keyword').val();
})

function deleteEmployee() {
$('#detailEmployeeModal').modal('hide');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/deleteEmployee",
    data: {
      Id : $('#detailEmployeeId').val()
    },
    success: function(result) {
      console.log(result);
      notify(result.icon, result.title, result.content, result.status);
      getEmployee();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function recoverEmployee(){
$('#addEmployeeModal').modal('hide');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/recoverEmployee",
    data: {
      Id : $('#recoverEmployeeId').val()
    },
    success: function(result) {
      console.log(result);
      notify(result.icon, result.title, result.content, result.status);
      getEmployee();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });

}

function addEmployee() {
  $('#addEmployeeModal').modal('hide');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/addEmployee",
    data: {
      Email : $('#addEmployeeEmail').val(),
      Ext : $('#addEmployeeExt').val(),
      RoleId : $('#addEmployeeRole').val(),
      DepartmentId : $('#addEmployeeDepartmentId').val()
    },
    success: function(result) {
      console.log(result);
      notify(result.icon, result.title, result.content, result.status);
      getEmployee();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function updateEmployee() {
  $('#detailEmployeeModal').modal('hide');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/updateEmployee",
    data: {
      Id : $('#detailEmployeeId').val(),
      Email : $('#detailEmployeeEmail').val(),
      Ext : $('#detailEmployeeExt').val(),
      RoleId : $('#detailEmployeeRole').val(),
      DepartmentId : $('#detailEmployeeDepartmentId').val()
    },
    success: function(result) {
      console.log(result);
      notify(result.icon, result.title, result.content, result.status);
      getEmployee();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function detailEmployee(id) {
  $('#detailEmployeeModal').modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/getDetailEmployee",
    data: {
      Id : id,
    },
    success: function(result) {
      console.log(result);
      var html1 = '<option value="0">Silahkan Pilih</option>';
      var html2 = '<option value="0">Silahkan Pilih</option>';
      result.department.forEach(function(data) {
        if (data.Id == result.detail.DepartmentId) {
          html1 = html1 + '<option value="'+data.Id+'" selected>'+data.Name+'</option>';
        } else {
          html1 = html1 + '<option value="'+data.Id+'" >'+data.Name+'</option>';
        }
      });

      result.role.forEach(function(data) {
        if (data.Id == result.detail.RoleId) {
          html2 = html2 + '<option value="'+data.Id+'" selected>'+data.Name+'</option>';
        } else {
          html2 = html2 + '<option value="'+data.Id+'" >'+data.Name+'</option>';
        }
      });

      $('#detailEmployeeDepartmentId').html(html1);
      $('#detailEmployeeRole').html(html2);

      $('#detailEmployeeId').val(result.detail.Id);
      $('#detailEmployeeFullname').text(result.detail.Fullname+" ( "+result.detail.Role+" ) ");
      $('#detailEmployeeEmail').val(result.detail.Email);
      $('#detailEmployeeExt').val(result.detail.Ext);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function getDepartment() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/getDepartment",
    data: {
      keyword : $('#keyword').val()
    },
    success: function(result) {
      console.log(result);
      var html1 = '<option value="0">Silahkan Pilih</option>';
      result.department.forEach(function(data) {
        if (data.IsExist==1) {
          html1 = html1 + '<option value="'+data.Id+'">'+data.Name+'</option>';
        } else {
          return;
        }
      });
      $('#addEmployeeDepartmentId').html(html1);
      $('#detailEmployeeDepartmentId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function getRole() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/getRole",
    success: function(result) {
      console.log(result);
      var html1 = '<option value="0">Silahkan Pilih</option>';
      result.role.forEach(function(data) {
        if(data.IsOnlyISP==1 && result.session.DepartmentId !=2){
          return;
        } else {
          html1 = html1 + '<option value="'+data.Id+'">'+data.Name+'</option>';
          
        }
      });
      $('#addEmployeeRole').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addEmployeeModal(){
  getDepartment();
  getRole();
  $('#addEmployeeModal').modal('show');
}

function getEmployee() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    url: "api/getEmployee",
    data: {
      keyword : $('#keyword').val()
    },
    success: function(result) {
      console.log(result);
      var html1='';
      var html2='';
      var image = '';
      //for(i=0; i<result.employee.length; i++){
      result.employee.forEach(function(data){

        if (data.Image==null) {
          image = 'assets/picture/user.jpg';
        } else {
          image = data.Image;
        }
        if (data.IsExist==1) {
          html1 +=
          '<div class="col-sm-6 col-lg-3">' +
          '<div class="card">' +
          '<div class="p-2">' +
          '<img class="card-img-top rounded" src="'+image+'" style="max-height:200px;">' +
          '</div>' +
          '<div class="card-body pt-2">' +
          '<h4 class="mb-1 fw-bold">' +
          data.Fullname +
          '</h4>' +
          '<br>' +
          '<center>' +
          '<button type="button" class="btn btn-secondary btn-round" onclick="detailEmployee('+data.Id+')">Detail</button>'+
          '</center>' +
          '</div>' +
          '</div>' +
          '</div>';
        } else {
          html2 = html2 + '<option value="'+data.Id+'" selected>'+data.Fullname+' ( '+data.Email+ ' )</option>';
        }

      });
      $('#employeeList').html(html1);
      $('#recoverEmployeeId').html(html2);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}
