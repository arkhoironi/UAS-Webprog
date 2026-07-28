document.addEventListener("DOMContentLoaded", () => {
  anime({
    targets: ".hero-photo",
    scale: [0.8, 1],
    opacity: [0, 1],
    duration: 1200,
    easing: "easeOutExpo",
  });

  anime({
    targets: ".hero-title",
    translateY: [60, 0],
    opacity: [0, 1],
    duration: 1000,
    delay: 300,
    easing: "easeOutExpo",
  });

  anime({
    targets: ".hero-subtitle",
    translateY: [40, 0],
    opacity: [0, 1],
    duration: 1000,
    delay: 600,
    easing: "easeOutExpo",
  });

  const revealVariants = {
    "fade-up": { opacity: [0, 1], translateY: [50, 0] },
    "slide-left": { opacity: [0, 1], translateX: [70, 0] },
    "slide-right": { opacity: [0, 1], translateX: [-70, 0] },
    "zoom-in": { opacity: [0, 1], scale: [0.92, 1] },
    "flip-up": { opacity: [0, 1], rotateX: [18, 0], translateY: [30, 0] },
    pop: { opacity: [0, 1], scale: [0.85, 1] },
    "rotate-in": { opacity: [0, 1], rotate: [-8, 0], scale: [0.96, 1] },
    "fade-in": { opacity: [0, 1] },
  };

  const revealObserver = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        const section = entry.target;
        const revealType = section.getAttribute("data-reveal") || "fade-up";
        const animation =
          revealVariants[revealType] || revealVariants["fade-up"];

        anime({
          targets: section,
          ...animation,
          duration: 1000,
          easing: "easeOutExpo",
        });

        anime({
          targets: section.querySelectorAll(
            ".section-title, .project-card, .cert-card, .skill-card, .hard-skill-card, .experience-card, .org-card, .tool-badge, .edu-card, .contact-link, .social-btn",
          ),
          opacity: [0, 1],
          translateY: [24, 0],
          duration: 800,
          delay: anime.stagger(90),
          easing: "easeOutQuad",
        });

        observer.unobserve(section);
      });
    },
    { threshold: 0.18 },
  );

  document.querySelectorAll(".reveal-section").forEach((section) => {
    section.style.opacity = "0";
    revealObserver.observe(section);
  });

  anime({
    targets: ".section-title",
    opacity: [0, 1],
    translateY: [24, 0],
    duration: 800,
    delay: anime.stagger(120),
    easing: "easeOutQuad",
  });

  const certModal = document.getElementById("certModal");
  if (certModal) {
    certModal.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      if (!button) {
        return;
      }

      const imgSrc = button.getAttribute("data-img");
      const certTitle = button.getAttribute("data-title");
      const modalTitle = certModal.querySelector(".modal-title");
      const modalImg = certModal.querySelector("#modalCertImg");

      if (modalTitle) {
        modalTitle.textContent = certTitle;
      }
      if (modalImg) {
        modalImg.src = imgSrc;
      }
    });
  }

  const translations = {
    id: {
      nav_home: "Beranda",
      nav_about: "Tentang",
      nav_contact: "Kontak",
      nav_tools: "Alat Favorit",
      nav_projects: "Proyek",
      hero_subtitle: "Informatics Engineering",
      nav_org: "Organisasi",
      projects_title: "Proyek",
      btn_cv: "Unduh CV",
      about_title: "Tentang Saya",
      about_desc:
        "Saya mahasiswa Mahasiswa Teknik Informatika dengan minat kuat di bidang pemrograman dan pengembangan perangkat lunak. Memiliki kemampuan dalam bahasa pemrograman seperti PHP, dan C++. Berpengalaman dalam mengerjakan proyek berbasis web. Saya juga tertarik pada Copywiriing dan Digital Marketing. Berorientasi pada hasil dan senang bekerja dalam tim untuk mencapai tujuan bersama..",
      edu_title: "Pendidikan",
      tittle_edu_smk: "SMK Luqman Al Hakim Kudus",
      edu_smk: "Rekayasa Perangkat Lunak · 2019 – 2022",
      skill_title: "Soft Skill",
      skill_title1: "Pemecahan Masalah",
      skill_title2: "Berpikir Analitis",
      skill_title3: "Kerja Tim",
      skill_title4: "Berbicara di Depan Umum",
      skill_title5: "Kepemimpinan",
      skill_title6: "Inovatif",
      skill_title7: "Kreatif",
      skill_title8: "Cermat & Teliti",
      skill_title9: "Manajemen Waktu",
      hard_title: "Hard Skill",
      hard_title1: "Frontend Development",
      hard_desc1:
        "Membangun antarmuka web yang responsif, interaktif, dan konsisten di semua perangkat.",
      hard_title2: "Backend Development",
      hard_desc2:
        "Mengembangkan logika aplikasi, REST API, dan layanan server yang stabil dan terstruktur.",
      hard_title3: "Database Management",
      hard_desc3:
        "Merancang dan mengelola database secara efisien untuk mendukung performa aplikasi.",
      hard_title4: "System Integration",
      hard_desc4:
        "Menghubungkan komponen aplikasi, layanan pihak ketiga, dan alur kerja bisnis secara mulus.",
      hard_title5: "Mobile App Basics",
      hard_desc5:
        "Membangun fondasi aplikasi mobile modern menggunakan Flutter dan Dart.",
      hard_title6: "Deployment & Cloud",
      hard_desc6:
        "Menyiapkan dan mengelola aplikasi agar mudah di-deploy, diakses, dan di-scale secara online.",
      tools_title: "Alat Favorit",
      contact_title: "Hubungi Saya",
      footer_rights: "© 2026 Ahmad Ridwan Khoironi. Hak cipta dilindungi.",
    },
    en: {
      nav_home: "Home",
      nav_about: "About",
      nav_contact: "Contact",
      nav_tools: "Favorite Tools",
      nav_projects: "Projects",
      hero_subtitle: "Informatics Engineering",
      nav_org: "Organizations",
      projects_title: "Projects",
      btn_cv: "Download CV",
      about_title: "About Me",
      about_desc:
        "I am an Informatics Engineering student with a strong interest in programming and software development. I have skills in programming languages such as PHP and C++. I have experience working on web-based projects. I am also interested in Copywriting and Digital Marketing. I am results-oriented and enjoy collaborating in teams to achieve shared goals.",
      edu_title: "Education",
      tittle_edu_smk: "Luqman Al Hakim Vocational High School, Kudus",
      edu_smk: "Software Engineering · 2019 – 2022",
      skill_title: "Soft Skills",
      skill_title1: "Problem Solving",
      skill_title2: "Analytical Thinking",
      skill_title3: "Teamwork",
      skill_title4: "Public Speaking",
      skill_title5: "Leadership",
      skill_title6: "Innovative",
      skill_title7: "Creative",
      skill_title8: "Attention to Detail",
      skill_title9: "Time Management",
      hard_title: "Hard Skills",
      hard_title1: "Frontend Development",
      hard_desc1:
        "Building responsive, interactive, and consistent web interfaces across all devices.",
      hard_title2: "Backend Development",
      hard_desc2:
        "Developing application logic, REST APIs, and reliable, well-structured server-side services.",
      hard_title3: "Database Management",
      hard_desc3:
        "Designing and managing databases efficiently to support application performance.",
      hard_title4: "System Integration",
      hard_desc4:
        "Integrating application components, third-party services, and business workflows seamlessly.",
      hard_title5: "Mobile App Development",
      hard_desc5:
        "Building the foundation of modern mobile applications using Flutter and Dart.",
      hard_title6: "Deployment & Cloud",
      hard_desc6:
        "Preparing and managing applications for easy deployment, accessibility, and scalability in the cloud.",
      tools_title: "Favorite Tools",
      contact_title: "Contact Me",
      footer_rights: "© 2026 Ahmad Ridwan Khoironi. All rights reserved.",
    },
  };

  const langToggleBtn = document.getElementById("langToggle");
  const langLabel = document.getElementById("langLabel");
  let currentLang = localStorage.getItem("portfolio_lang") || "en";

  function updateLanguage(lang) {
    document.querySelectorAll("[data-i18n]").forEach((el) => {
      const key = el.getAttribute("data-i18n");
      if (translations[lang] && translations[lang][key]) {
        el.innerHTML = translations[lang][key];
      }
    });

    if (langLabel) {
      langLabel.innerText = lang === "en" ? "ID" : "EN";
    }
    document.documentElement.lang = lang;
    localStorage.setItem("portfolio_lang", lang);
  }

  updateLanguage(currentLang);

  if (langToggleBtn) {
    langToggleBtn.addEventListener("click", () => {
      currentLang = currentLang === "en" ? "id" : "en";
      updateLanguage(currentLang);

      anime({
        targets: langToggleBtn,
        scale: [0.9, 1],
        duration: 300,
        easing: "easeOutElastic(1, .8)",
      });
    });
  }

  const yearSpan = document.querySelector(".current-year");
  if (yearSpan) {
    yearSpan.textContent = new Date().getFullYear();
  }

  const downloadPortoBtn = document.getElementById("downloadPortoBtn");
  if (downloadPortoBtn) {
    downloadPortoBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.open(`format-porto.html?lang=${currentLang}`, "_blank");
    });
  }

  const downloadCvBtn = document.getElementById("downloadCvBtn");
  if (downloadCvBtn) {
    downloadCvBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.open(`format-cv.html?lang=${currentLang}`, "_blank");
    });
  }

  const shareBtn = document.getElementById("shareBtn");
  if (shareBtn) {
    shareBtn.addEventListener("click", async () => {
      const shareData = {
        title: "Ahmad Ridwan Khoironi | Informatics Engineering",
        text: "Halo! Lihat portofolio Ahmad Ridwan Khoironi, Informatics Engineering.",
        url: window.location.href,
      };

      try {
        if (navigator.share) {
          await navigator.share(shareData);
        } else {
          await navigator.clipboard.writeText(window.location.href);
          alert("Link portofolio berhasil disalin ke clipboard!");
        }
      } catch (err) {
        console.log("Share dibatalkan atau terjadi kesalahan:", err);
      }
    });
  }

  console.log(
    "%cPortfolio Ahmad Ridwan Khoironi siap digunakan!",
    "color:#00d4ff; font-size:16px; font-weight:bold",
  );
});
