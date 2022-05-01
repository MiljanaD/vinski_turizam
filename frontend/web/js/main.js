$("#openSignUp").click(function(){
    $("#signUpModal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
});

yii.confirm = function (message, okCallback, cancelCallback) {
    swal({
        title: message,
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: true,
        allowOutsideClick: true
    }, okCallback);
};