<?php
// Session and user info
if (session_status() === PHP_SESSION_NONE) session_start();
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Avanti Thakre';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Lorem ipsum dolor sit amet consectetur.';
?>
<!-- Combined Navbar and Sidebar -->
<nav class="navbar navbar-expand-md" style="background: linear-gradient(to right, #1845ad, #23a2f6, #ff512f, #f09819); border-radius: 16px; margin-bottom: 30px; box-shadow: 0 0 20px rgba(8,7,16,0.2);">
  <div class="container-fluid mx-2">
    <div class="navbar-header">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle-navbar" aria-controls="toggle-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="uil-bars text-white"></i>
      </button>
      <a class="navbar-brand" href="#">TheCode<span style="color:#ff512f;">Crafters</span></a>
    </div>
    <div class="collapse navbar-collapse" id="toggle-navbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Settings
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">My account</a></li>
            <li><a class="dropdown-item" href="#">My inbox</a></li>
            <li><a class="dropdown-item" href="#">Help</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Log out</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="uil-comments-alt"></i><span>23</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="openNotificationPanel"><i class="uil-bell"></i><span>98</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i data-show="show-side-navigation1" class="uil-bars show-side-btn"><span>.</span></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left show-sidebar" id="show-side-navigation1" style="background: rgba(255,255,255,0.13); border-radius: 30px; box-shadow: 0 0 40px rgba(8,7,16,0.6); backdrop-filter: blur(10px); width: 250px; min-height: 100vh; border: 6px solid rgba(255,255,255,0.1); color: #fff;">
  <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
  <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
    <img class="rounded-pill img-fluid" width="65"
         src="https://media.licdn.com/dms/image/v2/D4D0BAQFeI4uvxStKLA/company-logo_200_200/company-logo_200_200/0/1683626394630/bosscoderacademy_logo?e=2147483647&v=beta&t=HgOfDJdiJOUOD0J2Ey8SDSI_YD6mmmJS24YoNDI9CHs"
         alt="">
    <div class="ms-2">
      <h5 class="fs-6 mb-0">
        <a class="text-decoration-none" href="#"><?php echo htmlspecialchars($user_name); ?></a>
      </h5>
      <p class="mt-1 mb-0"><?php echo htmlspecialchars($user_email); ?></p>
    </div>
  </div>
  <div class="search position-relative text-center px-4 py-3 mt-2">
    <input type="text" class="form-control w-100 border-0 bg-transparent" placeholder="Search here">
    <i class="fa fa-search position-absolute d-block fs-6"></i>
  </div>
  <ul class="categories list-unstyled">
    <li class="has-dropdown">
      <i class="uil-estate fa-fw"></i><a href="dash.php"> Dashboard</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="#">Overview</a></li>
        <li><a href="#">Reports</a></li>
      </ul>
    </li>
    <li class="has-dropdown">
      <i class="uil-folder"></i><a href="#"> Take Quiz</a>
      <ul class="sidebar-dropdown list-unstyled">
      <div class="d-flex flex-wrap gap-2 px-2 py-2">
        <a href="quiz.php" class="btn btn-outline-primary btn-sm">Python</a>
        <a href="quiz.php?topic=javascript" class="btn btn-outline-primary btn-sm">JavaScript</a>
        <a href="quiz.php?topic=java" class="btn btn-outline-primary btn-sm">Java</a>
        <a href="quiz.php?topic=csharp" class="btn btn-outline-primary btn-sm">C#</a>
        <a href="quiz.php?topic=cpp" class="btn btn-outline-primary btn-sm">C++</a>
        <a href="quiz.php?topic=php" class="btn btn-outline-primary btn-sm">Php</a>
        <a href="quiz.php?topic=typescript" class="btn btn-outline-primary btn-sm">Typescript</a>
        <a href="quiz.php?topic=dotnet" class="btn btn-outline-primary btn-sm">.NET</a>
        <a href="quiz.php?topic=machinelearning" class="btn btn-outline-primary btn-sm">Machine Learning</a>
        <a href="quiz.php?topic=cybersecurity" class="btn btn-outline-primary btn-sm">Cyber Security</a>
        <a href="quiz.php?topic=kotlin" class="btn btn-outline-primary btn-sm">Kotlin</a>
        <a href="quiz.php?topic=r" class="btn btn-outline-primary btn-sm">R</a>
        <a href="quiz.php?topic=rust" class="btn btn-outline-primary btn-sm">Rust</a>
        <a href="quiz.php?topic=matlab" class="btn btn-outline-primary btn-sm">Matlab</a>
        <a href="quiz.php?topic=sql" class="btn btn-outline-primary btn-sm">SQL</a>
        <a href="quiz.php?topic=ruby" class="btn btn-outline-primary btn-sm">Ruby</a>
      </div>
      </ul>
    </li>
    <li class="has-dropdown">
      <i class="uil-calendar-alt"></i><a href="#"> Calendar</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="#">Events</a></li>
      </ul>
    </li>
    <li><i class="uil-setting"></i><a href="#"> Settings</a></li>
    <li class="mt-3 text-center">
      <a href="login.php" class="btn btn-danger w-75" style="font-weight:600; border-radius:8px;">
        <i class="uil uil-signout" style="margin-right:6px;"></i>Logout
      </a>
    </li>
  </ul>
</aside>
<!-- Notification Sidebar -->
<aside id="notification-sidebar" style="
  position: fixed;
  top: 0;
  right: -320px;
  width: 320px;
  height: 100vh;
  background: rgba(255,255,255,0.13);
  border-radius: 0 20px 20px 0;
  box-shadow: 0 0 40px rgba(8,7,16,0.6);
  backdrop-filter: blur(10px);
  z-index: 10000;
  transition: right 0.3s;
  color: #fff;
  border: 2px solid rgba(255,255,255,0.1);
  display: flex;
  flex-direction: column;
