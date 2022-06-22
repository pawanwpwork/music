$(document).ready(function () {
    $('.countdownTimer').each(function () {
        "use strict";
        var $this = $(this);
        var countdownTimerYear = $(".countdownTimerYear").html();
        var countdownTimerMonth = $(".countdownTimerMonth").html();
        var countdownTimerDay = $(".countdownTimerDay").html();

        $this.countdown("" + countdownTimerYear + "/" + countdownTimerMonth + "/" + countdownTimerDay + "",
            function (
                event) {
                $this.text(
                    event.strftime('%D days %H hours %M minutes %S seconds')
                );
            });
    });


});

// onscroll add or remove class
$(window).scroll(function () {
    "use strict";
    var scroll = $(window).scrollTop();
    var headerFixitBody = parseInt($(".header").css("height")) + parseInt($(".header").css("margin-bottom"));

    if (scroll >= 200) {
        $(".header").addClass("headerfixit");
        $("body").css("margin-top", headerFixitBody);
    } else {
        $(".header").removeClass("headerfixit");
        $("body").css("margin-top", "0px");
    }
});


//album slider owl carousel initialize + settings
$('.albumslider').owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    dots: false,
    animateIn: 'fadeIn',
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        567: {
            items: 2
        },
        767: {
            items: 3
        },
        991: {
            items: 4
        }
    }
});

//album slider owl carousel initialize + settings
$('.relatedslider').owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    dots: false,
    animateIn: 'fadeIn',
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        567: {
            items: 2
        },
        767: {
            items: 3
        },
        991: {
            items: 4
        }
    }
});

//addclass formfield
$(".formfield input, .formfield textarea, .formfield select").addClass("form-control");

//carousel
$('#carousel1').carousel({
    interval: 2000
});
$('.carousel-item').append('<div class="carou--bg"></div>');

//navigation toggle
$(document).ready(function () {
    $('.navicon-button').click(function () {
        "use strict";
        var $this = $(this);
        $('.navicon-button,.navigation').toggleClass('open');
        $('.has-submenu').removeClass('open');
        $('html').toggleClass('overflowYStop');
    });
});
//upgrade toggle
$(document).ready(function () {
    $('#profileUpgradeButton').click(function () {
        "use strict";
        var $this = $(this);
        $this.toggleClass('toggled');
        $('.profile-upgrade-list').toggleClass('toggled');
    });
});
$(document).mouseup(function (e) {
    var container = $('.profile-upgrade');

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('#profileUpgradeButton,.profile-upgrade-list').removeClass('toggled');
    }
});
//navigation toggle submenu
$(document).ready(function () {
    $('.has-submenu').click(function () {
        "use strict";
        var $this = $(this);
        $('.has-submenu').not(this).removeClass('open');
        $this.toggleClass('open');
    });
});

$(document).ready(function () {
    var url = window.location;
    $('.checklink a[href="' + url + '"]').parent().addClass('active');
    $('.checklink a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');
    $('.has-submenu>ul>li.active').parents('.has-submenu').addClass('active');
});

//copy img to background
$(document).ready(function () {
    "use strict";
    var $classforbg = $('#carousel1 img,.imgtobg--img');
    $classforbg.addClass('imgtobg');
    $('.imgtobg').each(function () {
        "use strict";
        var $this = $(this);
        var thissrc = $(this).attr('src');
        $this.wrap('<div class="imgtobg-o" style="background-image:url(' + thissrc + ')"></div>');
        $this.hide();
    });
});

$(document).ready(function () {
    $('p').each(function () {
        "use strict";
        var maxLength = parseInt($(this).attr('data-maxlength'));
        var txt = $(this).text();
        if (txt.length > maxLength)
            $(this).text(txt.substring(0, maxLength) + '.....');
    });
});
//setting overlay outer height


$(document).ready(overlayHeight);
$(window).resize(overlayHeight);

function overlayHeight() {
    $('.square').each(function () {
        "use strict";
        var $this = $(this);
        var widthValue = $this.width();
        $this.css('height', widthValue);
    });
}

function select_genre(obj) {
    var value = $(obj).val();
    if (value == 7) {
        $('#music_genre_other1').show();
        $('#music_genre_other1 input').val('');
        $('#music_genre_other1 input').attr('placeholder', 'Other');
    } else {
        $('#music_genre_other1 input').val(value);
        $('#music_genre_other1').hide();
    }
}

$('#frmEventOther').change(function () {
    if ($(this).is(':checked')) {
        $('#event_category_other').show();
    } else {
        $('#event_category_other').hide();
    }
});

// chekout page select2 js
$(document).ready(function () {
    $('#country_id').select2();
});

$(document).ready(function ($) {
    $('a[data-rel^=lightcase]').lightcase();
});