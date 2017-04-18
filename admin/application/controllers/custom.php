<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Custom extends Main_controller {

    function __construct() {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect(site_url('login'));
        }
        $this->load->model('CustomPostTypeModel');
    }

    public $layout = "default";
    public $data = array();

    public function index($post_type = false, $action = false, $post_id = false) {
        $this->data['selected_table_name'] = $post_type;
        $this->data['custom_field'] = $this->CustomPostTypeModel->customField($post_type);
        $this->data['custom_field_t'] = $this->CustomPostTypeModel->customFieldTranslation($post_type);
        $array_languages = array();
        $array_custom = array();
        $array_custom_t = array();
        $this->data['default_language'] = $this->CustomPostTypeModel->getDefaultLanguage();
        //var_dump($this->data['default_language']['value']);exit;
        $this->data['languages'] = $this->CustomPostTypeModel->getAllLanguages('languages');
        if ($post_type) {
            $exist_post_type = $this->CustomPostTypeModel->existPostType($post_type);
            if (!$exist_post_type) {
                show_404();
            } else if ($post_type && !$action) {
                $exist_post_type = $this->CustomPostTypeModel->existPostType($post_type);
                if ($exist_post_type) {
                    $this->data['selected_table_name'] = $post_type;
                    $this->data['all_post'] = $this->CustomPostTypeModel->getAllPostType($post_type);
                    $this->data['all_post_default_leng'] = $this->CustomPostTypeModel->getAllPostTypeDefaultLeng($post_type,$this->data['default_language']['value']);
                    $this->data['post_field_data'] = $this->CustomPostTypeModel->getPostTypeFieldData($post_type);                    
                    $this->load->view('post_type/show_post', $this->data);
                } else {
                    show_404();
                }
            } else {
                if ($action == 'add') {
                    if (isset($_POST['submit'])) {
                        $last_id = $this->CustomPostTypeModel->last_id($post_type);
                        $i = 0;
                        foreach ($this->data['custom_field'] as $index => $value) {
                            if ($index < 2) {
                                continue;
                            }
                            $pos = strripos($value, '_');
                            $field_name = substr($value, 0, $pos);
                            $field_type = substr($value, $pos + 1);
                            if ($field_type == 'file') {
                                $i++;
                                $userfile = $field_name;
                                $folder = ltrim($post_type, 'custom_') . '/' . $last_id . '/';
                                $upload_data = $this->_do_upload($userfile, $folder);
                                if (!isset($upload_data['error'])) {
                                    $img_name = $upload_data['upload_data']['file_name'];
                                    $file_url[$i] = $folder . $img_name;
                                } else {
                                    $file_url[$i] = 'no-img.jpg';
                                }
                            }
                        }
                        $j = 0;
                        $k = 0;
                        foreach ($this->data['languages'] as $element) {
                            $j++;
                            foreach ($this->data['custom_field_t'] as $index => $value) {
                                if ($index < 3) {
                                    continue;
                                }
                                $pos = strripos($value, '_');
                                $field_name = substr($value, 0, $pos);
                                $field_type = substr($value, $pos + 1);
                                if ($field_type == 'file') {
                                    $k++;
                                    $userfile = $element->code . '_' . $field_name;
                                    $folder = ltrim($post_type, 'custom_') . '/' . $last_id . '/' . $element->code . '/';
                                    $upload_data = $this->_do_upload($userfile, $folder);
                                    if (!isset($upload_data['error'])) {
                                        $file_name = $upload_data['upload_data']['file_name'];
                                        $file_url_t[$j][$k] = $folder . $file_name;
                                    } else {
                                        $file_url_t[$j][$k] = 'no-img.jpg';
                                    }
                                }
                            }
                        }
                        $i = 0;
                        foreach ($this->data['custom_field'] as $index => $value) {
                            if ($index < 1) {
                                continue;
                            }
                            if ($index == 1) {
                                $array_custom[$value] = $this->input->post('achievable', true);
                                continue;
                            }
                            $pos = strripos($value, '_');
                            $field_name = substr($value, 0, $pos);
                            $field_type = substr($value, $pos + 1);
                            if ($field_type == 'file') {
                                $i++;
                                $array_custom[$value] = $file_url[$i];
                                continue;
                            }
                            $array_custom[$value] = $this->input->post($field_name, true);
                        }
                        $default_id = $last_id;
                        $j = 0;
                        $k = 0;
                        foreach ($this->data['languages'] as $element) {
                            $j++;
                            foreach ($this->data['custom_field_t'] as $index => $value) {
                                $pos = strripos($value, '_');
                                $field_name = substr($value, 0, $pos);
                                $field_type = substr($value, $pos + 1);
                                if ($index < 3) {
                                    continue;
                                }
                                if ($field_type == 'file') {
                                    $k++;
                                    $array_custom_t[$value] = $file_url_t[$j][$k];
                                    continue;
                                }
                                $array_custom_t[$value] = $this->input->post($element->code . '_' . $field_name, true);
                            }
                            $array_languages[$element->code] = $array_custom_t;
                        }
                        $this->CustomPostTypeModel->insertPostType($post_type, $default_id, $array_custom, $array_languages);
                    }
                    $this->load->view('post_type/add', $this->data);
                } else if ($action == 'edit') {
                    $exist_post_id = $this->CustomPostTypeModel->existPostId($post_type, $post_id);
                    if ($exist_post_id) {
                        $this->data['selected_table_name'] = $post_type;
                        $this->data['post_id'] = $post_id;
                        $this->data['edit_translation_post'] = $this->CustomPostTypeModel->getEditTranslationPostType($post_type, $post_id);
                        $this->data['edit_post'] = $this->CustomPostTypeModel->getEditPostType($post_type, $post_id);
                        if (isset($_POST['submit'])) {                            
                            $i = 0;
                            foreach ($this->data['custom_field'] as $index => $value) {
                                if ($index < 2) {
                                    continue;
                                }
                                $pos = strripos($value, '_');
                                $field_name = substr($value, 0, $pos);
                                $field_type = substr($value, $pos + 1);
                                if ($field_type == 'file') {
                                    $i++;
                                    $userfile = $field_name;
                                    $folder = ltrim($post_type, 'custom_') . '/' . $post_id . '/';
                                    //var_dump($fileso);exit;
                                    //$this->_delete_folder($folder, false);
                                    $file_url[$i] = $this->data['edit_post'][$value];
                                    $upload_data = $this->_do_upload($userfile, $folder);
                                    if (!isset($upload_data['error'])) {
                                        $pos = strripos($file_url[$i], '/');
                                        $folder_name = substr($file_url[$i], 0, $pos);
                                        $old_file_name = substr($file_url[$i], $pos + 1);
                                        $this->_delete_img($old_file_name, $folder_name);
                                        $img_name = $upload_data['upload_data']['file_name'];
                                        $file_url[$i] = $folder . $img_name;
                                    }
                                }
                            }
                            $j = 0;
                            $k = 0;
                            foreach ($this->data['languages'] as $cod => $element) {
                                $j++;
                                foreach ($this->data['custom_field_t'] as $index => $value) {
                                    if ($index < 3) {
                                        continue;
                                    }
                                    $pos = strripos($value, '_');
                                    $field_name = substr($value, 0, $pos);
                                    $field_type = substr($value, $pos + 1);
                                    if ($field_type == 'file') {
                                        $k++;
                                        $userfile = $element->code . '_' . $field_name;
                                        $folder = ltrim($post_type, 'custom_') . '/' . $post_id . '/' . $element->code . '/';
                                        $file_url_t[$j][$k] = $this->data['edit_translation_post'][$cod][$value];
                                        $upload_data = $this->_do_upload($userfile, $folder);
                                        if (!isset($upload_data['error'])) {
                                            $pos = strripos($file_url_t[$j][$k], '/');
                                            $folder_name = substr($file_url_t[$j][$k], 0, $pos);
                                            $old_file_name = substr($file_url_t[$j][$k], $pos + 1);
                                            $this->_delete_img($old_file_name, $folder_name);
                                            $file_name = $upload_data['upload_data']['file_name'];
                                            $file_url_t[$j][$k] = $folder . $file_name;
                                        }
                                    }
                                }
                            }
                            $i = 0;
                            foreach ($this->data['custom_field'] as $index => $value) {
                                if ($index < 1) {
                                    continue;
                                }
                                if ($index == 1) {
                                    $array_custom[$value] = $this->input->post('achievable', true);
                                    continue;
                                }
                                $pos = strripos($value, '_');
                                $field_name = substr($value, 0, $pos);
                                $field_type = substr($value, $pos + 1);
                                if ($field_type == 'file') {
                                    $i++;
                                    $array_custom[$value] = $file_url[$i];
                                    continue;
                                }
                                $array_custom[$value] = $this->input->post($field_name, true);
                            }
                            //$default_id = $post_id;
                            $j = 0;
                            $k = 0;
                            foreach ($this->data['languages'] as $element) {
                                $j++;
                                foreach ($this->data['custom_field_t'] as $index => $value) {
                                    $pos = strripos($value, '_');
                                    $field_name = substr($value, 0, $pos);
                                    $field_type = substr($value, $pos + 1);
                                    if ($index < 3) {
                                        continue;
                                    }
                                    if ($field_type == 'file') {
                                        $k++;
                                        $array_custom_t[$value] = $file_url_t[$j][$k];
                                        continue;
                                    }
                                    $array_custom_t[$value] = $this->input->post($element->code . '_' . $field_name, true);
                                }
                                $array_languages[$element->code] = $array_custom_t;
                            }
                            $this->CustomPostTypeModel->editPostType($post_type, $post_id, $array_custom, $array_languages);
                        }
                        $this->data['edit_post'] = $this->CustomPostTypeModel->getEditPostType($post_type, $post_id);
                        $this->data['edit_translation_post'] = $this->CustomPostTypeModel->getEditTranslationPostType($post_type, $post_id);
                        //var_dump($this->data['edit_translation_post']);exit;
                        $this->load->view('post_type/edit', $this->data);
                    } else {
                        show_404();
                    }
                } else {
                    show_404();
                }
            }
        }
    }

}
