$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailJobModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addJobModal')
  });
  getJob();
});

function detailJobForm(id) {
  $("#detailJobModal").modal('show');
  getCategory();
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/job/readDetail",
    success: function(result) {
      $('#editId').val(result.detail.id);
      $('#editName').val(result.detail.name);
      $("#editCategoryId").val(result.detail.categoryId).change();
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}



$("#keyword").on('change', function(){
  getJob();
  $("#keyword").val();
})

function updateJob(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       categoryId : $("#editCategoryId").val()
    },
    url: "api/job/update",
    success: function(result) {
      $("#detailJobModal").modal('hide');
      getJob();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewJobForm() {
  $('#keyword').val("");
  getCategory();
  getJob();
  $("#addJobModal").modal('show');
}

function addJob() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       categoryId : $("#addCategoryId").val(),
    },
    url: "api/job/create",
    success: function(result) {
      $("#addJobModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getJob();
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

function  getJob(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/job/read",
    success: function(result) {
      var html = "";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.job.forEach(job => {
        if(job.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-4" onclick="detailJobForm('+job.id+')">' +
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
                        '<p class="card-job"> Backup '+uppercase(job.category)+'</p>' +
                        '<h4 class="card-title">' + uppercase(job.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+job.id+'"> '+uppercase(job.name)+' </option>';
        }
      });

      $('#jobList').html(html);
      $('#recoverJobId').html(html1);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function  getCategory(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/category/read",
    success: function(result) {
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.category.forEach(category => {
        if(category.isExist == 1){
          html1 = html1 +
           '<option value="'+category.id+'"> '+uppercase(category.name)+' </option>';
        }
      });

      $('#addCategoryId').html(html1);
      $('#editCategoryId').html(html1);
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

function deleteJob() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/job/delete",
    success: function(result) {
      $("#detailJobModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getJob();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverJob() {
  if($('#recoverJobId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverJobId").val(),
      },
      url: "api/job/recover",
      success: function(result) {
        $("#addJobModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getJob();
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
