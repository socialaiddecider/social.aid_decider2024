import jQuery from 'jquery'; // Import jQuery
import Alpine from 'alpinejs' // Import Alpine
import * as ripple from './animate/ripple' // Import animate ripple
import * as counter from './animate/counter' // Import animate counter


// inject jQuery to window
window.$ = jQuery;
// inject Alpine to window
window.Alpine = Alpine

// Import animate js
window.utils = {};
window.utils.Animate = {};
window.utils.Animate.ripple = ripple;
window.utils.Animate.counter = counter;

// Alpine Start
Alpine.start()
