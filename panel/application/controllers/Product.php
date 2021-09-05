<?php
class Product extends CI_Controller
{
    private $viewFolder = "";


    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";
        $this->load->model("product_model");
    }
    public function index()
    {
        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $items = $this->product_model->get_all();
        /* View'e gonderilecek deyiskenlerin set edilmesi */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }


    public function insert()
    {
        echo "Inserted";
    }
}
