<?php
require_once '../Model/wargaModel.php';

class wargaController extends wargaModel
{
    function getNamaClean()
    {
        return $this->getNamaModel()->fetch_assoc()['nama'];
    }
    function getAlamatClean()
    {
        return $this->getAlamatModel()->fetch_assoc()['alamat'];
    }
    function getNoHpClean()
    {
        return $this->getNoHpModel()->fetch_assoc()['no_hp'];
    }
    

}
