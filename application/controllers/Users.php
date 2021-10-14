<?php

class Users extends CI_Controller
{
    private $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");

        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        $items = $this->user_model->get_all(array(), array("id", "ASC"));
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

        $this->form_validation->set_rules("user_name", "User Name", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Full Name", "required|trim");
        $this->form_validation->set_rules("email", "E-mail", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Password Repeat", "required|trim|min_length[6]|max_length[8]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Duzgun Email Adresi Girin Zehmet Olmasa",
                "is_unique" => "<b>{field}</b> Artiq movzuddur",
                "min_length" => "<b>{field}</b> Xanasi 6-dan az Olmamalidir",
                "max_length" => "<b>{field}</b> Xanasi 8-dan çox Olmamalidir",
                "matches" => "Daxil Etdiyiniz Sifreler Eyni Deyil",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {

            $insert = $this->user_model->insert(array(
                "user_name" => $this->input->post("user_name"),
                "full_name" => $this->input->post("full_name"),
                "email" => $this->input->post("email"),
                "password" => md5($this->input->post("password")),

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
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url("users"));
            die();
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
        $item = $this->user_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update_password_form($id)
    {

        $viewData = new stdClass();
        /* Bazadan Products Table-den Datalarin getirilmesi*/
        $item = $this->user_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password_update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $this->load->library("form_validation");
        $oldUser = $this->user_model->get(array("id" => $id));
        if ($oldUser->user_name != $this->input->post("user_name")) {
            $this->form_validation->set_rules("user_name", "User Name", "required|trim|is_unique[users.user_name]");
        }
        if ($oldUser->email != $this->input->post("email")) {
            $this->form_validation->set_rules("email", "E-mail", "required|trim|valid_email|is_unique[users.email]");
        }

        $this->form_validation->set_rules("full_name", "Full Name", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Duzgun Email Adresi Girin Zehmet Olmasa",
                "is_unique" => "<b>{field}</b> Artiq movzuddur",
            )
        );
        $validation = $this->form_validation->run();//**

        if ($validation) {


            $update = $this->user_model->update(
                array("id" => $id), array(
                "user_name" => $this->input->post("user_name"),
                "full_name" => $this->input->post("full_name"),
                "email" => $this->input->post("email"),
            ));
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
            redirect(base_url("users"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $this->user_model->get(array(
                "id" => $id
            ));
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_password($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("password", "Password", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Password Repeat", "required|trim|min_length[6]|max_length[8]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "min_length" => "<b>{field}</b> Xanasi 6-dan az Olmamalidir",
                "max_length" => "<b>{field}</b> Xanasi 8-dan çox Olmamalidir",
                "matches" => "Daxil Etdiyiniz Sifreler Eyni Deyil",
            )
        );
        $validation = $this->form_validation->run();//**

        if ($validation) {


            $update = $this->user_model->update(
                array("id" => $id), array(
                "password" => md5($this->input->post("password")),
            ));
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
            redirect(base_url("users"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password_update";
            $viewData->form_error = true;
            $viewData->item = $this->user_model->get(array(
                "id" => $id
            ));
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $delete = $this->user_model->delete(array(
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
        redirect(base_url("users"));
    }

    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->user_model->update(array(
                "id" => $id
            ), array(
                "isActive" => $isActive
            ));
        }
    }

}