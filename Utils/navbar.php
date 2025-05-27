<nav
    id="navbar"
    class="mb-20 px-15 transition-all ease-in duration-200 bg-[rgb(99,52,14)] text-white w-full h-20 fixed top-0 z-10">
    <div class="grid grid-cols-5 h-full">
        <button type="button" data-target="home" class="navBtn flex items-center pl-10">
            <img
                id="logo"
                src="assets/img/logo3.png"
                class="w-20 h-auto object-contain transition-all duration-300"
                alt="logoMain" />
        </button>
        <div class="col-span-3 space-x-10 justify-center flex my-auto">
            <button
                data-target="home"
                type="button"
                class="navBtn scroll-link pb-1 border-b border-transparent hover:cursor-pointer hover:border-white transition-all ease-in-out duration-150">
                Home
            </button>
            <button
                data-target="fitur"
                type="button"
                class="navBtn scroll-link pb-1 border-b border-transparent hover:cursor-pointer hover:border-white transition-all ease-in-out duration-150">
                Fitur
            </button>
            <button
                data-target="caraKerja"
                type="button"
                class="navBtn scroll-link pb-1 border-b border-transparent hover:cursor-pointer hover:border-white transition-all ease-in-out duration-150">
                Cara Kerja
            </button>
        </div>

        <div class="flex space-x-5 justify-end mr-6 items-center">
            <?php
            if (isset($_SESSION['isLogin'])) {
                echo '
                            <div class="relative inline-block mt-4">
                <div id="profileBtn" class="hover:cursor-pointer size-10 rounded-full flex-row items-center justify-center">
                    <svg id="profileSvg" fill="currentColor" class="text-white w-5 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"></path>
                        </g>
                    </svg>
                </div>
                <div id="profileModal" class="hidden w-30 h-44 bg-white text-[rgb(99,52,14)] rounded absolute right-0">
                    <ul class="w-fit mt-5 space-y-5 mx-auto">
                        <li class="text-center">
                            <div class="text-sm font-semibold">
                                ' . ucwords($_SESSION['nama_akun']) . '
                            </div>
                            <div class="text-xs">
                                ' . $_SESSION['id_akun'] . '
                            </div>
                        </li>
                        <a href="../' . $_SESSION['level_akun'] . '" class="">
                            <li class="hover:cursor-pointer hover:font-bold flex justify-center items-center space-x-3 mb-5">
                                <svg fill="currentColor" class="shrink-0 w-4 h-ft transition duration-75 group-hover:text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M1,22V4A1,1,0,0,1,2,3H12a1,1,0,0,1,0,2H3V21H19V12a1,1,0,0,1,2,0V22a1,1,0,0,1-1,1H2A1,1,0,0,1,1,22ZM11.293,8.626l7.333-7.333a1,1,0,0,1,1.414,0l2.667,2.666a1,1,0,0,1,0,1.415l-7.334,7.333a1,1,0,0,1-.707.293H12a1,1,0,0,1-1-1V9.333A1,1,0,0,1,11.293,8.626ZM13,11h1.252l6.334-6.333L19.333,3.414,13,9.748Z"></path>
                                    </g>
                                </svg>
                                <div>' .
                    ucwords($_SESSION['level_akun']) . '
                                </div>
                            </li>
                        </a>
                        <a href="../Controller/logout.php">
                            <li class="hover:cursor-pointer hover:font-bold flex justify-center items-center space-x-3">
                                <svg fill="currentColor" class="shrink-0 w-4 h-ft transition duration-75 group-hover:text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M7.707,8.707,5.414,11H17a1,1,0,0,1,0,2H5.414l2.293,2.293a1,1,0,1,1-1.414,1.414l-4-4a1,1,0,0,1,0-1.414l4-4A1,1,0,1,1,7.707,8.707ZM21,1H13a1,1,0,0,0,0,2h7V21H13a1,1,0,0,0,0,2h8a1,1,0,0,0,1-1V2A1,1,0,0,0,21,1Z"></path>
                                    </g>
                                </svg>
                                <div>
                                    Logout
                                </div>
                            </li>
                        </a>
                    </ul>
                </div>
                ';
            } else {
                echo '
                    <a
                href="login/"
                class="navBtn pb-1 border-b border-transparent hover:cursor-pointer hover:border-white transition-all ease-in-out duration-150">
                Login
            </a>
                    ';
            }
            ?>

        </div>

    </div>
    </div>
</nav>