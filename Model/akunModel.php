<?php
require_once 'koneksi.php';


class akunModel extends koneksi
{
    protected $akun;

    function getNama()
    {
        $sql = $this->connect()->query("SELECT nama FROM akun WHERE id_akun='" .$_SESSION['id_akun'] . "'");
        $nama = $sql->fetch_assoc()['nama'];
        return $nama;
    }

    function getEmail()
    {
        $sql = $this->connect()->query("SELECT email FROM akun WHERE id_akun='" .$_SESSION['id_akun'] . "'");
        $email = $sql->fetch_assoc()['email'];
        return $email;
    }

    function getLevel()
    {
        $sql = $this->connect()->query("SELECT level FROM akun WHERE id_akun='" .$_SESSION['id_akun'] . "'");
        $level = $sql->fetch_assoc()['level'];
        return $level;
    }

    function cekEmail($email)
    {
        $sql = $this->connect()->query("SELECT * FROM akun WHERE email='" . $email . "'");

        if (!$sql->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    function login($email, $password)
    {
        $sql = $this->connect()->query("SELECT password FROM akun WHERE email='" . $email . "'");
        $passwordDb = $sql->fetch_assoc()['password'];

        if ($password == $passwordDb) {
            $sqlAkun = $this->connect()->query("SELECT * FROM akun WHERE email='" . $email . "'");
            $this->akun = $sqlAkun->fetch_assoc();
            return true;
        } else if (password_verify($password, $passwordDb)) {
            $sqlAkun = $this->connect()->query("SELECT * FROM akun WHERE email='" . $email . "'");
            $this->akun = $sqlAkun->fetch_assoc();
            return true;
        } else {
            return false;
        }
    }
}
