<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

$pdo = getDB();
$projects   = $pdo->query('SELECT * FROM projects ORDER BY sort_order ASC, id ASC')->fetchAll();
$educations = $pdo->query('SELECT * FROM education ORDER BY sort_order ASC, id ASC')->fetchAll();
$experiences = $pdo->query('SELECT * FROM experience ORDER BY sort_order ASC, id ASC')->fetchAll();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ahmad Ridwan Khoironi | Informatics Engineering</title>

    <meta
      name="description"
      content="Portfolio of Ahmad Ridwan Khoironi, Informatics Engineering. Specializing in Laravel, PHP, Next.js, and building innovative, scalable digital business solutions"
    />

    <link rel="icon" type="image/jpeg" href="assets/foto_diri.jpg" />
    <link rel="apple-touch-icon" href="assets/foto_diri.jpg" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="https:// /" />
    <meta
      property="og:title"
      content="Ahmad Ridwan Khoironi | Informatics Engineering"
    />
    <meta
      property="og:description"
      content="Information Systems student & Informatics Engineering. View my portfolio."
    />
    <meta property="og:image" content="https:// /assets/foto_diri.jpg" />
    <meta property="og:image:width" content="1000" />
    <meta property="og:image:height" content="700" />
    <meta property="og:image:type" content="image/jpeg" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="https:// /" />
    <meta
      name="twitter:title"
      content="Ahmad Ridwan Khoironi | Informatics Engineering"
    />
    <meta
      name="twitter:description"
      content="Information Systems student & Informatics Engineering. View my portfolio."
    />
    <meta name="twitter:image" content="https:// /assets/foto_diri.jpg" />

    <meta
      name="google-site-verification"
      content="Ts9F9SsCrWW-GhvIngLud9StUG38j2ewDG3Nt7YHqlI"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css"
    />

    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand fw-bold text-white" href="#">PORTOFOLIO</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#home" data-i18n="nav_home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about" data-i18n="nav_about">About</a>
            </li>
            <?php if (!empty($projects)): ?>
            <li class="nav-item">
              <a class="nav-link" href="#projects" data-i18n="nav_projects">Projects</a>
            </li>
            <?php endif; ?>
            <?php if (!empty($experiences)): ?>
            <li class="nav-item">
              <a class="nav-link" href="#organization" data-i18n="nav_org">Organizations</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="#tools" data-i18n="nav_tools">Tools</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact" data-i18n="nav_contact"
                >Contact</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="home" class="hero d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-8">
            <img
              src="assets/Photo.jpg"
              alt="Ahmad Ridwan Khoironi"
              class="hero-photo mb-4"
            />
            <h1 class="hero-title display-4 fw-bold mb-2 text-white">
              Ahmad Ridwan Khoironi
            </h1>
            <p class="hero-subtitle fs-4 mb-4" data-i18n="hero_subtitle"></p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
              <a
                href="https://api.kemnaker.go.id/profile/v1/profiles/7d4610c3-b7d7-44a6-b7c2-a4f6fb2ab075/cv-creative/download?_token=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJjbGllbnQiOiJlZTlmYWFiNi1lNzcwLTQxNDQtOGRiMC1mMGVjNDkxMWU4ODYiLCJ1c2VyIjoiYmZjOGVlYjAtNDhhNS00Mzc4LTlmOGQtMGFmYTA0OWEzZDkwIiwidHRsIjoyMTYwMCwic3ViIjoiOTA2NWNlOWItYzRiMy00ZGVlLTliYWYtNzQ1MzJkNmRiNTliIiwiYXVkIjoiZWU5ZmFhYjYtZTc3MC00MTQ0LThkYjAtZjBlYzQ5MTFlODg2IiwiZmluZ2VycHJpbnQiOiI2ZTFhNzRiMGU5MDgzYWQ1NzQ2YTFlY2QzMzU0NTA3ZDZiM2RlMDczIn0.Psg8nrEaJE4ScnpuANOu4j4z9DQ15CEMI-cTSAo6tjYCacXGdmm09hQ8PHJxIp7LEXPnko4XSl3Uwz6iZGYCfH9F_yys1OvvARV6AJqHY5QbvanmtFEhjmYR2CMi9TueXQhaOcLkeYp28e-LgbtDdi2ochZkX8eaKN6Dq31wgT5P4nyE_HtDThhB6Tdhaoo9vQiNFxL5Ng035_eyeNqVswtsXhxOo2Ntdc36bPPBAJibn1SrGflVIqcHVqBCE8qavMqJDFe1nATJhGMEkZML6nXdCmJsKTpCETGqaWrT39rRd78ljp4ZfpWUu1Z5gq2HBGZ3B6FP5Lj10662U2jswRRhjJoJmqOoS0xMmvdvFYOy9pkkymzWkr2cyIvXntkBfjqMTgKcO-UyYHR0gYxJ_61-lZzSpvPMiodF1oDzgm6msdLJoW3CJjGI0buOikLpHt-G_KOa0a7wAZJGxM9ZmxlNS1ElXKiCE02Lit755FxIFqrpkOzq9Wg0kk_cnUnhJX39uLkVay-STewfhc9zj-gyNJ3DVXD6tQGLXF68d_e7YRwNzF9bXHXijfMzOUGSR5P_o17lVN8g86WzjeDujX96QutF28GLXUbEpFjf5Mfyg48htcK91YkO4v9Ru-Zo3ksg9qGdzAuL9s_7uUK4pTYd2hw3TOVir5LLWrnjeq0"
                id="downloadCvBtn"
                class="btn btn-outline-info btn-lg px-4 custom-btn"
              >
                <i class="bi bi-file-earmark-pdf"></i>
                <span data-i18n="btn_cv"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section
      id="about"
      class="section py-5 reveal-section"
      data-reveal="fade-up"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="about_title"></h2>
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <p
              class="about-text text-light opacity-75"
              style="text-align: justify"
              data-i18n="about_desc"
            ></p>
          </div>
        </div>
      </div>
    </section>

    <?php if (!empty($projects)): ?>
    <!-- PROJECTS -->
    <section
      id="projects"
      class="section py-5 reveal-section"
      data-reveal="fade-up"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="projects_title">Projects</h2>
        <div class="row g-4">
          <?php foreach ($projects as $proj): ?>
          <div class="col-md-6 col-lg-4">
            <div class="project-card h-100 p-4">
              <?php if (!empty($proj['image'])): ?>
                <div class="project-logo-wrap mb-3">
                  <img src="uploads/projects/<?= e($proj['image']) ?>" alt="<?= e($proj['title']) ?>" class="project-logo">
                </div>
              <?php endif; ?>
              <h5 class="text-white mb-2"><?= e($proj['title']) ?></h5>
              <p class="text-light opacity-75 small mb-3"><?= nl2br(e($proj['description'])) ?></p>
              <?php if (!empty($proj['tech_stack'])): ?>
                <div class="mb-3 d-flex flex-wrap gap-1">
                  <?php foreach (array_filter(array_map('trim', explode(',', $proj['tech_stack']))) as $tech): ?>
                    <span class="badge rounded-pill text-bg-dark border border-secondary-subtle small fw-normal"><?= e($tech) ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <div class="d-flex gap-2">
                <?php if (!empty($proj['project_url'])): ?>
                  <a href="<?= e($proj['project_url']) ?>" target="_blank" class="btn btn-sm btn-outline-info">
                    <i class="bi bi-box-arrow-up-right"></i> Demo
                  </a>
                <?php endif; ?>
                <?php if (!empty($proj['github_url'])): ?>
                  <a href="<?= e($proj['github_url']) ?>" target="_blank" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-github"></i> Code
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- EDUCATION -->
    <section
      id="education"
      class="section py-5 bg-darker reveal-section"
      data-reveal="slide-right"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="edu_title"></h2>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php if (!empty($educations)): ?>
              <?php foreach ($educations as $edu): ?>
              <div class="edu-card text-center p-4 mb-4">
                <div class="edu-icon mb-3">
                  <i class="bi bi-building fs-2 text-primary"></i>
                </div>
                <h4 class="text-white"><?= e($edu['institution']) ?></h4>
                <p class="text-primary mb-0">
                  <?= e($edu['major']) ?><?= (!empty($edu['major']) && !empty($edu['period'])) ? ' &middot; ' : '' ?><?= e($edu['period']) ?>
                </p>
                <?php if (!empty($edu['description'])): ?>
                  <p class="text-light opacity-75 small mb-0 mt-2"><?= nl2br(e($edu['description'])) ?></p>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-center text-light opacity-50">Belum ada data pendidikan.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <?php if (!empty($experiences)): ?>
    <!-- EXPERIENCE / ORGANIZATION -->
    <section
      id="organization"
      class="section py-5 reveal-section"
      data-reveal="slide-left"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="nav_org">Organizations</h2>
        <div class="row justify-content-center g-4">
          <?php foreach ($experiences as $exp): ?>
          <div class="col-lg-8">
            <div class="org-card p-4 d-flex gap-3 align-items-start">
              <div class="org-icon-wrap">
                <i class="bi bi-briefcase text-primary"></i>
              </div>
              <div>
                <h5 class="text-white mb-1"><?= e($exp['organization']) ?></h5>
                <p class="text-primary small mb-2">
                  <?= e($exp['role']) ?><?= (!empty($exp['role']) && !empty($exp['period'])) ? ' &middot; ' : '' ?><?= e($exp['period']) ?>
                </p>
                <?php if (!empty($exp['description'])): ?>
                  <p class="text-light opacity-75 small mb-0"><?= nl2br(e($exp['description'])) ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- HARD SKILLS -->
    <section
      id="hardskill"
      class="section py-5 reveal-section"
      data-reveal="flip-up"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="hard_title"></h2>
        <div class="row g-4 justify-content-center text-center">
          <div class="col-sm-6 col-lg-4">
            <div class="hard-skill-card p-4 h-100">
              <i
                class="bi bi-window-sidebar fs-1 mb-3 text-primary d-block"
              ></i>
              <h5 class="text-white mb-2" data-i18n="hard_title1"></h5>
              <p class="text-light opacity-75 mb-0" data-i18n="hard_desc1"></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="hard-skill-card p-4 h-100">
              <i class="bi bi-server fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white mb-2" data-i18n="hard_title2"></h5>
              <p class="text-light opacity-75 mb-0" data-i18n="hard_desc2"></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="hard-skill-card p-4 h-100">
              <i
                class="bi bi-database-check fs-1 mb-3 text-primary d-block"
              ></i>
              <h5 class="text-white mb-2" data-i18n="hard_title3"></h5>
              <p class="text-light opacity-75 mb-0" data-i18n="hard_desc3"></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="hard-skill-card p-4 h-100">
              <i class="bi bi-plug fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white mb-2" data-i18n="hard_title4"></h5>
              <p class="text-light opacity-75 mb-0" data-i18n="hard_desc4"></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="hard-skill-card p-4 h-100">
              <i class="bi bi-phone fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white mb-2" data-i18n="hard_title5"></h5>
              <p class="text-light opacity-75 mb-0" data-i18n="hard_desc5"></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="hard-skill-card p-4 h-100">
              <i
                class="bi bi-cloud-arrow-up fs-1 mb-3 text-primary d-block"
              ></i>
              <h5 class="text-white mb-2" data-i18n="hard_title6"></h5>
              <p class="text-light opacity-75 mb-0" data-i18n="hard_desc6"></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SOFT SKILLS -->
    <section
      id="softskill"
      class="section py-5 bg-darker reveal-section"
      data-reveal="slide-right"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="skill_title"></h2>
        <div class="row g-4 justify-content-center text-center">
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-lightbulb fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title1"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-graph-up fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title2"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-people fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title3"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-mic fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title4"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-person-badge fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title5"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-stars fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title6"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-palette fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title7"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-search fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title8"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="skill-card p-4">
              <i class="bi bi-clock-history fs-1 mb-3 text-primary d-block"></i>
              <h5 class="text-white" data-i18n="skill_title9"></h5>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TOOLS -->
    <section
      id="tools"
      class="section py-5 reveal-section"
      data-reveal="rotate-in"
    >
      <div class="container">
        <h2 class="section-title text-center mb-5" data-i18n="tools_title">
          Tools & Technologies
        </h2>
        <div class="row g-3 justify-content-center text-center">
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-html5-plain"></i> HTML
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-css3-plain"></i> CSS
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-javascript-plain"></i> JavaScript
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-php-plain"></i> PHP
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-mysql-plain"></i> MySQL
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-bootstrap-plain"></i> Bootstrap
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-nextjs-plain"></i> Next.js
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="bi bi-database-fill"></i> phpMyAdmin
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-github-original"></i> GitHub
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-vscode-plain"></i> VSCode
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="bi bi-robot"></i> Gemini AI
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-cloudflare-plain"></i> Cloudflare
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-googlecloud-plain"></i> Google Cloud
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="bi bi-stars"></i> Claude AI
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-nodejs-plain"></i> Node.js
            </div>
          </div>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="tool-badge w-100 h-100">
              <i class="devicon-react-original"></i> React.js
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer
      id="contact"
      class="py-5 bg-darker reveal-section"
      data-reveal="fade-in"
    >
      <div class="container">
        <!-- Judul -->
        <div class="row justify-content-center text-center mb-5">
          <div class="col-12">
            <h4 class="text-white fw-semibold" data-i18n="contact_title">
              Contact Me
            </h4>
          </div>
        </div>

        <!-- Konten utama -->
        <div class="row align-items-start g-4">
          <!-- Kiri: info kontak -->
          <div class="col-12 col-md-6 text-center text-md-start">
            <div
              class="d-flex flex-column align-items-center align-items-md-start gap-2"
            >
              <a
                href="mailto:arkhoironi175@gmail.com"
                class="contact-link text-decoration-none d-flex align-items-center gap-2"
              >
                <i class="bi bi-envelope fs-6"></i>
                <span class="text-break">arkhoironi175@gmail.com</span>
              </a>
              <a
                href="https://wa.me/6285815016094"
                target="_blank"
                class="contact-link text-decoration-none d-flex align-items-center gap-2"
              >
                <i class="bi bi-whatsapp fs-6"></i>
                <span>+62 858-1501-6094</span>
              </a>
              <span
                class="text-light opacity-50 d-flex align-items-center gap-2 small"
              >
                <i class="bi bi-geo-alt-fill fs-6"></i>
                <span>Pati, Jawa Tengah</span>
              </span>
            </div>
          </div>

          <!-- Kanan: tombol sosial media -->
          <div class="col-12 col-md-6 text-center text-md-end">
            <p
              class="text-uppercase text-light opacity-25 small fw-semibold mb-3"
              style="letter-spacing: 0.1em"
            >
              Connect
            </p>
            <div
              class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-end"
            >
              <a
                href="https://github.com/arkhoironi"
                target="_blank"
                class="social-btn text-decoration-none d-inline-flex align-items-center gap-2"
              >
                <i class="bi bi-github"></i> GitHub
              </a>

              <a
                href="https://www.instagram.com/elfthann_"
                target="_blank"
                class="social-btn text-decoration-none d-inline-flex align-items-center gap-2"
              >
                <i class="bi bi-instagram"></i> Instagram
              </a>
            </div>
          </div>
        </div>

        <hr class="border-secondary mt-5 mb-4 opacity-25" />

        <div
          class="text-center text-light opacity-50 small"
          data-i18n="footer_rights"
        >
          © <span class="current-year"></span> Ahmad Ridwan Khoironi. All Rights
          Reserved.
        </div>
      </div>
    </footer>

    <button id="langToggle" class="lang-toggle-btn">
      <i class="bi bi-translate"></i> <span id="langLabel">EN</span>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
  </body>
</html>
