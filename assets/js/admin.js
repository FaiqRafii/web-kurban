document.addEventListener("DOMContentLoaded", function () {
  const inputsAkun = document.querySelectorAll(".input-data");
  const inputsKeuangan = document.querySelectorAll(".input-keuangan");
  const addModal = document.getElementById("addModalContent");

  function minimizeAddModal() {
    addModal.classList.toggle("hidden");
  }

  window.minimizeAddModal = minimizeAddModal;

  inputsAkun.forEach((input) => {
    input.addEventListener("change", () => {
      const idAkun = input.getAttribute("data-id");
      const field = input.getAttribute("data-field");
      const value = input.value;

      fetch("../action/adminAction.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `action=updateField&idAkun=${idAkun}&field=${field}&value=${encodeURIComponent(
          value
        )}`,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log("Berhasil update:", data);
        })
        .catch((error) => {
          console.error("Gagal update:", error);
        });
    });
  });

  document.querySelectorAll('input[id="rupiah"]').forEach((e) => {
    e.addEventListener("input", function (input) {
      const value = input.target.value;
      const clean = value.replace(/\D/g, "");

      if (clean) {
        input.target.value = new Intl.NumberFormat("id-ID").format(clean);
      } else {
        input.target.value = "";
      }
    });
  });
});
