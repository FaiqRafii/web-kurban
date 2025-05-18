<nav
    id="navbar"
    class="mb-20 px-15 transition-all ease-in duration-200 bg-[rgb(99,52,14)] text-white w-full h-20 fixed top-0 z-10">
    <div class="grid grid-cols-5 h-full">
        <button type="button" data-target="home" class="navBtn flex items-center pl-10">
            <img
                id="logo"
                src="../assets/img/logo3.png"
                class="w-20 h-auto object-contain transition-all duration-300"
                alt="Logo" />
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
            <a
                href="login.php"
                class="navBtn pb-1 border-b border-transparent hover:cursor-pointer hover:border-white transition-all ease-in-out duration-150">
                Login
            </a>
        </div>
    </div>
</nav>