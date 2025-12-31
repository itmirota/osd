<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function uploadFoto($field, $folder)
{
    $CI =& get_instance();

    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $path = FCPATH . 'assets/images/' . $folder . '/';

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $config = [
        'upload_path'   => $path,
        'allowed_types' => 'jpg|jpeg|png',
        'max_size'      => 5120, // 5MB
        'file_name'  => 'absenVisit_' . time()
    ];

    // ⬇️ load library lewat CI instance
    $CI->load->library('upload');
    $CI->upload->initialize($config);

    if (!$CI->upload->do_upload($field)) {
        log_message('error', 'Upload foto gagal: ' . $CI->upload->display_errors());
        return null;
    }

    $data = $CI->upload->data();

    // 🔐 VALIDASI FILE ADALAH IMAGE ASLI
    if (!@getimagesize($data['full_path'])) {
        unlink($data['full_path']);
        return null;
    }

    return $data['file_name'];
}