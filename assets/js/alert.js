function closeAlert() {
  const alertBox = document.getElementById("alert");
  if (alertBox) {
      alertBox.classList.add("hidden");
      alertBox.remove();
  }
}

function setAlert(keterangan) {
  const alert = document.createElement("div");
  alert.id = "alert";
  alert.className =
    "z-100 transition-all ease-in-out transform duration-150 fixed top-2 right-5 bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4";
  alert.innerHTML = `
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
                    ${keterangan}
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
    `;

  document.body.append(alert);
}

window.closeAlert = closeAlert;
