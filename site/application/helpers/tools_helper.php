<?php

function get_product_cover_image($product_id)
{
    $t = get_instance();
    $t->load->model("product_image_model");
    $image = $t->product_image_model->get(
        array(
            "isCover" => 1,
            "product_id" => $product_id
        )
    );
    if (empty($image)) {
        $image = $t->product_image_model->get(
            array(
                "product_id" => $product_id
            )
        );
    }
    return !empty($image) ? $image->img_url : null;
}

function get_portfolio_cover_image($id)
{
    $t = get_instance();
    $t->load->model("portfolio_image_model");
    $image = $t->portfolio_image_model->get(
        array(
            "isCover" => 1,
            "portfolio_id" => $id
        )
    );

    if (empty($image)) {
        $image = $t->portfolio_image_model->get(
            array(
                "portfolio_id" => $id
            )
        );
    }
    return !empty($image) ? $image->img_url : null;
}

function get_portfolio_category_title($id)
{
    $t = get_instance();
    $t->load->model("portfolio_category_model");
    $category = $t->portfolio_category_model->get(
        array(
            "id" => $id
        )
    );
    return (empty($category)) ? false : $category->title;
}

function get_readable_date($date)
{
    setlocale(LC_ALL, 'az_AZ.UTF-8', 'az_AZ', 'az', 'azerbaijan');
    return strftime('%e %B %Y', strtotime($date));
}