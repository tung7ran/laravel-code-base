$(document).ready(function() {
    let closHTML = '<button class="btn btn__clos"></button>';
    let menuClass = $(".menu");
    let addonMenu = $(".addon-menu");

    function openMenu() {
        let menuList = $(".menu__list");
        for (let index = 6; index <= menuList.length; index++) {
            menuList.eq(index).addClass("menu__list--right");
        }

        $(".btn__menu").on("click", function() {
            addonMenu.toggleClass("active");
            $("body").toggleClass("open__body");
            menuClass.prepend(closHTML);
            closMenu();
        });
    }

    function closMenu() {
        function removeMenu() {
            addonMenu.removeClass("active");
            $(".btn").removeClass("btn__clos");
            $("body").removeClass("open__body");
        }
        $(".addon-menu__container").on("click", function(e) {
            if (!menuClass.is(e.target) && menuClass.has(e.target).length === 0) {
                removeMenu();
            }
        });
        $(".btn__clos").on("click", function() {
            removeMenu();
        });
    }

    function dowMenu() {
        $(".btn__toggle").on("click", function() {
            let _ = $(this).parent("li").children("ul");
            let _sub = $(this).parents(".menu__list").children("ul ");
            let _togleSub = $(this).parents(".menu__list").children(".btn__toggle");
            $(".menu .menu__list ul").not(_).not(_sub).slideUp();

            $(".btn__toggle").not(this).not(_togleSub).removeClass("active");
            _.slideToggle();
            $(this).toggleClass("active");
        });
    }

    function menu() {
        var has = $('.menu li:has("ul")');
        var hasSub = $('.menu li ul li:has("ul")');
        if (has) {
            has.addClass("menu__list--sub");
            has.append('<button class="btn btn__toggle"></button>');
        }
        if (hasSub) {
            hasSub.addClass("menu__list--sub");
            hasSub.append('<button class="btn btn__toggle"></button>');
        }
        $('.menu .menu__list ul li:has("ul")').addClass("menu__list--sub");
        dowMenu();
        openMenu();
    }
    menu();

    $(window).on("scroll", function() {
        var height = $("#header").height();

        if ($(this).scrollTop() > height) {
            $(".header__scroll").addClass("scroll");
        } else {
            $(".header__scroll").removeClass("scroll");
        }
    });;

    function addonTab() {
        $(".control-list__item").click(function() {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
            $($(this).attr("tab-show")).slideDown();
            $($(this).attr("tab-show")).siblings().slideUp();
            $(this).parent(".control-list").removeClass("active");
            $(".product-slide").slick("setPosition");
        });
    }
    addonTab();;

    function quit() {

        $('.btn__minus').on('click', function() {
            let inputValue = parseInt($('#viewInput').val());
            if (inputValue > 1) {
                $('#viewInput').val(inputValue - 1)
            }
        })
        $('.btn__plus').on('click', function() {
            let inputValue = parseInt($('#viewInput').val());
            $('#viewInput').val(inputValue + 1)
        })
    }
    quit();

    function slideSingle() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            arrows: false,
            focusOnSelect: true
        });
        $('.modal').on('shown.bs.modal', function(e) {
            $('.slider-for').slick('setPosition');
            $('.slider-nav').slick('setPosition');
            $('.wrap-modal-slider').addClass('open');
            quit();
        })
    }
    slideSingle();

    function productSlide() {
        $(".product-slide").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1199.98,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 991.98,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 479.98,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    }
    productSlide();

    $(document).on('click', '.modal-content .content-qty button', function () {
        var hscc = $(this).hasClass('qty-minus');

        if (hscc) {
            var val = $(this).next().attr('value');

            if (val > 1) {
                val--;
            }

            $(this).next().attr('value', val);
        } else {

            var val = $(this).prev().attr('value');
            val++;

            $(this).prev().attr('value', val);
        }
    });

    $(document).on('click', '.get_add_cart', function (e) {
        var url = $(this).data('url');
        var id_product = $(this).parents('form').find('input[name="id_product"]').val();
        var price = $(this).parents('form').find('input[name="price"]').val();
        var qty = $(this).parents('form').find('input[name="qty"]').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id_product: id_product,
                price: price,
                qty: qty
            },
            success: function (data) {
                if (data.status == 1) {
                    window.location.href = data.url;
                }

                if(data.status == 0){
                    toastr["error"](data.message, "Thông báo");
                }
            }
        });
    });

})
