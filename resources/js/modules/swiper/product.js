import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const Product = (function() {

  const selectors = {
    variation: {
      btn: '[data-variation-btn]',
      wrapper: '[data-variation-wrapper]',
    },
    swiper: {
      container: '.js-swiper-product',
      btns: {
        prev: '.js-swiper-prev',
        next: '.js-swiper-next',
      },
    },
  };

  let swiper = null;

  const init = () => {
    initSwiper();

    // Add event listener for variation.btn click
    document.querySelectorAll(selectors.variation.btn).forEach(btn => {
      btn.addEventListener('click', function(e) {
        // get event target parent a dataset.variationBtn
        const uuid = e.target.closest(selectors.variation.btn).dataset.variationBtn;
        toggleVariation(uuid);

      });
    });

  };

  const initSwiper = () => {
    
    swiper = new Swiper(selectors.swiper.container, {
      modules: [Navigation],
      direction: 'horizontal',
      slidesPerView: "1",
      centeredSlides: true,
      spaceBetween: "16",
      breakpoints: {
        768: {
          slidesPerView: "1.2",
        },
        1024: {
          slidesPerView: "2",
        },
      },
      navigation: {
        nextEl: selectors.swiper.btns.next,
        prevEl: selectors.swiper.btns.prev,
      },
    }); 
    
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

  const toggleVariation = (uuid) => {

    // hide all variation wrappers
    document.querySelectorAll(selectors.variation.wrapper).forEach(wrapper => {
      wrapper.classList.add('hidden');
    });

    // show variation wrapper
    document.querySelector(`[data-variation-wrapper="${uuid}"]`).classList.remove('hidden');

    // find the slide with data-product-uuid
    const slide = document.querySelector(`[data-product-uuid="${uuid}"]`);
   
    // get all slides
    const slides = document.querySelectorAll('.swiper-slide');

    // get the index of the slide in the slides
    const index = Array.from(slides).indexOf(slide);

    // slide to the index
    swiper.slideTo(index);

    console.log(slides);


  };

  return {
    init: init,
  };

})();

Product.init();

