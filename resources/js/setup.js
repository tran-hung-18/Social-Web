$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

setTimeout(() => {
    $(".alert").remove();
}, 3000);
