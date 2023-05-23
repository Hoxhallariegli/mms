$(document).ready(function() {
  	$('#rootwizard').bootstrapWizard();


    $('.my_link').click(function(){
      var i=50;
      var id=this.id;
      var c_id=id*10;
      var color='#337a'+c_id;
      $('#tab'+id).css('background',color)
      i++;
      console.log(color);
    })
});
