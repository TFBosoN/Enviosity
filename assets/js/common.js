$(".top-table-icons").on("click", function(e){
    if(!$(e.target).parents('.show').length){
        if(!$(this).children('.dd-content').hasClass('show')){
            $('.dd-content').removeClass('show');
            $('li').removeClass('selected');
        }
        $(this).children('.dd-content').toggleClass('show');
        $(this).toggleClass('selected');
    }
	e.stopPropagation();
});

$(document).click(function(e) {
	if(!$(e.target).parents('.show').length){
		$('.dd-content').removeClass("show");
		$('.top-table-icons').removeClass('selected');
	}
});

$("#search").on("focus", function(){
    $(".search").addClass('selected');
});
$("#search").on("focusout", function(){
    $(".search").removeClass('selected');
});

//Menu
$(document).ready(function() {
    var d = window.location.href.split('/')[3];
    if(d.length<2 || d[0]=='?'){
        d = '';
    }
    $((".tcg_"+d)).addClass("active");
});

$(".menu-nav dd").mouseover(function(){
    $(".menu-nav dd").removeClass("active");
    $(".dd-tab").removeClass("active");
    var m = $(this).attr('class');
    $("."+m).addClass("active");
});