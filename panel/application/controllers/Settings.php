<?php

class Settings extends CI_Controller
{
    private $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "settings_v";
        $this->load->model("settings_model");

        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        $item = $this->settings_model->get();
        $viewData->viewFolder = $this->viewFolder;
        if ($item)
            $viewData->subViewFolder = "update";
        else
            $viewData->subViewFolder = "no_content";

        $viewData->item = $item;
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
        if ($_FILES['logo']['name'] == "") {
            $alert = array(
                "title" => "Error Title will be from DB",
                "text" => "Error Choose a File will be from DB",
                "type" => "error"
            );
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("settings/new_form"));
        }
        $this->form_validation->set_rules("company_name", "Company Name", "required|trim");
        $this->form_validation->set_rules("phone_1", "Phone 1", "required|trim");
        $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Please enter the correct <b>{field}</b>",
            )
        );
        $validation = $this->form_validation->run();
        if ($validation) {
            $file_name = convertToSeo($this->input->post("company_name")) . "." . pathinfo($_FILES['logo']['name'],
                    PATHINFO_EXTENSION);
            $config = array(
                "allowed_types" => "jpg|jpeg|png",
                "upload_path" => "uploads/$this->viewFolder/",
                "file_name" => $file_name
            );

            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("logo");
            if ($upload) {
                $uploaded_file = $this->upload->data("file_name");
                $insert = $this->settings_model->insert(array(
                    "company_name" => $this->input->post("company_name"),
                    "phone_1" => $this->input->post("phone_1"),
                    "phone_2" => $this->input->post("phone_2"),
                    "fax_1" => $this->input->post("fax_1"),
                    "fax_2" => $this->input->post("fax_2"),
                    "address" => $this->input->post("address"),
                    "about_us" => $this->input->post("about_us"),
                    "mission" => $this->input->post("mission"),
                    "vision" => $this->input->post("vision"),
                    "email" => $this->input->post("email"),
                    "facebook" => $this->input->post("facebook"),
                    "twitter" => $this->input->post("twitter"),
                    "instagram" => $this->input->post("instagram"),
                    "linkedin" => $this->input->post("linkedin"),
                    "logo" => $uploaded_file,
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
                redirect(base_url("settings/new_form"));
                die();
            }


            //Is Result-un Sessiona Yazma
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("settings"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function update($id)
    {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("company_name", "Company Name", "required|trim");
        $this->form_validation->set_rules("phone_1", "Phone 1", "required|trim");
        $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Please enter the correct <b>{field}</b>",
            )
        );
        $validation = $this->form_validation->run();

        if ($validation) {

            if ($_FILES['logo']['name'] !== "") {
                $file_name = convertToSeo($this->input->post("company_name")) . "." . pathinfo($_FILES['logo']['name'],
                        PATHINFO_EXTENSION);
                $config = array(
                    "allowed_types" => "jpg|jpeg|png",
                    "upload_path" => "uploads/$this->viewFolder/",
                    "file_name" => $file_name
                );
                $this->load->library("upload", $config);
                $upload = $this->upload->do_upload("logo");
                if ($upload) {
                    $uploaded_file = $this->upload->data("file_name");
                    $data = array(
                        "company_name" => $this->input->post("company_name"),
                        "phone_1" => $this->input->post("phone_1"),
                        "phone_2" => $this->input->post("phone_2"),
                        "fax_1" => $this->input->post("fax_1"),
                        "fax_2" => $this->input->post("fax_2"),
                        "address" => $this->input->post("address"),
                        "about_us" => $this->input->post("about_us"),
                        "mission" => $this->input->post("mission"),
                        "vision" => $this->input->post("vision"),
                        "email" => $this->input->post("email"),
                        "facebook" => $this->input->post("facebook"),
                        "twitter" => $this->input->post("twitter"),
                        "instagram" => $this->input->post("instagram"),
                        "linkedin" => $this->input->post("linkedin"),
                        "logo" => $uploaded_file,
                        "updatedAt" => date("Y-m-d H:i:s")
                    );
                    $fileName = getFileName($id, "settings_model");
                    unlink("uploads/{$this->viewFolder}/$fileName->logo");
                } else {
                    $alert = array(
                        "title" => "Error image Title will be from DB",
                        "text" => "Error  image Text will be from DB",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("settings/update_form/$id"));
                    die();
                }
            } else {
                $data = array(
                    "company_name" => $this->input->post("company_name"),
                    "phone_1" => $this->input->post("phone_1"),
                    "phone_2" => $this->input->post("phone_2"),
                    "fax_1" => $this->input->post("fax_1"),
                    "fax_2" => $this->input->post("fax_2"),
                    "address" => $this->input->post("address"),
                    "about_us" => $this->input->post("about_us"),
                    "mission" => $this->input->post("mission"),
                    "vision" => $this->input->post("vision"),
                    "email" => $this->input->post("email"),
                    "facebook" => $this->input->post("facebook"),
                    "twitter" => $this->input->post("twitter"),
                    "instagram" => $this->input->post("instagram"),
                    "linkedin" => $this->input->post("linkedin"),
                    "updatedAt" => date("Y-m-d H:i:s")
                );
            }
            $update = $this->settings_model->update(array("id" => $id), $data);

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
            //Session Update
            $settings=$this->settings_model->get();
            $this->session->set_userdata("settings", $settings);

            //Is Result-un Sessiona Yazma
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("settings"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $this->settings_model->get(array(
                "id" => $id
            ));
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }


}