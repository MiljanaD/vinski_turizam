yii.confirm = function (message, ok, cancel) {
    var title = $(this).data("title");
    var confirm_label = $(this).data("ok");
    var cancel_label = $(this).data("cancel");

    new swal({
        title: message,
        showCancelButton: true,
        buttons: {
            confirm: {
                label: confirm_label,
                className: 'btn-danger btn-flat'
            },
            cancel: {
                label: cancel_label,
                className: 'btn-default btn-flat'
            }
        },
    },).then((res) => {
        if (res.isConfirmed) {
            !ok || ok();
        } else {
            !cancel || cancel();
        }

    })
};

$("#openSignUp").click(function () {
    $("#signUpModal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
});

$(".openUserModal").click(function () {
    $("#user-grid-modal").modal().find(".modal-dialog").addClass('modal-lg');
    $("#user-grid-modal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
    $("#user-grid-modal").modal().find(".modal-title")
        .html("<b>"+$(this).attr('title').toUpperCase() +"</b>");
});

$("#user-grid-modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("<div class=\"loader\"></div>");
});


$(".openVineRegionModal").click(function () {
    $("#vine-region-grid-modal").modal().find(".modal-dialog").addClass('modal-lg');
    $("#vine-region-grid-modal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
    $("#vine-region-grid-modal").modal().find(".modal-title")
        .html("<b>"+$(this).attr('title').toUpperCase() +"</b>");
});

$("#vine-region-grid-modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("<div class=\"loader\"></div>");
});

$(".openVineSortModal").click(function () {
    $("#vine-sort-grid-modal").modal().find(".modal-dialog").addClass('modal-lg');
    $("#vine-sort-grid-modal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
    $("#vine-sort-grid-modal").modal().find(".modal-title")
        .html("<b>"+$(this).attr('title').toUpperCase() +"</b>");
});

$("#vine-sort-grid-modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("<div class=\"loader\"></div>");
});

$(".openVineServiceModal").click(function () {
    $("#vine-service-grid-modal").modal().find(".modal-dialog").addClass('modal-lg');
    $("#vine-service-grid-modal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
    $("#vine-service-grid-modal").modal().find(".modal-title")
        .html("<b>"+$(this).attr('title').toUpperCase() +"</b>");
});

$("#vine-service-grid-modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("<div class=\"loader\"></div>");
});

$(".openWineryModal").click(function () {
    $("#winery-grid-modal").modal().find(".modal-dialog").addClass('modal-lg');
    $("#winery-grid-modal").modal('show')
        .find(".modal-body")
        .load($(this).attr('value'));
    $("#winery-grid-modal").modal().find(".modal-title")
        .html("<b>"+$(this).attr('title').toUpperCase() +"</b>");
});

$("#winery-grid-modal").on("hidden.bs.modal", function(){
    $(".modal-body").html("<div class=\"loader\"></div>");
});

