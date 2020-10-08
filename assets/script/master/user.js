$(document).ready(function(){
    $('.select2modal').select2({
        dropdownParent: $('#detailUserModal')
    });
    $('.select2addmodal').select2({
        dropdownParent: $('#addUserModal')
    });
    getUser();
    getRole();
  });

  $('#editRoleId').on('change', function(){
    if($('#editRoleId').val()==3){
      $("#editTeamId").parent().show(); 
    } else {
      $('#editTeamId').val(0);
      $("#editTeamId").parent().hide();
    }    
  });

  function getUser(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/user/read",
      success: function(result) {
        console.log(result);
        var html1='';
        var html2='';
        var image = '';
        result.user.forEach(function(data){        
          if (data.image==null) {
            image = 'assets/picture/user.jpg';
          } else {
            image = data.image;
          }
          if (data.isExist==1) {
            html1 +=
            '<div class="col-sm-6 col-lg-3">' +
            '<div class="card">' +
            '<div class="p-2">' +
            '<img class="card-img-top rounded" src="'+image+'" style="max-height:200px;">' +
            '</div>' +
            '<div class="card-body pt-2">' +
            '<h4 class="mb-1 fw-bold">' +
            data.name +
            '</h4>' +
            '<br>' +
            '<center>' +
            '<button type="button" class="btn btn-secondary btn-round" onclick="detailUserForm('+data.id+')">Detail</button>'+
            '</center>' +
            '</div>' +
            '</div>' +
            '</div>';
          } else {
            html2 = html2 + '<option value="'+data.id+'" selected>'+data.name+' ( '+data.email+ ' )</option>';
          }
        
        });
        $('#userList').html(html1);
        $('#recoverUserId').html(html2);
    },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  
  }

  function  getTeam(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/team/read",
      success: function(result) {
          console.log(result);
        var html = '<option value="0"> Silahkan pilih </option>';
        result.team.forEach(team => {
            if(team.supervisor == null){
                var name = "Belum dikonfirmasi";
            } else {
                var name = team.supervisor;
            }
          if(team.isExist == 1){
            html = html +
            '<option value="'+team.id+'"> Tim '+uppercase(name)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addTeamId').html(html);
        $('#editTeamId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function  getRole(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/role/read",
      success: function(result) {
        var html = '<option value="0"> Silahkan pilih </option>';
        result.role.forEach(role => {
          if(role.isExist == 1){
            html = html +
            '<option value="'+role.id+'"> '+uppercase(role.name)+' </option>';
          } else {
            return;
          }
        });
  
        $('#addRoleId').html(html);
        $('#editRoleId').html(html);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

  function getDetailUser(id){
    $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
           id : id,
        },
        url: "api/user/readDetail",
        success: function(result) {
           console.log(result);
          $('#editId').val(result.detail.id);
          $('#editName').val(result.detail.name);
          $('#editEmail').val(result.detail.email);
          $("#editRoleId").val(result.detail.roleId).change();
          if(result.detail.role == "staff"){              
            $("#editTeamId").val(result.detail.teamId).change();
            $("#editTeamId").parent().show();
          } else {
            $("#editTeamId").parent().hide();
          }
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
  }

  function detailUserForm(id) {
    $("#detailUserModal").modal('show');
    getTeam();
    getDetailUser(id);
  
  }
  
  $("#keyword").on('change', function(){
    getUser();
    $("#keyword").val();
  })
  
  function updateUser(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         id : $("#editId").val(),
         email : $("#editEmail").val(),
         roleId : $("#editRoleId").val(),
         teamId : $("#editTeamId").val()
      },
      url: "api/user/update",
      success: function(result) {
        $("#detailUserModal").modal('hide');
        getUser();
        notify('fas fa-check', 'Berhasil', result.content, 'success');
      },
      error: function(result) {
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function addNewUserForm() {
    $('#keyword').val("");
    getRole();
    getUser();
    $("#addUserModal").modal('show');
  }
  
  function addUser() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         email : $("#addEmail").val(),
         roleId : $("#addRoleId").val()
      },
      url: "api/user/create",
      success: function(result) {
        $("#addUserModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getUser();
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function getErrorMsg(result){
    var responseInArray = result.split('\n');
    for(var i=0; i < responseInArray.length; i++) {
      responseInArray[i] = responseInArray[i].replace(/ +(?= )/g,'');
      responseInArray[i] = responseInArray[i].replace('\t','');
      responseInArray[i] = responseInArray[i].replace('\t','');
      responseInArray[i] = responseInArray[i].replace('<h1>','');
      responseInArray[i] = responseInArray[i].replace('</h1>','');
      responseInArray[i] = responseInArray[i].replace('<div>','');
      responseInArray[i] = responseInArray[i].replace('</div>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
      responseInArray[i] = responseInArray[i].replace('<p>','');
      responseInArray[i] = responseInArray[i].replace('</p>','');
     }
  
     var error = responseInArray.filter(x => (x.includes("Message")));
     if(error.length == 0){
       error = responseInArray.filter(x => (x.includes("Error ")));
     }
    return error.toString();  
  }
  
  function uppercase(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
  
  function deleteUser() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         id : $("#editId").val(),
      },
      url: "api/user/delete",
      success: function(result) {
        $("#detailUserModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getUser();
      },
      error: function(result) {
        console.log(result);
         notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function recoverUser() {
    if($('#recoverUserId').val()!=0)
    {
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          id : $("#recoverUserId").val(),
        },
        url: "api/user/recover",
        success: function(result) {
          $("#addUserModal").modal('hide');
          notify('fas fa-check', 'Berhasil', result.content, 'success');
          getUser();
        },
        error: function(result) {
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
  
    } else {
      notify('fas fa-bell', 'Gagal', 'Mohon pilih dengan benar', 'danger');
    }
  }
  
  function unauthorized() {
    notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
  }
  