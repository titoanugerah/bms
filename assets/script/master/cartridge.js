$(document).ready(function(){
  $('.select2modal').select2({
      dropdownParent: $('#detailCartridgeModal')
  });
  $('.select2addmodal').select2({
      dropdownParent: $('#addCartridgeModal')
  });
  getCartridge();
});

function detailCartridgeForm(id) {
  $("#detailCartridgeModal").modal('show');
  getJob();
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : id,
    },
    url: "api/cartridge/readDetail",
    success: function(result) {
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
  getCartridge();
  $("#keyword").val();
})

function updateCartridge(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
       name : $("#editName").val(),
       jobId : $("#editJobId").val()
    },
    url: "api/cartridge/update",
    success: function(result) {
      $("#detailCartridgeModal").modal('hide');
      getCartridge();
      notify('fas fa-check', 'Berhasil', result.content, 'success');
    },
    error: function(result) {
      notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function addNewCartridgeForm() {
  $('#keyword').val("");
  getCartridge();
  getJob();
  $("#addCartridgeModal").modal('show');
}

function addCartridge() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       name : $("#addName").val(),
       jobId : $("#addJobId").val()
    },
    url: "api/cartridge/create",
    success: function(result) {
      $("#addCartridgeModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getCartridge();
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

function  getCartridge(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       keyword : $("#keyword").val(),
    },
    url: "api/cartridge/read",
    success: function(result) {
      var html = "";
     var html1 = '<option value="0"> Silahkan pilih </option>';
      result.cartridge.forEach(cartridge => {
        if(cartridge.isExist == 1){
          html = html +         
          '<div class="col-sm-6 col-md-3" onclick="detailCartridgeForm('+cartridge.id+')">' +
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
                        '<p class="card-cartridge">'+cartridge.job+'</p>' +
                        '<h4 class="card-title">' + uppercase(cartridge.name) +'</h4>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>';             
        } else {
          html1 = html1 +
           '<option value="'+cartridge.id+'"> '+uppercase(cartridge.name)+' </option>';
        }
      });

      $('#cartridgeList').html(html);
      $('#recoverCartridgeId').html(html1);
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

function deleteCartridge() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
       id : $("#editId").val(),
    },
    url: "api/cartridge/delete",
    success: function(result) {
      $("#detailCartridgeModal").modal('hide');
      notify('fas fa-check', 'Berhasil', result.content, 'success');
      getCartridge();
    },
    error: function(result) {
      console.log(result);
       notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
    }
  });
}

function recoverCartridge() {
  if($('#recoverCartridgeId').val()!=0)
  {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        id : $("#recoverCartridgeId").val(),
      },
      url: "api/cartridge/recover",
      success: function(result) {
        $("#addCartridgeModal").modal('hide');
        notify('fas fa-check', 'Berhasil', result.content, 'success');
        getCartridge();
      },
      error: function(result) {
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });

  } else {
    notify('fas fa-bell', 'Gagal', 'Mohon pilih dengan benar', 'danger');
  }
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

function unauthorized() {
  notify('fas fa-user', 'Tidak diijinkan', 'Anda tidak memiliki hak akses untuk mengedit kolom ini', 'danger');
}
