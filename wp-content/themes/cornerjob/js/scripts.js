(function ($, root, undefined) {
	
	$(function () {
		'use strict';
		
		// mobile menu
		$(".button-collapse").sideNav({
			edge: 'right'
		});
		$('#close-menu').click(function(){
			$(".button-collapse").sideNav('hide');
		})

		// waves
		$('#main-nav a').addClass('waves-effect waves-light');

		// tooltips
		$('.tooltipped').tooltip({delay: 50});

		// header search form
		var topSearch = $('#top-search');
		$('#show-search').click(function(){
			topSearch.fadeIn(600).find('.search-input').focus();
			return false;
		})
		$('.close-form', topSearch).click(function(){
			topSearch.fadeOut(300);
		})

		// home featured posts
		$('#featured-posts').slick({
			dots: true,
			infinite: false,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 3,
			prevArrow: '<button type="button" class="slick-prev ficon-angle-left-circle"></button>',
			nextArrow: '<button type="button" class="slick-next ficon-angle-right-circle"></button>',
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [{
				breakpoint: 991,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 680,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});

		// sticky footer
		var footer = $('.page-footer');
		$(window).scroll(function(){
			if( $(window).scrollTop() > 100 && ! footer.hasClass('fixed-bottom') ) footer.addClass('fixed-bottom');
			else if( $(window).scrollTop() < 101) footer.removeClass('fixed-bottom');
		})
		
	});
	
})(jQuery, this);
