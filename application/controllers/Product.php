<?php
class Product extends CI_Controller
{
    private $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";
        $this->load->model("product_model");
        $this->load->model("product_image_model");
    }

    public function index()
    {
        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $items = $this->product_model->get_all(array(), array("rank", "ASC"));
        /* View'e gonderilecek deyiskenlerin set edilmesi */
        $viewData->viewFolder = $this->viewFolder;
        // $viewData->strings = $this->string();
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    // public function string()
    // {

    //     $string = array();
    //     $lang_setting = $this->product_model->front_read('lang_settings', array('l_id' => get_lang()));
    //     foreach ($lang_setting as $l) {
    //         $string = array_merge($string, array($l['selector'] => $l['value']));
    //     }
    //     return $string;
    // }
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
                "isActive" => false
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
            //Is Result-un Sessiona Yazma
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("product"));
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
                $alert = array(
                    "title" => "Success Update Title will be from DB",
                    "text" => "Succes Update Text will be from DB",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "Error Update Title will be from DB",
                    "text" => "Error Update Text will be from DB",
                    "type" => "error"
                );
            }
            //Is Result-un Sessiona Yazma
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("product"));
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
        redirect(base_url("product"));
    }

    public function imageDelete($id, $parent_id)
    {
        $fileName = getFileName($id);
        $delete = $this->product_image_model->delete(array(
            "id" => $id
        ));

        if ($delete) {
            unlink("uploads/{$this->viewFolder}/$fileName->img_url");
            redirect(base_url("product/image_form/$parent_id"));
        } else {
            redirect(base_url("product/image_form/$parent_id"));
        }
    }

    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_model->update(array(
                "id" => $id
            ), array(
                "isActive" => $isActive
            ));
        }
    }

    public function isCoverSetter($id, $parent_id)
    {
        if ($id && $parent_id) {
            $isCover = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_image_model->update(array(
                "id" => $id,
                "product_id" => $parent_id
            ), array(
                "isCover" => $isCover
            ));
            $this->product_image_model->update(array(
                "id !=" => $id,
                "product_id" => $parent_id
            ), array(
                "isCover" => 0
            ));
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";
            $viewData->item_images = $this->product_image_model->get_all(array(
                "product_id" => $parent_id
            ), array("rank", "ASC"));
            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
            echo $render_html;
        }
    }

    public function imageIsActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_image_model->update(array(
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
            $this->product_model->update(
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

    public function imageRankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->product_image_model->update(
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

    public function image_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->product_model->get(array(
            "id" => $id
        ));
        $viewData->item_images = $this->product_image_model->get_all(array(
            "product_id" => $id
        ), array("rank", "ASC"));
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function image_upload($id)
    {
        $config = array(
            "allowed_types" => "jpg|jpeg|png",
            "upload_path" => "uploads/$this->viewFolder/",
            "encrypt_name" => true
        );

        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("file");
        if ($upload) {
            $uploaded_file = $this->upload->data("file_name");
            $this->product_image_model->insert(array(
                "img_url" => $uploaded_file,
                "product_id" => $id
            ));
        } else {
            echo "Faild";
        }
    }

    public function refresh_image_list($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item_images = $this->product_image_model->get_all(array(
            "product_id" => $id
        ));
        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
        echo $render_html;
    }
}