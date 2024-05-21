import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

let swiper = new Swiper('.js-swiper-product', {
  modules: [Navigation],
  direction: 'horizontal',
  slidesPerView: "1",
  centeredSlides: true,
  spaceBetween: "16",
  //autoHeight: true,
  breakpoints: {
    1024: {
      slidesPerView: "2",
    },
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

// On resize the swiper should be destroyed and re-initialized. The goal is to recalculate the number of slides per view based on the window height. 
// Since the slides have an aspect ratio of 1:1, the number of slides per view can be calculated based on the window height.
// The height of each slide equals to window height.
// window.addEventListener('resize', () => {
//   // get window height
//   let windowHeight = window.innerHeight;
//   let windowWidth = window.innerWidth;

//   // Destroy swiper
//   // swiper.destroy();

//   // Calculate number of slides per view. The height of each slide equals to window height.
//   let availableSpace = windowWidth - windowHeight;

//   // Get ratio of available space to window height
//   let ratio = (availableSpace*2) / windowHeight;

//   console.log(ratio);

//   // reinitialize swiper
//   // swiper = new Swiper('.swiper', {
//   //   modules: [Navigation, Autoplay],
//   //   direction: 'horizontal',
//   //   slidesPerView: slidesPerView,
//   //   centeredSlides: true,
//   //   spaceBetween: "16",
//   //   autoHeight: true,

//   //   navigation: {
//   //     nextEl: '.swiper-button-next',
//   //     prevEl: '.swiper-button-prev',
//   //   },

//   // });


// });