(function($) {
    'use strict';

    // Strecth header background
    if ( _warrior.bg_header !== '' )
      $('#main-header').backstretch( _warrior.bg_header, {centeredY: false} );

    $(".post-slider ul.slides").owlCarousel({
      singleItem: true,
      pagination: true
    });


    $(".site-navigation .menu-item-has-children").hover(function() {
      $(this).find(".child-menu, .sub-menu").stop().slideToggle();
    })

    $('.comments-form-widget input, .comments-form-widget textarea').floatingPlaceholder({
      placeholderActiveColor: "#000",
      placeholderIdleColor : "#aaa"
    });

    $(".search-trigger").click(function(j) {
      $(this).parent().find(".input-wrapper").toggleClass("active")
      j.stopPropagation();
    })

    $(".thumbnail, .video-holder").fitVids();

    // justifiedGallery
    $(window).load(function() {
      var hentryWidth = $('.inner .entry-content').outerWidth();
      $('article.hentry .gallery').justifiedGallery({
          rowHeight: 150,
          maxRowHeight: 0,
          margins: 5,
          lastRow : 'justify'
      });
      $('.justified-gallery').css('width', hentryWidth);
      $('.justified-gallery a[href$=".jpg"], .justified-gallery a[href$=".jpeg"], .justified-gallery a[href$=".png"], .justified-gallery a[href$=".gif"]').addClass('thickbox');

     // Hide default pagination if Jetpack infinite scroll is use
      if( $('#infinite-handle').length < 1 ) {
          $('.pagination').css('display', 'block');
      }

      $(".preload").fadeOut("slow");
    });

    $( window ).resize(function() {
        // Justified Gallery
        var hentryWidth = $('.inner .entry-content').outerWidth();
        $('article.hentry .gallery').justifiedGallery({
            rowHeight: 150,
            maxRowHeight: 0,
            margins: 5,
            lastRow : 'justify'
        });
        $('.justified-gallery').css('width', hentryWidth);
        $('.justified-gallery a').addClass('thickbox');

       // Hide default pagination if Jetpack infinite scroll is use
        if( $('#infinite-handle').length < 1 ) {
            $('.pagination').css('display', 'block');
        }
    });

    // Bold title widgets last word
    $('h4.widget-title span').each(function(index, element) {
        var heading = $(element);
        var word_array, last_word, first_part;

        word_array = heading.html().split(/\s+/); // split on spaces
        last_word = word_array.pop();             // pop the last word
        first_part = word_array.join(' ');        // rejoin the first words together

        heading.html([first_part, ' <strong>', last_word, '</strong>'].join(''));
    });

    // Mobile menu
    //$('ul.main-menu').mobileMenu();
    var combinedMenu = $('#main-nav ul.root').clone();
    var searchform = $('.searchform').clone();
    //var secondMenu = $('#main-menu-right ul.main-menu').clone();

    //secondMenu.children('li').appendTo(combinedMenu);
    combinedMenu.slicknav({
        duplicate:false,
        prependTo : '.mobile-menu',
        label: 'MENU',
        allowParentLinks: true
    });

    $('.mobile-menu').prepend(searchform);

})(jQuery);