var btnLogout = document.getElementById("btn-logout");
if(btnLogout) {
    document.getElementById("btn-logout").addEventListener("click", () => {
        document.getElementById("form-logout").submit();
    });
}
window.addEventListener("load",()=>{
    document.getElementById("subscription")?.addEventListener("submit",()=> {
        event.preventDefault();
        event.stopPropagation();
        let email = $("#email-subscription").val();
        $("#btn-subscription").prop("disabled",true);
        $.ajax({
            url: `${Enviroments.baseHttp}/email?email=${email}`,
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            success: function (result) {
                alert(result);
                $("#btn-subscription").prop("disabled",false);
                $("#subscription").trigger("reset");
            },
            error: function (error) {
                alert(error.responseJSON);
                $("#btn-subscription").prop("disabled",false);
            }
        });
    });
})
jQuery(document).ready(function($){
    // jQuery sticky Menu

	$(".mainmenu-area").sticky({topSpacing:0});

    $('.related-products-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            },
            1200:{
                items:3,
            }
        }
    });  
    
    $('.brand-list').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });    
    
    
    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function(){
        $(".navbar-collapse").removeClass('in');
    });    
    
    // jQuery Scroll effect
    $('.navbar-nav li a, .scroll-to-up').bind('click', function(event) {
        var $anchor = $(this);
        var headerH = $('.header-area').outerHeight();
        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
    });

});
function reloadProductCarousel() {
    $('.product-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });
}
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-10146041-21', 'auto');
ga('send', 'pageview');



