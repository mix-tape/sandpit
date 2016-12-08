// --------------------------------------------------------------------------
//
//   Breakpoints
//
// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
//   Add functions to breakpoints with breakPointArray.push()
// --------------------------------------------------------------------------

$(window).load( () => {

  mediaCheck({

    media: '(max-width: ' + mobileBreakPoint + ')',

    entry: () => {
      mobile = true;

      executeOnMobile.forEach( (callback) => {
        callback();
      });
    },

    exit: () => {
      mobile = false;

      executeOnDesktop.forEach( (callback) => {
        callback();
      });
    },

    both: () => {

      executeOnResize.forEach( (callback) => {
        callback();
      });
    }

  });
});
