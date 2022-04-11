$("#openSignUp").click(function(){
    $("#signUpModal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
});
