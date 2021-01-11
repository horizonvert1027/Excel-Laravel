$(document).ready(function () {
  //Import Excel
  showSpinner();
  $.ajax({
    type: "POST",
    url: '/loadExcel',
    async: false,
    data: { "_token": token },
    success: function (res) {
      for (const key in res) {
        res[key]['button'] = "<div id='" + res[key]['id'] + "' class='d-flex flex-wrap gap-2 align-items-center justify-content-center'><button class='btn btn-success btn-sm d-none waves-effect waves-light'><i class='mdi mdi-content-save'></i> Save </button></button><button class='btn btn-sm btn-primary waves-effect waves-light' data-bs-toggle='modal' data-bs-target='.bs-example-modal-lg'><i class='mdi mdi-upload'></i> Upload </button></div>";
      }
      init(res);
      hideSpinner();
    }
  });

  //Init DataTable
  function init(result) {
    $("#datatable").DataTable({
      data: result,
      columns: [
        { data: 'name' },
        { data: 'planned_start' },
        { data: 'planned_finish' },
        { data: 'actual_start' },
        { data: 'actual_finish' },
        { data: 'percent_complete' },
        { data: 'comment' },
        { data: 'button' },
      ]
    }),
      $("#datatable-buttons").DataTable({
        lengthChange: !1,
      }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");
  }

  //Update Excel
  $("#datatable tbody").on("click", "td", function () {
    if ($(this).parent().children().eq(0).has('input').length == 0 && $(this)[0].cellIndex != 7) {
      let datelist = [];
      for (let index = 1; index < 5; index++) {
        let datePicker = '<div class="input-daterange input-group" id="project-date-inputgroup" data-provide="datepicker" data-date-format="D dd M yyyy" data-date-container="#project-date-inputgroup" data-date-autoclose="true"><input type="text" class="form-control" value="'+ $(this).parent().children().eq(index)[0].innerText +'" name="start" /></div>';
        datelist.push(datePicker);
      }
      $(this).parent().children().eq(0).html("<input type='text' class='form-control' value='" + $(this).parent().children().eq(0)[0].innerText + "' >");
      $(this).parent().children().eq(1).html(datelist[0]);
      $(this).parent().children().eq(2).html(datelist[1]);
      $(this).parent().children().eq(3).html(datelist[2]);
      $(this).parent().children().eq(4).html(datelist[3]);
      $(this).parent().children().eq(5).html("<input type='range' id='vol' min='0' max='100' value='" + $(this).parent().children().eq(5)[0].innerText + "' >");
      $(this).parent().children().eq(6).html("<input type='text' class='form-control' value='" + $(this).parent().children().eq(6)[0].innerText + "' >");

      let successBtn = $(this).parent().children().eq(7).children().children().eq(0);
      let primaryBtn = $(this).parent().children().eq(7).children().children().eq(1);
      successBtn.removeClass('d-none');
      primaryBtn.addClass('d-none');
    }
  });

  //Tooltip 
  $("#datatable").on("change", "#vol", function(){

  })

  $("#datatable").on("click", ".btn-success", function () {
    const rowId = $(this).parent().attr('id');
    const editRow = $(this).parent().parentsUntil().eq(1);
    editRow.children().eq(0).html(editRow.children().eq(0).children().val());
    editRow.children().eq(5).html(editRow.children().eq(5).children().val());
    editRow.children().eq(6).html(editRow.children().eq(6).children().val());
    for (let i = 1; i < 5; i++) {
      editRow.children().eq(i).html(editRow.children().eq(i).children().children().val());
    }
    $(this).addClass('d-none');
    $(this).siblings().removeClass('d-none');

    let data = {
      id: rowId,
      name: editRow.children().eq(0).html(),
      planned_start: editRow.children().eq(1).html(),
      planned_finish: editRow.children().eq(2).html(),
      actual_start: editRow.children().eq(3).html(),
      actual_finish: editRow.children().eq(4).html(),
      percent_complete: editRow.children().eq(5).html(),
      comment: editRow.children().eq(6).html(),
    }

    $.ajax({
      type: 'POST',
      url: '/editExcel',
      data: {
        "_token": token,
        data: data,
      },
      success: function (res) {
        if (res.msg) {
          toastr.success(res.msg);
        }
      }
    })

  })

  let dataId = '';
  $("#datatable").on("click", ".btn-primary", function () {
    dataId = $(this).parent().attr('id');
    showImage();
  })

  //Image Upload
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': token,
    }
  });

  function showImage() {
    $.ajax({
      type: 'POST',
      url: '/image',
      data: { id: dataId },
      success: function (res) {
        let caroselItem = '';
        console.log(res.data.length);
        if(res.data.length != 0){
          $('.empty').html('');
          if(res.data.length == 1){
            $('.carousel-control-prev').css('display', 'none');
            $('.carousel-control-next').css('display', 'none');
          }else{
            $('.carousel-control-prev').css('display', 'block');
            $('.carousel-control-next').css('display', 'block');
          }
          for (const key in res.data) {
            const active = key == 0 ? 'active' : '';
            caroselItem += '<div class="carousel-item '+ active +'">';
            caroselItem += '<img src="'+public+'assets/images/upload/'+res.data[key]['name']+'" alt="Los Angeles" class="d-block w-75 mx-auto">';
            caroselItem += '</div>';
          }
        }else{
          $('.empty').html('<p class="text-center mt-4">No Uploaded Images.</p>')
          $('.carousel-control-prev').css('display', 'none');
          $('.carousel-control-next').css('display', 'none');
        }
        $('.carousel-inner').html(caroselItem);
      },
      error: function (err) {
        console.log(err)
      }
    })
  }

  $('#image-upload').submit(function (e) {
    if($('#image').val() == ''){
      toastr.error('Please Select Images.');
      return;
    }
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('id', dataId);
    $.ajax({
      type: 'POST',
      url: "/upload",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (res) {
        if (res.msg) {
          toastr.info(res.msg);
          $('.bs-example-modal-lg').modal('hide');
          $('#image').val('');
        }
      },
      error: function (data) {
      }
    });
  });

  $('.carousel').carousel({
    interval: 200000
  })

});
