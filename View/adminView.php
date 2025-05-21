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
        <td class="text-xs pt-5 pl-5"><span class="font-bold">' . $this->model->getJumlahWarga() . '</span> Warga</td>
        ';
    }

    function jumlahBerqurban()
    {
        echo '
        <td class="text-xs pt-5 pl-5"><span class="font-bold">' . $this->model->getJumlahBerqurban() . '</span> Berqurban</td>
        ';
    }

    function jumlahAdmin()
    {
        echo '
        <td class="text-xs pt-5 pl-5"><span class="font-bold">' . $this->model->getJumlahAdmin() . '</span> Admin</td>
        ';
    }

    function jumlahPanitia()
    {
        echo '
        <td class="text-xs pt-5 pl-5"><span class="font-bold">' . $this->model->getJumlahPanitia() . '</span> Panitia</td>
        ';
    }

    function jumlahTotal()
    {
        echo '
        <td class="text-xs pt-5 pl-5 font-semibold">Total <span class="font-bold">' . $this->model->getJumlahTotal() . '</span></td>
        ';
    }

    function isiTabelAkun()
    {
        $q = $this->model->getAllAkunByLevel();
        $no = 1;
        while ($akun = $q->fetch_array()) {
            echo '
            <tr class="text-left odd:bg-white even:bg-neutral-50 hover:bg-[rgb(154,94,44)]/10 hover:cursor-pointer" onclick="">
                            <td class="border border-black py-2 pl-5">
                            <input type="checkbox" id="idAkun" name="idAkun[]" value="' . $akun['id_akun'] . '" class="hover:cursor-pointer">
                            </td>
                            <td class="text-center">' . $no++ . '
                            </td>
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
        echo '
        <tfoot>
        <tr>
            <td class="text-xs pt-5 pr-10  sticky bottom-4 z-10"><input type="submit" class="text-xs bottom-10 border border-red-600 bg-white text-red-600 hover:cursor-pointer hover:bg-red-600 hover:text-white hover:border-transparent px-1 py-0.5 rounded" value="Hapus"></input></td>';
        echo $this->jumlahTotal();
        echo $this->jumlahWarga();
        echo $this->jumlahBerqurban();
        echo $this->jumlahAdmin();
        echo $this->jumlahPanitia();
        echo '</tr>
        </tfoot>
        ';
    }

    function alert($keterangan)
    {
        echo '
        <div id="alert" class="z-10 transition-all ease-in-out transform duration-150 fixed top-2 right-5 bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
        <div class="flex">
            <div class="shrink-0">
                <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m15 9-6 6"></path>
                    <path d="m9 9 6 6"></path>
                </svg>
            </div>
            <div class="ms-2">
                <h3 class="text-sm font-medium">
                    ' . $keterangan . '
                </h3>
            </div>
            <div class="ps-3 ms-auto">
                <div class="-mx-1.5 -my-1.5">
                    <button id="closeAlertBtn" onclick="closeAlert()" type="button" class="hover:cursor-pointer inline-flex bg-red-50 rounded-lg p-1.5 text-red-500 hover:bg-red-100 focus:outline-none">
                        <span class="sr-only">Dismiss</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
        ';
    }

    function alertSukses($keterangan)
    {
        echo '
        <div id="alert" class="z-10 transition-all ease-in-out transform duration-150 fixed top-2 right-5 bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4" role="alert">
        <div class="flex">
            <div class="shrink-0">
            <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
            <path d="m9 12 2 2 4-4"></path>
          </svg>
            </div>
            <div class="ms-2">
                <h3 class="text-sm font-medium">
                    ' . $keterangan . '
                </h3>
            </div>
            <div class="ps-3 ms-auto">
                <div class="-mx-1.5 -my-1.5">
                    <button id="closeAlertBtn" onclick="closeAlert()" type="button" class="hover:cursor-pointer inline-flex bg-teal-50 rounded-lg p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none">
                        <span class="sr-only">Dismiss</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
        ';
    }

    function isiTabelKeuangan()
    {
        $qTransaksi = $this->model->getAllKeuanganByTanggal();
        while ($transaksi = $qTransaksi->fetch_assoc()) {
            echo '
            <tr class="text-left odd:bg-white even:bg-neutral-50 hover:bg-[rgb(154,94,44)]/10" onclick="">
            <td class="border border-black py-2 pl-5">
            <input type="checkbox" id="idTransaksi" name="idTransaksi[]" value="' . $transaksi['id_transaksi'] . '" class="hover:cursor-pointer">
            </td>
            <td class="border border-black pr-5">' . $transaksi['tanggal'] . '
            </td>
            <td class="border border-black py-2 px-5">' . $transaksi['keterangan'] . '
            </td>
            <td class="border border-black py-2 px-5">Rp';
            if ($transaksi['akun'] == 'debet') {
                echo number_format($transaksi['nominal'] ?? 0, 0, ',', '.');
            } else {
                echo '0';
            }

            echo
            '</td>
            <td class="border border-black py-2 px-5">Rp';

            if ($transaksi['akun'] == 'kredit') {
                echo number_format($transaksi['nominal'] ?? 0, 0, ',', '.');
            } else {
                echo '0';
            }
            echo '
            </td>
            <td class="border border-black py-2 px-5">Rp' . number_format($transaksi['saldo'] ?? 0, 0, ',', '.') . '
            </td>
            </tr>
            ';
        }

        echo '
        <tfoot class="border-t-2 pt-3 border-[rgb(99,52,14)]">
        <tr>
            <td class="text-xs pt-5 pr-10  sticky bottom-4 z-10"><input type="submit" class="text-xs bottom-10 border border-red-600 bg-white text-red-600 hover:cursor-pointer hover:bg-red-600 hover:text-white hover:border-transparent px-1 py-0.5 rounded" value="Hapus"></input></td>
            <td class="pt-2 px-5"></td>
            <td class="pt-2 px-5"><span class="font-bold">' . $this->getTotalTransaksiClean() . '</span> Transaksi</td>
            <td id="totaldebet" class="pt-2 px-5">Rp' . number_format($this->getTotalDebetClean() ?? '0', 0, ',', '.') . '</td>
            <td id="totalkredit " class="pt-2 px-5">Rp' . number_format($this->getTotalKreditClean() ?? '0', 0, ',', '.') . '</td>
            <td id="totalsaldo" class="pt-2 px-5">Rp' . number_format($this->getTotalSaldoClean() ?? '0', 0, ',', '.') . '</td>
        </tr>
    </tfoot>
        ';
    }
}
