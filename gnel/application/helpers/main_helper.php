<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function treealize($items, $identifier = 'id', $parentIdentifier = 'parent_id', $parentId = null) {
    $results = array();

    if (is_array($items) && count($items) > 0) {
        foreach ($items as $item) {
            if (is_object($item)) {
                if ($item->$parentIdentifier === $parentId) {
                    $children = treealize($items, $identifier, $parentIdentifier, $item->$identifier);
                    if (sizeof($children) > 0)
                        $item->children = $children;
                    $results[] = $item;
                }
            } else {
                if ($item[$parentIdentifier] === $parentId) {
                    $children = treealize($items, $identifier, $parentIdentifier, $item[$identifier]);
                    if (sizeof($children) > 0)
                        $item["children"] = $children;
                    $results[] = $item;
                }
            }
        }
    }

    return $results;
}

function cmp($a, $b) {
    if (is_array($a)) {
        if ($a['ordering'] == $b['ordering']) {
            return 0;
        }

        return ($a['ordering'] < $b['ordering']) ? -1 : 1;
    } else if (is_object($a)) {
        if ($a->order == $b->order) {
            return 0;
        }

        return ($a->order < $b->order) ? -1 : 1;
    }
}

function Sort_Multidimension_Array(&$categories_tree) {

    usort($categories_tree, "cmp");

    foreach ($categories_tree as &$v) {
        if (is_array($v)) {
            if (isset($v['children'])) {
                Sort_Multidimension_Array($v['children']);
            }
        } else {
            if (isset($v->children)) {
                Sort_Multidimension_Array($v->children);
            }
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
                    </a>
                </div>";
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

function getChildCategories($categories) {
    static $children = array();
    static $name = '';
    foreach ($categories as $key => $category) {
        if (isset($category['children'])) {
            $name .= $category['name'] . ' � ';
            getChildCategories($category['children']);
        } else {
            $children[$category['id']] = $name . $category['name'];
            $name = '';
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

function getParentArray($tree, $key, $val = array()) {
    $arr = array();
    if (!empty($val)) {
        foreach ($tree AS $item) {
            if ($item->$key == $val) {
                $arr = array($item->$key => $item->name) + $arr;
                return $arr;
            }
            if (isset($item->children)) {
                $arr = getParentArray($item->children, $key, $val);
                if (!empty($arr)) {
                    $arr = array($item->$key => $item->name) + $arr;
                    return $arr;
                }
            }
        }
    }

    return $arr;
}

function thumbImg($url, $width = 100, $height = 100, $quality = '100') {
    if(isset($_GET['dev'])) {

        $size = getimagesize($url);
        $orig_width = $size[0];
        $orig_height = $size[1];

        if($orig_width != $orig_height) {
            if($orig_width > $orig_height) {
                $width_diff = $orig_width / $width;
                $height = intval($orig_height / $width_diff);
            } else {
                $heigth_diff = $orig_height / $height;
                $width = intval($orig_width / $heigth_diff);
            }
        }
    }
    //$url = base_url($url);
    return base_url("timthumb/timthumb.php?src=$url&w=$width&h=$height&q=$quality");
}

function prodImg($id, $image) {
    return base_url("images/product/" . $id . "/" . $image);
}

function pageImg($id, $image) {
    return base_url("images/pages/" . $image);
}

function brandImg($image) {
    return base_url("images/brand/" . $image);
}

function partnerImg($image) {
    return base_url("images/partner/" . $image);
}

function userImg($user_id, $image) {
    $url = $image != '' ? "images/users/" . $user_id . "/" . $image : "images/icons/user-icon.png";

    return base_url($url);
}

function drawLeftMenu($categories, $parent_categories_array, $f = false) {
    // echo "<pre>"; var_dump($categories); exit;
    $c_cat = count($categories);
    $html = '<ul ' . ($f ? 'class="box-category"' : '') . '>';
    foreach ($categories AS $k => $category) {
        if ($category->product_count > 0) {
            $html .= '<li ' . ($c_cat == $k + 1 ? 'class="last-item"' : '') . '>';
            if (isset($category->children)) {
                $html .= '<a href="" ' . (array_key_exists($category->id, $parent_categories_array) ? 'class="active"' : '') . '>' . $category->name . '</a>';
                $html .= drawLeftMenu($category->children, $parent_categories_array);
            } else {
                $html .= '<a href="' . category_url($category->id, $category->name) . '" ' . (array_key_exists($category->id, $parent_categories_array) ? 'class="active"' : '') . '>' . $category->name . ' (' . $category->product_count . ')</a>';
            }
            $html .= '</li>';
        }
    }
    $html .= '</ul>';

    return $html;
}

function product_url($product_id, $product_name) {
    $url = 'product/';
    $name = $product_name . '-p' . $product_id . '.html';
    $str_remove = str_split(' _~:/?#[]@!$&\'"()*+,;=');
    $name = str_replace($str_remove, '-', $name);

    $name = preg_replace('/[\s-]+/', '-', $name);
    $product_url = site_url($url . $name);
    return $product_url;
}

function category_url($category_id, $category_name) {
    $url = '';
    $url = 'category/' . $category_name . '-c' . $category_id . '.html';

    $url = str_replace(' ', '-', $url);
    $url = str_replace(',', '', $url);
    $url = site_url($url);
    return $url;
}
function blognews_url($blog_id, $blog_name) {
    $url = '';
    $url = 'blognews/'. $blog_name . '-b' . $blog_id . '.html';

    $url = str_replace(' ', '-', $url);
    $url = str_replace(',', '', $url);
    $url = site_url($url);
    return $url;
}
function brand_url($brand_id, $brand_name) {
    $url = '';
    $url = 'brand/' . $brand_name . '-b' . $brand_id . '.html';

    $url = str_replace(' ', '-', $url);
    $url = site_url($url);
    return $url;
}

function drawMenu($top_menu_pages, $attributes = array()) {
    $attr = '';
    if (count($attributes) > 0) {
        foreach ($attributes AS $key => $val) {
            $attr .=$key . '="' . $val . '" ';
        }
    }
    $html = '<ul ' . $attr . '>';
    $i = 1;
    $count = count($top_menu_pages);
    if ($count > 0) {
        foreach ($top_menu_pages AS $page) {
            $i++;
            if($page->parent_id == 0) {
                $html .= '<li' . ($i == $count ? ' class="last-item"' : '') . '>';

                //var_dump(strpos($page->url, 'http://'));echo "<br/>";
                if (strpos($page->url, '/') === 0) {
                    $url = site_url($page->url);
                } else if (strpos($page->url, 'http://') === 0) {
                    $url = $page->url;
                } else {
                    $url = site_url('page/' . $page->url);
                }
                $html .= '<a href="' . $url . '">' . $page->title . '</a>';
                if (isset($page->children)) {
                    $html .= drawMenu($page->children);
                }
                $html .= '</li>';
            }

        }
    }
    $html .= '</ul>';
    return $html;
}



function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function converArmToLatin($armtext) {
    $arm = array('??', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
        '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '??', '??', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
        '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '??', '?', '?');
    $lat = array('u', 'a', 'b', 'g', 'd', 'e', 'z', 'e', '@', 't', 'j', 'i', 'l', 'x', 'c', 'k', 'h', 'dz', 'x', 'ch', 'm', 'y', 'n', 'sh', 'o', 'ch', 'p', 'j',
        'r', 's', 'v', 't', 'r', 'c', 'p', 'q', 'ev', 'o', 'f', 'U', 'U', 'A', 'B', 'G', 'D', 'E', 'Z', 'E', '@', 'T', 'J', 'I', 'L', 'X', 'C', 'K', 'H', 'Dz', 'X',
        'Ch', 'M', 'Y', 'N', 'Sh', 'O', 'Ch', 'P', 'J', 'R', 'S', 'V', 'T', 'R', 'C', 'P', 'Q', 'Ev', 'O', 'F');
    //$textcyr = str_replace($cyr, $lat, $textcyr);
    //$textlat = str_replace($lat, $cyr, $textlat);
    $result = str_replace($arm, $lat, $armtext);
    return $result;
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// function to add index.html forbidden file to all folders
function addHTMLFileToAllFolders() {
    $path = FCPATH;
    $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

    foreach ($files as $file => $mykey) {
        if (is_dir($file)) {

            $directory = $file;
            $dest = $directory. "/index.html";
            $source = $path . "system/index.html";
            if(is_file($source)) {
                copy($source, $dest);
            }
        }
    }



    echo "<br/><br/>";
    echo 888888888888888888888888888;
    exit;
}


// function to convert all product images square size
function convertAllProductImagesToSquare() {
    $path = FCPATH . 'images/product/';
    $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

    foreach ($files as $file => $mykey) {
        if (!is_dir($file)&& exif_imagetype($file) == 2) {
//            echo $file . "<br/>";
            convertImgToRectangle($file);
        }
    }



    echo "<br/><br/>";
    echo 888888888888888888888888888;
    exit;
}


function convertImgToRectangle($src) {
    list($width_orig, $height_orig) = getimagesize($src);
    if ($width_orig != $height_orig) {
        //$src = 'http://new.babybuy.am/images/product/305/744c7f7675fec2083728d79f771c0b75.jpg';

        if ($width_orig > $height_orig) { // horizontal image
            $background = imagecreatetruecolor($width_orig, $width_orig);
            $whiteBackground = imagecolorallocate($background, 255, 255, 255);
            imagefill($background, 0, 0, $whiteBackground);
            $src_image = imagecreatefromjpeg($src);
            imagecopymerge($background, $src_image, ($width_orig - $width_orig) / 2, ($width_orig - $height_orig) / 2, 0, 0, $width_orig, $height_orig, 100);
        } else if ($width_orig < $height_orig) {
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
        resize_image($src, 1200, 1200);
    }
}

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}