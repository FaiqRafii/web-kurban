<?php
class koneksi
{
private $host = 'localhost';
private $username = 'root';
private $password = '';
private $database = 'easy_qurban';
protected $koneksi;

public function connect()
{
    $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);

    if (!$this->koneksi) {
        die('Server not connected: ' . mysqli_connect_error());
    } else {
        return $this->koneksi;
    }
}
}
