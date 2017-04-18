<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('editor')) {

    function editor($name = 'default_name', $id = 'default_id', $text = null) {
        include("editor/index.php");
    }

}

function ckeditor($name = 'default_name', $id = 'default_id', $text = null) {
    include("ckeditor/index.php");
}

function treealize($items, $identifier = 'id', $parentIdentifier = 'parent_id', $parentId = null) {
    $results = array();

    if (is_array($items) && count($items) > 0) {
        foreach ($items as $item) {
            if ($item[$parentIdentifier] === $parentId) {
                $children = treealize($items, $identifier, $parentIdentifier, $item[$identifier]);
                if (sizeof($children) > 0)
                    $item["children"] = $children;
                $results[] = $item;
            }
        }
    }

    return $results;
}

function cmp($a, $b) {
    if ($a['order'] == $b['order']) {
        return 0;
    }

    return ($a['order'] < $b['order']) ? -1 : 1;
}

function Sort_Multidimension_Array(&$categories_tree) {
    usort($categories_tree, "cmp");

    foreach ($categories_tree as &$v) {
        if (isset($v['children'])) {
            Sort_Multidimension_Array($v['children']);
        }
    }

    return $categories_tree;
}

function get_menu_html($categories, $attributes = array(), $is_admin = true, $flag = true, $level = 1) {
    $ci = & get_instance();
    $attributes_str = "";

    if (!empty($attributes)) {
        foreach ($attributes as $k => $v) {
            $attributes_str .= $k . "='" . $v . "' ";
        }
    }

    if ($is_admin) {
        $html = "";
        if ($flag) {
            $html = "<div " . $attributes_str . ">";
        }
        $html .= "<ol class='dd-list'>";
        foreach ($categories as $item) {
            $html .= "<li id=" . $item['id'] . " class='dd-item dd3-item' data-id='" . $item['id'] . "'>
                <div class='dd-handle dd3-handle'>Drag</div>
                <div class='dd3-content'>" . $item['name'] . "
                    <span url='" . $item['id'] . "' item_title = '" . $item['name'] . "' item_id = '" . $item['id'] . "' class='delete btn btn-mini btn-danger remove_menu_item'><i class='icon-trash icon-white'></i>" . $ci->lang->line('Delete') . "</span>
                    <span url='/menuitem/edit/" . $item['id'] . "' item_title = '" . $item['name'] . "' item_id = '" . $item['id'] . "' external = '" . $item['url'] . "' class='edit btn btn-mini btn-info edit_menu_item'><i class='icon-edit icon-white'></i>" . $ci->lang->line('Edit') . "</span>
                </div>";
            if (isset($item['children'])) {
                $html .= get_menu_html($item['children'], array(), $is_admin, false);
            }
            $html .= "</li>";
        }
        $html .= "</ol><div class='clr'></div>";
        if ($flag) {
            $html .= "</div>";
        }
    } else {
        $html = "<ul>";
        if ($flag) {
            $html = "<ul " . $attributes_str . ">";
        }
        foreach ($categories as $category) {
            $html .= "<li>";
            $html .= "<a href='" . $category['url'] . "'>" . $category['name'] . "</a>";
            $html .= "</li>";
        }
        $html .= "</ul>";
    }
    return $html;
}

function get_category_html($categories, $attributes = array(), $is_admin = true, $flag = true, $level = 1) {
    $ci = & get_instance();
    $attributes_str = "";

    if (!empty($attributes)) {
        foreach ($attributes as $k => $v) {
            $attributes_str .= $k . "='" . $v . "' ";
        }
    }

    if ($is_admin) {
        $html = "";
        if ($flag) {
            $html = "<div " . $attributes_str . ">";
        }
        $html .= "<ol class='dd-list'>";
        foreach ($categories as $item) {
            $html .= "<li id=" . $item['id'] . " class='dd-item dd3-item' data-id='" . $item['id'] . "'>
                <div class='dd-handle dd3-handle'>Drag</div>
                <div class='dd3-content'>" . $item['name'] . "
                    <span url='" . $item['id'] . "' item_title = '" . $item['name'] . "' item_id = '" . $item['id'] . "' class='delete btn btn-mini btn-danger remove_menu_item'><i class='icon-trash icon-white'></i>" . $ci->lang->line('Delete') . "</span>
                    <a href='" . site_url('/category/edit/' . $item['id']) . "'>
                        <span url='" . $item['id'] . "' item_title = '" . $item['name'] . "' item_id = '" . $item['id'] . "' class='edit btn btn-mini btn-info edit_menu_item'><i class='icon-edit icon-white'></i>" . $ci->lang->line('Edit') . "</span>
                    </a>";
            if ($item['status'] == "1") {
                $html .=$item['status'] . '<span class="label-success label label-default" action="disable" id="' . $item['id'] . '" status="change" title="' . $ci->lang->line('Press to ban') . '" style="cursor: pointer; float: right;">' . $ci->lang->line('Active') . '</span>';
            } else {
                $html .= '<span class="label-default label label-danger"  action="enable" id="' . $item['id'] . '" status="change" title="' . $ci->lang->line('Press to activate') . '" style="cursor: pointer; float: right;">' . $ci->lang->line('Banned') . '</span>';
            }
            $html .= "</div>";
            if (isset($item['children'])) {
                $html .= get_category_html($item['children'], array(), $is_admin, false);
            }
            $html .= "</li>";
        }
        $html .= "</ol><div class='clr'></div>";
        if ($flag) {
            $html .= "</div>";
        }
    }
    return $html;
}

