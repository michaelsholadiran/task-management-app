function ajaxSubmit(e, form, callBackFunction, type) {

    e.preventDefault()

    var action = form.attr('action');
    var form2 = e.target;
    var data = new FormData(form2);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type,
        url: action,
        processData: false,
        contentType: false,
        dataType: 'json',
        data: data,
        error: function(error) {
            console.log(error.responseText);

            if (error.status == 422) {
                var a = error.responseJSON.errors;
                var validator = form.validate();
                for (i in a) {
                    validator.showErrors({
                        [i]: a[i]
                    });
                }

            }

        },
        success: function(response) {
            console.log(response);
            callBackFunction();
        },
        complete: function(data) {
            jQuery('#editTask').modal('hide');
        }
    });

}
