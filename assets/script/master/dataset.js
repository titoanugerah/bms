$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailDatasetModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addDatasetModal')
  });
  getDataset();
});

function detailDatasetForm(id) {
  $("#detailDatasetModal").modal('show');
  getJob();
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/dataset/readDetail",
    success: function(result) {
      console.log(result);
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $("#editJobId").val(result.detail.jobId).change();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}



$("#keyword").on('change', function(){
  getDataset();
  $("#keyword").val();
})

function updateDataset(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       jobId : $("#editJobId").val()
    },
    url: "api/dataset/update",
    success: function(result) {
      $("#detailDatasetModal").modal('hide');
      getDataset();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewDatasetForm() {
  $('#keyword').val("");
  getJob();
  getDataset();
  $("#addDatasetModal").modal('show');
}

function addDataset() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       jobId : $("#addJobId").val(),
    },
    url: "api/dataset/create",
    success: function(result) {
      $("#addDatasetModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getDataset();
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

function  getDataset(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/dataset/read",
    success: function(result) {
      var html = "";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.dataset.forEach(dataset => {
        if(dataset.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-4" onclick="detailDatasetForm('+dataset.id+')">' +
            '<div class="card card-stats card-info card-round">' +
                '<div class="card-body">' +
                  '<div class="row">' +
                    '<div class="col-5">' +
                      '<div class="icon-big text-center">' +
                        '<i class="flaticon-user-5"></i>' +
                      '</div>' +
                    '</div>' +
                    '<div class="col-7 col-stats">' +
                      '<div class="numbers">' +
                        '<p class="card-dataset"> Backup '+uppercase(dataset.job)+'</p>' +
                        '<h4 class="card-title">' + uppercase(dataset.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+dataset.id+'"> '+uppercase(dataset.name)+' </option>';
        }
      });

      $('#datasetList').html(html);
      $('#recoverDatasetId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function  getJob(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/job/read",
    success: function(result) {
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.job.forEach(job => {
        if(job.isExist == 1){
          html1 = html1 +
           '<option value="'+job.id+'"> '+uppercase(job.name)+' </option>';
        }
      });

      $('#addJobId').html(html1);
      $('#editJobId').html(html1);
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

function deleteDataset() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/dataset/delete",
    success: function(result) {
      $("#detailDatasetModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getDataset();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverDataset() {
  if($('#recoverDatasetId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverDatasetId").val(),
      },
      url: "api/dataset/recover",
      success: function(result) {
        $("#addDatasetModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getDataset();
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
