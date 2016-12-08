// --------------------------------------------------------------------------
//   Wait for final event
// --------------------------------------------------------------------------

// Usage:

// $(window).resize( () => {
//   waitForFinalEvent( () => {
//     alert('Resize...');
//     //...
//   }, 500, "some unique string");
// });

var waitForFinalEvent = ( () => {
  var timers = {};
  return (callback, ms, uniqueId) => {
    if (!uniqueId) {
      uniqueId = "Don't call this twice without a uniqueId";
    }
    if (timers[uniqueId]) {
      clearTimeout (timers[uniqueId]);
    }
    timers[uniqueId] = setTimeout(callback, ms);
  };
})();
