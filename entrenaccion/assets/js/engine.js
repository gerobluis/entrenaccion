$(document).ready(function() {

	$(".contacto").toggle(function(){
		$('#footer').css('z-index','8000');
		$(".contactanosopen").show().animate({top:"-400px"}, { queue: false, duration: 500 });
		$(".contacto").animate({top:"-460px"}, { queue: false, duration: 500 });
	}, function(){
		$('#footer').css('z-index','998');
		$(".contactanosopen").animate({top:"60px"}, { queue: false, duration: 500 });
		$(".contacto").animate({top:"0"}, { queue: false, duration: 500 });
		$('.contactanosopen').hide();
	});

});

function openFB(w,h,url){
	w = parseInt(w);
	h = parseInt(h);
	$.fancybox({
		href: url + '',
		width : w,
		height : h,
		type : 'iframe',
		autoSize  : false
	});
}

$(".carritoover").mouseover(function(){
  $("#carrito").show();
});

$(".carritoover").mouseout(function(){
  $("#carrito").hide();
});