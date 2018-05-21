$('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
});

setInterval(function() {
    $('.carousel').carousel('next');
}, 5000);

$('.sidenav').sidenav();