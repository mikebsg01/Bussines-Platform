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

$.fn.switch = function(callback = null) {

  return this.each(function() { 
    var self      = this,
        $element  = $(this),
        arr       = $element.data('enable').split(',');

    self.callback = callback;
    var enabled   = $.parseJSON( $element.attr('data-enabled') );

    for ( var i = 0; i < arr.length; ++i ) {
      var $control  = $(arr[i]),
          tagName   = $control.prop('tagName');
        
      if ( $control.val() == "" ) {
        $control.prop('disabled', !enabled);
      } else {
        tagName = $control.prop('tagName');

        if ( tagName == 'INPUT' ) {
          for ( j = 0; j < arr.length; ++j ) {
            $(arr[j]).prop('disabled', enabled);
          }

          self.callback(enabled);
        }
        break;
      }
    }

    $element.click(function(event) {
      event.preventDefault();
      var $this = $(this), 
          disabled = $.parseJSON( $element.attr('data-enabled') );

      if (typeof self.callback != "null") {
        self.callback(disabled);
      }

      for (var i = 0; i < arr.length; ++i) {
        var $control = $(arr[i]);

        $control.prop('disabled', disabled);

        if (disabled) {  
          var tagName = $control.prop('tagName');

          if (tagName == 'INPUT') {
            if ($control.attr('type') == 'text') {
              $control.val('');
            }
          }
        }
      }

      $element.attr('data-enabled', '' + ! disabled + '');
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

$.fn.filter = function(options) {
  var self = this,
      defaults = {
        'delimiter' : ';'
      };

  var settings = $.extend({}, defaults, options);

  return self.each(function() {
    var $filter = $(this),
        $filter_options = $('.filter-option', this);

    $filter_options.each(function() {
      var $filter_option = $(this);

      $filter_option.click(function(event){
        event.preventDefault();
        var current_url = $.url(),
            decode_current_url = decodeURIComponent(current_url),
            parameter = $.url('?' + $filter.data('name'));

        if (typeof parameter === "undefined") {
          current_url += "&" + $filter.data('name') + "=";
        }

        var next_url = null;

        if (decode_current_url.search($filter_option.data('value')) === -1 ) {
          next_url = current_url.replace(
            new RegExp("("+$filter.data('name')+"=([^\&]){0,})"),
            $filter.data('name') + '=' + encodeURIComponent(
              ( (typeof parameter !== "undefined" && parameter !== "") ? (parameter + settings.delimiter) : "") + 
              $filter_option.data('value')
            )
          );
        } else {
          next_url = current_url.replace(
            new RegExp("("+$filter.data('name')+"=([^\&]){0,})"),
            $filter.data('name') + '=' + encodeURIComponent(
              parameter.replace(
                new RegExp("("+$filter_option.data('value')+")([\;]?)"),
                ""
              )
            )
          );
        }
        
        location.href = next_url;
      });
    });
  });
}

$(function(){

  $('a.thumbnail').viewer();

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