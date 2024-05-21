import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

const SwiperLanding = (function() {

  let swiperInstance;
  
  const selectors = {
    body: 'body',
    swiper: '.js-swiper-landing'
  };

  const swiperOptions = {
    modules: [Navigation],
    direction: 'horizontal',
    slidesPerView: "1",
    centeredSlides: true,
    spaceBetween: "16",
    breakpoints: {
      1024: {
        slidesPerView: "2",
      },
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  };

  const initialize = function() {
    swiperInstance = new Swiper(
      selectors.swiper, 
      swiperOptions
    );
  };

  return {
    init: initialize,
  };
})();

// Initialize
document.addEventListener('DOMContentLoaded', function() {
  const swiperWrapper = document.querySelector('.js-swiper-landing');
  if (swiperWrapper) {
    SwiperLanding.init();
  }
});
