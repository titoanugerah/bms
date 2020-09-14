$(document).ready(function(){
    $('.select2modal').select2({
        dropdownParent: $('#detailTeamModal')
    });
    $('.select2addmodal').select2({
        dropdownParent: $('#addTeamModal')
    });
    getTeam();
  });

  function getTeam(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/team/read",
      success: function(result) {
        console.log(result);
        var html1='';
        var html2='';
        var image = '';
        result.team.forEach(function(data){        
          if (data.supervisorImage==null) {
            image = 'assets/picture/user.jpg';
          } else {
            image = data.supervisorImage;
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
            'Tim ' + data.supervisor +
            '</h4>' +
            '<br>' +
            '<center>' +
            '<button type="button" class="btn btn-secondary btn-round" onclick="detailTeamForm('+data.id+')">Detail</button>'+
            '</center>' +
            '</div>' +
            '</div>' +
            '</div>';
          } else {
            html2 = html2 + '<option value="'+data.id+'" selected>'+data.supervisor+' </option>';
          }
        
        });
        $('#teamList').html(html1);
        $('#recoverTeamId').html(html2);
    },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });  
  }

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
        result.user.forEach(function(data){        
          if(data.isExist==1){
            html1 = html1 + '<option value="'+data.id+'" selected>'+data.name+' </option>';
            if (data.Role!="supervisor") {
              html2 = html2 + '<option value="'+data.id+'" selected>'+data.name+' </option>';
            }  
          }        
        });
        $('#addSpvId').html(html2);
        $('#editSpvId').html(html1);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  
  }


  function getDetailTeam(id){
    $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
           id : id,
        },
        url: "api/team/readDetail",
        success: function(result) {
          var html1="";
           console.log(result);
           $('#editId').val(result.detail.id);
           $("#editSpvId").val(result.detail.spvId).change();

           result.member.forEach(function(data){
            if(data.image==null){
              image = 'assets/picture/user.jpg';
            } else {
              var image = data.image
            }
            html1 = html1 +
            '<div class="item-list">'+
              '<div class="avatar">' +
                '<img src="'+image+'" class="avatar-img rounded-circle">' +
              '</div>' +
              '<div class="info-user ml-3">' +
                '<div class="username">' + data.name + '</div>' +
                '<div class="status">' + data.email + '</div>' +
              '</div>' +
              data.role +
            '</div>';
          });
          $('#memberList').html(html1);
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
        }
      });
  }

  function detailTeamForm(id) {
    $("#detailTeamModal").modal('show');
    getTeam();
    getUser();
    getDetailTeam(id);
  
  }
  
  $("#keyword").on('change', function(){
    getTeam();
    $("#keyword").val();
  })
  
  function updateTeam(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         id : $("#editId").val(),
         spvId : $("#editSpvId").val(),
      },
      url: "api/team/update",
      success: function(result) {
        $("#detailTeamModal").modal('hide');
        getTeam();
        notify('fas fa-check', 'Berhasil', result.content, 'success');
      },
      error: function(result) {
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function addNewTeamForm() {
    $('#keyword').val("");
    getTeam();
    getUser();
    $("#addTeamModal").modal('show');
  }
  
  function addTeam() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         spvId : $("#addSpvId").val()
      },
      url: "api/team/create",
      success: function(result) {
        console.log(result);
        $("#addTeamModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getTeam();
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
  
  function deleteTeam() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         id : $("#editId").val(),
      },
      url: "api/team/delete",
      success: function(result) {
        $("#detailTeamModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getTeam();
      },
      error: function(result) {
        console.log(result);
         notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }
  
  function recoverTeam() {
    if($('#recoverTeamId').val()!=0)
    {
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          id : $("#recoverTeamId").val(),
        },
        url: "api/team/recover",
        success: function(result) {
          $("#addTeamModal").modal('hide');
          notify('fas fa-check', 'Berhasil', result.content, 'success');
          getTeam();
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
    notify('fas fa-team', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
  }
  