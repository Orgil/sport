$('.datepicker').datepicker({
  format: 'yyyy-mm-dd'
}).on('changeDate',function(){
  $(this).datepicker('hide');
});
