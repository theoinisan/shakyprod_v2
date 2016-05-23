function centrerElement(el,cont){
	$(window).resize(function(){
		for(var i = 0; i < $(el).length; i++){
			var w = $(el[i]).width();
			var h = $(el[i]).height();
			var W = $(cont[i]).width();
			var H = $(cont[i]).height();
			$(el[i]).css('top',(H - h) / 2).css('left',(W - w) / 2);
		}
	})
}

function redimensionnement(el,cont){ 
	var $image = $(el);
    var image_width = $image.width(); 
    var image_height = $image.height();     
     
    var over = image_width / image_height; 
    var under = image_height / image_width; 
     
    var body_width = $(cont).width(); 
    var body_height = $(cont).height(); 
     
    if (body_width / body_height >= over) { 
      $image.css({ 
        'width': body_width + 'px', 
        'height': Math.ceil(under * body_width) + 'px', 
        'left': '0px', 
        'top': Math.abs((under * body_width) - body_height) / -2 + 'px' 
      }); 
    }  
     
    else { 
      $image.css({ 
        'width': Math.ceil(over * body_height) + 'px', 
        'height': body_height + 'px', 
        'top': '0px', 
        'left': Math.abs((over * body_height) - body_width) / -2 + 'px' 
      }); 
    } 
} 

function rumble(el){
    $(el).jrumble({
        x: 0.5,
        y: 0.5,
        rotation: 1
    });
    $(el).hover(function(){
        $(this).trigger('startRumble');
    }, function(){
        $(this).trigger('stopRumble');
    });
}

function soulignement(el){
    $(el).before('<span class=\"souligne\"></span>');
    for(var i = 0; i < $(el).length; i ++) {
        $(el[i]).mouseenter(function() {
            var W = $(this).width();
            $(this).prev().stop().animate({width:W,opacity:1},300,'easeInOutExpo');
          })
          .mouseleave(function() {
            $(this).prev().stop().animate({width:0,opacity:0.5},150,'easeInOutExpo');
        });
    }
}

function animBlocAccueil(){
	centrerElement($('.grid .bloc span'),$('.grid .bloc'));
	$('.grid .bloc .content h2').css('marginTop','-100px');
	$('.grid .bloc .content p').css('marginBottom','-100px');
	$('.grid .bloc').mouseenter(function(){
		$(this).find('h2').stop().animate({marginTop:'30px'},500,'easeInOutExpo');
		$(this).find('p').stop().animate({marginBottom:'30px'},500,'easeInOutExpo');
		$(this).find('.content').stop().animate({backgroundColor:'rgba(21,21,21,0.7)'},500,'easeInOutExpo');
		$(this).find('span').stop().animate({opacity:0},500,'easeInOutExpo');
	}).mouseleave(function(){
		$(this).find('h2').stop().animate({marginTop:'-100px'},400,'easeInOutExpo');
		$(this).find('p').stop().animate({marginBottom:'-100px'},400,'easeInOutExpo');
		$(this).find('.content').stop().animate({backgroundColor:'rgba(21,21,21,0.2)'},400,'easeInOutExpo');
		$(this).find('span').stop().animate({opacity:1},400,'easeInOutExpo');
	});
}

