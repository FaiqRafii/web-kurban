<?php
require_once '../database/wargaDatabase.php';

class wargaAction extends wargaDatabase
{
    function getNamaClean()
    {
        return $this->getNamaDatabase()->fetch_assoc()['nama'];
    }
    function getAlamatClean()
    {
        return $this->getAlamatDatabase()->fetch_assoc()['alamat'];
    }
    function getNoHpClean()
    {
        return $this->getNoHpDatabase()->fetch_assoc()['no_hp'];
    }
    
    function getJatah()
    {
        return $this->getJatahDatabase();
    }

    function getStatus(){
        return $this->getStatusDatabase();
    }
}
