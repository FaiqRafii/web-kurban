document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("navbar");
  const profileSvg = document.getElementById("profileSvg");
  const profileBtn = document.getElementById("profileBtn");
  const logo = document.getElementById("logo");
  const navBtn = document.querySelectorAll(".navBtn");
  console.log("Logo:", logo);

  const profileModal = document.getElementById("profileModal");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 500) {
      // Navbar warna & teks
      navbar.classList.replace("bg-[rgb(99,52,14)]", "bg-white");
      navbar.classList.replace("text-white", "text-[rgb(99,52,14)]");
      navBtn.forEach((e) => {
        e.classList.replace(
          "hover:border-white",
          "hover:border-[rgb(99,52,14)]"
        );
      });
      profileSvg.classList.replace("text-white", "text-[rgb(99,52,14)]");
      profileModal.classList.replace("bg-white", "bg-[rgb(99,52,14)]");
      profileModal.classList.replace("text-[rgb(99,52,14)]", "text-white");

      logo.src = "assets/img/logoScroll.png";

      // Nav buttons hover underline color
      document.querySelectorAll(".navBtn").forEach((btn) => {
        btn.classList.replace(
          "hover:border-white",
          "hover:border-[rgb(99,52,14)]"
        );
      });
    } else {
      // Kembali ke kondisi awal
      navbar.classList.replace("bg-white", "bg-[rgb(99,52,14)]");
      navbar.classList.replace("text-[rgb(99,52,14)]", "text-white");
      navBtn.forEach((e) => {
        e.classList.replace(
          "hover:border-[rgb(99,52,14)]",
          "hover:border-white"
        );
      });
      profileSvg.classList.replace("text-[rgb(99,52,14)]", "text-white");
      profileModal.classList.replace("bg-[rgb(99,52,14)]", "bg-white");
      profileModal.classList.replace("text-white", "text-[rgb(99,52,14)]");

      logo.src = "assets/img/logo3.png";

      document.querySelectorAll(".navBtn").forEach((btn) => {
        btn.classList.replace(
          "hover:border-[rgb(99,52,14)]",
          "hover:border-white"
        );
      });
    }
  });

  // Scroll to section
  document.querySelectorAll(".scroll-link").forEach((button) => {
    button.addEventListener("click", function () {
      const target = this.dataset.target;
      const el = document.getElementById(target);
      if (!el) return;
      window.scrollTo({
        top: el.offsetTop - 80,
        behavior: "smooth",
      });
    });
  });

  profileBtn.addEventListener("click", () => {
    profileModal.classList.toggle("hidden");
  });
});
