// --------------------------------------------------------------------------
//
//   matchHeight
//     Allows elements aligned horizontally to have the same height
//
// --------------------------------------------------------------------------

$(window).load( () => {

  // --------------------------------------------------------------------------
  //   Matchheight options
  // --------------------------------------------------------------------------

  var options = {
    byRow: true,
    property: 'height',
    target: null,
    remove: false
  }

  // --------------------------------------------------------------------------
  //   Timeout to allow for animations to complete
  // --------------------------------------------------------------------------

  setTimeout( () => {
    // $('.example').matchHeight(options);
  }, 100);

  $(document).trigger('redraw');

});


// --------------------------------------------------------------------------
//   Trigger an update on redraw
// --------------------------------------------------------------------------

$(document).on('redraw', triggerMatchHeight);

var triggerMatchHeight = () => {
  $.fn.matchHeight._update();
}
