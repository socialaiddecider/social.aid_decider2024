import jQuery from 'jquery'; // Import jQuery
import Alpine from 'alpinejs' // Import Alpine
import * as ripple from './animate/ripple' // Import animate ripple
import * as counter from './animate/counter' // Import animate counter
import ApexCharts from 'apexcharts' // Import ApexCharts


// inject jQuery to window
window.$ = jQuery;
// inject Alpine to window
window.Alpine = Alpine

// inject ApexCharts to window
window.ApexCharts = ApexCharts

// Import animate js
window.utils = {};
window.utils.Animate = {};
window.utils.Animate.ripple = ripple;
window.utils.Animate.counter = counter;

// Alpine Start
Alpine.start()

// import image
import.meta.glob(['../assets/**/*', '../assets/images/**/*']);
