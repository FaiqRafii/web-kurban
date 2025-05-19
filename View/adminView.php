<?php
require_once '../Controller/adminController.php';
require_once '../Model/adminModel.php';

class adminView extends adminController
{
    public $model;
    function __construct()
    {
        $this->model = new adminModel();
    }

    function jumlahWarga()
    {
        echo '
        <td class="text-xs pt-5"><span class="font-bold">' . $this->model->getJumlahWarga() . '</span> Warga</td>
        ';
    }

    function jumlahBerqurban()
    {
        echo '
        <td class="text-xs pt-5"><span class="font-bold">' . $this->model->getJumlahBerqurban() . '</span> Berqurban</td>
        ';
    }

    function jumlahAdmin()
    {
        echo '
        <td class="text-xs pt-5"><span class="font-bold">' . $this->model->getJumlahAdmin() . '</span> Admin</td>
        ';
    }

    function jumlahPanitia()
    {
        echo '
        <td class="text-xs pt-5"><span class="font-bold">' . $this->model->getJumlahPanitia() . '</span> Panitia</td>
        ';
    }

    function jumlahTotal()
    {
        echo '
        <td class="text-xs pt-5 font-semibold">Total <span class="font-bold">' . $this->model->getJumlahTotal() . '</span></td>
        ';
    }

    function isiTabelAkun()
    {
        $q = $this->model->getAllAkunByLevel();
        $no = 1;
        while ($akun = $q->fetch_array()) {
            echo '
            <tr class="text-left odd:bg-white even:bg-neutral-50 hover:bg-[rgb(154,94,44)]/10 hover:cursor-pointer" onclick="">
                            <td class="text-center">' . $no++ . '
                            </td>
                            <input type="hidden" class="idAkun" name="idAkun" value="' . $akun['id_akun'] . '">
                            <td class="border border-black pl-5"><input name="nama" type="text" class="input-data w-25 placeholder:text-black focus:border-none focus:outline-none" placeholder="Masukkan nama" data-field="nama" data-id="' . $akun['id_akun'] . '" value="' . $akun['nama'] . '">
                            </td>
                            <td class="border border-black pl-5"><input name="nik" type="text" class="input-data w-29 placeholder:text-black focus:border-none focus:outline-none" placeholder="Masukkan NIK" data-field="nik" data-id="' . $akun['id_akun'] . '" value="' . $akun['nik'] . '">
                            </td>
                            <td class="border border-black py-2 "> <input name="alamat" type="text" class="input-data w-40 placeholder:text-black focus:border-none focus:outline-none" placeholder="Jl. Melati No. 5" data-field="alamat" data-id="' . $akun['id_akun'] . '" value="' . $akun['alamat'] . '">
                            </td>
                            <td class="border border-black py-2 px-5"> <input name="noHp" type="text" class="input-data w-25 placeholder:text-black focus:border-none focus:outline-none" placeholder="08123456789" data-field="noHp" data-id="' . $akun['id_akun'] . '" value="' . $akun['no_hp'] . '">
                            </td>
                            <td>
                            <select name="" class="input-data focus-within:outline-none focus-within:border-none hover:cursor-pointer" data-field="level" data-id="' . $akun['id_akun'] . '" id="">
    <option value="warga" ' . ($akun['level'] == 'warga' ? 'selected' : '') . '>Warga</option>
    <option value="berqurban" ' . ($akun['level'] == 'berqurban' ? 'selected' : '') . '>Berqurban</option>
    <option value="admin" ' . ($akun['level'] == 'admin' ? 'selected' : '') . '>Admin</option>
    <option value="panitia" ' . ($akun['level'] == 'panitia' ? 'selected' : '') . '>Panitia</option>
</select>
                            </td>
                        </tr>
                        ';
        }
    }
}
