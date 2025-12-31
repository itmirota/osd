<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function uploadDokumen($field, $folder)
{
    $CI =& get_instance();

    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $path = FCPATH . 'assets/' . $folder . '/';
    if (!is_dir($path)) mkdir($path, 0777, true);

    $config = [
        'upload_path'   => $path,
        'allowed_types' => 'pdf|jpg|jpeg|png',
        'max_size'      => 10240,
        'file_name'  => 'dokumen_' . time()
    ];

    if (!isset($CI->upload)) {
        $CI->load->library('upload');
    }

    $CI->upload->initialize($config, true);

    if (!$CI->upload->do_upload($field)) {
        log_message('error', $CI->upload->display_errors());
        return null;
    }

    return $CI->upload->data('file_name');
}