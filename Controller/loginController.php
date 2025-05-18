<?php

require_once '../View/loginView.php';
require_once '../Model/akunModel.php';

session_start();

class loginController extends akunModel
{
    public $email;
    public $password;
    private $view;

    function __construct()
    {
        $this->view = new loginView();
    }

    function cekIsLogin()
    {
        if (isset($_SESSION['isLogin'])) {
            header('Location: ../' . $_SESSION['level_akun'] . '/');
        }
    }

    function validasiData()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];

            $emailStatus = $this->cekEmail($this->email);

            if (!$emailStatus) {
                $_SESSION['alert'] = 'Email tidak ditemukan';
            } else {
                $login = $this->login($this->email, $this->password);

                if ($login) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['id_akun'] = $this->akun['id_akun'];
                    $_SESSION['nama_akun'] = $this->akun['nama'];
                    $_SESSION['email_akun'] = $this->akun['email'];
                    $_SESSION['level_akun'] = $this->akun['level'];
                    $_SESSION['no_hp_akun'] = $this->akun['no_hp'];
                    unset($_SESSION['alert']);
                    header('Location: ../' . $_SESSION['level_akun'] . '/');
                    exit();
                } else {
                    $_SESSION['alert'] = 'Password salah';
                }
            }
        } else {
            return;
        }
    }
};
