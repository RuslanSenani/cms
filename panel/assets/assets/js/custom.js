$(document).ready(function () {
    $(".sortable").sortable();

    $(".remove-btn").click(function () {
        var $data_url = $(this).data("url");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete it!',
            cancelButtonText: "Cancle"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $data_url;
            }
        })
    })


    $(".isActive").change(function () {
        var $data = $(this).prop("checked");
        var $data_url = $(this).data("url");
        if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
            $.post($data_url, { data: $data }, function (result) {

            })
        }
    })

    $(".sortable").on("sortupdate", function (event, ui) {
        var $data = $(this).sortable("serialize");
        var $data_url = $(this).data("url");
        $.post($data_url, { data: $data }, function (result) { })
    })


})