">
  <div style="padding: 24px 20px 12px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center;">
    <i class="uil-bell" style="font-size: 2rem; margin-right: 10px;"></i>
    <span style="font-size: 1.2rem; font-weight: 600;">Notifications</span>
    <button id="close-notification" style="margin-left:auto; background:none; border:none; color:#fff; font-size:1.5rem; cursor:pointer;">&times;</button>
  </div>
  <div style="flex:1; padding:20px; overflow-y:auto;">
    <div style="margin-bottom:20px; color:#23a2f6;">No new notifications.</div>
    <div id="notification-messages"></div>
  </div>
</aside>
<!-- Chatbot Sidebar -->
<aside id="chatbot-sidebar" style="
  position: fixed;
  top: 0;
  right: -320px;
  width: 320px;
  height: 100vh;
  background: rgba(255,255,255,0.13);
  border-radius: 0 20px 20px 0;
  box-shadow: 0 0 40px rgba(8,7,16,0.6);
  backdrop-filter: blur(10px);
  z-index: 10000;
  transition: right 0.3s;
  color: #fff;
  border: 2px solid rgba(255,255,255,0.1);
  display: flex;
  flex-direction: column;
">
  <div style="padding: 24px 20px 12px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center;">
    <i class="uil-comments-alt" style="font-size: 2rem; margin-right: 10px;"></i>
    <span style="font-size: 1.2rem; font-weight: 600;">Chatbot</span>
    <button id="close-chatbot" style="margin-left:auto; background:none; border:none; color:#fff; font-size:1.5rem; cursor:pointer;">&times;</button>
  </div>
  <div style="flex:1; padding:20px; overflow-y:auto;">
    <div style="margin-bottom:20px; color:#23a2f6;">Hi! How can I help you today?</div>
    <div id="chatbot-messages"></div>
  </div>
  <div style="padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.1);">
    <form id="chatbot-form" style="display:flex;">
      <input type="text" id="chatbot-input" placeholder="Type your message..." style="flex:1; border-radius:8px; border:none; padding:5px; background:rgba(255,255,255,0.07); color:#fff;">
      <button type="submit" style="margin-left:10px; border:none; border-radius:8px; background:#1845ad; color:#fff; font-size:16px; padding:10px 18px; cursor:pointer;">Send</button>
    </form>
    <div id="coming-soon-popup" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(8,7,16,0.3); z-index:20000; align-items:center; justify-content:center;">
      <div style="background:rgba(255,255,255,0.18); border-radius:16px; padding:32px 40px; color:#1845ad; font-size:1.3rem; font-weight:600; box-shadow:0 0 40px rgba(8,7,16,0.3); text-align:center;">
        🚧 Coming Soon!
      </div>
    </div>
  </div>
</aside>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var closeSidebarBtn = document.getElementById('closeSidebarBtn');
  var sidebar = document.getElementById('show-side-navigation1');
  if (closeSidebarBtn && sidebar) {
    closeSidebarBtn.addEventListener('click', function() {
      sidebar.style.display = 'none';
    });
  }
  // Notification sidebar logic
  var notificationSidebar = document.getElementById('notification-sidebar');
  var openNotificationBtn = document.getElementById('openNotificationPanel');
  var closeNotificationBtn = document.getElementById('close-notification');
  if (openNotificationBtn && notificationSidebar) {
    openNotificationBtn.addEventListener('click', function(e) {
      e.preventDefault();
      notificationSidebar.style.right = '0';
    });
  }
  if (closeNotificationBtn) {
    closeNotificationBtn.addEventListener('click', function() {
      notificationSidebar.style.right = '-320px';
    });
  }
  // Chatbot sidebar logic
  var chatbotSidebar = document.getElementById('chatbot-sidebar');
  var openChatbotBtn = document.querySelector('.nav-link .uil-comments-alt');
  var closeChatbotBtn = document.getElementById('close-chatbot');
  if (openChatbotBtn && chatbotSidebar) {
    openChatbotBtn.parentElement.addEventListener('click', function(e) {
      e.preventDefault();
      chatbotSidebar.style.right = '0';
    });
  }
  if (closeChatbotBtn) {
    closeChatbotBtn.addEventListener('click', function() {
      chatbotSidebar.style.right = '-320px';
    });
  }
  // Chatbot submit popup ONLY
  var chatbotForm = document.getElementById('chatbot-form');
  var popup = document.getElementById('coming-soon-popup');
  if (chatbotForm && popup) {
    chatbotForm.addEventListener('submit', function(e) {
      e.preventDefault();
      popup.style.display = 'flex';
      setTimeout(function() {
        popup.style.display = 'none';
      }, 1500);
    });
  }
  // Only prevent default for dropdown toggles, not for direct links
  document.querySelectorAll('aside.sidebar ul.categories li.has-dropdown > a').forEach(function(dropdownToggle) {
    dropdownToggle.addEventListener('click', function(event) {
      event.preventDefault();
      // Toggle dropdown logic here if needed
      var parentLi = this.parentElement;
      parentLi.classList.toggle('open');
    });
  });
});
</script>
<style>
.sidebar {
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.sidebar::-webkit-scrollbar {
  display: none;
}

    /* --- Combined style.css --- */
    @import 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet';
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
    .navbar { background-color: var(--navbar-bg-color) !important; border: none !important; }
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
<!-- JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>