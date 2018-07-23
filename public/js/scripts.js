var App = {
    Conf: {
        isTouch: !!('ontouchstart' in window)
    },
    toggleMainNav: function(){

	    var trigger = $('#trigger_mobile_nav');

        $('body').on(this.Conf.isTouch ? 'touchend' : 'click', function(e){

            var el = $(e.target);

            if(el.is(trigger)){
	            $('#wrap').toggleClass('mobile_nav_visible');
            } else if($('#wrap').hasClass('mobile_nav_visible')) {
	            $('#wrap').removeClass('mobile_nav_visible');	            
            }
        });
    },
    validateForm: function(){
        $('form.validate_form').on('submit', function(e){
            var form = $(this);
            var formValid = true;
            
            form.removeClass('err');
            
            form.find('input.required').each(function(){
                if ($(this).attr('type') == 'email'){
                    function isValidEmailAddress(emailAddress) {
                        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                        return pattern.test(emailAddress);
                    };
                    if (!isValidEmailAddress($(this).val())){
                        formValid = false
                        if (!$(this).hasClass('error')){
                            $(this).addClass('error').closest('label').append('<span class="field_error">Invalid email address</span>');
                        }
                    }else if ($(this).hasClass('error')){
                        $(this).removeClass('error').siblings('.field_error').remove();
                    }
                }else{
                    if ($(this).val() == ''){
                        formValid = false
                        var error_message = $(this).data('errormsg');
                        if (!$(this).hasClass('error')){
                            $(this).addClass('error').closest('label').append('<span class="field_error">'+error_message+'</span>');
                        }
                    }else if ($(this).hasClass('error')){
                        $(this).removeClass('error').siblings('.field_error').remove();
                    }
                }
            });

            if (formValid != true){
                e.preventDefault();
				form.addClass('err');                
				
	            form.find('input.required').each(function(){
		            $(this).attr('name', "");
				});	            
				
            }else{
	            
	            form.find('input.required').each(function(){
		            $(this).attr('name', $(this).data('mchimp'));
				});
	            
                return true;
            }
        });

        $('html').on('click','.mobile .field_error', function(){
            $(this).siblings('input').removeClass('error').focus().end().remove();
        });
    },
    tabs: function(){
        $('body').on('click', '.tabs_paging li:not(.active)', function(e) {
            var currTab = $(this).data('tabid');
            var tabSet = $(this).parents('ul').data('tabcontainer');
            $('.tabs_content[data-tabcontainer='+tabSet+'] .tab').hide();
            $('.tabs_content[data-tabcontainer='+tabSet+'] .tab[data-tabid="'+currTab+'"]').css('visibility','visible').fadeIn();
            $('.tabs_paging[data-tabcontainer='+tabSet+'] li.active').removeClass('active');
            $(this).addClass('active');
        });
    },
    carousels: {
        footerFeatured: function(){
            $("#footer_featured ul").owlCarousel({
                items : 4,
                itemsDesktop : [1100,4],
                itemsDesktopSmall : [768,3],
                itemsTablet: [600,2],
                itemsMobile : false
            });
        },
        homeAccent: function(action){
            $("#home_accent .owl-carousel").owlCarousel({
                singleItem:true,
                pagination: false,
                autoPlay: true,
                autoHeight: true
            });
        },
        homeTrusted: function(action){
            $("#home_trusted .owl-carousel").owlCarousel({
                items : 5,
                itemsDesktop : [1100,5],
                itemsDesktopSmall : [768,3],
                itemsTablet: [600,2],
                itemsMobile : false
            });
        },
        homeTabs: function(action){
            if (action == 'destroy'){
                $(".home_tabs_list").each(function(){
                    if($(this).data('owlCarousel') != undefined){
                        $(this).data('owlCarousel').destroy();
                    }
                });
            }else {
                $(".home_tabs_list").each(function(){
                    $(this).owlCarousel({
                        singleItem:true
                    });
                });
            }
        },
        isotopeSlides: function(action){
            if (action == 'destroy'){
                $(".story_item .inner").each(function(){
                    if($(this).data('owlCarousel') != undefined){
                        $(this).data('owlCarousel').destroy();
                    }
                });
            }else {
                if (action != 'arrange'){
                    $(".story_item .inner").each(function(){
                        $(this).owlCarousel({
                            singleItem:true
                        });
                    });

                    $(".isotope").isotope( 'on', 'layoutComplete',
                        function( isoInstance, laidOutItems ) {
                            $(".story_item .inner .info").each(function(){
                                $(this).css({'display':'block', 'height':$(this).parents('.inner').height()});
                            })
                            $(".story_item:visible .inner").css({'height':$(".story_item:visible:first .inner img").height()});
                        }
                    );
                }
                
                setTimeout(function(){
                    $('.isotope').isotope('layout');
                },1000);
            }
        }
    },
    isotope: {
	    init: function(){
	        var $container = $('.isotope').isotope({
	            itemSelector: '.story_item'
	        });
	
	        this.elm = $('#filters'),
	        	filters = {};
	
	        this.elm.on( 'click', 'li', function() {
	            var $this = $(this);
	            $container.isotope({ filter: $this.attr('data-filter') });
	
	            $this.siblings('li').removeClass('active');
	            $this.addClass('active');
	            $this.parents('.filter_container').siblings('.filter_container').find('li.active').removeClass('active').parents('ul').children('li:first-child').addClass('active');
	
	            if ($(window).width() < 768){
	                App.isotope.elm.css('height', 0);
	            }
	            App.carousels.isotopeSlides('arrange');
	        });
	
	        $('body').on('click','.filter_mobile_trigger', function(){
		        
		        var isActive = App.isotope.elm.hasClass('active'),
		        	contentHeight = App.isotope.elm[0].scrollHeight;
	
	            App.isotope.elm.css('height', isActive ? 0 : contentHeight).toggleClass('active');
	        });
	    }
    },
    imagePopup: function(){
        $('.fancybox').fancybox({margin:[15, 40, 15, 40]})
        $('.fancybox-media').fancybox({
            openEffect  : 'none',
            closeEffect : 'none',
            helpers : {
                media : {}
            }
        });
    },
    TabBars: {
	    init: function(){
		    
		    var bars = $('body').find('.tabbar');
		    
		    if(bars.length == 0)
		    	return;
		    	
		    this.bars = bars;
		    	
		    this.bars.each(function(){

			    var bar = $(this),
			    	prevArrow = $('<a href="#" class="arrow prev-arrow"><i class="icon-arrow-left8"></i></a>'),
			    	nextArrow = $('<a href="#" class="arrow next-arrow"><i class="icon-arrow-right8"></i></a>');
			    
				prevArrow.click(function(e){
					e.preventDefault();

					var currentIndex = bar.data('currentIndex');

					App.TabBars.slide(bar, (currentIndex + 1));

				})
				.appendTo(bar)
				.css('display', 'none'); // Hidden on init

				nextArrow.click(function(e){
					e.preventDefault();

					var currentIndex = bar.data('currentIndex');

					App.TabBars.slide(bar, (currentIndex - 1));
				})
				.appendTo(bar);
				
				bar.data('currentIndex', 0);
		    });
		    
		    this.slideToActive();
	    },
	    slide: function(tabbar, toIndex){

		    var list = tabbar.find('ul');
		    
		    if(list.length == 0)
		    	return;
		    	
		    var currentIndex = tabbar.data('currentIndex'),
		    	tabs = tabbar.find('li'),
		    	step = tabs.filter(':first-child').outerWidth(),
		    	tabsInView = Math.round(list.width() / step);
		    
		    if(Math.abs(toIndex) > (tabs.length - tabsInView)) {
			    toIndex = -(tabs.length - tabsInView);
		    }
		    
	    	var newPosition = toIndex * step;
			    	    		    	
		    list.css('left', newPosition);
		    
		    var prevArrow = tabbar.find('.prev-arrow'),
		    	nextArrow = tabbar.find('.next-arrow');
		    
			if(tabs.length == tabsInView) {
			    prevArrow.css('display', 'none');
			    nextArrow.css('display', 'none');  
		    } else if(toIndex == 0) {
			    prevArrow.css('display', 'none');
			    nextArrow.css('display', 'block');			    
		    } else if(Math.abs(toIndex) == (tabs.length - tabsInView)) {
			    nextArrow.css('display', 'none');			    
			    prevArrow.css('display', 'block');			    
		    } else {
			    prevArrow.css('display', 'block');
			    nextArrow.css('display', 'block');  
		    }
		    
			tabbar.data('currentIndex', toIndex);
	    },
	    slideToActive: function(){

		    this.bars.each(function(){

			    var tabbar = $(this),
			    	tabs = tabbar.find('li'),
			    	activeTabIndex = parseInt(tabs.filter('.active').index());
			    	
			    if(activeTabIndex > 0)
				    App.TabBars.slide(tabbar, (activeTabIndex * -1));
		    });
			
		    
	    },
	    resize: function(){
		    
		    if(!this.bars || this.bars.length == 0)
		    	return;

			this.slideToActive();		    	
	    }
    },
    Testimonials: {
		init: function(){
			
			var elm = $('body').find('#testimonials');
			
			if(elm.length == 0)
				return;

			this.elm = elm;
			
			var slider = this.elm.find('.testimonials-slider');
			
			this.overlay.init(slider);
			this.slider.init(slider);			
		},
		slider: {
			init: function(slider){
				
				var ul = slider.find('ul'),
					elms = ul.find('li');
				
				if(elms.length > 1) {

					var pages = $('<div class="pages"></div>');
					
					elms.each(function(){
						var elm = $(this),
							index = elm.index(),
							page = $('<a href="#"></a>');
							
						page
						.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
							e.preventDefault();
							
							App.Testimonials.slider.slide(slider, index);
						})
						.appendTo(pages);
						
						(index == 0)&&(page.addClass('active'));
					});
					
					pages.appendTo(slider);
					
					var prevArrow = $('<a href="#" class="arrow prev">Previous</a>');
					
					prevArrow
					.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
						e.preventDefault();
						
						var i = pages.find('a.active').prev().index();
						
						App.Testimonials.slider.slide(slider, i);
					})
					.appendTo(slider)
					.css('visibility', 'hidden');

					var nextArrow = $('<a href="#" class="arrow next">Next</a>');
					
					nextArrow
					.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
						e.preventDefault();
						
						var i = pages.find('a.active').next().index();
						
						App.Testimonials.slider.slide(slider, i);
					})
					.appendTo(slider);
					
					
					slider.on('swipeleft', function(e) {
						var i = pages.find('a.active').next().index();
						
						App.Testimonials.slider.slide(slider, i);

					}).on('swiperight', function(e) {

						var i = pages.find('a.active').prev().index();
						
						App.Testimonials.slider.slide(slider, i);

					}).on('movestart', function(e) {
						if ((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) {
							e.preventDefault();
						}
					});					
					
				}
			},
			slide: function(slider, to){
				
				var step = slider.outerWidth(),
					ul = slider.find('ul'),
					pages = slider.find('.pages'),
					arrows = slider.find('.arrow'),
					max = (ul.find('li').length - 1);

				pages.find('a.active').removeClass('active');
				pages.find('a:eq(' + to + ')').addClass('active');
				
				ul.css('left', -(step * to));
				
				if(to == 0) {
					arrows.filter('.prev').css('visibility', 'hidden');
					arrows.filter('.next').css('visibility', '');
				} else if(to == max) {
					arrows.filter('.prev').css('visibility', '');
					arrows.filter('.next').css('visibility', 'hidden');
				} else {
					arrows.filter('.prev').css('visibility', '');
					arrows.filter('.next').css('visibility', '');
				}
			},
			resize: function(){
				$('body')
				.find('.testimonials-slider').each(function(){
					App.Testimonials.slider.slide($(this), 0);
				});
			}
		},
		overlay: {
			init: function(slider){
				
				var cloning = slider.clone();				
				
				this.elm = $('<div id="overlay"></div>');
				this.elm.appendTo($('body'));
				
				var content = $('<div class="content"></div>');
				content.appendTo(this.elm);
				
				var bg = $('<div class="bg"></div>');
				
				bg
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					
					App.Testimonials.overlay.toggle();					
				})
				.appendTo(this.elm);
				
				var head = $('<div class="head">Testimonials</div>');
				head.appendTo(content)
				
				cloning.appendTo(content);				
				App.Testimonials.slider.init(cloning);
				
				slider.find('a.more')
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					
					var trigger = $(this),
						li = trigger.closest('li');
					
					App.Testimonials.overlay.toggle();
					App.Testimonials.slider.slide(cloning, li.index());
				});
				
				var close = $('<a href="#" class="close"></a>');
				
				close
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					
					App.Testimonials.overlay.toggle();					
				})
				.appendTo(content);
			},
			toggle: function(){
				
				var isVisible = $('body').hasClass('with-testimonials-overlay'),
					content = this.elm.find('.content');
				
				if(isVisible) {
					$('body').removeClass('will-toggle-overlay with-testimonials-overlay');
					content.css('height', '');					
				} else {
					
					$('body').addClass('will-toggle-overlay');					
					var h = Math.min(content.outerHeight(true), ($(window).height() * 0.85));
					content.css('height', h);
					$('body').addClass('with-testimonials-overlay');										
				}
			},
			resize: function(){
				$('body').removeClass('will-toggle-overlay with-testimonials-overlay');
				this.elm.find('.content').css('height', '');									
			}
		}
    },
	ResourcesSlider: {
		init: function(){

			var section = $('body').find('.running-ic');
			
			if(section.length == 0)
				return;

			this.section = section;
				
			var elm = this.section.find('.slider');
			
			if(elm.length == 0)
				return;

			this.elm = elm;

			this.grid = this.elm.find('.grid');
			this.entries = this.grid.children('li');			
			
			// fix bg
			this.entries.find('a').each(function(){
				
				var a = $(this),
					img = a.find('img');
					
				if(img && img.attr('src').length > 0) {
					a.css('background-image', 'url(' + img.attr('src') + ')');
				}
			});

			this.build();
		},	

		build: function(){
			
			if(!this.section || this.section.length == 0)
				return;			
			
			if(this.pages) { // from old build ...
				this.pages.remove();
				this.arrows.remove();
			}
			
			this.elm.removeClass('sliding at-the-end').data('activePage', 0);

			var isMobile = $(window).width() < 768,
				totalPages = Math.ceil(this.entries.length / 3);
				
			if(!isMobile)
				totalPages = Math.ceil(totalPages / 3);
				
			var height = this.entries.filter(':first').outerHeight(true),
				width = this.entries.filter(':first').outerWidth(true),
				totalEntries = this.entries.length,
				columnsPerPage = isMobile ? 1 : 3,
				rowsPerPage = 3,
				entriesPerPage = (columnsPerPage * rowsPerPage);

			this.grid.css({
				'left': '',
				'height': totalPages > 1 ? (height * rowsPerPage) : (Math.ceil(totalEntries / columnsPerPage) * height)
			});				

			this.entries.each(function(){
				
				var entry = $(this),
					index = entry.index(),
					page = Math.floor(index / entriesPerPage),
					row = (Math.floor(index / columnsPerPage) % rowsPerPage),
					column;
					
				if(isMobile) {
					column = page;
				} else {
					column = Math.floor((index%rowsPerPage) + (page * rowsPerPage));
				}
				entry.css({
					'top': (height * row),
					'left': (width * column),
					'zIndex': totalEntries - index
				});
			});

			if(totalPages > 1) {
				
				var pages = $('<div class="pages"></div>'),
					first = $('<a href="#" class="first"></a>'),
					prev = $('<a href="#" class="prev"></a>'),
					page = $('<span></span>'),
					next = $('<a href="#" class="next"></a>'),
					last = $('<a href="#" class="last"></a>'),
					prevArrow = $('<a href="#" class="arrow prev"></a>'),
					nextArrow = $('<a href="#" class="arrow next"></a>');
				
				first
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					App.ResourcesSlider.slide(0, totalPages);					
				})
				.appendTo(pages);
				
				prev
				.add(prevArrow)
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					
					var prevIndex = Math.max(0, parseInt(App.ResourcesSlider.elm.data('activePage') - 1));
					
					App.ResourcesSlider.slide(prevIndex, totalPages);
				})

				prev
				.appendTo(pages);

				prevArrow
				.appendTo(this.elm);				
				
				page
				.html(parseInt(this.elm.data('activePage') + 1) + ' / ' + totalPages)
				.appendTo(pages);
				
				next
				.add(nextArrow)				
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					
					var nextIndex = Math.min((totalPages - 1), parseInt(App.ResourcesSlider.elm.data('activePage') + 1));
				
					App.ResourcesSlider.slide(nextIndex, totalPages);
				})

				next
				.appendTo(pages);

				nextArrow
				.appendTo(this.elm);
				
				last
				.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
					e.preventDefault();
					App.ResourcesSlider.slide((totalPages - 1), totalPages);					
				})
				.appendTo(pages);
				
				pages.appendTo(this.elm);
				
				this.elm.on('swipeleft', function(e) {
					nextArrow.trigger(App.Conf.isTouch ? 'touchend' : 'click');
				}).on('swiperight', function(e) {
					prevArrow.trigger(App.Conf.isTouch ? 'touchend' : 'click');
				}).on('movestart', function(e) {
					if ((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) {
						e.preventDefault();
					}
				});					

				this.pages = pages;
				this.arrows = prevArrow.add(nextArrow);
				
				this.elm.addClass('at-the-beginning');
			}
		},
		slide: function(to, from){

			this.elm.addClass('sliding');
			
			this.grid.css('left', (to * -100) + '%');
			this.pages.find('span').html((to + 1) + ' / ' + from);
			
			this.elm.data('activePage', to);
			
			this.elm.removeClass('at-the-beginning at-the-end');				

			if(to == 0) {
				this.elm.addClass('at-the-beginning');
			} else if((to + 1) == from) {
				this.elm.addClass('at-the-end');				
			}
			
		}
	},
	QAList: {
		init: function(){
			var elms = $('body').find('ul.qa-list');
			
			if(elms.length == 0)
				return;
				
			this.elms = elms;
			
			this.elms.each(function(){
				
				var elm = $(this),
					rows = elm.children('li');

				rows.each(function(){
					
					var row = $(this),
						q = row.find('.q');
					q
					.on(App.Conf.isTouch ? 'touchend' : 'click', function(e){
						e.preventDefault();
						App.QAList.toggle(elm, row);						
					});
				});
			});
		},
		toggle: function(elm, row){
			
			var isActive = row.hasClass('active'),
				active = elm.find('li.active');
				
			active.removeClass('active').find('.a').css('height', '');
			
			if(isActive)
				return;
			
			var a = row.find('.a');
			
			row.addClass('active');
			a.css('height', a.prop('scrollHeight'));
		},
		resize: function(){

			if(!this.elms || this.elms.length == 0)
				return;
				
			this.elms.find('li.active').each(function(){
				var elm = $(this),
					a = elm.find('.a');
					
				elm.removeClass('active');
				a.css('height', '');
			});
		}
	},
    initAll: function(){
        this.toggleMainNav();
        this.validateForm();
        this.tabs();
        this.carousels.footerFeatured();
        this.carousels.homeTrusted();
        this.carousels.homeAccent();
        this.isotope.init();
        this.imagePopup();
        this.TabBars.init();
        this.Testimonials.init();
        this.ResourcesSlider.init();
        this.QAList.init();
    }
};

$(document).ready(function(){
    App.initAll();

    if ($(window).width() < 768){
        App.carousels.homeTabs();
        App.carousels.isotopeSlides();
    }
});


var resizeTimer;
$(window).resize(function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function(){
	    
	    App.TabBars.resize();
	    App.Testimonials.slider.resize();
	    App.Testimonials.overlay.resize();
	    App.ResourcesSlider.build();
	    App.QAList.resize();
	    
        if ($(window).width() < 768){
            App.carousels.homeTabs();
            App.carousels.isotopeSlides(); 
        }else{
            App.carousels.homeTabs('destroy');
            App.carousels.isotopeSlides('destroy');            
			App.isotope.elm.css('height', '').removeClass('active');
        }
    }, 20);
});
