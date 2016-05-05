function attrCSStoJSON( stringCSS ) {
  stringCSS.replace(/\s+/g, "");

  var attrValue   = stringCSS.split(";"),
      objJSON     = "{"; 

  for ( var i = 0; i < attrValue.length; ++i ) {
    var t = attrValue[i].split(":");

    objJSON += "\"" + t[0] + "\":" + "\"" + t[1] + "\"";

    if ( i != ( attrValue.length - 1 ) ) {
      if ( ( i + 1 ) < attrValue.length ) {
        if ( attrValue[i + 1] == "" ) {
          break;
        } 
      }
      objJSON += ",";
    }
  }
  objJSON += "}";
  return objJSON;
}

$.fn.adaptableStyle = function( ) {

  return this.each ( function ( ) {
    var $this = $( this ),
      styles = $this.attr( 'data-style' );
    
    if ( typeof styles != "undefined" && styles != "" ) {
      styles = jQuery.parseJSON( attrCSStoJSON( styles ) );
      var x;

      $.each ( styles, function ( k, v ) {

        x = v;

        if ( k == 'width' ) { 
          x = ( ( $( window ) .width() * v ) / 100 ) + 'px';
        }
        else if ( k == 'height' || 
             k == 'min-height' ||
             k == 'margin-top' ) {
          x = ( ( ( $( window ) .height() * v ) / 100 ) + 1 ) + 'px';
        }

        $this.css( k, x );

      });

    }

  });
}

$.fn.overflow = function(value) {
  return this.each ( function ( ) {
    var $this = $(this);

    $this.css({
      'overflow': value
    });
  });
}

$.fn.switch = function(options) {
  var self = this,
      rgTextFields = new RegExp('(INPUT|TEXTAREA)'),
      defaults = {
        enabled: false,
        onEnabled: function(){},
        onDisabled: function(){}
      };

  var settings = $.extend({}, defaults, options);

  return self.each(function() {
    var $switch = $(this),
        $elements = $('[data-switch="'+$switch.attr('id')+'"');

    $switch.enabled     = settings.enabled;
    $switch.onEnabled   = settings.onEnabled;
    $switch.onDisabled  = settings.onDisabled;

    if (typeof $switch.data('enabled') !== "undefined") {
      $switch.enabled = $switch.data('enabled');
    }

    $elements.each(function() {
      var $element = $(this);

      $element.prop('disabled', !$switch.enabled);
    });

    $switch.click(function(event) {
      event.preventDefault();
      $switch.enabled = !$switch.enabled;
      $elements = $('[data-switch="'+$switch.attr('id')+'"');

      if ($switch.enabled) { /* on */
        $switch.onEnabled();
      } else { /* off */
        $switch.onDisabled();
      }

      $elements.each(function() {
        var $element = $(this);

        $element.prop('disabled', !$switch.enabled);

        if (!$switch.enabled) {
          if (rgTextFields.test($element.prop('tagName'))) {
            $element.val('');
          }
        }
      });
    });
  });
}

$.fn.viewer = function() {
  var self = this;

  return self.each(function() {
    var $this = $(this),
        type  = $this.attr('data-viewer-type'),
        file  = $this.attr('data-viewer-file');

    if (type == "image") {
      $this.css({
        'background-image' : 'url(' + file + ')'
      });
    }

    $this.click(function(event) {
      event.preventDefault();
    });
  });
}

$.fn.saveForm = function(options) {
  var self = this;
  var defaults  = {
    chromeHTML5Validation: true,
  };

  var settings = $.extend({}, defaults, options);

  return self.each(function() {
    var $this = $(this),
        $form = $('#' + $this.data('form'));

    $this.click(function(event) {

      event.preventDefault();

      if ( settings.chromeHTML5Validation ) {

        if (!!window.chrome) {
          var report = $form[0].reportValidity();

          if (report) {
            $form.submit();
          }
        }
      } else {
        $form.submit();
      }
    });
  });
}

$.fn.radioButton = function() {
  var self = this;

  self.each(function() {
    var $element = $(this);
    $element.addClass('input-radio-1');

    var $label = $('<label></label>');
    $label.attr('for', $element.attr('id'));
    $label.addClass('lbl-input-radio-1');
    $label.text($element.data('title'));

    $label.click(function(event) {
      event.stopPropagation();
    });

    $element.after($label);
  });
}

$.fn.searchFilters = function(options) {
  var self = this,
      defaults = {};

  var settings = $.extend({}, defaults, options);

  return self.each(function() {
    var $formTools = $(this);
    var $form = $($formTools.data('href'));

    var tools = {
      markAll: $('.mark-all', $formTools),
      unmarkAll: $('.unmark-all', $formTools)
    };

    var attr_values = {
      checked: false
    };

    for (tool in tools) {
      switch (tool) {
        case 'markAll':
        case 'unmarkAll':

          var $tool = null;

          if (tool == 'markAll') {
            $tool = tools.markAll;
          } else {
            $tool = tools.unmarkAll;
          }

          if ($tool.length) {
            $tool.click(function(event) {
              event.preventDefault();
              event.stopPropagation();
              var $element = $(this);
              
              $('input[type="checkbox"]', $form).each(function() {
                $(this).prop('checked', $element.hasClass('mark-all') ? true : false);
              });
            });
          }
        break;

        default:
        break;
      }
    }

  });
}

$(function(){

  $('a.thumbnail').viewer();

  $('.dropdown ul li').each(function() {
    var $element = $(this);

    $element.click(function(event) {
      event.stopPropagation();
    });
  });

  $('[data-role="input-radio"]').radioButton();

  $('[data-role="form-tools"]').searchFilters();

  $('[data-save="true"]').saveForm();

  $('[data-element="popover"]').each(function() {
    var $this = $(this);
    var show;

    if (show = $this.data('show')) {
      show = $.parseJSON(show);

      $this.popover(show ? 'show' : null );
    } else {
      $this.popover();
    }
    
  });

  $('[data-toggle="tooltip"]').tooltip();

  $('.chosen-select').chosen({
    no_results_text:          'No existen resultados con: ',
    placeholder_text_single:  'Selecciona...'
  });

  $('.tags-input').tagsInput({
    'width':'100%',
    'height':'68px',
    'defaultText':'',
    'delimiter': [',',';'],
    'defaultText':'Ej. One, Two, Three...',   
    'placeholderColor':'#AFAFAF',
  });

  $('.datetimepicker-date').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: moment.locale('es')
  });

  $('.datetimepicker-time').datetimepicker({
    format: 'LT'
  });

  $('.barrating-1').barrating({
    theme: 'fontawesome-stars'
  });

  $('[data-adaptable-style="true"]').adaptableStyle();
  $('.overflow-hidden') .overflow('hidden');
  $('.overflow-auto') .overflow('auto');
  
  $( window ) .resize( function() {
    $('[data-adaptable-style="true"]').adaptableStyle();
    $('.overflow-hidden') .overflow('hidden');
    $('.overflow-auto') .overflow('auto');
  });

});