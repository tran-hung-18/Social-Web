// SCROLL HEADER
$(window).scroll(function() {
    let header = $('.container-header');
    $(window).scrollTop() > 0 ? header.addClass('header-scrolled') : header.removeClass('header-scrolled');
  });

// SELECT CATEGORY
$('#select-category').change(function() {
    let idCategory = $(this).val();
    if (idCategory != 0) {
      location.href = $(this).val();
    }
  });
  

// PREVIEW IMAGE BLOG
$('#btn-upload-img').click(function() {
    $('#image').click();
});

$('#image').change(function() {
  const file = $('#image')[0].files[0];
  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const imageUrl = e.target.result;
      $('.img-preview').html(`<img src="${imageUrl}" alt="Image Preview">`);
    };
    reader.readAsDataURL(file);
  }
});

// RELATED IMAGE
if ($(window).width() <= 768) {
    $('.related-img').slick({
        infinite: true,
        dots: true,
        arrows: false,
        autoplaySpeed: 1500,
        draggable: true,
    });     
}

setTimeout(() => {
    $(".alert").remove();
}, 3000);

$('.icon-show-menu').click(function() {
    $('.menu-mobile').css('width','100%');
});
$('.icon-close-menu').click(function() {
    $('.menu-mobile').width(0);
});

$('.icon-show-search').click(function() {
    $('.search-mobile').css('width','100%');
});
$('.icon-close-search').click(function() {
    $('.search-mobile').width(0);
});

$('.delete-blog').click(function() {
    $('.box-delete').show();
});
$('.cancel-box-delete').click(function() {
    $('.box-delete').hide();
});


