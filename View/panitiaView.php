<?php
require_once '../Controller/panitiaController.php';
require_once '../Model/panitiaModel.php';

class panitiaView extends panitiaController
{
    public $model;

    function __construct()
    {
        $this->model = new panitiaModel();
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

    function totalDagingKambing()
    {
        echo $this->getTotalKambing();
    }

    function totalDagingSapi()
    {
        echo $this->getTotalSapi();
    }

    function listAkun()
    {
        $akun = $this->getAkun();
        while ($data = $akun->fetch_assoc()) {
            echo '
             <div class="px-1 mt-2 text-sm w-full p-2 rounded hover:bg-[rgb(99,52,14)] hover:cursor-pointer transition-all ease-in duration-75 group">
             <div data-id="' . $data['id_akun'] . '" class="opt px-2 group-hover:text-white ">' . $data['nama'] . '</div>
         </div>
             ';
        }
    }

    function listSearch($keyword)
    {
        $hasil = $this->getResult($keyword);
        while ($result = $hasil->fetch_assoc()) {
            echo '
             <div class="px-1 mt-2 text-sm w-full p-2 rounded hover:bg-[rgb(99,52,14)] hover:cursor-pointer transition-all ease-in duration-75 group">
             <div data-id="' . $result['id_akun'] . '" class="opt px-2 group-hover:text-white ">' . $result['nama'] . '</div>
         </div>
             ';
        }
    }

    function isiQurban()
    {
        $q = $this->getQurbanAll();
        $noKambing = 1;
        $noSapi = 1;
        $idQurban = 0;
        while ($qurban = $q->fetch_assoc()) {
            $qId = $this->getIdAkunQurban($qurban['id_qurban']);
            $idAkun = $qId->fetch_assoc()['id_akun'];
            echo '
            <div data-id="' . $qurban['id_qurban'] . '" data-hewan="' . $qurban['hewan'] . '" data-idAkun="' . $idAkun . '" data-namaAkun="' . $qurban['nama'] . '" class="cardQurban hover:cursor-pointer hover:-translate-y-1 transition-all ease-in duration-100 col-span-2 bg-gradient-to-r from-[#fff5e3] via-white to-white rounded-xl w-full h-30 relative overflow-hidden group">
            <form action="../Controller/panitiaController.php" method="POST">
            <div class="grid grid-cols-75%_25%">
            <div class="absolute left-0 h-full w-35 overflow-hidden">
                <img src="../assets/img/' . (($qurban['hewan'] == 'kambing') ? 'kambing' : 'sapi') . '.png" class="absolute ' . (($qurban['hewan'] == 'kambing') ? "scale-180 right-10" : "scale-220 scale-x-[-2.5] right-25") . ' top-14" alt="">
            </div>
            <div class="w-85 h-30 ml-28 grid grid-cols-3">
                <div class="flex justify-center items-center ">
                    <div class="grid grid-rows-10%_90% text-center">
                        <div class="font-bold text-lg">';
            if ($qurban['hewan'] == 'kambing') {
                echo ucwords($qurban['hewan']) . " " . $noKambing++;
            } else {
                echo ucwords($qurban['hewan']) . " " . $noSapi++;
            }
            echo '</div>
                    </div>
                </div>
                <div class="flex justify-center text-left items-center col-span-2">
                <div class="grid grid-cols-2">';
            if ($qurban['hewan'] == 'sapi') {
                $pengqurbanView = explode(", ", $qurban['nama']);
                $kiri = array_slice($pengqurbanView, 0, 4);
                $kanan = array_slice($pengqurbanView, 4);

                echo '<ol style="list-style-type:decimal">';
                for ($i = 0; $i < count($kiri); $i++) {
                    echo '<li class="text-xs">' . $kiri[$i] . '</li>';
                }
                echo '</ol>';
                echo '<ol class="pl-4" start="' . (count($kiri) + 1) . '" style="list-style-type:decimal">';
                for ($i = 0; $i < count($kanan); $i++) {
                    echo '
                <li class="text-xs">' . $kanan[$i] . '</li>';
                }
                echo '</ol>';
            } else {
                echo '<div class="grid grid-rows-10%_90% text-left">
                <div class="text-sm text-left">' . $qurban['nama'] . '</div>
            </div>';
            }
            echo '</div>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="hapusQurban">
        <input type="hidden" name="id_qurban" value="' . $qurban['id_qurban'] . '">
        <button type="submit" class="hapusBtn absolute right-0 bottom-0 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto hover:-translate-y-1 hover:cursor-pointer transition-all ease-in duration-100">
        <div class="w-8 h-8 rounded-full bg-red-600/30 flex justify-center items-center p-1">
        <svg fill="currentColor" class="text-red-500 w-4.5 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M22,5H17V2a1,1,0,0,0-1-1H8A1,1,0,0,0,7,2V5H2A1,1,0,0,0,2,7H3.117L5.008,22.124A1,1,0,0,0,6,23H18a1,1,0,0,0,.992-.876L20.883,7H22a1,1,0,0,0,0-2ZM9,3h6V5H9Zm8.117,18H6.883L5.133,7H18.867Z"></path></g></svg>
        </div>
        </button>            
        </form>
        </div>
        ';
        }
    }

    function isiTabelPembagian()
    {
        $qP = $this->getPembagian();

        while ($data = $qP->fetch_assoc()) {
            echo '
            <tr>
            <td class="py-5 pl-5 flex justify-center items-center"><input name="statusCheck" data-idPembagian="' . $data['id_pembagian'] . '" type="checkbox"';
            if ($data['status'] == 'terbagi') {
                echo ' checked ';
            }
            echo 'class="hover:cursor-pointer" name="" id=""></td>
            <td class="py-2 pl-5">' . $data['id_akun'] . '</td>
            <td class="py-2 px-5">' . $data['nama'] . '</td>
            <td class="py-2 px-5">' . $data['alamat'] . '</td>
            <td class="py-2 pr-5">' . $data['no_hp'] . '</td>
            <td class="py-2 pr-5">' . number_format($data['kambing'], 2, ',') . ' Kg</td>
            <td class="py-2 pr-5">' .  number_format($data['sapi'], 2, ',')  . ' Kg</td>
        </tr>
            ';
        }
    }

    function isiTabelAkun()
    {
        $q = $this->model->getAllAkunByLevel();
        $no = 1;
        while ($akun = $q->fetch_array()) {
            echo '
            <tr class="text-left odd:bg-white even:bg-neutral-50 hover:bg-[rgb(154,94,44)]/10 hover:cursor-pointer" onclick="">
                            <td class="border border-black py-2 pl-5 flex justify-center items-center">
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
        <div id="alert" class="z-100 transition-all ease-in-out transform duration-150 fixed top-2 right-5 bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
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
        <div id="alert" class="z-100 transition-all ease-in-out transform duration-150 fixed top-2 right-5 bg-teal-50 border border-teal-200 text-sm text-teal-800 rounded-lg p-4" role="alert">
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

    function tabelPembagianSearch()
    {
        $keyword = $_GET['searchp'];
        $hasil = $this->searchPembagian($keyword);
        while ($data = $hasil->fetch_assoc()) {
            echo '
            <tr>
            <td class="py-5 pl-5 flex justify-center items-center"><input name="statusCheck" data-idPembagian="' . $data['id_pembagian'] . '" type="checkbox"';
            if ($data['status'] == 'terbagi') {
                echo ' checked ';
            }
            echo 'class="hover:cursor-pointer" name="" id=""></td>
            <td class="py-2 pl-5">' . $data['id_akun'] . '</td>
            <td class="py-2 px-5">' . $data['nama'] . '</td>
            <td class="py-2 px-10">' . $data['alamat'] . '</td>
            <td class="py-2 pl-10">' . $data['no_hp'] . '</td>
            <td class="py-2 px-5">' . number_format($data['kambing'], 2, ',') . ' Kg</td>
            <td class="py-2 px-8">' .  number_format($data['sapi'], 2, ',')  . ' Kg</td>
        </tr>
            ';
        }
    }

    function suggestion(){
        $keyword=$_GET['searchj'];
        $q=$this->searchJatah($keyword);

        while ($data=$q->fetch_assoc()){
            echo '
            <div data-value="'.$data['nama'].'" data-idPembagian="'.$data['id_pembagian'].'" class="optJ px-4 py-2 cursor-pointer hover:bg-[rgb(99,52,14)] hover:text-white">
            '.$data['nama'].'
            </div>
            ';
        }
    }

    function totalTerbagiKambing()
    {
        $kambing = $this->getTerbagiKambing()->fetch_column();
        echo number_format($kambing, 2) . " Kg";
    }

    function persenTerbagiKambing()
    {
        $kambing = (float) $this->getTerbagiKambing()->fetch_column();
        $totalKambing = (float) $this->getTotalKambing();
        $persenTerbagiKambing = (($kambing / $totalKambing) * 100);
        echo $persenTerbagiKambing . "%";
    }

    function totalTerbagiSapi()
    {
        $sapi = $this->getTerbagiSapi()->fetch_column();
        echo number_format($sapi, 2) . " Kg";
    }

    function persenTerbagiSapi()
    {
        $sapi = (float) $this->getTerbagiSapi()->fetch_column();
        $totalSapi = (float) $this->getTotalSapi();
        $persenTerbagiSapi = (($sapi / $totalSapi) * 100);
        echo $persenTerbagiSapi . "%";
    }
}


$view = new panitiaView();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['search'])) {
        $keyword = $_GET['search'];
        $view->listSearch($keyword);
    } else if (isset($_GET['searchp'])) {
        $view->tabelPembagianSearch();
    } else if(isset($_GET['searchj'])){
        $view->suggestion();
    }
}
