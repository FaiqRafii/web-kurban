const menu = document.getElementById("selectMenu");
const openMenuBtn = document.querySelector('button[onclick="openMenu()"]');
const opt = document.querySelectorAll(".opt");
const pengqurbanList = document.getElementById("pengqurbanList");
const idAkunInput = document.querySelector('input[name="idAkun"]');
const labelPengqurban = document.getElementById("labelPengqurban");
const labelPengqurbanLuar = document.getElementById("labelPengqurbanLuar");
const searchInput = document.querySelector('input[name="searchAkun"]');
const listAkun = document.getElementById("listAkun");
const openModalBtn = document.getElementById("openModal");
const modal = document.getElementById("containerQurban");
const closeModal = document.querySelectorAll(".closeModal");
const cardQurban = document.querySelectorAll(".cardQurban");
const hewanInput = document.querySelector('select[name="hewan"]');
const actionInput = modal.querySelector('input[name="action"]');
const idQurbanInput = document.querySelector('input[name="idQurban"]');
const pengqurbanLamaInput = document.querySelector(
  'input[name="pengqurbanLama"]'
);
const hapusBtn = document.querySelectorAll(".hapusBtn");
const hitungJatahInput = document.querySelector('input[name="cariJatah"]');
const suggestionBox = document.getElementById("suggestions");

const pengqurban = [];
const pengqurbanLama = [];

function openMenu() {
  if (hewanInput.value !== "") {
    menu.classList.toggle("hidden");
  } else {
    closeAlert();
    setAlert("Isi hewan terlebih dahulu");
  }
}

closeModal.forEach((e) => {
  e.addEventListener("click", () => {
    hewanInput.value = "";
    pengqurban.splice(0, pengqurban.length);
    idAkunInput.value = pengqurban.join();
    pengqurbanList.innerHTML = "";
    actionInput.value = "addQurban";
    idQurbanInput.value = "";
    modal.classList.add("hidden");
    updateLabelPengqurban();
  });
});

hapusBtn.forEach((btn) => {
  btn.addEventListener("click", function (e) {
    e.stopPropagation();
  });
});

modal.addEventListener("click", function (e) {
  if (e.target === modal) {
    hewanInput.value = "";
    pengqurban.splice(0, pengqurban.length);
    idAkunInput.value = pengqurban.join();
    pengqurbanList.innerHTML = "";
    actionInput.value = "addQurban";
    idQurbanInput.value = "";
    modal.classList.add("hidden");
  }
});

cardQurban.forEach((card) => {
  card.addEventListener("click", function (event) {
    const idQurban = card.getAttribute("data-id");
    const hewanQurban = card.getAttribute("data-hewan");
    const dataIdAkun = card.getAttribute("data-idAkun");
    const dataNamaAkun = card.getAttribute("data-namaAkun");

    idQurbanInput.value = idQurban;
    actionInput.value = "updateQurban";
    hewanInput.value = hewanQurban;

    const dataIdAkunSplitted = dataIdAkun.split(", ");
    const dataNamaAkunSplitted = dataNamaAkun.split(", ");

    for (let index = 0; index < dataIdAkunSplitted.length; index++) {
      pengqurban.push(dataIdAkunSplitted[index]);
      pengqurbanLama.push(dataIdAkunSplitted[index]);

      const tag = document.createElement("div");
      tag.className =
        "min-w-20 h-6 text-[rgb(255,228,205)] bg-[rgb(99,52,14)] rounded-xl py-1 px-3 text-xs flex justify-between";
      tag.innerHTML = `
        ${dataNamaAkunSplitted[index]}
        <div class="hapusPengqurbanBtn hover:font-semibold hover:cursor-pointer">x</div>
      `;

      const hapusPengqurbanBtn = tag.querySelector(".hapusPengqurbanBtn");
      hapusPengqurbanBtn.addEventListener("click", function (event) {
        event.stopPropagation();
        tag.remove();
        hapusPengqurban(dataIdAkunSplitted[index]);
        updateLabelPengqurban();
      });

      pengqurbanLamaInput.value = pengqurbanLama.join(", ");
      idAkunInput.value = pengqurban.join(", ");

      updateLabelPengqurban();
      pengqurbanList.appendChild(tag);
    }
    modal.classList.remove("hidden");
  });
});

openModalBtn.addEventListener("click", () => {
  pengqurbanList.innerHTML = "";
  idAkunInput.value = "";
  actionInput.value = "addQurban";
  idQurbanInput.value = "";
  updateLabelPengqurban();
  modal.classList.remove("hidden");
});

