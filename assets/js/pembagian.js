const search = document.querySelector('input[name="keyword"]');
const tabelPembagian = document.getElementById("isiTabelPembagian");
const checkbox = document.querySelectorAll('input[name="statusCheck"]');

search.addEventListener("input", function (e) {
  const keyword = e.target.value;
  fetch(`../tampilan/panitiaTampilan.php?searchp=${encodeURIComponent(keyword)}`)
    .then((response) => response.text())
    .then((data) => {
      tabelPembagian.innerHTML = data;
      const checkbox = document.querySelectorAll('input[name="statusCheck"]');
      checkbox.forEach((c) => {
        c.addEventListener("change", function () {
          const idPembagian = c.getAttribute("data-idPembagian");
          if (c.checked) {
            fetch(`../action/panitiaAction.php`, {
              method: "POST",
              headers: { "Content-Type": "application/x-www-form-urlencoded" },
              body: `action=checkedStatus&id=${encodeURIComponent(
                idPembagian
              )}`,
            })
              .then((response) => response.text())
              .then((data) => {
                console.log("Berhasil update status: ", data);
              })
              .catch((error) => {
                console.log("Gagal update status: ", data);
              });
          } else {
            fetch(`../action/panitiaAction.php`, {
              method: "POST",
              headers: { "Content-Type": "application/x-www-form-urlencoded" },
              body: `action=uncheckedStatus&id=${encodeURIComponent(
                idPembagian
              )}`,
            })
              .then((response) => response.text())
              .then((data) => {
                console.log("Berhasil update status: ", data);
              })
              .catch((error) => {
                console.log("Gagal update status: ", data);
              });
          }
        });
      });
    })
    .catch((error) => {
      console.log("Error: ", error);
    });
});

checkbox.forEach((c) => {
  c.addEventListener("change", function () {
    const idPembagian = c.getAttribute("data-idPembagian");
    if (c.checked) {
      fetch(`../action/panitiaAction.php`, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=checkedStatus&id=${encodeURIComponent(idPembagian)}`,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log("Berhasil update status: ", data);
        })
        .catch((error) => {
          console.log("Gagal update status: ", data);
        });
    } else {
      fetch(`../action/panitiaAction.php`, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=uncheckedStatus&id=${encodeURIComponent(idPembagian)}`,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log("Berhasil update status: ", data);
        })
        .catch((error) => {
          console.log("Gagal update status: ", data);
        });
    }
  });
});
