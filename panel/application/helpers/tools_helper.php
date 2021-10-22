<?php


function convertToSeo($string, $slug = '-', $extra = null)
{
    if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false) {
        $string = html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|caron|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string), ENT_QUOTES, 'UTF-8');
    }

    if (preg_match('~[^[:ascii:]]~', $string) > 0) {
        $latin = array(
            'a' => '~[àáảãạăằắẳẵặâầấẩẫậÀÁẢÃẠĂẰẮẲẴẶÂẦẤẨẪẬą]~iu',
            'ae' => '~[ǽǣ]~iu',
            'b' => '~[ɓ]~iu',
            'c' => '~[ćċĉč]~iu',
            'd' => '~[ďḍđɗð]~iu',
            'e' => '~[èéẻẽẹêềếểễệÈÉẺẼẸÊỀẾỂỄỆęǝəɛ]~iu',
            'g' => '~[ġĝǧğģɣ]~iu',
            'h' => '~[ĥḥħ]~iu',
            'i' => '~[ìíỉĩịÌÍỈĨỊıǐĭīįİ]~iu',
            'ij' => '~[ĳ]~iu',
            'j' => '~[ĵ]~iu',
            'k' => '~[ķƙĸ]~iu',
            'l' => '~[ĺļłľŀ]~iu',
            'n' => '~[ŉń̈ňņŋ]~iu',
            'o' => '~[òóỏõọôồốổỗộơờớởỡợÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢǒŏōőǫǿ]~iu',
            'r' => '~[ŕřŗ]~iu',
            's' => '~[ſśŝşșṣ]~iu',
            't' => '~[ťţṭŧ]~iu',
            'u' => '~[ùúủũụưừứửữựÙÚỦŨỤƯỪỨỬỮỰǔŭūűůų]~iu',
            'w' => '~[ẃẁŵẅƿ]~iu',
            'y' => '~[ỳýỷỹỵYỲÝỶỸỴŷȳƴ]~iu',
            'z' => '~[źżžẓ]~iu',
        );

        $string = preg_replace($latin, array_keys($latin), $string);
    }

    return strtolower(trim(preg_replace('~[^0-9a-z' . preg_quote($extra, '~') . ']++~i', $slug, $string), $slug));
}

function getFileName($id, $model_name)
{
    $t = get_instance();
    $t->load->model($model_name);
    return $t->$model_name->get(array(
        "id" => $id
    ));
}

function get_readable_date($date)
{
    setlocale(LC_ALL, 'az_AZ.UTF-8', 'az_AZ', 'az', 'azerbaijan');
    return strftime('%e %B %Y', strtotime($date));
}

function get_active_user()
{
    $t = get_instance();
    $user = $t->session->userdata("user");
    if ($user)
        return $user;
    else
        return false;

}

function send_email($toEmail = "", $subject = "", $message = "")
{
    $t = get_instance();
    $t->load->model("emailsettings_model");
    $email_settings = $t->emailsettings_model->get(
        array(
            "isActive" => 1
        )
    );

    $config = array(
        "protocol" => $email_settings->protocol,
        "smtp_host" => $email_settings->host,
        "smtp_port" => $email_settings->port,
        "smtp_user" => $email_settings->user,
        "smtp_pass" => $email_settings->password,
        "starttls" => true,
        "charset" => "utf-8",
        "mailtype" => "html",
        "wordwrap" => true,
        "newline" => "\r\n"
    );
    $t->load->library("email", $config);
    $t->email->from($email_settings->from, $email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);
    return $t->email->send();
}

function get_settings()
{
    $t = get_instance();
    $t->load->model("settings_model");
    if ($t->session->userdata("settings")) {
        $settings = $t->session->userdata("settings");
    } else {
        $settings = $t->settings_model->get();
        if (!$settings) {
            $settings = new  stdClass();
            $settings->company_name = "CMS";
            $settings->logo = "default";

        }
        $t->session->set_userdata("settings", $settings);

    }

    return $settings;
}

function get_category_name($category_id = 0)
{
    $t = get_instance();
    $t->load->model("portfolio_category_model");
    $category = $t->portfolio_category_model->get(
        array(
            "id" => $category_id
        )
    );
    if ($category)
        return $category->title;
    else
        return "<b style='color: red'>Not Defined</b>";
}


// function get_lang($l = '')
// {
//     if (isset($_COOKIE['lang'])) {
//         if ($l == 'url_tag') {
//             return $_COOKIE['url_tag'];
//         } else {
//             return $_COOKIE['lang'];
//         }
//     } else {

//         if ($l == 'url_tag') {
//             return 'AZ';
//         } else {
//             return 1;
//         }
//     }
// }
