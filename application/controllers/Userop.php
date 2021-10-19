<?php

class Userop extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");


    }

    public function login()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $this->load->library("form_validation");
        $this->form_validation->set_rules("user_email", "E-mail", "required|trim|valid_email");
        $this->form_validation->set_rules("user_password", "Password", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "min_length" => "<b>{field}</b> Xanasi 6-dan az Olmamalidir",
                "max_length" => "<b>{field}</b> Xanasi 8-dan çox Olmamalidir",
                "valid_email" => "Duzgun Email Adresi Girin Zehmet Olmasa",
            )
        );
        if ($this->form_validation->run() == false) {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        } else {
            $user = $this->user_model->get(
                array(
                    "email" => $this->input->post("user_email"),
                    "password" => md5($this->input->post("user_password")),
                    "isActive" => 1,
                )
            );
            if ($user) {

                $alert = array(
                    "title" => "Success Login",
                    "text" => "Welcome {$user->full_name}",
                    "type" => "success"
                );
                $this->session->set_flashdata("alert", $alert);
                $this->session->set_userdata("user", $user);
                redirect(base_url());
            } else {
                $alert = array(
                    "title" => "Success Failed",
                    "text" => "Please check your info",
                    "type" => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("login"));
            }


        }
    }

    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url("login"));
    }


    public function forget_password()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function reset_password()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "E-mail", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
                "valid_email" => "Duzgun <b>Email</b> Adresi Girin Zehmet Olmasa",
            )
        );
        if ($this->form_validation->run() == false) {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        } else {
            $user = $this->user_model->get(
                array(
                    "isActive" => 1,
                    "email" => $this->input->post("email")
                )
            );

            if ($user) {
                $this->load->helpers("string");
                $temp_password = random_string('alnum', 8);
                $send = send_email($user->email, "Forget Password", "Your Temporary CMS Passwords: <b>{$temp_password}</b>");
                if ($send) {
                    $this->user_model->update(
                        array(
                            "id" => $user->id
                        ),
                        array(
                            "password" => md5($temp_password)
                        )
                    );
                    $alert = array(
                        "title" => "Email Sent",
                        "text" => "Please check your email <b>$user->email</b>",
                        "type" => "success"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("login"));
                    die();
                } else {
                    $alert = array(
                        "title" => "Not Sent",
                        "text" => "E-mail Not Sent",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("reset-password"));
                    die();
                }

            } else {
                $alert = array(
                    "title" => "Error",
                    "text" => "Not Found !!!",
                    "type" => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("reset-password"));
            }
        }

    }
}