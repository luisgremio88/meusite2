(function ($) {
 "use strict";
 
$('.menu>li').slice(-2).addClass('last-elements'); 
 
 
  $(window).on('scroll',function() {    
   var scroll = $(window).scrollTop();
   if (scroll < 245) {
    $(".header-sticky").removeClass("sticky");
   }else{
    $(".header-sticky").addClass("sticky");
   }
  }); 

 
$('.main-menu nav').meanmenu({
	meanScreenWidth: "991",
	meanMenuContainer: '.mobile-menu'
}); 
 
$('.grid').imagesLoaded( function() {
	
// filter items on button click
$('.portfolio-menu').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});	

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  percentPosition: true,
  masonry: {
    // use outer width of grid-sizer for columnWidth
    columnWidth: '.grid-item',
  }
});



});

$('.portfolio-menu button').on('click', function(event) {
	$(this).siblings('.active').removeClass('active');
	$(this).addClass('active');
	event.preventDefault();
});


/* slider active  */ 
$('.slider-active').owlCarousel({
    loop:true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    items:1,
    dots:false,
    nav:true,
    navText:['prev','next'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

/* brand-logo-active */ 
$('.brand-logo-active').owlCarousel({
    loop:true,
    items:5,
    dots:false,
    nav:false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:4
        },
        1000:{
            items:5
        }
    }
})

/* portfolio active  */ 
$('.portfolio-slider').owlCarousel({
    loop:true,
    items:1,
    dots:false,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',	
    nav:true,
    navText:['prev','next'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
/* testimonial active  */ 
$('.testimonial-active').owlCarousel({
    loop:true,
    items:1,
    dots:false,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

/*--
Magnific Popup
------------------------*/
$('.img-poppu').magnificPopup({
    type: 'image',
    gallery:{
        enabled:true
    }
});

/*--
menu-toggle
------------------------*/
$('.menu-toggle').on('click', function(){
	if( $('.menu-toggle').hasClass('is-active') ){
		$('.main-menu nav').removeClass('menu-open');
	}else {
		$('.main-menu nav').addClass('menu-open');
	}
});

    
/*--
	Hamburger js
-----------------------------------*/
var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};

var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
  forEach(hamburgers, function(hamburger) {
	hamburger.addEventListener("click", function() {
	  this.classList.toggle("is-active");
	}, false);
  });
}


/*--------------------------
    scrollUp
    ---------------------------- */	
    $(window).on('scroll',function () {
        if($(window).scrollTop()>200) {
            $("#toTop").fadeIn();
        } else {
            $("#toTop").fadeOut();
        }
    });
    $('#toTop').on('click', function() {
        $("html,body").animate({
            scrollTop:0
        }, 500)
    }); 


    /*---------------------
       Circular Bars - Knob
    --------------------- */	
	  if(typeof($.fn.knob) != 'undefined') {
		$('.knob').each(function () {
		  var $this = $(this),
			  knobVal = $this.attr('data-rel');
	
		  $this.knob({
			'draw' : function () { 
			  $(this.i).val(this.cv + '%')
			}
		  });
		  
		  $this.appear(function() {
			$({
			  value: 0
			}).animate({
			  value: knobVal
			}, {
			  duration : 2000,
			  easing   : 'swing',
			  step     : function () {
				$this.val(Math.ceil(this.value)).trigger('change');
			  }
			});
		  }, {accX: 0, accY: -150});
		});
    }
    
    
    /*--------------------------
    counterUp
    ---------------------------- */	
     $('.count').counterUp({
        delay: 10,
        time: 5000
    }); 
    
    
    /*----------------------------
    youtube video
    ------------------------------ */
    $('.youtube-bg').YTPlayer({
        containment: '.youtube-bg',
        autoPlay: true,
        loop: true,
    });
    
    
    /*----------------------------
    cadastro de nova busca
    ------------------------------ */

    $('#falsim').on('click', function(event){
      $('#faldiv').show();
    });
    $('#falnao').on('click', function(event){
      $('#faldiv').hide();
    });
    //qdo entra na página já deixa oculto
    $('#faldiv').show();

    // busca solicitante por CPF
    $('#search-form #cpf').on('blur', function(event){
      event.preventDefault();
      
      var cpf = $(this).val();
      var jsonData = '{"cpf" : "'+cpf+'"}'; 
      $.ajax({
        type: "POST",
        url: "https://www.colnotrs.app.br/ws/v1/busca-testamento-1.php",
        contentType : 'application/json',
        dataType : 'json',
        data : jsonData, 
        success: function (data) {
          if (data.ok == true) {
            let json = data.msg;
            $("#idc").val(json.ClienteId);
            $("#nom").val(json.Nome);
            $("#ema").val(json.Email);
            $("#tel").val(json.Telefone);
            $("#cep").val(json.Cep);
            $("#cid").val(json.Municipio);
            $("#bai").val(json.Bairro);
            $("#end").val(json.Endereco);
            //$("#nro").val(json.Complemento);
            $("#est").val(json.Estado);
          } 
          else {
            $('.form-messege').html(data.msg);
            $("#idc").val(0);
          }
        },
        error: function () {
          console.log('Opps');
        }
      });
    });

    // busca endereco por CEP
    $('#search-form #cep').on('blur', function(event){
      event.preventDefault();
      
      var cep = $(this).val();
      $.ajax({
        type: "GET",
        url: "https://viacep.com.br/ws/"+cep+"/json/",
        success: function (data) {
          if (data) {
            let json = data;
            $("#cid").val(json.localidade);
            $("#bai").val(json.bairro);
            $("#end").val(json.logradouro);
            //$("#nro").val(json.complemento);
            $("#est").val(json.uf);
          } 
          else {
            $('.form-messege').html(data.msg);
          }
        },
        error: function () {
          console.log('Opps');
        }
      });
    });
 
})(jQuery);  

/*
jQuery(function(){
  // jQuery('.date').mask('99/99/9999');     
  // jQuery('.hour').mask('00:00', {placeholder: "__:__", clearIfNotMatch: true});
  // jQuery('.peso').mask('#0.00', {reverse: true});        
  jQuery('#cep').mask('99999-999');
  // jQuery('.money').mask('000.000.000.000.000,00', {reverse: true});
  // jQuery('.numero').mask('00000000');
  // jQuery('.percent').mask('00%', {reverse: true});
  jQuery('#cpf').mask('000.000.000-00', {placeholder: "___.___.___-__", clearIfNotMatch: true});
  // jQuery('.cnpj').mask('00.000.000/0000-00', {placeholder: "__.___.___/____-__", clearIfNotMatch: true});


  var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };
  $('#tel').mask(SPMaskBehavior, spOptions);


  var maskCpfCnpj = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '000.000.000-009' : '00.000.000/0000-00';
  },
  options = {onKeyPress: function(val, e, field, options) {
          field.mask(maskCpfCnpj.apply({}, arguments), options);
      }
  };
  $('.cpf_cnpj').mask(maskCpfCnpj, options);
});
*/