function creationMenuMobile(){
	$('#main-menu').before('<div id=\"menu-mobile\"><span class=\"menu-txt\">Menu</span><span class=\"top\"></span><span class=\"middle\"></span><span class=\"bottom\"></span></div>');
	$('#menu-mobile').click(function(){
		if(!$('#menu-mobile').hasClass('active')){
			$('#main').animate({marginLeft:'-280px',marginRight:'280px'},1000,'easeInOutExpo');
			$('#main-menu').animate({right:-5},1000,'easeInOutExpo');
			$(this).find('.top').rotate({angle:0,animateTo:45,easing:$.easing.easeInOutExpo,duration:500});
			$(this).find('.bottom').rotate({angle:0,animateTo:-45,easing:$.easing.easeInOutExpo,duration:500});
			$(this).find('.top').animate({width:'30px',top:'10px'},1000,'easeInOutExpo');
			$(this).find('.bottom').animate({width:'30px',top:'10px'},1000,'easeInOutExpo');
			$(this).find('.middle').animate({left:'-200px',opacity:0},1000,'easeInOutExpo');
			$(this).find('.menu-txt').animate({left:'-200px',opacity:0},1000,'easeInOutExpo');
			$('#menu-mobile').addClass('active');
		} else {
			$('#main').animate({marginLeft:0,marginRight:0},1000,'easeInOutExpo');
			$('#main-menu').animate({right:'-280px'},1000,'easeInOutExpo');
			$(this).find('.top').rotate({angle:45,animateTo:0,easing:$.easing.easeInOutExpo,duration:500});
			$(this).find('.bottom').rotate({angle:-45,animateTo:0,easing:$.easing.easeInOutExpo,duration:500});
			$(this).find('.top').animate({width:'27px',top:'0px'},1000,'easeInOutExpo');
			$(this).find('.bottom').animate({width:'27px',top:'20px'},1000,'easeInOutExpo');
			$(this).find('.middle').animate({left:0,opacity:1},1000,'easeInOutExpo');
			$(this).find('.menu-txt').animate({left:'-42px',opacity:1},1000,'easeInOutExpo');
			$('#menu-mobile').removeClass('active');
		}
	})
}

function realisationAnimIntro(){
	var real = $('.anim-real');
	var delay = 250;
	var delay2 = 600;
	for (var i = 0; i < $(real).length; i++){
		$(real[i]).delay(delay).animate({opacity:1,marginTop:0},800,'easeInOutExpo');
		$(real[i]).find('h2').delay(delay2).animate({opacity:1,marginTop:'130px'},800,'easeInOutExpo');
		delay += 200;
		delay2 += 400;
	}
}

function realisationAnimOver(){
	$('.anim-real').css('opacity',0).css('marginTop','200px');
	$('.anim-real h2').css('opacity',0).css('marginTop','200px');
	$('.realisation p').css('opacity',0).css('marginTop','50px');

	$('.realisation').mouseenter(function(){
		$(this).find('.cache-bl').stop().animate({height:'300px'}, 500, 'easeInOutExpo');
		$(this).find('h2').stop().animate({marginTop:'50px'}, 500, 'easeInOutExpo');
		$(this).find('p').stop().animate({opacity:1,marginTop:'140px'}, 500, 'easeInOutExpo');
	})
	.mouseleave(function(){
		$(this).find('.cache-bl').stop().animate({height:0}, 400, 'easeInOutExpo');
		$(this).find('h2').stop().animate({marginTop:'130px'}, 400, 'easeInOutExpo');
		$(this).find('p').stop().animate({opacity:0,marginTop:'50px'}, 400, 'easeInOutExpo');
	});
}

function suggestionRealOver(){
	$('.real-sug').mouseenter(function(){
		$(this).find('.cache-bl').stop().animate({backgroundColor:'rgba(21,21,21,0.2)'}, 400, 'easeInOutExpo');
		$(this).find('h3').stop().animate({backgroundColor:'rgba(21,21,21,0.7)'}, 400, 'easeInOutExpo');
	})
	.mouseleave(function(){
		$(this).find('.cache-bl').stop().animate({backgroundColor:'rgba(21,21,21,0.6)'}, 300, 'easeInOutExpo');
		$(this).find('h3').stop().animate({backgroundColor:'rgba(21,21,21,0)'}, 300, 'easeInOutExpo');
	});
}

function intro(){
	$('#intro .top').css('height',$(window).height() / 2);
	$('#intro .bottom').css('height',$(window).height() / 2);
}

