<?php
// Dokumentasi Pengerjaan Kelompok
// Nama kelompok : .................
// Kelas : .................
// Ketua : Rudi Sujarwo - 12181234
// Anggota : Joko Susanto - 12189388
// : ....
// : dst..
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Rest_member extends RestController {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        // Deskripsi Fungsi :
        // ----------------------------------------------------------------------------------
        // Script dibawah ini merupakan implementasi dari metode GET
        // ----------------------------------------------------------------------------------
        $id = $this->get('id');
        if ($id == '') {
            $member = $this->db->get('member')->result();
        } else {
            $this->db->where('id', $id);
            $member = $this->db->get('member')->result();
        }
        $this->response($member, 404);
    }

    function index_post() {
        $data = array(
            'id' => $this->post('id'),
            'nama_member' => $this->post('nama_member'),
            'email' => $this->post('email'),
            'no_telp' => $this->post('no_telp')
        );
        $insert = $this->db->insert('member', $data);

        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
            'id' => $this->post('id'),
            'nama_member' => $this->post('nama_member'),
            'email' => $this->post('email'),
            'no_telp' => $this->post('no_telp')
        );

        $this->db->where('id', $id);
        $update = $this->db->update('member', $data);

        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('member');

        if ($delete) {
            $this->response(array('status'=>'sukses'), 200);
        } else {
            $this->response(array('status' => 'gagal', 502));
        }
    }
}
?>