// Show button "Top" at the scrolling of documents
var topBox = $('<div class="webPage-go-top"></div>').css({
    position  : 'fixed',
    bottom    : '20px',
    right     : '20px',
    'z-index' : '555',
    'cursor'  : 'pointer',
    'display' : 'none'
}).addClass('btn icon icon-arrow-up2');
if(!device.type) {
    $('body').append(topBox);
    $(window).scroll(function(e) {
        $(window).scrollTop() <= 300 ? $('.webPage-go-top').hide('slow') : $('.webPage-go-top').show('slow');
    });
}
$(document).on('click', '.webPage-go-top', function(e) {
    $("html, body").animate({scrollTop : 0}, 1000);
});