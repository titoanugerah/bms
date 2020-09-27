$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailIssueModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addIssueModal')
  });
  getIssue();
});

setTimeout(function(){
  $('.datatable').DataTable({
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
   'csv', 'excel', 'pdf']  
});
}, 600);

$('#addStatusId').on('change', function(){
  if($('#addStatusId').val()==1){
    $('#remarkLabel').text('Deskripsi');
    $('.remarkInput').attr('id', 'addDescription');
    $('.remarkInput').val( $('#editDetail').val());
  } else if($('#addStatusId').val()==2){
    $('#remarkLabel').text('Hasil analisa penyebab');
    $('.remarkInput').attr('id', 'addRootCause');
    $('.remarkInput').val( $('#editRootCause').val());
  } else if($('#addStatusId').val()==3){
    $('#remarkLabel').text('Hasil analisa tindakan');
    $('.remarkInput').attr('id', 'addCounterMeasure');
    $('.remarkInput').val( $('#editCounterMeasure').val());
  } else if($('#addStatusId').val()==4 || $('#addStatusId').val()==5){
    $('#remarkLabel').text('Hasil analisa penyelesaian');
    $('.remarkInput').attr('id', 'addCounterMeasure');
    $('.remarkInput').val( $('#editCounterMeasure').val());    
  }
});

function detailIssueForm(id) {
  $("#detailIssueModal").modal('show');
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/issue/readDetail",
    success: function(result) {
      var html2=  '<option value="0"> Silahkan Pilih </option>';
      console.log(result);
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $('#editUser').val(result.detail.user);
      $('#editDate').val(result.detail.dateAdd);
      $('#editDetail').val(result.detail.detail);
      $('#editRootCause').val(result.detail.rootcause);
      $('#editCountermeasure').val(result.detail.countermeasure);
      $('#editStatus').val(getStatusMessage(result.detail.status));
      $('#editPIC').val((result.detail.pic));

      for (let index = result.detail.status; index <= 5; index++) {
        html2 = html2 +
        '<option value="'+index+'"> '+getStatusMessage(index)+' </option>';
      }
      $('#addStatusId').html(html2);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}



$("#keyword").on('change', function(){
  getIssue();
  $("#keyword").val();
})

function updateIssue(){

  $.ajax({
    type: "POST",
    dataType : "JSON",
    data :  {
      issueId : $("#editId").val(),
      status : $('#addStatusId').val(),
      remark : $(".remarkInput").val()
    },
    url: "api/issue/update",
    success: function(result) {
      console.log(result);
      $("#detailIssueModal").modal('hide');
      getIssue();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewIssueForm() {
  $('#keyword').val("");
  getIssue();
  $("#addIssueModal").modal('show');
}

function addIssue() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       description : $("#addDescription").val(),
    },
    url: "api/issue/create",
    success: function(result) {
      $("#addIssueModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getIssue();
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

function  getIssue(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/issue/read",
    success: function(result) {
      var html1 = '';
      var html2 = '';
      var no = 1;
      result.issue.forEach(function(data){
        html1 =
        '<tr>' +
        '<td>'+no+'</td>' +
        '<td>'+data.date+'</td>' +
        '<td>'+data.user+'</td>' +
        '<td>'+data.name+'</td>' +
        '<td>'+getStatusMessage(data.status)+'</td>' +
        '<td><div class="row">'+'<button class="btn btn-primary btn-sm" onclick="detailIssueForm('+data.id+')"><i class="fas fa-eye"></i></button>&nbsp;<button class="btn btn-danger btn-sm" onclick="deleteIssue('+data.id+')"><i class="fas fa-trash"></i></button></div></td>' +
        '</tr>' + html1;
        no++;
      });
      $('#issueData').html(html1);

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

// function  getJob(){
//   $.ajax({
//     type: "POST",
//     dataType : "JSON",
//     data : {
//        keyword : $("#keyword").val(),
//     },
//     url: "api/job/read",
//     success: function(result) {
//      var html1 = '<option value="0"> Silahkan pilih </option>';
//       result.job.forEach(job => {
//         if(job.isExist == 1){
//           html1 = html1 +
//            '<option value="'+job.id+'"> '+uppercase(job.name)+' </option>';
//         }
//       });

//       $('#addJobId').html(html1);
//       $('#editJobId').html(html1);
//     },
//     error: function(result) {
//       console.log(result);
//       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
//     }
//   });

// }

function uppercase(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}



function deleteIssue(id) {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/issue/delete",
    success: function(result) {
      $("#detailIssueModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getIssue();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText)+"laporan hanya bisa dihapus oleh pembuat dan laporan belum ada tindakan", 'danger');
    }
  });
}

// function recoverIssue() {
//   if($('#recoverIssueId').val()!=0)
//   {
//     $.ajax({
//       type: "POST",
//       dataType : "JSON",
//       data : {
//         id : $("#recoverIssueId").val(),
//       },
//       url: "api/issue/recover",
//       success: function(result) {
//         $("#addIssueModal").modal('hide');
//         notify('fas fa-check', 'Berhasil', result.content, 'success');
//         getIssue();
//       },
//       error: function(result) {
//         notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
//       }
//     });

//   } else {
//     notify('fas fa-bell', 'Gagal', 'Mohon pilih dengan benar', 'danger');
//   }
// }

function getStatusMessage(statusCode){
  if(statusCode==1){
    return "Belum ada penanganan";    
  } else if(statusCode==2){
    return "Analisa Masalah ";    
  } else if(statusCode==3){
    return "Analisa Tindakan ";    
  } else if(statusCode==4){
    return "Selesai (Temporer) ";    
  } else if(statusCode==5){
    return "Selesai (Permanen) ";    
  } 
}

function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
