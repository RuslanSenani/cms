$(document).ready(function () {
    // var controller = window.location.href.split("/")[5];
    // var edit_link = controller.split("#");
    // controller = edit_link[0];
    //var base_url = $('#base_url').val();
    //var data_url = 'http://localhost/cms/';
    // $(".image_upload_container").hide();
    // $(".video_url_container").hide();
    $(".news_type_select").change(function () {
        if ($(this).val() === "image") {
            $(".video_url_container").hide();
            $(".image_upload_container").fadeIn();
        } else if ($(this).val() === "video") {
            $(".image_upload_container").hide();
            $(".video_url_container").fadeIn();
        }
    })
})
