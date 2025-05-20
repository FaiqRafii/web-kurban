<?php 
require_once '../View/adminView.php'; 
$view=new adminView(); 
?>

<div class="px-10 py-5">
    <div class="w-full h-fit px-10 pb-15 bg-gradient-to-b from-[#fff5e3] via-white to-white rounded-xl">
        <div class="pt-1 w-full h-full">
            <div class="w-full">
                <h1 class="text-left text-3xl pt-10 font-bold">Pencatatan Keuangan</h1>
                <div id="addContainer" >
                    <form action="" method="POST" class="w-full h-20 bg-white border border-neutral-300 mt-5 rounded-lg flex space-x-5 items-center px-5">
                        <div class="datepicker-container">
                            <div class="bg-white rounded-lg border-1 text-black border-neutral-300 focus-within:border-neutral-500">
                                <input type="text" name="tanggal" id="tanggal" required class="date-input w-35" placeholder="Pilih tanggal" />
                            </div>


                            <div class="datepicker" hidden>
                                <!-- .datepicker-header -->
                                <div class="datepicker-header">
                                    <button type="button" class="prev">Prev</button>

                                    <div>
                                        <select class="month-input">
                                            <option>Januari</option>
                                            <option>Februari</option>
                                            <option>Maret</option>
                                            <option>April</option>
                                            <option>Mei</option>
                                            <option>Juni</option>
                                            <option>Juli</option>
                                            <option>Agustus</option>
                                            <option>September</option>
                                            <option>October</option>
                                            <option>November</option>
                                            <option>Desember</option>
                                        </select>
                                        <input type="number" class="year-input px-1.5" min="1900" max="2100" />
                                    </div>

                                    <button type="button" class="next">Next</button>
                                </div>
                                <!-- /.datepicker-header -->

                                <!-- .days -->
                                <div class="days">
                                    <span>Min</span>
                                    <span>Sen</span>
                                    <span>Sel</span>
                                    <span>Rab</span>
                                    <span>Kam</span>
                                    <span>Jum</span>
                                    <span>Sab</span>
                                </div>
                                <!-- /.days -->

                                <!-- .dates -->
                                <div class="dates"></div>


                                <!-- .datepicker-footer -->
                                <div class="datepicker-footer">
                                    <button type="button" class="cancel">Batal</button>
                                    <button type="button" id="applyTanggal" class="apply" onclick="console.log('clicked')">Pilih</button>
                                </div>
                                <!-- /.datepicker-footer -->
                            </div>
                        </div>
                        <div class="h-12 p-2.5 bg-white rounded-lg border-1 text-black border-neutral-300 flex items-center">
                            <input type="text" name="keterangan" id="" class="focus:outline-none focus:border-none" placeholder="Keterangan">
                        </div>
                        <div class="h-12 p-2.5 bg-white rounded-lg border-1 text-black border-neutral-300 flex items-center">
                            <div class="text-neutral-400 mr-2">Rp</div>
                            <input type="number" name="keterangan" id="" class="w-35 focus:outline-none focus:border-none" placeholder="Nominal">
                        </div>
                        <div class="h-12 p-2.5 bg-white rounded-lg border-1 text-black border-neutral-300 flex items-center">
                            <select name="" id="" class="w-25 focus:outline-none focus:border-none disabled:text-neutral-300">
                                <option value="" selected disabled>Akun</option>
                                <option value="">Debet</option>
                                <option value="">Kredit</option>
                            </select>
                        </div>
                        <div class="h-12 p-2.5 flex items-center">
                            <input type="submit" class="w-30 transition-all ease-in duration-300 bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] hover:bg-gradient-to-r hover:cursor-pointer h-fit py-1.5 rounded-lg text-white" value="Tambah">
                        </div>
                    </form>
                </div>
                <table class="mt-5 w-full text-sm">
                    <tr class=" text-left text-white bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)]">
                        <th class="border border-black py-2 pl-5">Tanggal</th>
                        <th class="border border-black py-2 px-5">Keterangan</th>
                        <th class="border border-black py-2 px-5">Debet</th>
                        <th class="border border-black py-2 px-5">Kredit</th>
                        <th class="border border-black py-2 px-5">Saldo</th>
                    </tr>

                    <?php $view->isiTabelKeuangan() ?>


                </table>
            </div>

        </div>
    </div>
</div>