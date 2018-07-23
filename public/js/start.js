/*
 * jQuery Form Tips 1.2.6
 * By Manuel Boy (http://www.manuelboy.de)
 * Copyright (c) 2012 Manuel Boy
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
 */

 (function (a) {
	a.fn.formtips = function (b) {
		var c = a.extend({tippedClass:"tipped"}, b);
		return this.each(function () {
			var b = a(this);
			var d = a(b).attr("type");
			if (d != "file" && d != "checkbox" && d != "radio") {
				a(b).bind("focus", function () {
					var b = a(this).attr("title");
					if (a(this).val() == b) {
						a(this).val("").removeClass(c.tippedClass)
					}
					return true
				});
				a(b).bind("blur", function () {
					var b = a(this).attr("title");
					if (a(this).val() == "") {
						a(this).val(b).addClass(c.tippedClass)
					}
					return true
				});
				var e = a(b).attr("title");
				if (a(b).val() == "" || a(b).val() == a(this).attr("title")) {
					a(b).val(e).addClass(c.tippedClass)
				} else {
					a(b).removeClass(c.tippedClass)
				}
				a(b).parentsUntil("form").parent().submit(function () {
					var d = a(b).attr("title");
					if (a(b).val() == d) {
						a(b).val("").removeClass(c.tippedClass)
					}
				})
			}
		})
	}

 })(jQuery);

 jQuery.extend(verge);
 var desktop = true,
 tablet = false,
 mobile = false;

 jQuery(function ($) {

	function equalHeight(group, groupSize) {
		if (!group.length) {
			return;
		}
		groupSize = +(groupSize || 0);
		if (groupSize < 1) {
			groupSize = group.length;
		}
		var start = -groupSize, part;
		while ((part = group.slice(start += groupSize, start + groupSize)) && part.length) {
			part.height(Math.max.apply(null, $.makeArray(part.map(function () {
				return $(this).height();
			}))));
		}
	}

	$(window).resize(function () {
		if ($.viewportW() >= 1024) {
			desktop = true;
			tablet = false;
			mobile = false;
		}
		if ($.viewportW() >= 768 && $.viewportW() <= 1023) {
			desktop = false;
			tablet = true;
			mobile = false;
		} else {
			if ($.viewportW() <= 767) {
				desktop = false;
				tablet = false;
				mobile = true;
			}
		}
	}).resize();

	$('input[title]').formtips();

	$(".popup-btn").fancybox({
		padding: 0,
		maxHeight: 700,
		maxWidth: 1000
	});

	$(".slider").each(function(){
		var $this = $(this);

		if($this.hasClass("slider_one")){
			$this.owlCarousel({
				autoplay: true,
				responsive:{
					0:{
						items:1,
						nav:false,
						dots: false
					},
					767:{
						items:3,
						nav:false,
						dots: false
					},
					1024:{
						items:5,
						nav:false,
						loop:true,
						dots: false
					}
				}
			});
		}else {
			$this.owlCarousel({
				items: 1,
				autoplay: true
			});
		}
	});

	

	

	$('.gallery').isotope({
		masonry: {
			columnWidth: 1
		}
	});

	$(".scroll-link").on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		$('html, body').stop().animate({'scrollTop' : $($this.attr('href')).offset().top},1000);
	});

	$(".tabs__controls__item").on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			$index = $this.index();

		$(".tabs__controls__item").removeClass('active');
		$(".tabs__main__item").removeClass('active');

		$(".tabs__main__item").eq($index).addClass('active');
		$this.addClass('active');
	});

	$(window).on("scroll", function(){
		var $window = $(window),
		$header = $(".header"),
		$section = $(".section");

		setTimeout(function(){
			if(desktop && $window.scrollTop() > $header.height()){
				$("body").addClass("fixed");
			}else {
				$("body").removeClass("fixed");
			}
		}, 50);
		
		$section.each(function(){
			var $this = $(this);

			if(($window.scrollTop() > ($this.offset().top - $window.height()/3)) && $('.nav ul li a[href="#'+$this.attr('id')+'"]').length > 0){
				$('.nav ul li').removeClass('active')
				$('.nav ul li a[href="#'+$this.attr('id')+'"]').closest("li").addClass('active');
			}
		});

	});
 });






