<?php
session_start();
// Example user data, replace with session or database values as needed
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Error';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Error';
include '../nav_sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap & Unicons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
  <link rel="icon" type="image/png" href="Codecrafters/saves/123.png">

  <style>
    /* --- Combined style.css --- */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
    :root {
      --dk-gray-100: #F3F4F6;
      --dk-gray-200: #E5E7EB;
      --dk-gray-300: #D1D5DB;
      --dk-gray-400: #9CA3AF;
      --dk-gray-500: #6B7280;
      --dk-gray-600: #4B5563;
      --dk-gray-700: #374151;
      --dk-gray-800: #1F2937;
      --dk-gray-900: #111827;
      --dk-dark-bg: #313348;
      --dk-darker-bg: #2a2b3d;
      --navbar-bg-color: #6f6486;
      --sidebar-bg-color: #252636;
      --sidebar-width: 250px;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background-color: var(--dk-darker-bg); font-size: .925rem; }
    #wrapper { margin-left: 0; transition: all .3s ease-in-out; }
    #wrapper.fullwidth { margin-left: 0; } /* When sidebar is visible, content shrinks */
    .sidebar { background-color: var(--sidebar-bg-color); width: var(--sidebar-width); transition: all .3s ease-in-out; transform: translateX(0); z-index: 9999999 }
    .sidebar .close-aside { position: absolute; top: 7px; right: 7px; cursor: pointer; color: #EEE; }
    .sidebar .sidebar-header { border-bottom: 1px solid #2a2b3c }
    .sidebar .sidebar-header h5 a { color: var(--dk-gray-300) }
    .sidebar .sidebar-header p { color: var(--dk-gray-400); font-size: .825rem; }
    .sidebar .search .form-control ~ i { color: #2b2f3a; right: 40px; top: 22px; }
    .sidebar > ul > li { padding: .7rem 1.75rem; }
    .sidebar ul > li > a { color: var(--dk-gray-400); text-decoration: none; }
    .sidebar ul > li > i { font-size: 18px; margin-right: .7rem; color: var(--dk-gray-500); }
    .sidebar ul > li.has-dropdown > a:after { content: '\eb3a'; font-family: unicons-line; font-size: 1rem; line-height: 1.8; float: right; color: var(--dk-gray-500); transition: all .3s ease-in-out; }
    .sidebar ul .opened > a:after { transform: rotate(-90deg); }
    .sidebar ul .sidebar-dropdown { padding-top: 10px; padding-left: 30px; display: none; }
    .sidebar ul .sidebar-dropdown.active { display: block; }
    .sidebar ul .sidebar-dropdown > li > a { font-size: .85rem; padding: .5rem 0; display: block; }
    .show-sidebar { transform: translateX(-270px); }
    @media (max-width: 767px) {
      .sidebar ul > li { padding-top: 12px; padding-bottom: 12px; }
      .sidebar .search { padding: 10px 0 10px 30px }
    }
    .welcome { color: var(--dk-gray-300); }
    .welcome .content { background-color: var(--dk-dark-bg); }
    .welcome p { color: var(--dk-gray-400); }
    .statistics { color: var(--dk-gray-200); }
    .statistics .box { background-color: var(--dk-dark-bg); }
    .statistics .box i { width: 60px; height: 60px; line-height: 60px; }
    .statistics .box p { color: var(--dk-gray-400); }
    .charts .chart-container { background-color: var(--dk-dark-bg); }
    .charts .chart-container h3 { color: var(--dk-gray-400) }
    .admins .box .admin { background-color: var(--dk-dark-bg); }
    .admins .box h3 { color: var(--dk-gray-300); }
    .admins .box p { color: var(--dk-gray-400) }
    .statis { color: var(--dk-gray-100); }
    .statis .box { position: relative; overflow: hidden; border-radius: 3px; }
    .statis .box h3:after { content: ""; height: 2px; width: 70%; margin: auto; background-color: rgba(255, 255, 255, 0.12); display: block; margin-top: 10px; }
    .statis .box i { position: absolute; height: 70px; width: 70px; font-size: 22px; padding: 15px; top: -25px; left: -25px; background-color: rgba(255, 255, 255, 0.15); line-height: 60px; text-align: right; border-radius: 50%; }
    .main-color { color: #ffc107 }
    .navbar { background-color: var(--navbar-bg-color) !important; border: none !important; margin-top: 1%;max-width: 98%; align-items: center; margin-left: auto; margin-right: auto; }
    .navbar .dropdown-menu { right: auto !important; left: 0 !important; }
    .navbar .navbar-nav>li>a { color: #EEE !important; line-height: 55px !important; padding: 0 10px !important; }
    .navbar .navbar-brand {color:#FFF !important}
    .navbar .navbar-nav>li>a:focus, .navbar .navbar-nav>li>a:hover {color: #EEE !important}
    .navbar .navbar-nav>.open>a, .navbar .navbar-nav>.open>a:focus, .navbar .navbar-nav>.open>a:hover {background-color: transparent !important; color: #FFF !important}
    .navbar .navbar-brand {line-height: 55px !important; padding: 0 !important}
    .navbar .navbar-brand:focus, .navbar .navbar-brand:hover {color: #FFF !important}
    .navbar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {margin: 0 !important}
    @media (max-width: 767px) {
      .navbar>.container-fluid .navbar-brand { margin-left: 15px !important; }
      .navbar .navbar-nav>li>a { padding-left: 0 !important; }
      .navbar-nav { margin: 0 !important; }
      .navbar .navbar-collapse, .navbar .navbar-form { border: none !important; }
    }
    .navbar .navbar-nav>li>a { float: left !important; }
    .navbar .navbar-nav>li>a>span:not(.caret) { background-color: #e74c3c !important; border-radius: 50% !important; height: 25px !important; width: 25px !important; padding: 2px !important; font-size: 11px !important; position: relative !important; top: -10px !important; right: 5px !important }
    .dropdown-menu>li>a { padding-top: 5px !important; padding-right: 5px !important; }
    .navbar .navbar-nav>li>a>i { font-size: 18px !important; }
    @media (max-width: 767px) {
      #wrapper { margin: 0 !important }
      .statistics .box { margin-bottom: 25px !important; }
      .navbar .navbar-nav .open .dropdown-menu>li>a { color: #CCC !important }
      .navbar .navbar-nav .open .dropdown-menu>li>a:hover { color: #FFF !important }
      .navbar .navbar-toggle{ border:none !important; color: #EEE !important; font-size: 18px !important; }
      .navbar .navbar-toggle:focus, .navbar .navbar-toggle:hover {background-color: transparent !important}
    }
    ::-webkit-scrollbar { background: transparent; width: 5px; height: 5px; }
    ::-webkit-scrollbar-thumb { background-color: #3c3f58; }
    ::-webkit-scrollbar-thumb:hover { background-color: rgba(0, 0, 0, 0.3); }
  </style>
</head>
<body>
<section id="wrapper">
  <div class="p-4">
    <div class="welcome">
      <div class="content rounded-3 p-3 d-flex justify-content-between align-items-center">
        <div>
          <h1 class="fs-3">Welcome to Dashboard</h1>
          <img src="../saves/123.png" alt="User Avatar" width="50" height="50" style="border-radius: 50%; margin-right: 10px; vertical-align: middle;">
          <p class="mb-0">Hello <?php echo htmlspecialchars($user_name); ?>, welcome to your awesome dashboard!</p>
        </div>
        <a href="login.php" class="btn btn-danger" style="font-weight:600; border-radius:8px;">
          <i class="uil uil-signout" style="margin-right:6px;"></i>Logout
        </a>
      </div>
    </div>
    <!-- Take a Test Tab -->
    <div class="d-flex justify-content-center align-items-center" style="min-height:180px;">
      <div style="
      backdrop-filter: blur(12px);
      background: rgba(44, 46, 68, 0.55);
      border-radius: 18px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
      padding: 32px 48px;
      display: flex;
      align-items: center;">
        <button id="takeTestBtn" class="btn btn-primary" style="font-weight:600; font-size:1.1rem; border-radius:8px;">
          <i class="uil uil-clipboard-alt" style="margin-right:8px;"></i>Take a Test
        </button>
      </div>
    </div>
    <!-- Language Selection Popup -->
    <div id="langPopup" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999; background:rgba(8,7,16,0.35); backdrop-filter: blur(6px); align-items:center; justify-content:center;">
      <div style="background:rgba(44,46,68,0.98); border-radius:18px; box-shadow:0 0 40px rgba(8,7,16,0.3); padding:40px 32px; min-width:320px; max-width:90vw; color:#fff; text-align:center; position:relative;">
        <button id="closeLangPopup" style="position:absolute; top:12px; right:18px; background:none; border:none; color:#fff; font-size:1.5rem; cursor:pointer;">&times;</button>
        <h4 style="margin-bottom:24px; color:#23a2f6;">Choose a Language</h4>
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-2">
          <a href="quiz.php?topic=python" class="btn lang-btn m-2">Python</a>
          <a href="quiz.php?topic=c" class="btn lang-btn m-1">C</a>
          <a href="quiz.php?topic=cpp" class="btn lang-btn m-1">C++</a>
          <a href="quiz.php?topic=csharp" class="btn lang-btn m-1">C#</a>
          <a href="quiz.php?topic=rust" class="btn lang-btn m-1">Rust</a>
          <a href="quiz.php?topic=r" class="btn lang-btn m-1">R Programming</a>
          <a href="quiz.php?topic=typescript" class="btn lang-btn m-1">Typescript</a>
          <a href="quiz.php?topic=ruby" class="btn lang-btn m-1">Ruby</a>
          <a href="quiz.php?topic=php" class="btn lang-btn m-1">PHP</a>
          <a href="quiz.php?topic=javascript" class="btn lang-btn m-1">JavaScript</a>
          <a href="quiz.php?topic=sql" class="btn lang-btn m-1">SQL</a>
          <a href="quiz.php?topic=kotlin" class="btn lang-btn m-1">Kotlin</a>
        </div>
        <style>
          .lang-btn {
            border: 2px solid #23a2f6 !important;
            border-radius: 5px;
            color: #23a2f6 !important;
            background: transparent !important;
            font-weight: 600;
            transition: background 0.2s, color 0.2s, border 0.2s;
            padding-top: 1%;
          }
          .lang-btn:hover, .lang-btn:focus {
            background: #23a2f6 !important;
            color: #fff !important;
            border-color: #23a2f6 !important;
          }
        </style>
      </div>
    </div>
    
</body>
<script>
// Popup logic for language selection
document.addEventListener('DOMContentLoaded', function() {
  var takeTestBtn = document.getElementById('takeTestBtn');
  var langPopup = document.getElementById('langPopup');
  var closeLangPopup = document.getElementById('closeLangPopup');
  if (takeTestBtn && langPopup) {
    takeTestBtn.addEventListener('click', function() {
      langPopup.style.display = 'flex';
    });
  }
  if (closeLangPopup && langPopup) {
    closeLangPopup.addEventListener('click', function() {
      langPopup.style.display = 'none';
    });
  }
  // Optional: close popup when clicking outside the box
  langPopup.addEventListener('click', function(e) {
    if (e.target === langPopup) langPopup.style.display = 'none';
  });
});
</script>
<section style="height: 900px; overflow-y: auto;">
  <!-- Side scrolling section for test scores -->
  <div style="width:100%; overflow-x:auto; margin-top:32px; height:180px;">
    <div style="display:flex; gap:24px; min-width:400px; padding-bottom:16px;">
    <?php
    // Fetch user scores from DB
    $user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '';
    $con = mysqli_connect('localhost', 'root', '', 'codecrafters');
    if ($con && $user_email) {
      $res = mysqli_query($con, "SELECT * FROM user_score WHERE email='" . mysqli_real_escape_string($con, $user_email) . "' ORDER BY created_at DESC");
      while ($row = mysqli_fetch_assoc($res)) {
        $lang = htmlspecialchars($row['language']);
        $score = intval($row['score']);
        echo '<div style="min-width:260px; max-width:320px; background:rgba(44,46,68,0.85); border-radius:16px; box-shadow:0 4px 18px rgba(8,7,16,0.18); padding:24px 18px; display:flex; flex-direction:column; align-items:center; justify-content:center;">';
        echo '<div style="font-size:1.1rem; font-weight:600; color:#23a2f6; margin-bottom:10px;">' . ucfirst($lang) . ' Test</div>';
        echo '<div style="font-size:1.3rem; font-weight:700; color:#fff; margin-bottom:12px;">Score: ' . $score . '</div>';
        echo '<button class="btn btn-outline-info" style="font-weight:600; border-radius:8px;" onclick="window.location.href=\'courses.php\'">Courses</button>';
        echo '</div>';
      }
    }
    ?>
    </div>
  </div>

  <!-- Statistics Section -->
  <section class="statistics mt-4">
    <div class="row">
      <div class="col-lg-4">
        <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
          <i class="uil-envelope-shield fs-2 text-center bg-primary rounded-circle"></i>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h3 class="mb-0">50</h3> <span class="d-block ms-2">Levels</span>
            </div>
            <p class="fs-normal mb-0">Grow Yourself by Leveling Up</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
          <i class="uil-file fs-2 text-center bg-danger rounded-circle"></i>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h3 class="mb-0">20</h3> <span class="d-block ms-2">Programming Languages</span>
            </div>
            <p class="fs-normal mb-0">More Features and Modeling</p>
          </div> 
        </div>
      </div>
      <div class="col-lg-4">
        <div class="box d-flex rounded-2 align-items-center p-3">
          <i class="uil-users-alt fs-2 text-center bg-success rounded-circle"></i>
          <div class="ms-3">
            <div class="d-flex align-items-center">
              <h3 class="mb-0">5,245</h3> <span class="d-block ms-2">Questions</span>
            </div>
            <p class="fs-normal mb-0">Logical, Aptitude, Verbal, DSA, Python</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Charts Section -->
  <section class="charts mt-4">
    <div class="row">
      <div class="col-lg-6">
        <div class="chart-container rounded-2 p-3">
          <h3 class="fs-6 mb-3">Score Chart</h3>
          <canvas id="myChart"></canvas>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="chart-container rounded-2 p-3">
          <h3 class="fs-6 mb-3">Progress</h3>
          <canvas id="myChart2"></canvas>
        </div>
      </div>
    </div>
  </section>

  <!-- Admins Section -->
  <section class="admins mt-4">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
            <div class="img">
              <img class="img-fluid rounded-pill" width="75" height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP">
            </div>
            <div class="ms-3">
              <h3 class="fs-5 mb-1">PHP</h3>
              <p class="mb-0">A popular server-side scripting language especially suited for web development.</p>
            </div>
          </div>
          <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
            <div class="img">
              <img class="img-fluid rounded-pill" width="75" height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="Python">
            </div>
            <div class="ms-3">
              <h3 class="fs-5 mb-1">Python</h3>
              <p class="mb-0">A versatile, high-level programming language known for its readability and wide range of applications.</p>
            </div>
          </div>
          <div class="admin d-flex align-items-center rounded-2 p-3">
            <div class="img">
              <img class="img-fluid rounded-pill" width="75" height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript">
            </div>
            <div class="ms-3">
              <h3 class="fs-5 mb-1">JavaScript</h3>
              <p class="mb-0">The language of the web, enabling interactive and dynamic content in browsers.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
            <div class="img">
              <img class="img-fluid rounded-pill" width="75" height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg" alt="Java">
            </div>
            <div class="ms-3">
              <h3 class="fs-5 mb-1">Java</h3>
              <p class="mb-0">A robust, object-oriented language widely used for enterprise and Android development.</p>
            </div>
          </div>
          <div class="admin d-flex align-items-center rounded-2 p-3 mb-4">
            <div class="img">
              <img class="img-fluid rounded-pill" width="75" height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg" alt="C++">
            </div>
            <div class="ms-3">
              <h3 class="fs-5 mb-1">C++</h3>
              <p class="mb-0">A powerful language for system/software development, known for its performance and flexibility.</p>
            </div>
          </div>
          <div class="admin d-flex align-items-center rounded-2 p-3">
            <div class="img">
              <img class="img-fluid rounded-pill" width="75" height="75" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/ruby/ruby-original.svg" alt="Ruby">
            </div>
            <div class="ms-3">
              <h3 class="fs-5 mb-1">Ruby</h3>
              <p class="mb-0">A dynamic, open source language with a focus on simplicity and productivity.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Statis Section -->
  <section class="statis mt-4 text-center">
    <div class="row">
      <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="box bg-primary p-3">
          <i class="uil-eye"></i>
          <h3>5,154</h3>
          <p class="lead">Total Points

          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="box bg-danger p-3">
          <i class="uil-user"></i>
          <h3>245</h3>
          <p class="lead">Questions solved</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
        <div class="box bg-warning p-3">
          <i class="uil-shopping-cart"></i>
          <h3>5,154</h3>
          <p class="lead">Last Score</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="box bg-success p-3">
          <i class="uil-feedback"></i>
          <h3>5Hrs 20Min</h3>
          <p class="lead">Time Spent</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Extra Chart Section -->
  <section class="charts mt-4">
    <div class="chart-container p-3">
      <h3 class="fs-6 mb-3">Your Average</h3>
      <div style="height: 300px">
        <canvas id="chart3" width="100%"></canvas>
      </div>
    </div>
  </section>
</section>
<!-- JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // --- Combined script.js ---
  'use strict'
  function $(selector) { return document.querySelector(selector) }
  function find(el, selector) { let finded; return (finded = el.querySelector(selector)) ? finded : null }
  function siblings(el) { const siblings = []; for (let sibling of el.parentNode.children) { if (sibling !== el) { siblings.push(sibling) } } return siblings }
  const showAsideBtn = $('.show-side-btn')
  const sidebar = $('.sidebar')
  const wrapper = $('#wrapper')
  showAsideBtn.addEventListener('click', function () {
    sidebar.classList.toggle('show-sidebar')
    wrapper.classList.toggle('expanded')
  })
  if (window.innerWidth < 767) {
    sidebar.classList.add('show-sidebar');
    wrapper.classList.remove('expanded');
  } else {
    sidebar.classList.remove('show-sidebar');
    wrapper.classList.add('expanded');
  }
  window.addEventListener('resize', function () {
    if (window.innerWidth > 767) {
      sidebar.classList.remove('show-sidebar');
      wrapper.classList.add('expanded');
    } else {
      sidebar.classList.add('show-sidebar');
      wrapper.classList.remove('expanded');
    }
  });
  var slideNavDropdown = $('.sidebar-dropdown');
  $('.sidebar .categories').addEventListener('click', function (event) {
    event.preventDefault()
    const item = event.target.closest('.has-dropdown')
    if (! item) { return }
    item.classList.toggle('opened')
    siblings(item).forEach(sibling => { sibling.classList.remove('opened') })
    if (item.classList.contains('opened')) {
      const toOpen = find(item, '.sidebar-dropdown')
      if (toOpen) { toOpen.classList.add('active') }
      siblings(item).forEach(sibling => {
        const toClose = find(sibling, '.sidebar-dropdown')
        if (toClose) { toClose.classList.remove('active') }
      })
    } else {
      find(item, '.sidebar-dropdown').classList.toggle('active')
    }
  })
  $('.sidebar .close-aside').addEventListener('click', function () {
    $(`#${this.dataset.close}`).classList.add('show-sidebar')
    wrapper.classList.remove('margin')
  })
  Chart.defaults.global.animation.duration = 2000;
  Chart.defaults.global.title.display = false;
  Chart.defaults.global.defaultFontColor = '#71748c';
  Chart.defaults.global.defaultFontSize = 13;
  Chart.defaults.global.tooltips.backgroundColor = '#111827'
  Chart.defaults.global.tooltips.borderColor = 'blue'
  Chart.defaults.scale.gridLines.zeroLineColor = '#3b3d56'
  Chart.defaults.scale.gridLines.color = '#3b3d56'
  Chart.defaults.scale.gridLines.drawBorder = false
  Chart.defaults.global.legend.labels.padding = 0;
  Chart.defaults.global.legend.display = false;
  Chart.defaults.scale.ticks.fontSize = 12
  Chart.defaults.scale.ticks.fontColor = '#71748c'
  Chart.defaults.scale.ticks.beginAtZero = false
  Chart.defaults.scale.ticks.padding = 10
  Chart.defaults.global.elements.point.radius = 0
  Chart.defaults.global.responsive = true
  Chart.defaults.global.maintainAspectRatio = false
  var myChart = new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
      labels: ["January", "February", "March", "April", 'May', 'June', 'August', 'September'],
      datasets: [{
        label: "Lost",
        data: [45, 25, 40, 20, 60, 20, 35, 25],
        backgroundColor: "#0d6efd",
        borderColor: 'transparent',
        borderWidth: 2.5,
        barPercentage: 0.4,
      }, {
        label: "Succes",
        startAngle: 2,
        data: [20, 40, 20, 50, 25, 40, 25, 10],
        backgroundColor: "#dc3545",
        borderColor: 'transparent',
        borderWidth: 2.5,
        barPercentage: 0.4,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          gridLines: {},
          ticks: { stepSize: 15, },
        }],
        xAxes: [{
          gridLines: { display: false, }
        }]
      }
    }
  })
  var chart = new Chart(document.getElementById('myChart2'), {
    type: 'line',
    data: {
      labels: ["January", "February", "March", "April", 'May', 'June', 'August', 'September'],
      datasets: [{
        label: "My First dataset",
        data: [4, 20, 5, 20, 5, 25, 9, 18],
        backgroundColor: 'transparent',
        borderColor: '#0d6efd',
        lineTension: .4,
        borderWidth: 1.5,
      }, {
        label: "Month",
        data: [11, 25, 10, 25, 10, 30, 14, 23],
        backgroundColor: 'transparent',
        borderColor: '#dc3545',
        lineTension: .4,
        borderWidth: 1.5,
      }, {
        label: "Month",
        data: [16, 30, 16, 30, 16, 36, 21, 35],
        backgroundColor: 'transparent',
        borderColor: '#f0ad4e',
        lineTension: .4,
        borderWidth: 1.5,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          gridLines: { drawBorder: false },
          ticks: { stepSize: 12, }
        }],
        xAxes: [{
          gridLines: { display: false, },
        }]
      }
    }
  })
  var chart3 = document.getElementById('chart3');
  var myChart3 = new Chart(chart3, {
    type: 'line',
    data: {
      labels: ["One", "Two", "Three", "Four", "Five", 'Six', "Seven", "Eight"],
      datasets: [{
        label: "Lost",
        lineTension: 0.2,
        borderColor: '#d9534f',
        borderWidth: 1.5,
        showLine: true,
        data: [3, 30, 16, 30, 16, 36, 21, 40, 20, 30],
        backgroundColor: 'transparent'
      }, {
        label: "Lost",
        lineTension: 0.2,
        borderColor: '#5cb85c',
        borderWidth: 1.5,
        data: [6, 20, 5, 20, 5, 25, 9, 18, 20, 15],
        backgroundColor: 'transparent'
      },
      {
        label: "Lost",
        lineTension: 0.2,
        borderColor: '#f0ad4e',
        borderWidth: 1.5,
        data: [12, 20, 15, 20, 5, 35, 10, 15, 35, 25],
        backgroundColor: 'transparent'
      },
      {
        label: "Lost",
        lineTension: 0.2,
        borderColor: '#337ab7',
        borderWidth: 1.5,
        data: [16, 25, 10, 25, 10, 30, 14, 23, 14, 29],
        backgroundColor: 'transparent'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          gridLines: { drawBorder: false },
          ticks: { stepSize: 12 }
        }],
        xAxes: [{
          gridLines: { display: false, },
        }],
      }
    }
  })
</script>
</body>
</html>