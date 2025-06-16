<?php

require_once '../tampilan/loginTampilan.php';
require_once '../database/akunDatabase.php';

session_start();

class loginAction extends akunDatabase
{
    public $idAkun;
    public $password;
    private $tampilan;

    function __construct()
    {
        $this->tampilan = new loginTampilan();
    }

    function cekIsLogin()
    {
        if (isset($_SESSION['isLogin'])) {
            header('Location: ../' . $_SESSION['level_akun'] . '/');
        }
    }

    function getIsLogin() {}

    function validasiData()
    {
        if (isset($_POST['id_akun'])) {
            $this->idAkun = $_POST['id_akun'];

            $login = $this->login($this->idAkun);

            if ($login) {
                $_SESSION['isLogin'] = true;
                $_SESSION['id_akun'] = $this->akun['id_akun'];
                $_SESSION['nama_akun'] = $this->akun['nama'];
                $_SESSION['alamat_akun'] = $this->akun['alamat'];
                $_SESSION['level_akun'] = explode(", ", $this->akun['level'])[0];
                $_SESSION['no_hp_akun'] = $this->akun['no_hp'];
                unset($_SESSION['alert']);
                if ($_SESSION['level_akun'] == 'berqurban') {
                    header('Location: ../warga/');
                } else {
                    header('Location: ../' . $_SESSION['level_akun'] . '/');
                }
                exit();
            } else {
                $_SESSION['alert'] = 'NIK salah';
            }
        } else {
            return;
        }
    }
};
