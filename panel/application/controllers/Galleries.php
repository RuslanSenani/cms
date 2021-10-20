<?php

class Galleries extends CI_Controller
{
    private $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "galleries_v";
        $this->load->model("gallery_model");
        $this->load->model("image_model");
        $this->load->model("file_model");
        $this->load->model("video_model");

        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();

        $items = $this->gallery_model->get_all(array(), array("rank", "ASC"));
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    // public function string()
    // {
    //     $string = array();
    //     $lang_setting = $this->gallery_model->front_read('lang_settings', array('l_id' => get_lang()));
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
        $this->form_validation->set_rules("title", "Gallery Name", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );
        $validation = $this->form_validation->run();
        if ($validation) {
            $gallery_type = $this->input->post("gallery_type");
            $path = "uploads/$this->viewFolder";
            $folder_name = convertToSeo($this->input->post("title"));
            if ($gallery_type == "image") {
                $path = "$path/images/$folder_name";
            } elseif ($gallery_type == "file") {
                $path = "$path/files/$folder_name";
            }
            if ($gallery_type != "video") {
                if (!mkdir($path, 0755)) {
                    $alert = array(
                        "title" => "Error Created Gallery will be from DB",
                        "text" => "Error Created Gallery will be from DB (Permissions Errors)",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("galleries"));
                    die();
                }
            }

            $insert = $this->gallery_model->insert(array(
                "title" => $folder_name,
                "gallery_type" => $gallery_type,
                "url" => convertToSeo($this->input->post("title")),
                "folder_name" => $folder_name,
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
            redirect(base_url("galleries"));
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
        $item = $this->gallery_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id, $gallery_type, $oldFolderName = "")
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Gallery Name", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {

            $path = "uploads/$this->viewFolder";
            $folder_name = convertToSeo($this->input->post("title"));
            if ($gallery_type == "image") {
                $path = "$path/images";
            } elseif ($gallery_type == "file") {
                $path = "$path/files";
            }
            if ($gallery_type != "video") {
                if (!rename("$path/$oldFolderName", "$path/$folder_name")) {
                    $alert = array(
                        "title" => "Error Created Gallery will be from DB",
                        "text" => "Error Created Gallery will be from DB (Permissions Errors)",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("galleries"));
                    die();
                }
            }

            $update = $this->gallery_model->update(array(
                "id" => $id
            ), array(
                "title" => $this->input->post("title"),
                "folder_name" => $folder_name,
                "url" => convertToSeo($this->input->post("title"))

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
            redirect(base_url("galleries"));
        } else {
            $item = $this->gallery_model->get(array(
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
        $gallery = $this->gallery_model->get(
            array(
                "id" => $id
            )
        );
        if ($gallery) {
            if ($gallery->gallery_type != "video") {
                if ($gallery->gallery_type == "image")
                    $path = "uploads/$this->viewFolder/images/$gallery->folder_name";
                elseif ($gallery->gallery_type == "file")
                    $path = "uploads/$this->viewFolder/files/$gallery->folder_name";
                $deleted_folder = rmdir($path);
                if (!$deleted_folder) {
                    $alert = array(
                        "title" => "Error Delete Title will be from DB",
                        "text" => "Error Delete Text will be from DB",
                        "type" => "error"
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url("galleries"));
                    die();
                }
            }
            $delete = $this->gallery_model->delete(array(
                "id" => $id
            ));
            if ($delete) {
                $alert = array(
                    "title" => "Success Delete Title will be from DB",
                    "text" => "Success Delete Text will be from DB",
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
            redirect(base_url("galleries"));
        }
    }

    public function fileDelete($id, $parent_id, $gallery_type)
    {
        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";
        $fileName = getFileName($id, $modelName);
        $delete = $this->$modelName->delete(array(
            "id" => $id
        ));

        if ($delete) {
            unlink($fileName->url);
            redirect(base_url("galleries/uploads_form/$parent_id"));
        } else {
            redirect(base_url("galleries/uploads_form/$parent_id"));
        }
    }

    public function isActiveSetter($id)
    {

        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->gallery_model->update(array(
                "id" => $id
            ), array(
                "isActive" => $isActive
            ));
        }
    }


    public function fileIsActiveSetter($id, $gallery_type)
    {
        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->$modelName->update(array(
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
            $this->gallery_model->update(
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

    public function fileRankSetter($gallery_type)
    {
        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->$modelName->update(
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

    public function uploads_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $item = $this->gallery_model->get(array(
            "id" => $id
        ));
        $viewData->item = $item;
        if ($item->gallery_type == "image") {
            $viewData->items = $this->image_model->get_all(array(
                "gallery_id" => $id
            ), array("rank", "ASC"));
        } elseif ($item->gallery_type = "file") {
            $viewData->items = $this->file_model->get_all(array(
                "gallery_id" => $id
            ), array("rank", "ASC"));
        } else {
            $viewData->items = $this->video_model->get_all(array(
                "gallery_id" => $id
            ), array("rank", "ASC"));
        }

        $viewData->gallery_type = $item->gallery_type;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function file_upload($gallery_id, $gallery_type, $folderName)
    {
        $config = array(
            "allowed_types" => "jpg|jpeg|png|pdf|doc|docx",
            "upload_path" => ($gallery_type == "image") ? "uploads/$this->viewFolder/images/$folderName/" : "uploads/$this->viewFolder/files/$folderName/",
            "encrypt_name" => true
        );

        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("file");
        if ($upload) {
            $uploaded_file = $this->upload->data("file_name");
            $modelName = ($gallery_type == "image") ? "image_model" : "file_model";

            $this->$modelName->insert(array(
                "url" => "{$config['upload_path']}$uploaded_file",
                "gallery_id" => $gallery_id
            ));
        } else {
            echo "Faild";
        }
    }

    public function refresh_file_list($gallery_id, $gallery_type)
    {

        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";
        $viewData->items = $this->$modelName->get_all(array(
            "gallery_id" => $gallery_id
        ));
        $viewData->gallery_type = $gallery_type;
        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/file_list_v", $viewData,
            true);
        echo $render_html;
    }


    public function gallery_video_list($id)
    {
        $viewData = new stdClass();
        $gallery = $this->gallery_model->get(array('id' => $id));
        $items = $this->video_model->get_all(
            array(
                "gallery_id" => $id

            ), array(
            "rank", "ASC"
        ));
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/list";
        $viewData->items = $items;
        $viewData->gallery = $gallery;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_gallery_video_form($id)
    {
        $viewData = new stdClass();
        $viewData->gallery_id = $id;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/add";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gallery_video_insert($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "Video  URL", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );
        $validation = $this->form_validation->run();
        if ($validation) {

            $insert = $this->video_model->insert(array(
                "url" => $this->input->post("url"),
                "gallery_id" => $id
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
            redirect(base_url("galleries/gallery_video_list/$id"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->gallery_id = $id;
            $viewData->subViewFolder = "video/add";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_gallery_video_form($id)
    {
        $viewData = new stdClass();
        $item = $this->video_model->get(array(
            "id" => $id
        ));

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gallery_video_update($id, $gallery_id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "Video URL", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Bolmesi Doldurulmalidir Bura Bazadan Tercumeler Gelecek",
            )
        );

        $validation = $this->form_validation->run();

        if ($validation) {
            $update = $this->video_model->update(array(
                "id" => $id
            ), array(
                "url" => $this->input->post("url"),
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
            redirect(base_url("galleries/gallery_video_list/$gallery_id"));
        } else {
            $item = $this->video_model->get(array(
                "id" => $id
            ));
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "video/update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function rankGalleryVideoSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->video_model->update(
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

    public function galleryVideoIsActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->video_model->update(array(
                "id" => $id
            ), array(
                "isActive" => $isActive
            ));
        }
    }

    public function galleryVideoDelete($id,$gallery_id)
    {
        $delete = $this->video_model->delete(array(
            "id" => $id
        ));
        if ($delete) {
            $alert = array(
                "title" => "Success Delete Title will be from DB",
                "text" => "Success Delete Text will be from DB",
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
        redirect(base_url("galleries/gallery_video_list/$gallery_id"));

    }


}