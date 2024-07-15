import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

const SwiperLanding = (function() {

  let swiper;
  
  const selectors = {
    body: 'body',
    swiper: {
      container: '.js-swiper-landing',
      btns: {
        prev: '.js-swiper-prev',
        next: '.js-swiper-next',
      },
    },
  };

  const swiperOptions = {
    modules: [Navigation],
    direction: 'horizontal',
    slidesPerView: "1",
    centeredSlides: true,
    spaceBetween: "16",
    breakpoints: {
      1024: {
        slidesPerView: "1.5",
      },
    },
    navigation: {
      nextEl: '.js-swiper-next',
      prevEl: '.js-swiper-prev',
    },
  };

  const initialize = function() {
    swiper = new Swiper(
      selectors.swiper.container, 
      swiperOptions
    );

    const prevBtn = document.querySelector(selectors.swiper.btns.prev);
    const nextBtn = document.querySelector(selectors.swiper.btns.next);

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        swiper.slidePrev();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        swiper.slideNext();
      });
    }
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
