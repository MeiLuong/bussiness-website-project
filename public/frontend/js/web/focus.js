/*  ---------------------------------------------------
    Template Name: FocusPoint
    Author: Mei
---------------------------------------------------------  */

'use strict';

(function ($) {

    $(document).ready(function(e) {

        // button scroll top action

        var scrollTopBtn =  $('#scroll_top');

        $(window).scroll(function (event) {

            var heightScroll = $(window).scrollTop();
            var header = $('#header');
            var addClass = 'site-header position-fixed';

            if (heightScroll > 100) {
                $(scrollTopBtn).addClass('active');
                $(header).addClass(addClass);
            }
            else {
                $(scrollTopBtn).removeClass('active');
                $(header).removeClass(addClass);
            }
        });


        $(scrollTopBtn).click(function () {
            $("html, body").animate({scrollTop: 0}, 1000);
        });

    });

})(jQuery);
