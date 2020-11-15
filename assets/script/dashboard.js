$(document).ready(function(){
    $('.select2modal').select2({
        dropdownParent: $('#detailIssueModal')
    });
    $('.select2addmodal').select2({
        dropdownParent: $('#addIssueModal')
    });
    console.log("mulai");
    getIssue();
  });
  
  setTimeout(function(){
    $('.datatable').DataTable({
      "order": [[ 0, "desc" ]],
//      dom: 'Bfrtip',
    //   buttons: [
    //  'csv', 'excel', 'pdf']  
  });
  }, 600);
  
  

  function  getIssue(){
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
         keyword : $("#keyword").val(),
      },
      url: "api/issue/readDashboard",
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
        $('.total').text(result.total);
        $('.fixed').text(result.fixed);
        $('.unfixed').text(result.unfixed);
  
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-times', 'Gagal', getErrorMsg(result.responseText), 'danger');
      }
    });
  }

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
  
  