function introAnim(){
	var H = $('header').height();
	$('#intro .top').delay(1000).animate({height:H},1000,'easeInOutExpo');
	$('#intro .bottom').delay(1000).animate({height:H},1000,'easeInOutExpo');
	$('#intro').delay(3000).fadeOut(150,'easeInOutCubic');
	$('#home-content').delay(3000).animate({opacity:1},250,'easeInOutExpo');
	$('#home-content .swiper-container').delay(3300).animate({opacity:1,marginTop:0},500,'easeInOutExpo');
	var bloc = $('#home-content .grid .bloc');
	var delay = 3500;
	for (var i = 0; i < $(bloc).length; i++){
		$(bloc[i]).delay(delay).animate({opacity:1,marginTop:0},500,'easeInOutExpo');
		delay += 250;
	}
	$('#home-content h1').delay(delay).animate({opacity:1,marginLeft:0},1500,'easeInOutExpo');
}

function posPageReal(){
	$('.embed-container').css('marginLeft','300px').css('opacity',0);
	$('.single-real .left').css('marginTop','500px').css('opacity',0);
	$('.single-real .others-real').css('marginTop','500px').css('opacity',0);
}

function introPageReal(elW){
	$('.anim-title').animate({width:elW + 30,opacity:1},1500,'easeInOutExpo');
	$('.embed-container').animate({opacity:1,marginLeft:0},1000,'easeInOutExpo');
	$('.single-real .left').delay(800).animate({opacity:1,marginTop:0},1000,'easeInOutExpo');
	$('.single-real .others-real').delay(800).animate({opacity:1,marginTop:0},1000,'easeInOutExpo');
}

function animContact(){
	$('#button-contact').click(function(){
		if(!$(this).hasClass('active')){
			$('.container-footer-mobile').show(500);
			$(this).html('X');
			$(this).addClass('active');
		} else {
			$('.container-footer-mobile').hide(500);
			$(this).html('Contact');
			$(this).removeClass('active');
		}
	})
}

function anim404(){
	$('.page-404 img').animate({marginLeft:0,opacity:1},2000,'easeInOutQuint');
	$('.page-404 .content').animate({marginLeft:0,opacity:1},2000,'easeInOutQuint');
}

function galerieMobile(){
	$('span.photo').click(function(){
		if(!$(this).hasClass('active')){
			$(this).html('- Photos');
			$('.galerie').show(500);
			$(this).addClass('active');
		} else {
			$(this).html('+ Photos');
			$('.galerie').hide(500);
			$(this).removeClass('active');
		}
	})
}

$(function(){
	var elRumble = $('.rumble');
	rumble(elRumble);
	var mainMenuA = $('#main-menu a');
	soulignement(mainMenuA);
	animBlocAccueil();
	realisationAnimOver();
	$('#home-content').css('opacity',0);
	$('#home-content .swiper-container').css('opacity',0).css('marginTop','-300px');
	$('#home-content .grid .bloc').css('opacity',0).css('marginTop', '300px');
	$('#home-content h1').css('opacity',0).css('marginLeft', '300px');
	suggestionRealOver();
	creationMenuMobile();
	posPageReal();
	animContact();
	galerieMobile();
	$('form').addClass('pure-form pure-form-aligned');
	$('input').removeAttr( "size" );
	$('textarea').removeAttr('cols');
	$('.wpcf7-validates-as-required').attr('required','required');

	$(window).resize(function(){
		intro();
		redimensionnement($('.realisation img'), $('.realisation'));
		redimensionnement($('.grid .bloc img'),$('.grid .bloc'));
		centrerElement($('.real-sug h3'),$('.real-sug'));
	})

	var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        centeredSlides: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        speed: 500,
        autoplay: 3000,
        loop: true
    });
	centrerElement($('#intro img'),$(window));
	centrerElement($('.real-sug h3'),$('.real-sug'));
	centrerElement($('.page-404'),$(window));
	$('.page-404 img').css('marginLeft','-800px').css('opacity',0);
	$('.page-404 .content').css('marginLeft','800px').css('opacity',0);
    $(window).resize();
})

$(window).load(function(){
	var h1W = $('.single-real h1').width();
	var h1H = $('.single-real h1').height();
	$('.single-real h1').css('width',h1W);
	$('.single-real .anim-title').css('display','block').css('width',0).css('overflow','hidden').css('opacity',0);
	$('.loader').fadeOut(150,'easeInOutCubic');
	introAnim();
	realisationAnimIntro();
	introPageReal(h1W);
	anim404();
})