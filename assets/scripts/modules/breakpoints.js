// --------------------------------------------------------------------------
//
//   Breakpoints
//
// --------------------------------------------------------------------------

var $ = require('jquery'),
    mediaCheck = require('mediaCheck'),
    config = require('../base/config')


// --------------------------------------------------------------------------
//   Add functions to breakpoints with breakPointArray.push()
// --------------------------------------------------------------------------

$(window).on('load', function() {

  mediaCheck({

    media: '(max-width: ' + config.mobileBreakPoint + ')',

    entry: function() {
      config.mobile = true;

      config.executeOnMobile.forEach(function(callback) {
        callback();
      });
    },

    exit: function() {
      config.mobile = false;

      config.executeOnDesktop.forEach(function(callback) {
        callback();
      });
    },

    both: function() {

      config.executeOnResize.forEach(function(callback) {
        callback();
      });
    }

  });
});
