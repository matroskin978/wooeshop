(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})();

window.addEventListener('scroll', function () {
    document.getElementById('header-nav').classList.toggle('headernav-scroll', window.scrollY > 135);
});

jQuery(document).ready(function($) {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });

    $('#top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });

    $(".owl-carousel-full").owlCarousel({
        margin: 20,
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    // https://gist.github.com/bagerathan/2b57e7413bfdd09afa04c7be8c6a617f
    $('body').on('adding_to_cart', function (e, btn, data) {
        btn.closest('.product-card').find('.ajax-loader').fadeIn();
    });

    $('body').on('added_to_cart', function (e, response_fragments, response_cart_hash, btn) {
        btn.closest('.product-card').find('.ajax-loader').fadeOut();
    });

    $('main.main').on('click', '.quantity button', function () {
        let btn = $(this);
        let groupedProduct = btn.closest('.woocommerce-grouped-product-list-item__quantity').length;
        let inputQty = btn.parent().find('.qty');
        let prevValue = +(inputQty.val());
        let newValue = groupedProduct ? 0 : 1;
        if (btn.hasClass('btn-plus')) {
            newValue = prevValue + 1;
        } else {
            if (!groupedProduct && prevValue > 1) {
                newValue = prevValue - 1;
            } else if (groupedProduct && prevValue > 0) {
                newValue = prevValue - 1;
            }
        }
        inputQty.val(newValue);
        $('.update-cart').prop('disabled', false);
    });

    $('.wishlist-icon2').on('click', function () {
        let $this = $(this);

        if ($this.hasClass('lock')) {
            iziToast.warning({
                title: 'Warning',
                message: 'Дождитесь завершения операции',
            });
            return false;
        }

        $('.wishlist-icon').addClass('lock');
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card').find('.ajax-loader');
        $.ajax({
            url: wooeshop_wishlist_object.url,
            type: 'POST',
            data: {
                action: 'wooeshop_wishlist_action',
                nonce: wooeshop_wishlist_object.nonce,
                product_id: productId
            },
            beforeSend: function () {
                ajaxLoader.fadeIn();
            },
            success: function (res) {
                $('.wishlist-icon').removeClass('lock');
                res = JSON.parse(res);
                if (res.status === 'success') {
                    $this.toggleClass('in-wishlist');
                    iziToast.success({
                        title: res.status,
                        message: res.answer,
                    });
                } else {
                    iziToast.error({
                        title: res.status,
                        message: res.answer,
                    });
                }

                if ( location.pathname === '/wishlist/' ) {
                    iziToast.warning({
                        message: 'Страница будет перезагружена',
                        timeout: 2000,
                        onClosing: function(instance, toast, closedBy){
                            location = location.href;
                        }
                    });
                }

                ajaxLoader.fadeOut();
            },
            error: function () {
                $('.wishlist-icon').removeClass('lock');
                ajaxLoader.fadeOut();
                iziToast.error({
                    title: 'Error',
                    message: 'Error add to wishlist',
                });
            },
        });
    });

    $('.wishlist-icon3').on('click', function () {
        let $this = $(this);
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card').find('.ajax-loader');
        ajaxLoader.fadeIn();

        let wishlist = $.cookie('wishlist');
        $this.toggleClass('in-wishlist');
        if (wishlist === undefined) {
            wishlist = [productId];
            $.cookie('wishlist', JSON.stringify(wishlist), { expires: 30, path: '/' });
            iziToast.success({
                title: 'Success',
                message: wooeshop_wishlist_object.add,
            });
        } else {
            wishlist = JSON.parse(wishlist);
            if (wishlist.includes(productId)) {
                let index = wishlist.indexOf(productId);
                wishlist.splice(index, 1);

                iziToast.success({
                    title: 'Success',
                    message: wooeshop_wishlist_object.remove,
                });

                if ( location.pathname === '/wishlist/' ) {
                    iziToast.warning({
                        message: wooeshop_wishlist_object.reload,
                        timeout: 2000,
                        onClosing: function(instance, toast, closedBy){
                            location = location.href;
                        }
                    });
                }
            } else {
                if (wishlist.length >= 8) {
                    wishlist.shift();
                }
                wishlist.push(productId);
                iziToast.success({
                    title: 'Success',
                    message: wooeshop_wishlist_object.add,
                });
            }
            $.cookie('wishlist', JSON.stringify(wishlist), { expires: 30, path: '/' });

        }

        ajaxLoader.fadeOut();
    });

    $('.wishlist-icon').on('click', function () {
        let $this = $(this);
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card').find('.ajax-loader');

        if (!wooeshop_wishlist_object.is_auth) {
            iziToast.error({
                message: wooeshop_wishlist_object.need_auth,
            });
            return false;
        }

        $.ajax({
            url: wooeshop_wishlist_object.url,
            type: 'POST',
            data: {
                action: 'wooeshop_wishlist_action_db',
                nonce: wooeshop_wishlist_object.nonce,
                product_id: productId
            },
            beforeSend: function () {
                ajaxLoader.fadeIn();
            },
            success: function (res) {
                res = JSON.parse(res);
                if (res.status === 'success') {
                    $this.toggleClass('in-wishlist');
                    iziToast.success({
                        message: res.answer,
                    });
                } else {
                    iziToast.error({
                        message: res.answer,
                    });
                }

                if ( location.pathname === '/wishlist/' ) {
                    iziToast.warning({
                        message: 'Страница будет перезагружена',
                        timeout: 2000,
                        onClosing: function(instance, toast, closedBy){
                            location = location.href;
                        }
                    });
                }

                ajaxLoader.fadeOut();
            },
            error: function () {
                ajaxLoader.fadeOut();
                iziToast.error({
                    message: 'Error add to wishlist',
                });
            },
        });

    });

});

Fancybox.bind("[data-fancybox]", {
    // Your custom options
});