function getChildCategories($categories, $name_ = '') {
    static $children = array();

    foreach ($categories as $key => $category) {
        $name = $name_;
        if (isset($category['children'])) {
            $name .= $category['name'] . ' » ';
            getChildCategories($category['children'], $name);
        } else {
            $children[$category['id']] = $name . $category['name'];
            $name = $name_;
        }
    }

    return $children;
}

function printTree($Items) {
    $html = "";

    $html .= "<ol>";
    foreach ($Items as $Item) {
        $html .= "<li id=" . $Item['id'] . ">" . $Item['name'] . "</li>";
        if (array_key_exists('children', $Item)) {
            $html .= printTree($Item['children']);
        }
    }
    $html .= "</ol>";

    return $html;
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

function thumbImg($url, $width = 100, $height = 100, $quality = '80') {
    $CI = & get_instance();
    return $CI->config->item('frontend_url') . "timthumb/timthumb.php?src=$url&h=$width&w=$height&q=$quality";
}

function prodImg($id, $image) {
    $CI = & get_instance();
    $img_url = $image != '' ? $CI->config->item('frontend_url') . 'images/product/' . $id . '/' . $image : base_url('img/NoPicture.jpg');
    return $img_url;
}

function blogImg($id, $image) {
    $CI = & get_instance();
    $img_url = $image != '' ? $CI->config->item('frontend_url') . 'images/blognews/' . $image : base_url('img/NoPicture.jpg');
    return $img_url;
}
function pageImg($id, $image) {
    $CI = & get_instance();
    $img_url = $image != '' ? $CI->config->item('frontend_url') . 'images/pages/' . $id . '/' . $image : base_url('img/NoPicture.jpg');
    return $img_url;
}

function brandImg($image) {
    return base_url("images/brand/" . $image);
}

function userImg($id, $image) {
    $CI = & get_instance();
    $img_url = $image != '' ? $CI->config->item('frontend_url') . 'images/users/' . $id . '/' . $image : base_url('img/user-icon.png');
    return $img_url;
}

function product_url($product_id, $product_name) {
    $CI = & get_instance();
    $url = 'product/';
    $name = $product_name . '-p' . $product_id . '.html';
    $str_remove = str_split(' _~:/?#[]@!$&\'"()*+,;=');
    $name = str_replace($str_remove, '-', $name);

    $name = preg_replace('/[\s-]+/', '-', $name);
    $product_url = $CI->config->item('frontend_url') . $url . $name;
    return $product_url;
}

function product_admin_url($product_id, $product_name) {
    $CI = & get_instance();
    $url = 'product/edit/';

    $product_admin_url = $CI->config->item('base_url') . $url . $product_id;
    return $product_admin_url;
}

function blognews_url($product_id, $product_name) {
    $CI = & get_instance();
    $url = 'blognews/';
    $name = $product_name . '-b' . $product_id . '.html';
    $str_remove = str_split(' _~:/?#[]@!$&\'"()*+,;=');
    $name = str_replace($str_remove, '-', $name);

    $name = preg_replace('/[\s-]+/', '-', $name);
    $product_url = $CI->config->item('frontend_url') . $url . $name;
    return $product_url;
}

function converArmToLatin($armtext) {
    $arm = array('ու', 'ա', 'բ', 'գ', 'դ', 'ե', 'զ', 'է', 'ը', 'թ', 'ժ', 'ի', 'լ', 'խ', 'ծ', 'կ', 'հ', 'ձ', 'ղ', 'ճ', 'մ', 'յ', 'ն', 'շ', 'ո', 'չ', 'պ', 'ջ',
        'ռ', 'ս', 'վ', 'տ', 'ր', 'ց', 'փ', 'ք', 'և', 'օ', 'ֆ', 'Ու', 'ՈՒ', 'Ա', 'Բ', 'Գ', 'Դ', 'Ե', 'Զ', 'Է', 'Ը', 'Թ', 'Ժ', 'Ի', 'Լ', 'Խ', 'Ծ', 'Կ', 'Հ', 'Ձ', 'Ղ',
        'Ճ', 'Մ', 'Յ', 'Ն', 'Շ', 'Ո', 'Չ', 'Պ', 'Ջ', 'Ռ', 'Ս', 'Վ', 'Տ', 'Ր', 'Ց', 'Փ', 'Ք', 'Եվ', 'Օ', 'Ֆ');
    $lat = array('u', 'a', 'b', 'g', 'd', 'e', 'z', 'e', '@', 't', 'j', 'i', 'l', 'x', 'c', 'k', 'h', 'dz', 'x', 'ch', 'm', 'y', 'n', 'sh', 'o', 'ch', 'p', 'j',
        'r', 's', 'v', 't', 'r', 'c', 'p', 'q', 'ev', 'o', 'f', 'U', 'U', 'A', 'B', 'G', 'D', 'E', 'Z', 'E', '@', 'T', 'J', 'I', 'L', 'X', 'C', 'K', 'H', 'Dz', 'X',
        'Ch', 'M', 'Y', 'N', 'Sh', 'O', 'Ch', 'P', 'J', 'R', 'S', 'V', 'T', 'R', 'C', 'P', 'Q', 'Ev', 'O', 'F');
    //$textcyr = str_replace($cyr, $lat, $textcyr);
    //$textlat = str_replace($lat, $cyr, $textlat);

    return str_replace($arm, $lat, $armtext);
}

function utf8_converter($array) {
    array_walk_recursive($array, function(&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });

    return $array;
}

function utf8_encode_deep(&$input) {
    if (is_string($input)) {
        $input = utf8_encode($input);
    } else if (is_array($input)) {
        foreach ($input as &$value) {
            utf8_encode_deep($value);
        }

        unset($value);
    } else if (is_object($input)) {
        $vars = array_keys(get_object_vars($input));

        foreach ($vars as $var) {
            utf8_encode_deep($input->$var);
        }
    }
}

function trim_array($data) {
    foreach ($data AS $k => $v) {
        if (is_string($v)) {
            $data[$k] = trim($v);
        }
    }

    return $data;
}

function getProductsArrayList($products) {
    $arr = array();
    if (!empty($products)) {
        foreach ($products AS $product) {
            array_push($arr, $product->id);
        }
    }

    return $arr;
}

function convertImgToRectangle($src) {
    list($width_orig, $height_orig, $img_type) = getimagesize($src);
    if($img_type == '3') {
        convertImgToJpg($src);
    }
//    convertImage($src, $src, 100);
    if ($width_orig != $height_orig) {
        if ($width_orig > $height_orig) { // horizontal image
            $background = imagecreatetruecolor($width_orig, $width_orig);
            $whiteBackground = imagecolorallocate($background, 255, 255, 255);
            imagefill($background, 0, 0, $whiteBackground);
            $src_image = imagecreatefromjpeg($src);
            imagecopymerge($background, $src_image, ($width_orig - $width_orig) / 2, ($width_orig - $height_orig) / 2, 0, 0, $width_orig, $height_orig, 100);
        } else if ($width_orig < $height_orig) { // vertical large
            $background = imagecreatetruecolor($height_orig, $height_orig);
            $whiteBackground = imagecolorallocate($background, 255, 255, 255);
            imagefill($background, 0, 0, $whiteBackground);
            $src_image = imagecreatefromjpeg($src);
            imagecopymerge($background, $src_image, ($height_orig - $width_orig) / 2, ($height_orig - $height_orig) / 2, 0, 0, $width_orig, $height_orig, 100);
        }
        ImageJpeg($background, $src, 100);
    }
    
    //make smaller image, if exceeds 1200px
    $max_size = intval(max($width_orig, $height_orig));

    if($max_size > 1200) {
        resizeImage($src, 1200, 1200);
    }
}

function convertImgToJpg($image) {
    $input_file = $image;
    $output_file = $image;
    $input = imagecreatefrompng($input_file);
    list($width, $height) = getimagesize($input_file);
    $output = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($output,  255, 255, 255);
    imagefilledrectangle($output, 0, 0, $width, $height, $white);
    imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
    imagejpeg($output, $output_file);
}

function resizeImage($file, $w, $h) {
    $n_image = new Imagick();
    $n_image->readImage($file);    
    $n_image->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
    $n_image->writeImage($file);
    $n_image->clear();
    $n_image->destroy(); 
}


