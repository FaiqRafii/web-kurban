function closeAlert() {
  const alertBox = document.getElementById("alert");
  if (alertBox) {
    alertBox.classList.add("translate-x-full");

    setTimeout(() => {
      alertBox.classList.add("hidden");
    }, 50);
  }
}
