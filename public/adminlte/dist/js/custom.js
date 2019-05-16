$(function () {

  "use strict";
  //select all checkboxes
  $("#select_all").change(function(){  //"select all" change 
      var status = this.checked; // "select all" checked status
      $('.checkbox').each(function(){ //iterate all listed checkbox items
          this.checked = status; //change ".checkbox" checked status
      });
  });

  $(document).on('change','.checkbox',function(){ //".checkbox" change 
      //uncheck "select all", if one of the listed checkbox item is unchecked
      if(this.checked == false){ //if this item is unchecked
          $("#select_all")[0].checked = false; //change "select all" checked status to false
      }
      
      //check "select all" if all checkbox items are checked
      if ($('.checkbox:checked').length == $('.checkbox').length ){ 
          $("#select_all")[0].checked = true; //change "select all" checked status to true
      }
  });

  $(document).on('click','.delete-all',function(e){
    e.preventDefault();
    if($('.checkbox').is(':checked')) {
      if(confirm('Are you sure want to delete ?')) {
        $('.confirm').submit();
      }
    } else {
      return alert('Please select at least one item !');
    }
  });
  $(document).on('click','.please-waiting',function(){
    waiting();
  });
  $(document).on('click','.delete',function(e){
    e.preventDefault();
    var CSRF_TOKEN = $('input[name="_token"]').attr('value');
    var METHOD = $('input[name="_method"]').attr('value');
    var url = $(this).closest('form').attr('action');;
    if(confirm('Are you sure want to delete ?')) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: {
            _method: 'POST',
            submit: true
        },
        success : function(data){
        if(data.msg) {
            // table.draw(false);
            table.ajax.reload();
          }
        }
      }).always(function(data) {
          // $('#dataTableBuilder').DataTable().draw(false);
      });
      
    } else {

    }
  });
  $('input, :input').attr('autocomplete', 'off');
});

function waiting(){
    $.blockUI({ 
        message: '<h1 style="font-weight:300">Please Wait</h1>',
        css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#fff', 
            '-webkit-border-radius': '0', 
            '-moz-border-radius': '0',  
            color: '#000',
            'text-transform': 'uppercase'
        },
        baseZ:9999
    });
}
