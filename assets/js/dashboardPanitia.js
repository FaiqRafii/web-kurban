const hapusBtn = document.querySelectorAll(".hapusBtn");
const hitungJatahInput = document.querySelector('input[name="cariJatah"]');
const suggestionBox = document.getElementById("suggestions");
const hitungBtn = document.querySelector(".hitungBtn");
const jatahKambingDisplay = document.querySelector(".jatahKambing");
const jatahSapiDisplay = document.querySelector(".jatahSapi");
const statusTerbagi=document.querySelector('.statusTerbagi');

hitungJatahInput.addEventListener("input", () => {
  const keyword = hitungJatahInput.value.trim();

  if (keyword.length === 0) {
    suggestionBox.innerHTML = "";
    suggestionBox.classList.add("hidden");
    hitungJatahInput.value = '';
    hitungJatahInput.setAttribute("data-idPembagian", '');
    jatahKambingDisplay.innerHTML = '0';
    jatahSapiDisplay.innerHTML = '0';
    statusTerbagi.classList.remove('text-green-800');
    statusTerbagi.innerHTML='Belum Menerima'
    return;
  }

  fetch(`../View/panitiaView.php?searchj=${encodeURIComponent(keyword)}`)
    .then((response) => response.text())
    .then((data) => {
      suggestionBox.innerHTML = data;
      suggestionBox.classList.remove("hidden");

      document.querySelectorAll(".optJ").forEach((item) => {
        item.addEventListener("click", function () {
          hitungJatahInput.value = this.getAttribute("data-value");
          hitungJatahInput.setAttribute(
            "data-idPembagian",
            this.getAttribute("data-idPembagian")
          );
          suggestionBox.classList.add("hidden");
          suggestionBox.innerHTML = "";
        });
      });
    });
});

hitungBtn.addEventListener("click", function (e) {
  const idPembagian = hitungJatahInput.getAttribute("data-idPembagian");
  if (idPembagian == '') {
    jatahKambingDisplay.innerHTML = '0';
    jatahSapiDisplay.innerHTML = '0';
    statusTerbagi.classList.remove('text-green-800');
    statusTerbagi.innerHTML='Belum Menerima'
  }else{
    fetch(
      `../Controller/panitiaController.php?searchjt=${encodeURIComponent(
        idPembagian
      )}`
    )
      .then((response) => response.json())
      .then((data) => {
        jatahKambingDisplay.innerHTML = data.kambing;
        jatahSapiDisplay.innerHTML = data.sapi;
        statusTerbagi.innerHTML=data.status;
        statusTerbagi.classList.add('text-green-800');
      });
  }
});
