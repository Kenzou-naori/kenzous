var slides = document.querySelectorAll('.slide');
var btnes = document.querySelectorAll('.btne');
let currentSlide = 1;


var manualNav = function(manual){
  slides.forEach((slide) => {
    slide.classList.remove('active');

    btnes.forEach((btne) => {
      btne.classList.remove('active');
    })
  })
  slides[manual].classList.add('active');
  btnes[manual].classList.add('active');
}

btnes.forEach((btne, i) => {
  btne.addEventListener("click", () => {
    manualNav(i);
    currentSlide = i;
  });
});

var repeat = function(activeClass){
  let active = document.getElementsByClassName('active');
  let i = 1;

  var repeater = () => {
    setTimeout(function(){
      [...active].forEach((activeSlide) => {
        activeSlide.classList.remove('active');
      })

      slides[i].classList.add('active');
      btnes[i].classList.add('active');
      i++;

      if(slides.length == i){
        i = 0;
      }
      if(i >= slides.length){
        return;
      }
      repeater();
    }, 8000);
  }
  repeater();
}
repeat();