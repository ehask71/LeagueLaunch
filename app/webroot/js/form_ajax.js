function afterValidate(data, status)  {
    $(".error-message").remove();

    $(".error").each(function() {
    	$(this).removeClass("error");
    });

    if(data.errors) {
        onError(data.errors);
        return false;
    } else {
    	onSuccess(data.success)
        return true;
    }
}

function onError(data, form) {
    $.each(data, function(model, errors) {
        for (fieldName in this) {
            var element = $("#" + camelize(model + '_' + fieldName));
            var _insert = $(document.createElement('div')).insertAfter(element);
            _insert.addClass('error-message').text(this[fieldName]);            
            _insert.parent().addClass('error');
        }
    });
};

function onSuccess(data) {
    window.location.href = data;
};