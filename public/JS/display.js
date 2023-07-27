var swiper = new Swiper(".blog-slider", {
    spaceBetween: 30,
    effect: "fade",
    loop: true,

    // autoHeight: true,
    pagination: {
        el: ".blog-slider__pagination",
        clickable: true,
    },
});
