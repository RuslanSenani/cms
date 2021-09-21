
$(document).ready(function () {

   
    $(".sortable").sortable();

    $(".content_container, .image_list_container").on('click', '.remove-btn', function () {
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


    $(".content_container, .image_list_container").on('change', '.isActive', function () {
        var $data = $(this).prop("checked");
        var $data_url = $(this).data("url");
        if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
            $.post($data_url, { data: $data }, function (result) {
            })
        }
    })

    $(".image_list_container").on('change', '.isCover', function () {
        var $data = $(this).prop("checked");
        var $data_url = $(this).data("url");
        if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
            $.post($data_url, { data: $data }, function (result) {
                $(".image_list_container").html(result);
                $('[data-switchery]').each(function () {
                    var $this = $(this),
                        color = $this.attr('data-color') || '#188ae2',
                        jackColor = $this.attr('data-jackColor') || '#ffffff',
                        size = $this.attr('data-size') || 'default'

                    new Switchery(this, {
                        color: color,
                        size: size,
                        jackColor: jackColor
                    });
                });
                $(".sortable").sortable();
            })
        }
    })

    $(".content_container, .image_list_container").on("sortupdate", ".sortable", function (event, ui) {
        var $data = $(this).sortable("serialize");
        var $data_url = $(this).data("url");
        $.post($data_url, { data: $data }, function (result) { })
    })


    var uploadSection = Dropzone.forElement("#dropzone");
    uploadSection.on("complete", function (file) {
        var $data_url = $("#dropzone").data("url");
        $.post($data_url, {}, function (result) {
            $(".image_list_container").html(result);

            $('[data-switchery]').each(function () {
                var $this = $(this),
                    color = $this.attr('data-color') || '#188ae2',
                    jackColor = $this.attr('data-jackColor') || '#ffffff',
                    size = $this.attr('data-size') || 'default'

                new Switchery(this, {
                    color: color,
                    size: size,
                    jackColor: jackColor
                });
            });
            $(".sortable").sortable();
        })
    })

})