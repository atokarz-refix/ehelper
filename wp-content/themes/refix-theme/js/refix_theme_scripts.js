jQuery(document).ready(function ($) {



    $('.bv_mobile_header #menu-opener').click(function () {
        $(this).toggleClass('opener');
        $('.bv_mobile-menu').toggleClass('opener');
    });//click

    
    $('input.variation_id').change(function () {
        if ('' != $(this).val()) {
            var var_id = $(this).val();
            $(document).trigger('rfx_variation_changed', [var_id]);
        }//if
    });



    function rfx_wc_tabs_accordion() {
        var tab = $(this).attr('id');
        var kontener = $(this).closest('.tab-kontener');
        var kontent = $(this).closest('.tab-kontener').find('.tab-kontent');

        // if(kontener.hasClass('aktiv')) return false;

        // kontener.find('.tab-kontent').slideDown(function(){
        //     $('.tab-kontener.aktiv .tab-kontent').slideUp();
        //     $('.tab-kontener.aktiv').removeClass('aktiv');
        //     kontener.addClass('aktiv');
        // });

        if (kontener.hasClass('aktiv')) {
            kontent.slideUp();
            kontener.removeClass('aktiv');
        } else {
            kontener.addClass('aktiv');
            kontent.slideDown();
        }


    }//rfx_wc_tabs_accordion()



    $('.tab-kontener .tab-tytul').click(rfx_wc_tabs_accordion);


    function rfx_wc_quantity_plus() {
        $('.quantity .input-text').val(function (i, oldval) {
            console.log('plus')
            return ++oldval;
        });
    }//rfx_wc_quantity_plus

    function rfx_wc_quantity_minus() {
        $('.quantity .input-text').val(function (i, oldval) {
            return --oldval;
        });
    }//rfx_wc_quantity_minus

    $('.button__quantity__plus').click(rfx_wc_quantity_plus);
    $('.button__quantity__minus').click(rfx_wc_quantity_minus);





    // $(document.body).on('found_variation',function(){
    // alert('event')
    // });


    function rfx_product_gallery_in_row() {

        var czek_gallery_exist = setInterval(function () {
            var li_count = $('.flex-control-nav.flex-control-thumbs li').length;
            if (li_count != 0) {
                clearInterval(czek_gallery_exist);
                rfx_single_product_gallery(li_count);
            }//if
        }, 10);


        function rfx_single_product_gallery(li_count) {
            if (li_count < 6) return false;

            var li_width = 150;
            var ul_width = li_width * li_count;
            var ul_height = $('.flex-control-nav.flex-control-thumbs').height();
            var half_height = Math.ceil(ul_height / 2) + 25;

            $('.flex-control-nav.flex-control-thumbs').wrapAll('<div class="rfx_gallery_wrapper rfx_no_scroll_bar"></div>');
            $('.flex-control-nav.flex-control-thumbs').css('width', ul_width + 'px');

            // $('.rfx_gallery_wrapper').prepend('<span class="rfx_sp_gallery_prev" scroll="'+li_width+'">&#10092;</span>');
            // $('.rfx_gallery_wrapper').append('<span class="rfx_sp_gallery_next" style="bottom:'+half_height+'px;" scroll="'+li_width+'">&#10093;</span>');
            $('<span class="rfx_sp_gallery_prev"  scroll="' + li_width + '"><img src="/wp-content/uploads/2022/10/product-gallery-prev.svg"></span>').insertAfter('.rfx_gallery_wrapper');
            $('<span class="rfx_sp_gallery_next"  scroll="' + li_width + '"><img src="/wp-content/uploads/2022/10/product-gallery-next.svg"></span>').insertAfter('.rfx_gallery_wrapper');

        }//rfx_single_product_gallery()



        $('.single-product').on('click', '.rfx_sp_gallery_prev', function () {
            var ile = parseInt($(this).attr('scroll'));
            var miejsce = $('.rfx_gallery_wrapper');
            var kierunek = 'left';
            rfx_scroll(ile, miejsce, kierunek);
        });



        $('.single-product').on('click', '.rfx_sp_gallery_next', function () {
            var ile = parseInt($(this).attr('scroll'));
            var miejsce = $('.rfx_gallery_wrapper');
            var kierunek = 'right';
            rfx_scroll(ile, miejsce, kierunek);
        });


        function rfx_scroll(ile, miejsce, kierunek) {

            var aktual = miejsce.scrollLeft();
            if (kierunek == 'left') {
                var new_scroll = aktual - parseInt(ile);
            } else {
                var new_scroll = aktual + parseInt(ile);
            }//if


            miejsce.animate({ scrollLeft: new_scroll }, 400);

        }//rfx_scroll()

    }//rfx_product_gallery_in_row()

    rfx_product_gallery_in_row();


});//koniec jQuery