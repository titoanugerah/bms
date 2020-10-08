$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailBackupModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addBackupModal')
  });
  getBackup();
});

setTimeout(function(){
  $('.datatable').DataTable({
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
   'csv', 'excel', 'pdf']  
});
}, 600)

function getHistoryDetail(id,date){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id   : id,
       date : date,
    },
    url: "api/backup/readHistoryDetail",
    success: function(result) {
       $("#detailBackupModal").modal('hide');
       $("#detailHistoryModal").modal('show');
      console.log(result);
      var html1,dates = '';
      $('#jobIdHistory').val(id);
      result.forEach(function(data){
        html1 =
        '<tr>' +
        '<td>'+data.dataset+'</td>' +
        '<td>'+data.cartridge+'</td>' +
        '<td>'+data.remark+'</td>' +
        '<td>'+data.user+'</td>' +
        '</tr>' + html1;  
        dates = data.date;
      });
      $('#dateHistory').val(dates);
      $('#historyData').html(html1);
      $("#downloadBtn").attr('href','api/backup/download/'+id+'/'+dates);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
  setTimeout(function() { getCartridge(); getDataset(); }, 1000);

}

function detailBackupForm(id) {
  $("#detailBackupModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/backup/readDetail",
    success: function(result) {
      console.log(result);
      var html1 = '';
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      result.history.forEach(function(data){
        html1 =
        '<tr>' +
        '<td>'+data.date+'</td>' +
        '<td>'+data.cartridge+'</td>' +
        '<td>'+data.currentBackup+'/'+data.totalBackup+'</td>' +
        '<td><div class="row">'+'<button class="btn btn-primary btn-sm" onclick="getHistoryDetail('+data.id+','+data.date.replace('-','').replace('-','')+')"><i class="fas fa-eye"></i></button></div></td>' +
        '</tr>' + html1;
  
      });
      $('#backupData').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
  setTimeout(function() { getCartridge(); getDataset(); }, 1000);
}

function downloadReportForm(){
  $('#startDate').val('');
  $('#endDate').val('');  
  $('#downloadReportModal').modal('show');  
}

$("#startDate").on('change', function(){
  if($('#endDate').val()!="") {
    $("#downloadBtn2").attr('href','api/backup/download/'+$('#startDate').val()+'/'+$('#endDate').val());
  }
})

$("#endDate").on('change', function(){
  if($('#startDate').val()!="") {    
    $("#downloadBtn2").attr('href','api/backup/download/'+$('#startDate').val()+'/'+$('#endDate').val());
  }
})


$("#keyword").on('change', function(){
  getBackup();
  $("#keyword").val();
})

function updateBackup(){
  listBackupJob = [];
  $(".allData").each(function(data) {
    var splitData = $(this).text().split(',');
    var backupJob =  {
      jobId : splitData[0],
      cartridgeId : splitData[1],
      datasetId : splitData[2],
      remark : splitData[3]
    }
    listBackupJob.push(backupJob);    
  });

  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {listBackupJob : listBackupJob},
    url: "api/backup/update",
    success: function(result) {
      console.log(result);
      $("#detailBackupModal").modal('hide');
      getBackup();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewBackupForm() {
  $('#keyword').val("");
  getBackup();
  $("#addBackupModal").modal('show');
}

function addBackup() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       jobId : $("#addJobId").val(),
    },
    url: "api/backup/create",
    success: function(result) {
      $("#addBackupModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getBackup();
    },
    error: function(result) {
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

function deleteList(e) {
  $(e).closest('.item-list').remove();
}


function addBackupActivity() {
  html =
  '<div class="item-list">'+
  '<div class="info-user ml-3">' +
  '<div class="username">' + $('#editName').val() + '</div>' +
  '<div class="row">' +
  '<div class="status PO col-md-3"> ' + $('#editDatasetId option:selected').text() +' </div> | '+'<div class="status SNList col-md-3"> ' + $('#editCartridgeId option:selected').text()  +' </div> | '+'<div class="status SNList col-md-4"> '  + $('#editRemark').val() +  '</div>' +
  '</div>' +
  '</div>' +
  '<p class="allData" hidden>' + $('#editId').val() + ',' + $('#editCartridgeId').val() + ',' + $('#editDatasetId').val() + ',' + $('#editRemark').val()  +',</p>' +
  '<button type="button" class="close" onclick="deleteList(this)">&times;</button>' +
  '</div>';
  $('#backupJobList').append(html);
  $('#editRemark').val('');
  $('#editRemark').click();
}

function getBackup(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/backup/read",
    success: function(result) {
      var html = "";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.backup.forEach(backup => {

        var color ="";
        if(backup.isExist == 1){
          if(backup.hasFinishedBackup >= 1){
            color = "info";
          } else if(backup.hasFinishedBackup == 0 && backup.currentBackup!=0) {
            color = "warning";
          } else {
            color = "danger";            
          }
          html = html +         
          '<div class="col-sm-6 col-md-4" onclick="detailBackupForm('+backup.id+')">' +
            '<div class="card card-stats card-'+color+' card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-5">' +
                      '<div class="icon-big text-center">' +
                        '<i class="flaticon-user-5"></i>' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-7 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-backup"> Backup '+ uppercase(backup.category)+' ('+backup.currentBackup+'/'+backup.totalBackup+')</p>' +
                        '<h4 class="card-title">' + uppercase(backup.job) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+backup.id+'"> '+uppercase(backup.job)+' </option>';
        }
      });

      $('#backupList').html(html);
      $('#recoverBackupId').html(html1);
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}
function getCartridge(){  
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#editName").val(),
    },
    url: "api/cartridge/read",
    success: function(result) {
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.cartridge.forEach(cartridge => {
        if(cartridge.isExist == 1){
          html1 = html1 +
           '<option value="'+cartridge.id+'"> '+uppercase(cartridge.name)+' </option>';
        }
      });

      $('#editCartridgeId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

function getDataset(){  
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#editName").val(),
    },
    url: "api/dataset/read",
    success: function(result) {
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.dataset.forEach(dataset => {
        if(dataset.isExist == 1){
          html1 = html1 +
           '<option value="'+dataset.id+'"> '+uppercase(dataset.name)+' </option>';
        }
      });

      $('#editDatasetId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });

}

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function deleteBackup() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/backup/delete",
    success: function(result) {
      $("#detailBackupModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getBackup();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverBackup() {
  if($('#recoverBackupId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverBackupId").val(),
      },
      url: "api/backup/recover",
      success: function(result) {
        $("#addBackupModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getBackup();
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
