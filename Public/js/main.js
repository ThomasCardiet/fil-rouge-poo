let burger_open = $(".fa-bars");
let burger_close = $(".fa-times");
let header_links = $(".header_links");

header_links.hide();
burger_close.hide();

burger_open.click(function(){
    burger_close.show();
    header_links.show();
    burger_open.hide();
})

burger_close.click(function(){
    burger_close.hide();
    header_links.hide();
    burger_open.show();
})