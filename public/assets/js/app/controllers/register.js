function deleteElement() {
  $('.app-delete-element').click(function(event) {
    event.preventDefault();

    var $this     = $(this),
        $element  = $($this.data('delete'));

    $element.remove();
  });
}

$(function() {

  /*$('#popcites').on('hide.bs.popover', function () {
    alert("hol");
  });*/

  $('[data-role="switch"]').switch({
    onEnabled: function() {
      var $this = $('span', this);

      $this.removeClass('fa-lock').addClass('fa-unlock');
    },
    onDisabled: function () {
      var $this = $('span', this);

      $this.removeClass('fa-unlock').addClass('fa-lock');

      console.log($this);
    }
  });

  var field_index = {};

  $('.app-add-element').click(function(event) {
    event.preventDefault();

    var $this       = $(this),
        $container  = $($this.data('container')),
        item        = $this.data('item');

    if (typeof field_index[item] == "undefined") {
      field_index[item] = 1;
    }

    $container.append(
      '<div id="inputs-'+item+'-'+field_index[item]+'" class="pulse animate-duration-20ms col-xs-11 col-xs-offset-1 no-padding margin-bottom-15px">' +
      '\t<div class="col-xs-3 no-padding"></div>'+
      '\t<div class="col-xs-1 no-padding"></div>'+
      '\t<div class="col-xs-3 no-padding">'+
      '\t\t<input type="text" id="'+item+'_from" class="day-'+item+'-from form-control datetimepicker-time text-center datetimepicker-time" placeholder="--:-- --" name="day['+item+']['+field_index[item]+'][from]" data-switch="'+item+'-switch" required="required">'+
      '\t</div>'+
      '\t<div class="col-xs-1 no-padding">'+
      '\t\t<p class="text-center">A</p>'+
      '\t</div>'+
      '\t<div class="col-xs-3 no-padding">'+
      '\t\t<input type="text" id="'+item+'_to" class="day-'+item+'-to form-control datetimepicker-time text-center datetimepicker-time" placeholder="--:-- --" name="day['+item+']['+field_index[item]+'][to]" data-switch="'+item+'-switch" required="required">'+
      '\t</div>'+
      '\t<div class="col-xs-1 no-padding">'+
      '\t\t<button data-delete="#inputs-'+item+'-'+field_index[item]+'" class="app-delete-element delete-element-'+item+' btn btn-link btn-invert-red" data-switch="'+item+'-switch">'+
      '\t\t\t<span class="glyphicon glyphicon-trash"></span>'+
      '\t\t</button>'+
      '\t</div>'+
      '</div>'
    );

    $('.datetimepicker-time').datetimepicker({
      format: 'LT'
    });

    deleteElement();
    ++field_index[item];

  });

  deleteElement();  

});