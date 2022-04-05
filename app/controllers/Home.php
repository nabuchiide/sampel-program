<?php
class Home extends Controller
{
    public function index()
    {
        $data['user']   = $this->model("UserModel")->getAllData();
        $this->view('home/index', $data);
    }

    public function tambah()
    {
        $saveData = $_POST;
        if ($this->model("UserModel")->tambahData($saveData) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success', 'User');
            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger', 'User');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    public function ubah()
    {
        $updateData = $_POST;
        if ($this->model("UserModel")->ubahData($updateData) > 0) {
            Flasher::setFlash('berhasil', 'dirubah', 'success', 'User');
            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dirubah', 'danger', 'User');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    public function getUbah()
    {
        echo json_encode($this->model("UserModel")->getOneDataById($_POST['id']));
    }

    public function setHapus()
    {
        $id = $_POST['id'];
        if ($this->model("UserModel")->hapusData($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success', 'User');
            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger', 'User');
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }
    
}
