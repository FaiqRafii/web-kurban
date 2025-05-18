document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");
    const logo = document.getElementById("logo");
  
    window.addEventListener("scroll", () => {
      if (window.scrollY > 500) {
        // Navbar warna & teks
        navbar.classList.replace("bg-[rgb(99,52,14)]", "bg-white");
        navbar.classList.replace("text-white", "text-[rgb(99,52,14)]");
  
        logo.src = "../assets/img/logo2.png";
  
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
  
  
        logo.src = "../assets/img/logo3.png";
  
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
  });
  