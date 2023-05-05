/*  ---------------------------------------------------
    Template Name: FocusPoint
    Author: Mei
---------------------------------------------------------  */

'use strict';

(function ($) {

    $(document).ready(function(e) {

        $(document).on('click', '.updateCartItem', function () {

            var new_qty=0;
            if($(this).hasClass('plus-value')) {
                var quantity = $(this).data('qty');

                new_qty = parseInt(quantity) + 1;

                alert(new_qty);
            }

            if($(this).hasClass('minus-value')) {
                var quantity = $(this).data('qty');

                if(quantity <= 1) {
                    alert('Quantity must be 1 or greater');
                    return false;
                }
                new_qty = parseInt(quantity) - 1;

                // alert(new_qty);
            }
            alert(new_qty);
            var cartid = $(this).data('cartid');
            $.ajax({
               data:{
                   cartid:new_qty,
                   quantity:new_qty
               },
                url: '/update_cart',
                type: 'post',
                success: function (resp) {
                   alert(resp);
                },
                error: function (resp) {
                   alert('Error.')
                }
            });
        });

    });

})(jQuery);
