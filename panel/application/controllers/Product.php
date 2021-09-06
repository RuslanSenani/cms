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
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $insert = $this->product_model->insert(array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "url" => convertToSeo($this->input->post("title")),
                "isActive" => true
            ));
            //TODO Alert Olunacaq
            if ($insert) {
                redirect(base_url("product"));
            } else {
                echo "Exeption";
            }
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id)
    {

        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $item = $this->product_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $update = $this->product_model->update(array(
                "id" => $id
            ), array(
                "title" => $this->input->post("title"),
                "description" => $this->input->post("description"),
                "url" => convertToSeo($this->input->post("title")),
                "updatedAt" => date("Y-m-d H:i:d")
            ));
            //TODO Alert Olunacaq
            if ($update) {
                redirect(base_url("product"));
            } else {
                redirect(base_url("product"));
            }
        } else {
            $item = $this->product_model->get(array(
                "id" => $id
            ));
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $delete = $this->product_model->delete(array(
            "id" => $id
        ));
        if ($delete) {
            redirect(base_url("product"));
        } else {
            redirect(base_url("product"));
        }
    }
}
