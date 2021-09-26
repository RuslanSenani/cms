<?php
class News extends CI_Controller
{
    private $viewFolder = "";


    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "news_v";
        $this->load->model("news_model");
        // $this->load->model("product_image_model");
    }
    public function index()
    {

        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $items = $this->news_model->get_all(array(), array("rank", "ASC"));
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
        $news_type = $this->input->post("news_type");
        if ($news_type == "image") {
            if ($_FILES['img_url']['name'] == "") {
                $alert = array(
                    "title" => "Error Title will be from DB",
                    "text" => "Error Choose a File will be from DB",
                    "type" => "error"
                );

                $this->session->set_flashdata('alert', $alert);
                redirect(base_url("news/new_form"));
            }
        } elseif ($news_type == "video") {
            $this->form_validation->set_rules("video_url", "Video Url", "required|trim");
        }

        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {

            if ($news_type == "image") {
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
                        "description" => $this->input->post("description"),
                        "news_type" => $news_type,
                        "url" => convertToSeo($this->input->post("title")),
                        "video_url" => "#",
                        "img_url" => $uploaded_file,
                        "isActive" => false
                    );
                } else {
                    $alert = array(
                        "title" => "Error image Title will be from DB",
                        "text" => "Error  image Text will be from DB",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("news/new_form"));
                    die();
                }
            } elseif ($news_type == "video") {
                $data = array(
                    "title" => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "news_type" => $news_type,
                    "url" => convertToSeo($this->input->post("title")),
                    "video_url" => $this->input->post("video_url"),
                    "img_url" => "#",
                    "isActive" => false
                );
            }



            $insert = $this->news_model->insert($data);
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
            redirect(base_url("news"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->news_type = $news_type;
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id)
    {

        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $item = $this->news_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update_($id)
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
            $update = $this->news_model->update(array(
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
            redirect(base_url("news"));
        } else {
            $item = $this->news_model->get(array(
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
    public function update($id)
    {


        $this->load->library("form_validation");
        $news_type = $this->input->post("news_type");
        if ($news_type == "image") {
            if ($_FILES['img_url']['name'] == "") {
                $alert = array(
                    "title" => "Error Title will be from DB",
                    "text" => "Error Choose a File will be from DB",
                    "type" => "error"
                );

                $this->session->set_flashdata('alert', $alert);
                redirect(base_url("news/new_form"));
            }
        } elseif ($news_type == "video") {
            $this->form_validation->set_rules("video_url", "Video Url", "required|trim");
        }

        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {

            if ($news_type == "image") {
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
                        "description" => $this->input->post("description"),
                        "news_type" => $news_type,
                        "url" => convertToSeo($this->input->post("title")),
                        "video_url" => "#",
                        "img_url" => $uploaded_file,
                        "isActive" => false
                    );
                } else {
                    $alert = array(
                        "title" => "Error image Title will be from DB",
                        "text" => "Error  image Text will be from DB",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("news/new_form"));
                    die();
                }
            } elseif ($news_type == "video") {
                $data = array(
                    "title" => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "news_type" => $news_type,
                    "url" => convertToSeo($this->input->post("title")),
                    "video_url" => $this->input->post("video_url"),
                    "img_url" => "#",
                    "isActive" => false
                );
            }



            $insert = $this->news_model->insert($data);
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
            redirect(base_url("news"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->news_type = $news_type;
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->news_model->delete(array(
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
        redirect(base_url("news"));
    }


    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->news_model->update(array(
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
            $this->news_model->update(
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
