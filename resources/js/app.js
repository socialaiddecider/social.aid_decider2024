import jQuery from 'jquery'; // Import jQuery
import Alpine from 'alpinejs' // Import Alpine
import * as animate from './animate/ripple' // Import animate


// inject jQuery to window
window.$ = jQuery;
// inject Alpine to window
window.Alpine = Alpine

// Import animate js
window.utils = {};
window.utils.Animate = animate;

// Alpine Start
Alpine.start()
