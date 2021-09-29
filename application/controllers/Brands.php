<?php

class Brands extends CI_Controller
{
    private $viewFolder = "";


    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "brands_v";
        $this->load->model("brand_model");
        // $this->load->model("product_image_model");
    }

    public function index()
    {

        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $items = $this->brand_model->get_all(array(), array("rank", "ASC"));
        /* View'e gonderilecek deyiskenlerin set edilmesi */
        $viewData->viewFolder = $this->viewFolder;
        // $viewData->strings = $this->string();
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
        if ($_FILES['img_url']['name'] == "") {
            $alert = array(
                "title" => "Error Title will be from DB",
                "text" => "Error Choose a File will be from DB",
                "type" => "error"
            );

            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("brands/new_form"));
        }
        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $config = array(
                "allowed_types" => "jpg|jpeg|png",
                "upload_path" => "uploads/$this->viewFolder/",
                "encrypt_name" => true
            );

            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("img_url");
            if ($upload) {
                $uploaded_file = $this->upload->data("file_name");
                $insert = $this->brand_model->insert(array(
                    "title" => $this->input->post("title"),
                    "img_url" => $uploaded_file,
                ));
                //TODO Alert Olunacaq
                if ($insert) {
                    $alert = array(
                        "title" => "Success Title will be from DB",
                        "text" => "Succes Text will be from DB",
                        "type" => "success"
                    );
                } else {
                    $alert = array(
                        "title" => "Error Title will be from DB",
                        "text" => "Error Text will be from DB",
                        "type" => "error"
                    );
                }
            } else {
                $alert = array(
                    "title" => "Error image Title will be from DB",
                    "text" => "Error  image Text will be from DB",
                    "type" => "error"
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url("brands/new_form"));
                die();
            }


            //Is Result-un Sessiona Yazma
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("brands"));
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
        $item = $this->brand_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $this->load->library("form_validation");//**
        $this->form_validation->set_rules("title", "Title", "required|trim");//**
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );//***
        $validation = $this->form_validation->run();//**

        if ($validation) {

            if ($_FILES['img_url']['name'] !== "") {
                $config = array(
                    "allowed_types" => "jpg|jpeg|png",
                    "upload_path" => "uploads/$this->viewFolder/",
                    "encrypt_name" => true
                );
                $this->load->library("upload", $config);
                $upload = $this->upload->do_upload("img_url");
                if ($upload) {
                    $uploaded_file = $this->upload->data("file_name");
                    $data = array(
                        "title" => $this->input->post("title"),
                        "img_url" => $uploaded_file,
                    );
                } else {
                    $alert = array(
                        "title" => "Error image Title will be from DB",
                        "text" => "Error  image Text will be from DB",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("brands/update_form/$id"));
                    die();
                }
            } else {
                $data = array(
                    "title" => $this->input->post("title"),
                );
            }
            $update = $this->brand_model->update(array("id" => $id), $data);
            //TODO Alert Olunacaq
            if ($update) {
                $alert = array(
                    "title" => "Success Title will be from DB",
                    "text" => "Succes Text will be from DB",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "Error Title will be from DB",
                    "text" => "Error Text will be from DB",
                    "type" => "error"
                );
            }
            //Is Result-un Sessiona Yazma
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("brands"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $this->brand_model->get(array(
                "id" => $id
            ));
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->brand_model->delete(array(
            "id" => $id
        ));
        if ($delete) {
            $alert = array(
                "title" => "Success Delet Title will be from DB",
                "text" => "Succes Delete Text will be from DB",
                "type" => "success"
            );
        } else {
            $alert = array(
                "title" => "Error Delete Title will be from DB",
                "text" => "Error Delete Text will be from DB",
                "type" => "error"
            );
        }
        //Is Result-un Sessiona Yazma
        $this->session->set_flashdata('alert', $alert);
        redirect(base_url("brands"));
    }


    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->brand_model->update(array(
                "id" => $id
            ), array(
                "isActive" => $isActive
            ));
        }
    }


    public function rankSetter()
    {
        $data = $this->input->post("data");

        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->brand_model->update(
                array(
                    "id" => $id,
                    "rank !=" => $rank

                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

}