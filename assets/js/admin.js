document.addEventListener("DOMContentLoaded", function () {
  const inputs = document.querySelectorAll(".input-data");
  const addModal=document.getElementById('addModalContent');

  function minimizeAddModal(){
    addModal.classList.toggle('hidden')
  }

  window.minimizeAddModal=minimizeAddModal;

  inputs.forEach((input) => {
    input.addEventListener("change", () => {
      const idAkun = input.getAttribute("data-id");
      const field = input.getAttribute("data-field");
      const value = input.value;

      fetch("../Controller/adminController.php", {
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
});
