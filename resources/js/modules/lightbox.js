import { Fancybox } from '@fancyapps/ui';
import '@fancyapps/ui/dist/fancybox/fancybox.css';

// Icons mirror resources/views/components/icons (chevron-*-large, cross-large)
// so the lightbox uses the exact same shapes as the rest of the site.
const prevIcon = '<svg width="24" height="45" viewBox="0 0 24 45" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.5 0L23.5607 1.06067L2.12134 22.5L23.5607 43.9393L22.5 45L0 22.5L22.5 0Z" fill="currentColor"/></svg>';
const nextIcon = '<svg width="24" height="45" viewBox="0 0 24 45" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.06067 0L0 1.06067L21.4393 22.5L0 43.9393L1.06067 45L23.5607 22.5L1.06067 0Z" fill="currentColor"/></svg>';
const crossIcon = '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25 1.06067L23.9393 0L12.5 11.4393L1.06067 0L0 1.06067L11.4393 12.5L0 23.9393L1.06067 25L12.5 13.5607L23.9393 25L25 23.9393L13.5607 12.5L25 1.06067Z" fill="currentColor"/></svg>';

Fancybox.bind('[data-fancybox]', {
  // Scope for CSS overrides (backdrop colour, black icons) — see fancybox.css
  mainClass: 'fancybox-fiefelstein',

  // Disable the built-in close button: in v6 it is injected into *each slide's*
  // wrapper (one cross per slide). We use a single Toolbar close item instead.
  closeButton: false,

  // No zoom: plain fade to a static image (no thumbnail-to-image zoom animation).
  zoomEffect: false,

  Carousel: {
    // Single, persistent close button (site cross) — the Toolbar renders once in
    // the container, not per slide. Only the close item, top-right column.
    Toolbar: {
      absolute: true,
      enabled: true,
      display: { left: [], middle: [], right: ['close'] },
      items: {
        close: {
          tpl: `<button class="f-button is-close-button" data-fancybox-close title="Schliessen">${crossIcon}</button>`,
          click: () => Fancybox.getInstance()?.close(),
        },
      },
    },
    Thumbs: false,
    // Keep Zoomable enabled (it renders the image!) but lock out all zooming:
    // never scale past fit and ignore click/dblclick/wheel zoom actions.
    Zoomable: {
      Panzoom: {
        maxScale: 1,
        clickAction: false,
        dblClickAction: false,
        wheelAction: false,
      },
    },
    Arrows: {
      prevTpl: prevIcon,
      nextTpl: nextIcon,
    },
  },
});
