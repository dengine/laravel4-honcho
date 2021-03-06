// Generated by CoffeeScript 1.4.0
(function() {
  var validateTextField;

  validateTextField = function($field) {
    var $helpContainer, error, maxLength, minLength, pattern, required, validateName, value;
    value = $field.val();
    error = false;
    $helpContainer = $field.siblings('.help-inline');
    if ($field.attr('required') || value !== '') {
      validateName = $field.attr('data-validatename') || $field.attr('name') || 'This field';
      required = $field.attr('required') === 'required';
      minLength = parseInt($field.attr('data-minlength'));
      if (isNaN(minLength)) {
        minLength = 0;
      }
      maxLength = parseInt($field.attr('maxlength'));
      if (isNaN(maxLength)) {
        maxLength = false;
      }
      pattern = $field.attr('pattern');
      if (pattern === '') {
        pattern = void 0;
      }
      if (required === true && value === '') {
        error = validateName + ' is required';
      }
      if (error === false && pattern !== void 0) {
        if (value.search(new RegExp(pattern, 'g')) === -1) {
          error = validateName + ' is invalid';
        }
      }
      if (error === false && minLength !== 0) {
        if (!(value.length >= minLength)) {
          error = validateName + ' is too short';
        }
      }
      if (error === false && maxLength !== false) {
        if (!(value.length <= maxLength)) {
          error = validateName + ' is too long';
        }
      }
      if (error !== false) {
        $field.closest('.control-group').addClass('error').removeClass('success');
        $helpContainer.html('<i class="icon-remove icon-red"></i> ' + error);
      } else {
        $field.closest('.control-group').addClass('success').removeClass('error');
        $helpContainer.html('<i class="icon-ok icon-green"></i>');
      }
    } else {
      $field.closest('.control-group').removeClass('success').removeClass('error');
      $helpContainer.html('');
    }
    return error;
  };

  (function($) {
    return $.fn.bootstrapValidate = function() {
      if (!this.is('form')) {
        throw new Error('Boostrap Validate Expects A Form');
      }
      this.attr('novalidate', 'novalidate').on('submit', function(submitEvent) {
        var errors;
        errors = [];
        $('input, textarea', $(this)).not('[type="radio"]').not('[type="checkbox"]').each(function(i, el) {
          var error;
          if (error = validateTextField($(el))) {
            return errors.push(error);
          }
        });
        if (errors.length !== 0) {
          submitEvent.stopImmediatePropagation();
          return false;
        }
      });
      $('input, textarea', this).not('[type="radio"]').not('[type="checkbox"]').on('change', function(changeEvent) {
        return validateTextField($(this));
      });
      $('input, textarea', this).not('[type="radio"]').not('[type="checkbox"]').on('keyup', function(keyupEvent) {
        var $this, timeout;
        $this = $(this);
        timeout = $this.data('keyup-timeout');
        if (timeout !== void 0) {
          clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
          return validateTextField($this);
        }, 750);
        return $this.data('keyup-timeout', timeout);
      });
      return this.each(function(i, el) {
        var $form, handlers, validation;
        $form = $(el);
        handlers = $form.data('events').submit;
        validation = handlers.pop();
        return handlers = handlers.splice(0, 0, validation);
      });
    };
  })(jQuery);

  jQuery(function() {
    return jQuery('form[data-validate="yes"]').bootstrapValidate();
  });

}).call(this);