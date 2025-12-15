<?php
// This file assumes a session is already started on the page that includes it.
// These variables will be used in the navbar and sidebar.
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'error';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'error';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Navigation Components</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <style>
        /* --- CONSOLIDATED CSS FOR ALL NAVIGATION COMPONENTS --- */
        @import 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap';

        body {
            font-family: 'Inter', sans-serif;
            /* The background should be set on your main page for context */
        }

        /* == Main Navbar Styling == */
        .navbar {
            background: linear-gradient(to right, #00F0FF 4%, #5200FF 57%, #FF2DF7 115%);
            border-radius: 16px;
            margin-top: 1%;
            box-shadow: 0 0 20px rgba(8, 7, 16, 0.99);
            padding: 1rem 1rem;
        }
        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
        }
        .nav-link {
            color: #fff !important;
            margin: 0 5px;
            position: relative;
        }
        .nav-link > span { /* For notification counts */
            position: absolute;
            top: -2px;
            right: -5px;
            background-color: #ff512f;
            color: white;
            border-radius: 50%;
            padding: 1px 5px;
            font-size: 10px;
            font-weight: 600;
        }
        .navbar .dropdown-toggle {
            background: rgba(255, 255, 255, 0.13);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(8, 7, 16, 0.18);
            backdrop-filter: blur(8px);
        }
        .navbar .dropdown-menu {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 16px;
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.18);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 10px;
        }
        .navbar .dropdown-item {
            color: #11f1ff;
            padding: 8px 12px;
            border-radius: 8px;
        }
        .navbar .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .navbar .dropdown-item.logout { color: #ff512f; font-weight: 600; }
        .navbar .dropdown-divider { border-color: rgba(255, 255, 255, 0.2); }

        /* == Main Left Sidebar Styling == */
        .sidebar {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 30px;
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            width: 250px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        .sidebar::-webkit-scrollbar { display: none; /* Chrome, Safari, Opera */ }
        .sidebar.collapsed { margin-left: -250px; }
        .sidebar .sidebar-header { border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .sidebar-header a { color: #fff; }
        .sidebar .search .form-control { border: 2px solid #23a2f6; border-radius: 10px; color: #fff; }
        .sidebar .search .form-control::placeholder { color: rgba(255,255,255,0.5); }
        .sidebar ul.categories { padding: 15px; }
        .sidebar ul.categories li { padding: 10px; border-radius: 8px; margin-bottom: 5px; }
        .sidebar ul.categories li a { color: #fff; text-decoration: none; }
        .sidebar ul.categories li i { margin-right: 10px; }
        .sidebar ul.categories li.has-dropdown.open { background-color: rgba(255,255,255,0.05); }
        .sidebar-dropdown { display: none; margin-top: 10px; }
        .sidebar li.has-dropdown.open > .sidebar-dropdown { display: block; }
        .sidebar .btn-outline-primary { color: white; border: 2px solid white; }
        .sidebar .btn-outline-primary:hover { background: white; color: #333; }

        /* == Right Slide-Out Panels (Notifications & Chatbot) == */
        .slide-out-panel {
            position: fixed; top: 0; right: -320px;
            width: 320px; height: 100vh;
            background: rgba(255, 255, 255, 0.13);
            border-radius: 20px 0 0 20px;
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            backdrop-filter: blur(10px);
            z-index: 10000;
            transition: right 0.3s ease-in-out;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
        }
        .slide-out-panel.active { right: 0; }
        .slide-out-panel .panel-header {
            padding: 24px 20px 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex; align-items: center;
        }
        .slide-out-panel .panel-header .icon { font-size: 2rem; margin-right: 10px; }
        .slide-out-panel .panel-header .title { font-size: 1.2rem; font-weight: 600; }
        .slide-out-panel .panel-header .close-btn {
            margin-left: auto; background: none; border: none;
            color: #fff; font-size: 1.5rem; cursor: pointer;
        }
        .slide-out-panel .panel-body { flex: 1; padding: 20px; overflow-y: auto; }
        .slide-out-panel .panel-footer {
            padding: 16px 20px; border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        #chatbot-form input {
            flex: 1; border-radius: 8px; border: none; padding: 8px;
            background: rgba(255, 255, 255, 0.07); color: #fff;
        }
        #chatbot-form button {
            margin-left: 10px; border: none; border-radius: 8px;
            background: #1845ad; color: #fff; font-size: 16px;
            padding: 8px 18px; cursor: pointer;
        }

        /* == Modals & Popups == */
        .popup-overlay {
            display: none; position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            z-index: 99999;
            background: rgba(8, 7, 16, 0.45);
            backdrop-filter: blur(8px);
            align-items: center; justify-content: center;
        }
        #coming-soon-popup .popup-content {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 16px; padding: 32px 40px; color: #1845ad;
            font-size: 1.3rem; font-weight: 600;
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.3);
            text-align: center;
        }
    </style>
</head>
<body>

<div id="accountModal" class="popup-overlay">
  <div id="accountModalContent" style="min-width:320px; max-width:90vw;"></div>
</div>

<div id="coming-soon-popup" class="popup-overlay">
  <div class="popup-content">🚧 Coming Soon!</div>
</div>

<nav class="navbar navbar-expand-md">
    <div class="container-fluid mx-2">
        <a class="navbar-brand" href="#">TheCode<span style="color:#ff512f;">Crafters</span></a>
        <a class="nav-link d-md-none" href="#" id="main-sidebar-toggle-mobile"><i class="uil-bars"></i></a>
        <div class="collapse navbar-collapse" id="toggle-navbar">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="chatbot-open-btn"><i class="uil-comments-alt"></i><span>23</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="notification-open-btn"><i class="uil-bell"></i><span>98</span></a>
                </li>
                <li class="nav-item">
        </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" id="myAccountBtn">My account</a></li>
                        <li><a class="dropdown-item" href="#">My inbox</a></li>
                        <li><a class="dropdown-item" href="#">Help</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item logout" href="#">Log out</a></li>
                    </ul>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="#" id="main-sidebar-toggle-desktop"><i class="uil-bars"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left collapsed" id="main-sidebar">
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <img class="rounded-pill img-fluid" width="65" src="https://media.licdn.com/dms/image/v2/D4D0BAQFeI4uvxStKLA/company-logo_200_200/company-logo_200_200/0/1683626394630/bosscoderacademy_logo?e=2147483647&v=beta&t=HgOfDJdiJOUOD0J2Ey8SDSI_YD6mmmJS24YoNDI9CHs" alt="User Avatar">
        <div class="ms-2">
            <h5 class="fs-6 mb-0"><a class="text-decoration-none" href="#"><?php echo htmlspecialchars($user_name); ?></a></h5>
            <p class="mt-1 mb-0 small"><?php echo htmlspecialchars($user_email); ?></p>
        </div>
    </div>
    <div class="search position-relative text-center px-4 py-3 mt-2">
        <input type="text" class="form-control w-100 bg-transparent" placeholder="Search here">
    </div>
    <ul class="categories list-unstyled">
        <li class="has-dropdown">
            <a href="#"><i class="uil-estate fa-fw"></i> Dashboard</a>
            <ul class="sidebar-dropdown list-unstyled">
                <li><a href="#">&nbsp;&nbsp;&nbsp; Overview</a></li>
                <li><a href="#">&nbsp;&nbsp;&nbsp; Reports</a></li>
            </ul>
        </li>
        <li class="has-dropdown">
            <a href="#"><i class="uil-folder"></i> Take Quiz</a>
            <ul class="sidebar-dropdown list-unstyled">
                <div class="d-flex flex-wrap gap-2 px-2 py-2">
                    <a href="quiz.php" class="btn btn-outline-primary btn-sm">Python</a>
                    <a href="quiz.php?topic=javascript" class="btn btn-outline-primary btn-sm">JavaScript</a>
                    <a href="quiz.php?topic=java" class="btn btn-outline-primary btn-sm">Java</a>
                    <a href="quiz.php?topic=csharp" class="btn btn-outline-primary btn-sm">C#</a>
                    <a href="quiz.php?topic=sql" class="btn btn-outline-primary btn-sm">SQL</a>
                    <a href="quiz.php?topic=ruby" class="btn btn-outline-primary btn-sm">Ruby</a>
                </div>
            </ul>
        </li>
        <li><a href="#"><i class="uil-setting"></i> Settings</a></li>
    </ul>
</aside>

<aside id="notification-sidebar" class="slide-out-panel">
    <div class="panel-header">
        <i class="uil-bell icon"></i>
        <span class="title">Notifications</span>
        <button id="notification-close-btn" class="close-btn">&times;</button>
    </div>
    <div class="panel-body">
        <div style="color:#23a2f6;">No new notifications.</div>
    </div>
</aside>

<aside id="chatbot-sidebar" class="slide-out-panel">
    <div class="panel-header">
        <i class="uil-comments-alt icon"></i>
        <span class="title">Chatbot</span>
        <button id="chatbot-close-btn" class="close-btn">&times;</button>
    </div>
    <div class="panel-body">
        <div style="color:#23a2f6;">Hi! How can I help you today?</div>
    </div>
    <div class="panel-footer">
        <form id="chatbot-form" class="d-flex">
            <input type="text" style="color: #000000ff;" id="chatbot-input" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>
</aside>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// --- CONSOLIDATED JAVASCRIPT FOR ALL NAVIGATION COMPONENTS ---
document.addEventListener('DOMContentLoaded', function() {

    // --- Main Left Sidebar Toggle Logic ---
    const mainSidebar = document.getElementById('main-sidebar');
    const mainContent = document.getElementById('main-content'); // Important: Your main content needs this ID
    
    function toggleMainSidebar() {
        mainSidebar.classList.toggle('collapsed');
        if(mainContent) {
            mainContent.classList.toggle('expanded');
        }
    }
    document.getElementById('main-sidebar-toggle-desktop')?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleMainSidebar();
    });
    document.getElementById('main-sidebar-toggle-mobile')?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleMainSidebar();
    });


    // --- Main Left Sidebar Dropdown Logic ---
    document.querySelectorAll('.sidebar .has-dropdown > a').forEach(function(dropdownToggle) {
        dropdownToggle.addEventListener('click', function(event) {
            event.preventDefault();
            const parentLi = this.parentElement;
            parentLi.classList.toggle('open');
            
            // Close other open dropdowns
            document.querySelectorAll('.sidebar .has-dropdown.open').forEach(function(openDropdown) {
                if (openDropdown !== parentLi) {
                    openDropdown.classList.remove('open');
                }
            });
        });
    });

    // --- Account Modal AJAX Logic ---
    const accountBtn = document.getElementById('myAccountBtn');
    const accountModal = document.getElementById('accountModal');
    const accountModalContent = document.getElementById('accountModalContent');
    if (accountBtn && accountModal && accountModalContent) {
        accountBtn.addEventListener('click', function(e) {
            e.preventDefault();
            fetch('account_popup.php') // This file needs to exist on your server
                .then(res => res.text())
                .then(data => {
                    accountModalContent.innerHTML = data;
                    accountModal.style.display = 'flex';
                    const closeBtn = accountModalContent.querySelector('.close-btn');
                    if (closeBtn) {
                        closeBtn.onclick = () => accountModal.style.display = 'none';
                    }
                }).catch(err => {
                    accountModalContent.innerHTML = '<div style="color:red; background:white; padding: 20px; border-radius: 8px;">Error loading account info. Please try again later.</div>';
                    accountModal.style.display = 'flex';
                });
        });
        accountModal.addEventListener('click', (e) => {
            if (e.target === accountModal) accountModal.style.display = 'none';
        });
    }

    // --- Notification & Chatbot Panel Logic ---
    function setupPanel(panelId, openBtnId, closeBtnId) {
        const panel = document.getElementById(panelId);
        const openBtn = document.getElementById(openBtnId);
        const closeBtn = document.getElementById(closeBtnId);
        if (panel && openBtn && closeBtn) {
            openBtn.addEventListener('click', (e) => {
                e.preventDefault();
                panel.classList.add('active');
            });
            closeBtn.addEventListener('click', () => panel.classList.remove('active'));
        }
    }
    setupPanel('notification-sidebar', 'notification-open-btn', 'notification-close-btn');
    setupPanel('chatbot-sidebar', 'chatbot-open-btn', 'chatbot-close-btn');


    // --- Chatbot "Coming Soon" Popup Logic ---
    const chatbotForm = document.getElementById('chatbot-form');
    const comingSoonPopup = document.getElementById('coming-soon-popup');
    if (chatbotForm && comingSoonPopup) {
        chatbotForm.addEventListener('submit', function(e) {
            e.preventDefault();
            comingSoonPopup.style.display = 'flex';
            setTimeout(() => {
                comingSoonPopup.style.display = 'none';
            }, 1500);
        });
    }
});
</script>
<script>
document.addEventListener('mousedown', function(e) {
  // Sidebar
  var sidebar = document.getElementById('show-side-navigation1');
  if (sidebar && sidebar.style.display !== 'none' && !sidebar.contains(e.target) && !e.target.classList.contains('show-side-btn')) {
    sidebar.style.display = 'none';
  }
  // Notification
  var notificationSidebar = document.getElementById('notification-sidebar');
  if (notificationSidebar && notificationSidebar.style.right === '0px' && !notificationSidebar.contains(e.target) && e.target.id !== 'openNotificationPanel') {
    notificationSidebar.style.right = '-320px';
  }
  // Chatbot
  var chatbotSidebar = document.getElementById('chatbot-sidebar');
  if (chatbotSidebar && chatbotSidebar.style.right === '0px' && !chatbotSidebar.contains(e.target) && !(e.target.classList.contains('uil-comments-alt') || e.target.closest('#chatbot-sidebar'))) {
    chatbotSidebar.style.right = '-320px';
  }
});
</script>
</body>
</html>