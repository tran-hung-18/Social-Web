$(document).on('click', '.interactive', function () {
    let btnLike = $(this);
    let route = $(this).data('route');
    $.ajax({
        url: route,
        type: "POST",
        dataType: "json",

        success: function (response) {
            $(".total-like").text(response.totalLike);
            if (response.statusLike) {
                btnLike.removeClass("fa-regular").addClass("fa-solid");
            } else {
                btnLike.removeClass("fa-solid").addClass("fa-regular");
            }
        },
        error: function (xhr, status, error) {
            console.log(error)
        },
    });
});

$('.icon-option-comment').click(function () {
    var index = $('.icon-option-comment').index(this);
    $('.icon-option-comment').eq(index).show();
    $('.box-option-comment').hide();
    $('.box-option-comment').eq(index).show();
});

$('.option-edit').click(function () {
    var index = $('.option-edit').index(this);
    $('.icon-option-comment').hide();
    $('.box-option-comment').hide();
    $('.form-edit-comment').eq(index).css('display', 'flex');
    $('.content-my-comment').eq(index).css('display', 'none');
});
