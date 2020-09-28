$(document).ready(function(){
   //console.log('init');
   
   //$('.col-xs-12.col-sm-4:first').addClass('slidedown');
   $(window).scroll(function(){
      //console.log($('.col-xs-12.col-sm-4:first').offset().top);
      //console.log($(window).scrollTop());
      if($(window).scrollTop()>184){
        $('.col-xs-12.col-sm-4:first').addClass('slidedown');
      } else {
        $('.col-xs-12.col-sm-4.slidedown').removeClass('slidedown');
      }
   });

   $('.cart-button, #button-cart').on('click',function(){
      var quantity_n = 0;
      
      //console.log('clicked');
      // setTimeout(function(){
      //   $.post( "/cart", function( data ) {
      //      //console.log(data);
      //      var quantity = $(data).find("input[name^='quantity']");
      //      var total = $(data).find('.text-right:last').text().replace(/[^0-9]/gi, '');
      //      $(quantity).each(function(){
      //         //console.log('here',$(this).val());
      //         quantity_n += parseInt($(this).val());
      //      });
      //      //console.log('quant is ',quantity);
      //      //console.log('quant_n is ',quantity_n);
      //      //console.log('total is ',total);
      //      $('#cart-total').empty().append(quantity_n+' товаров на сумму '+total+'р.');
      //   });
      // }, 100);
      
      var cart = $('.fa.fa-chevron-circle-down');
      var imgtodrag = $(this).parent(".caption").prev().find('img');
      //console.log(imgtodrag);
        if (imgtodrag.length>0) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '1.0',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000 );

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        } else {

          var imgtodrag = $(this).parents().find('.thumbnail.bigimg img');
          console.log(imgtodrag);
          var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '1.0',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000 );

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });

        }

   });
   
});