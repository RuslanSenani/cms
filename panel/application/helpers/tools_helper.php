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
