$(document).ready(function(){
  $('.select2modal').select2({
    dropdownParent: $('#detailAssetModal')
  });
  $('.select2addmodal').select2({
    dropdownParent: $('#addAssetRequestModal')
  });
  $('.select2regmodal').select2({
    dropdownParent: $('#registerAssetModal')
  });

  $('.select2dispossemodal').select2({
    dropdownParent: $('#disposalAssetModal')
  });
  getAsset();
});

setTimeout(function(){
  $('.datatable').DataTable({
    "order": [[ 0, "desc" ]],
    dom: 'Bfrtip',
    buttons: [
  'copy', 'csv', 'excel', 'pdf', 'print']  
  });
}, 600)


$('#keyword').on('change', function(){
  getAsset();
})

function deleteList(e) {
  $(e).closest('.item-list').remove();
  console.log(e);
}


$('#addItemId').on('change', function(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#addItemId option:selected").text()
    },
    url: "api/getModel",
    success: function(result) {
      console.log(result);
      var html = '<option value="0" >Silahkan Pilih</option>';
      result.model.forEach(function(data){
        if (data.IsExist == 1) {
          html = html + '<option value="'+data.Id+'" >'+data.Name+'</option>';
        }
      });
      $('#addModelId').html(html);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
});

function  requestDispossal(){
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      Id : $("#dispossalAssetId").val(),
      Remark : $("#dispossalRemark").val()
    },
    url: "api/requestDispossal",
    success: function(result) {
      console.log(result);
      $('#disposalAssetModal').modal('hide');
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addRequestAssetForm() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getItem",
    success: function(result) {
      console.log(result);
      var html = '<option value="0" >Silahkan Pilih</option>';
      result.item.forEach(function(data){
        if (data.IsExist == 1) {
          html = html + '<option value="'+data.Id+'" >'+data.Name+'</option>';
        }
      });
      $('#addItemId').html(html);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function registerAssetForm() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      keyword : $("#keyword").val()
    },
    url: "api/getModel",
    success: function(result) {
      console.log(result);
      var html = '<option value="0" >Silahkan Pilih</option>';
      result.model.forEach(function(data){
        if (data.IsExist == 1) {
          html = html + '<option value="'+data.Id+'" >'+ data.Item+' '+data.Name+'</option>';
        }
      });
      $('#regModelId').html(html);
    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

function addAsset() {
  $.ajax({
    type: "POST",
    dataType : "JSON",
    data : {
      Id : $('#regModelId').val(),
    },
    url: "api/getDetailModel",
    success: function(result) {
      console.log('success', result);
      html =
      '<div class="item-list">'+
      '<div class="avatar">' +
      '<img src="assets/picture/'+result.detail.Image+'" class="avatar-img rounded-circle">' +
      '</div>' +
      '<div class="info-user ml-3">' +
      '<div class="username">' + result.detail.Name + '</div>' +
      '<div class="row">' +
      '<div class="status PO col-md-4"> ' + $('#regPO').val() +' </div> | '+'<div class="status SNList col-md-6"> ' + $('#regSN').val() +  '</div>' +
      '</div>' +
      '</div>' +
      '<p class="ModelIdList" hidden>' + $('#regModelId').val() + '</p>' +
      '<button type="button" class="close" onclick="deleteList(this)">&times;</button>' +
      '</div>';
      $('#assetList').append(html);
      $('#regSN').val('');
      //        $('#regPO').val('');
      $('#regSN').click();

    },
    error: function(result) {
      console.log(result);
      notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
    }
  });
}

$('#regSN').keydown(function(e) {
  var code = e.keyCode || e.which;
  var html = '';
  //   if (code == '9') {
    if (code == '13') {
      addAsset();
    }
  });


  function registerAsset() {
    var listPO = [];
    var listSN = [];
    var listModelId = [];
    var newData = [];
    var dataAsset = [];
    var total= 0;
    $(".PO").each(function(data) {
      listPO.push($(this).text())
    });

    $(".SNList").each(function() {
      listSN.push($(this).text())
    });

    $(".ModelIdList").each(function() {
      listModelId.push($(this).text())
    });

    var no = 0;
    $(".item-list").each(function() {
      // newData.['PO'] = listPO[no];
      // dataAsset[no].['SN'] = listSN[no];
      // dataAsset[no].['ModelId'] = listModelId[no];
      dataAsset.push([listPO[no],listSN[no], listModelId[no]]);
      no++;
    });

    dataAsset.forEach(function(data){
      $.ajax({
        type: "POST",
        dataType : "JSON",
        data : {
          PO : data[0],
          SN : data[1],
          ModelId : data[2]
        },
        url: "api/registerAsset",
        success: function(result) {
          console.log(result);
          notify('fas fa-check', result.title, result.content, result.status);
          $('#registerAssetForm').modal('hide');
          $('.item-list').remove();
          getAsset();
        },
        error: function(result) {
          console.log(result);
          notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
        }
      });
    });

  }


  function getDetailAsset(id) {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        Id : id,
      },
      url: "api/getDetailAsset",
      success: function(result) {
        console.log(result);
        var html1 = "<option value='0' >Silahkan Pilih</option>";
        var html2 = "<option value='0' >Silahkan Pilih</option>";
        var html3 = "";
        $('#editId').val(result.detail.Id);
        $('#editSN').val(result.detail.SN);
        $('#editPO').val(result.detail.PO);
        $('#editDuration').val(result.detail.Duration+" Bulan ");
        $('#editRegNumber').val(result.detail.RegNumber);
        $('#editUserId').val(result.detail.PICName);
        $('#editDepartment').val(result.detail.Department);
        $('#editRemark').val(result.detail.Remark);
        $('#editPicture').attr('src','assets/picture/'+result.detail.ModelImage);
        result.item.forEach(function(data){
          if (data.Id == result.detail.ItemId) {
            html1 = html1 + "<option value="+data.Id+" selected>"+data.Name+"</option>";
          } else {
            html1 = html1 + "<option value="+data.Id+" >"+data.Name+"</option>";
          }
        });
        result.model.forEach(function(data){
          if (data.Id == result.detail.ModelId) {
            html2 = html2 + "<option value="+data.Id+" selected>"+" "+data.Name+"</option>";
          } else {
            html2 = html2 + "<option value="+data.Id+" >"+" "+data.Name+"</option>";
          }
        });
        if (result.detail.Status>6 && result.detail.Status<9) {
          $('#btnFollowUpSuperior').attr('hidden', 'true');
          $('#btnDelete').attr('hidden', 'true');
          $('#editItemId').attr('disabled', 'true');
          $('#editSN').attr('disabled', 'true');
          $('#editPrice').attr('disabled', 'true');
          $('#editRemark').attr('disabled', 'true');
          $('#editModelId').attr('disabled', 'true');
          
        }
        result.log.forEach(function(data){
          html3 =
          '<div class="card card-secondary">' +
          '<div class="card-header">' +
          data.DateTime +
          '</div>' +
          '<div class="card-body">' +
          data.Description  +
          '</div>' +
          '</div>' + html3;
        });


        $('#editItemId').html(html1);
        $('#editModelId').html(html2);
        $('#logData').html(html3);
        $('#detailAssetModal').modal('show');
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
      }
    });
  }

  function deleteAsset() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        Id : $("#editId").val()
      },
      url: "api/deleteAsset",
      success: function(result) {
        console.log(result);
        $('detailAssetModal').modal('hide');
        notify('fas fa-check', result.title, result.content, result.status);
        getAsset();
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
      }
    });
  }

  function getAsset() {
    $.ajax({
      type: "POST",
      dataType : "JSON",
      data : {
        keyword : $("#keyword").val()
      },
      url: "api/getAsset",
      success: function(result) {
        console.log(result);
        var html1= "";
        var html2= "";
        var html3= "";
        var html4= "";
        var html5= "";
        var html6= "";
        var html7= "<option value='0'> Silahkan pilih </option>";
        var no = 1;
        result.asset.forEach(function(data){
          if (data.IsExist==1) {
            html5 = html5+'<option value="'+data.Id+'">'+data.Item+' '+data.Model+' (SN : '+data.SN+' )</option>';
            html1 =
            '<tr>' +
            '<td>'+no+'</td>' +
            '<td>'+data.Model+'</td>' +
            '<td>'+data.PO+'</td>' +
            '<td>'+data.SN+'</td>' +
            '<td>'+data.PICName+'</td>' +
            '<td>'+data.CreateDate+'</td>' +
            '<td> <button class="btn btn-primary" onclick="getDetailAsset('+data.Id+')">Detail</button></td>' +
            '</tr>' + html1;

            no++;
            if (data.Status==2) {
              html2 =
              '<tr>' +
              '<td>'+no+'</td>' +
              '<td>'+data.Model+'</td>' +
              '<td>'+data.PO+'</td>' +
              '<td>'+data.SN+'</td>' +
              '<td>'+data.PICName+'</td>' +
              '<td> <button class="btn btn-primary" onclick="getDetailAsset('+data.Id+')">Detail</button></td>' +
              '</tr>' + html2;
            }else if (data.Status>=3 && data.Status<=8) {
              html3 =
              '<tr>' +
              '<td>'+no+'</td>' +
              '<td>'+data.Model+'</td>' +
              '<td>'+data.PO+'</td>' +
              '<td>'+data.SN+'</td>' +
              '<td>'+data.PICName+'</td>' +
              '<td> <button class="btn btn-primary" onclick="getDetailAsset('+data.Id+')">Detail</button></td>' +
              '</tr>' + html3;
            }
          } else {
            html7 = html7 + '<option value="'+data.Id+'" >' +data.Model+'</option>';
          }
        });

        $('#dispossalAssetId').html(html5);
        $('#allData').html(html1);
        $('#transferData').html(html2);
        $('#disposalData').html(html3);
        $('#recoverAssetRequestId').html(html7);
      },
      error: function(result) {
        console.log(result);
        notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
      }
    });
  }

  function getStatusMessage(code) {
    if (code==0) {
      return 'Perangkat di Registrasi oleh IT Asset';
    } else if (code==1) {
      return 'Perangkat dalam proses pemindahan dari ISP';
    } else if (code==2){
      return 'Perangkat berhasil dipindahkan dari ISP';
    } else if (code==3){
      return 'Perangkat dalam proses pemindahan dari departemen';
    } else if (code==4){
      return 'Perangkat dalam berhasil dipemindahan dari departemen';
    } else if (code==5){
      return 'Perangkat dalam proses pemusnahan';
    } else if (code==6){
      return 'Perangkat Dimusnahkan';
    }
  }

  // function getStatusMessage(data){
    //   if (data == 0) {
      //     return "Dihapus oleh Admin IT";
      //   } else if (data == 1) {
        //     return "Diajukan oleh Admin IT";
        //   } else if (data == 2) {
          //     return "Ditolak oleh Manager ISP";
          //   } else if (data == 3) {
            //     return "Disetujui oleh Manager ISP";
            //   } else if (data == 4) {
              //     return "Ditolak oleh General Manager ISP";
              //   } else if (data == 5) {
                //     return "Disetujui oleh General Manager ISP";
                //   } else if (data == 6) {
                  //     return "Perangkat dikembalikan ke vendor karena tidak sesuai";
                  //   } else if (data == 7) {
                    //     return "Perangkat diterima, dan sudah diregistrasi";
                    //   } else if (data == 8) {
                      //     return "Perangkat tersedia";
                      //   } else if (data == 9) {
                        //     return "Perangkat dalam Proses Transfer";
                        //   } else if (data == 10) {
                          //     return "Perangkat digunakan";
                          //   } else if (data == 11) {
                            //     return "";
                            //   }
                            //
                            // }

                            function updateAsset() {
                              if ($("#editModelId").val() != 0 && $("#editSN").val() != "" && $("#editPrice").val() != "" && $("#editPrice").val() != 0 ) {
                                $.ajax({
                                  type: "POST",
                                  dataType : "JSON",
                                  data : {
                                    Id : $('#editId').val(),
                                    ModelId : $("#editModelId").val(),
                                    SN : $('#editSN').val(),
                                    Price : $('#editPrice').val(),
                                    Remark : $('#editRemark').val()
                                  },
                                  url: "api/updateAsset",
                                  success: function(result) {
                                    console.log(result);
                                    notify('fas fa-check', result.title, result.content, result.status);
                                    getAsset();
                                  },
                                  error: function(result) {
                                    console.log(result);
                                    notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
                                  }
                                });
                                $('#addAssetRequestModal').modal('hide');
                              } else {
                                notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, silahkan lengkapi kolom yang kosong ', 'danger');
                              }
                            }

                            function addAssetRequest() {
                              if ($("#addModelId").val() != 0 && $("#addQty").val() != "" ) {
                                $.ajax({
                                  type: "POST",
                                  dataType : "JSON",
                                  data : {
                                    ModelId : $("#addModelId").val(),
                                    Qty :  $("#addQty").val(),
                                    Remark : $('#addRemark').val()
                                  },
                                  url: "api/addAssetRequest",
                                  success: function(result) {
                                    console.log(result);
                                    getAsset();
                                  },
                                  error: function(result) {
                                    console.log(result);
                                    notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
                                  }
                                });
                                $('#addAssetRequestModal').modal('hide');
                              } else {
                                notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, silahkan lengkapi kolom yang kosong ', 'danger');
                              }

                            }

                            function recoverAsset() {
                              $.ajax({
                                type: "POST",
                                dataType : "JSON",
                                data : {
                                  Id : $("#recoverAssetRequestId").val()
                                },
                                url: "api/recoverAsset",
                                success: function(result) {
                                  console.log(result);
                                  $('detailAssetModal').modal('hide');
                                  notify('fas fa-check', result.title, result.content, result.status);
                                  getAsset();
                                },
                                error: function(result) {
                                  console.log(result);
                                  notify('fas fa-bell', 'Gagal', 'Terjadi masalah ketika memproses, kode error : '+result.status, 'danger');
                                }
                              });
                            }

                            function numberWithCommas(x) {
                              var parts = x.toString().split(".");
                              parts[0]=parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
                              return parts.join(",");
                            }