hewanInput.addEventListener("change", function () {
  const value = this.value;
  if (value == "kambing") {
    if (pengqurban.length > 1) {
      pengqurban.splice(0, pengqurban.length);
      idAkunInput.value = pengqurban.join();
      pengqurbanList.innerHTML = "";
      closeAlert();
      setAlert("Hanya boleh 1 pengkurban untuk 1 kambing");
    }
  } else if (value == "sapi") {
    if (pengqurban.length > 6) {
      pengqurban.splice(0, pengqurban.length);
      idAkunInput.value = pengqurban.join();
      pengqurbanList.innerHTML = "";
      setAlert("Hanya boleh 7 pengkurban untuk 1 sapi");
    }
  }
});

document.addEventListener("click", function (event) {
  const isClickInsideMenu = menu.contains(event.target);
  const isClickInsideBtn = openMenuBtn.contains(event.target);
  const isClickInsideCloseBtn =
    event.target.classList.contains("hapusPengqurbanBtn");
  const isClickInsideDeleteBtn = event.target.classList.contains("hapusBtn");

  if (
    !isClickInsideBtn &&
    !isClickInsideMenu &&
    !isClickInsideCloseBtn &&
    !isClickInsideDeleteBtn
  ) {
    menu.classList.add("hidden");
  }
});

function updateLabelPengqurban() {
  if (pengqurban.length > 0) {
    labelPengqurbanLuar.classList.remove("hidden");
    labelPengqurban.classList.add("hidden");
  } else {
    labelPengqurbanLuar.classList.add("hidden");
    labelPengqurban.classList.remove("hidden");
  }
}

function hapusPengqurban(idAkun) {
  const index = pengqurban.indexOf(idAkun);
  pengqurban.splice(index, 1);
  idAkunInput.value = pengqurban.join(", ");
}

listAkun.addEventListener("click", function (e) {
  const hewan = document.querySelector('select[name="hewan"]').value;
  if (e.target.classList.contains("opt")) {
    const idAkun = e.target.getAttribute("data-id");
    console.log("idAkub read target:", idAkun);
    const namaAkun = e.target.textContent.trim();
    if (hewan == "kambing") {
      if (pengqurban.length < 1) {
        if (!pengqurban.includes(idAkun)) {
          pengqurban.push(idAkun);
          const tag = document.createElement("div");
          tag.className =
            "min-w-20 h-6 text-[rgb(255,228,205)] bg-[rgb(99,52,14)] rounded-xl py-1 px-3 text-xs flex justify-between";
          tag.innerHTML = `
                ${namaAkun}
                <div class="hapusPengqurbanBtn hover:font-semibold hover:cursor-pointer">x</div>
                `;
          const hapusPengqurbanBtn = tag.querySelector(".hapusPengqurbanBtn");
          hapusPengqurbanBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            tag.remove();
            hapusPengqurban(idAkun);
            updateLabelPengqurban();
          });

          idAkunInput.value = pengqurban.join(", ");
          updateLabelPengqurban();
          pengqurbanList.appendChild(tag);
        } else {
          closeAlert();
          setAlert(`${namaAkun} sudah ada`);
        }
      } else {
        closeAlert();
        setAlert("Hanya boleh 1 pengkurban untuk 1 kambing");
      }
    } else if (hewan == "sapi") {
      if (pengqurban.length < 7) {
        if (!pengqurban.includes(idAkun)) {
          pengqurban.push(idAkun);
          const tag = document.createElement("div");
          tag.className =
            "min-w-20 h-6 text-[rgb(255,228,205)] bg-[rgb(99,52,14)] rounded-xl py-1 px-3 text-xs flex justify-between";
          tag.innerHTML = `
                ${namaAkun}
                <div class="hapusPengqurbanBtn hover:font-semibold hover:cursor-pointer">x</div>
                `;
          const hapusPengqurbanBtn = tag.querySelector(".hapusPengqurbanBtn");
          hapusPengqurbanBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            tag.remove();
            hapusPengqurban(idAkun);
            updateLabelPengqurban();
          });

          idAkunInput.value = pengqurban.join(", ");
          updateLabelPengqurban();
          pengqurbanList.appendChild(tag);
        } else {
          closeAlert();
          setAlert(`${namaAkun} sudah ada`);
        }
      } else {
        closeAlert();
        setAlert("Hanya boleh 7 pengkurban untuk 1 sapi");
      }
    }
  }
});

searchInput.addEventListener("input", function () {
  const keyword = this.value;
  fetch(`../View/panitiaView.php?search=${encodeURIComponent(keyword)}`)
    .then((response) => response.text())
    .then((data) => {
      listAkun.innerHTML = data;
    })
    .catch((error) => {
      console.error("Error: ", error);
    });
});
