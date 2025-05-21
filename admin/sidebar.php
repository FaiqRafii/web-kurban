<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="flex flex-col justify-between h-full px-3 py-4 overflow-y-auto bg-gradient-to-tr from-[#e2cca7] via-[#F6F2EC] to-white">
      <a href="../" class="flex items-center ps-2.5 mb-7 mt-10">
         <img src="../assets/img/logoScroll.png" class="w-25 h-fit ml-12" />
      </a>
      <div class="w-full h-10 mb-5 flex items-center relative px-5">
         <svg id="profileSvg" fill="currentColor" class="text-black w-7 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
               <path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"></path>
            </g>
         </svg>
         <div class="text-xs ml-2">
            <div class="font-semibold"><?= $akun->getNama() ?><span class="text-neutral-500"> - <?= ucwords($akun->getLevel()) ?></span></div>
            <div><?= $akun->getNIK() ?></div>
         </div>
      </div>
      <ul class="space-y-2 font-montserrat">
         <li>
            <a href="./" class="flex items-center p-2 text-[rgb(102,57,19)] rounded-lg  hover:bg-[rgb(102,57,19)] hover:text-white  group">
               <svg class="w-5 h-5 text-[rgb(102,57,19)] transition duration-75  group-hover:text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
               </svg>
               <span class="ms-3">Akun</span>
            </a>
         </li>
         <li>
            <a href="?page=keuangan" class="flex items-center p-2 text-[rgb(102,57,19)] rounded-lg  hover:bg-[rgb(102,57,19)] hover:text-white  group">
               <svg fill="currentColor" class="w-5 h-5 text-[rgb(102,57,19)] transition duration-75  group-hover:text-white mb-0.5"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                     <path d="M22,4H2A1,1,0,0,0,1,5V19a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1V5A1,1,0,0,0,22,4ZM21,16.184A2.987,2.987,0,0,0,19.184,18H4.816A2.987,2.987,0,0,0,3,16.184V7.816A2.987,2.987,0,0,0,4.816,6H19.184A2.987,2.987,0,0,0,21,7.816ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14ZM7,12a1,1,0,0,1-1,1H5a1,1,0,0,1,0-2H6A1,1,0,0,1,7,12Zm13,0a1,1,0,0,1-1,1H18a1,1,0,0,1,0-2h1A1,1,0,0,1,20,12Z"></path>
                  </g>
               </svg>
               <span class="ms-3">Keuangan</span>
            </a>
         </li>
      </ul>

      <ul class="mt-auto">
         <li>
            <a href="../Controller/logout.php" class="flex items-center p-2 text-[rgb(102,57,19)] rounded-lg hover:bg-[rgb(102,57,19)] hover:text-white group">
               <svg fill="currentColor" class="shrink-0 w-5 h-5 text-[rgb(102,57,19)] transition duration-75 group-hover:text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                     <path d="M7.707,8.707,5.414,11H17a1,1,0,0,1,0,2H5.414l2.293,2.293a1,1,0,1,1-1.414,1.414l-4-4a1,1,0,0,1,0-1.414l4-4A1,1,0,1,1,7.707,8.707ZM21,1H13a1,1,0,0,0,0,2h7V21H13a1,1,0,0,0,0,2h8a1,1,0,0,0,1-1V2A1,1,0,0,0,21,1Z"></path>
                  </g>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
            </a>
         </li>

      </ul>
   </div>
</aside>