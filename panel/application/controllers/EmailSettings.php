<?php

class EmailSettings extends CI_Controller
{
    private $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "email_settings_v";
        $this->load->model("emailsettings_model");

        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        $items = $this->emailsettings_model->get_all(array(), array("id", "ASC"));
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

        $this->form_validation->set_rules("protocol", "Protocol", "required|trim");
        $this->form_validation->set_rules("host", "Host", "required|trim");
        $this->form_validation->set_rules("port", "Port", "required|trim");
        $this->form_validation->set_rules("user_name", "Email Title", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim");
        $this->form_validation->set_rules("user", "E-mail (User)", "required|trim|valid_email");
        $this->form_validation->set_rules("from", "E-mail (From)", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "E-mail (To)", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Duzgun Email Adresi Girin Zehmet Olmasa",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {

            $insert = $this->emailsettings_model->insert(array(
                "protocol" => $this->input->post("protocol"),
                "host" => $this->input->post("host"),
                "port" => $this->input->post("port"),
                "user_name" => $this->input->post("user_name"),
                "password" => $this->input->post("password"),
                "user" => $this->input->post("user"),
                "from" => $this->input->post("from"),
                "to" => $this->input->post("to"),


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
            redirect(base_url("emailsettings"));
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
        $item = $this->emailsettings_model->get(array(
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
        $this->form_validation->set_rules("protocol", "Protocol", "required|trim");
        $this->form_validation->set_rules("host", "Host", "required|trim");
        $this->form_validation->set_rules("port", "Port", "required|trim");
        $this->form_validation->set_rules("user_name", "Email Title", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim");
        $this->form_validation->set_rules("user", "E-mail (User)", "required|trim|valid_email");
        $this->form_validation->set_rules("from", "E-mail (From)", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "E-mail (To)", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Duzgun Email Adresi Girin Zehmet Olmasa",
            )
        );
        $validation = $this->form_validation->run();//**

        if ($validation) {


            $update = $this->emailsettings_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "protocol" => $this->input->post("protocol"),
                    "host" => $this->input->post("host"),
                    "port" => $this->input->post("port"),
                    "user_name" => $this->input->post("user_name"),
                    "password" => $this->input->post("password"),
                    "user" => $this->input->post("user"),
                    "from" => $this->input->post("from"),
                    "to" => $this->input->post("to"),
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
            redirect(base_url("emailsettings"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $this->emailsettings_model->get(array(
                "id" => $id
            ));
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }


    public function delete($id)
    {
        $delete = $this->emailsettings_model->delete(array(
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
        redirect(base_url("emailsettings"));
    }

    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->emailsettings_model->update(array(
                "id" => $id
            ), array(
                "isActive" => $isActive
            ));
        }
    }

}