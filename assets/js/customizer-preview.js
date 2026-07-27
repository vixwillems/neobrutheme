(function($) {
  var api = wp.customize;

  // Colors.
  var colors = ['bg', 'fg', 'red', 'yellow', 'cyan', 'white'];
  colors.forEach(function(id) {
    api('neobrutheme_color_' + id, function(value) {
      value.bind(function(to) {
        document.documentElement.style.setProperty('--color-' + id, to);
      });
    });
  });

  // Typography.
  var typography = ['body-font-weight', 'heading-font-weight', 'heading-letter-spacing', 'line-height'];
  typography.forEach(function(prop) {
    api('neobrutheme_' + prop.replace(/-/g, '_'), function(value) {
      value.bind(function(to) {
        document.documentElement.style.setProperty('--' + prop, to);
      });
    });
  });

  // Buttons.
  var buttons = ['btn-border-width', 'btn-shadow-size', 'btn-text-transform'];
  buttons.forEach(function(prop) {
    api('neobrutheme_' + prop.replace(/-/g, '_'), function(value) {
      value.bind(function(to) {
        document.documentElement.style.setProperty('--' + prop, to);
      });
    });
  });

  // Cards.
  var cards = ['card-border-width', 'card-shadow-size', 'card-accent-color'];
  cards.forEach(function(prop) {
    api('neobrutheme_' + prop.replace(/-/g, '_'), function(value) {
      value.bind(function(to) {
        document.documentElement.style.setProperty('--' + prop, to);
      });
    });
  });

  // Layout.
  api('neobrutheme_content_max_width', function(value) {
    value.bind(function(to) {
      document.documentElement.style.setProperty('--content-max-width', to);
    });
  });

  // Header border.
  api('neobrutheme_header_border_width', function(value) {
    value.bind(function(to) {
      document.documentElement.style.setProperty('--header-border-width', to);
    });
  });

  // Footer text.
  api('neobrutheme_footer_text', function(value) {
    value.bind(function(to) {
      var el = document.querySelector('.footer-text');
      if (el) el.textContent = to;
    });
  });
})(jQuery);
