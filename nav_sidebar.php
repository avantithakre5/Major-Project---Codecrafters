<div id="accountModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:99999; background:rgba(8,7,16,0.45); backdrop-filter:blur(8px); align-items:center; justify-content:center;">
  <div id="accountModalContent" style="min-width:320px; max-width:90vw;"></div>
</div>
<script>
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
document.addEventListener('DOMContentLoaded', function() {
  var btn = document.getElementById('myAccountBtn');
  var modal = document.getElementById('accountModal');
  var modalContent = document.getElementById('accountModalContent');
  if (btn && modal && modalContent) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      // Load account_popup.php via AJAX (handle both JSON and HTML)
      fetch('account_popup.php')
        .then(res => {
          const ct = res.headers.get('content-type');
          if (ct && ct.includes('application/json')) {
            return res.json();
          } else {
            return res.text();
          }
        })
        .then(data => {
          if (typeof data === 'string') {
            modalContent.innerHTML = data;
          } else {
            modalContent.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
          }
          modal.style.display = 'flex';
          // Add close logic for modal
          var closeBtn = modalContent.querySelector('.close-btn');
          if (closeBtn) {
            closeBtn.onclick = function() {
              modal.style.display = 'none';
            };
          }
        })
        .catch(err => {
          modalContent.innerHTML = '<div style="color:red;">Error loading account info.</div>';
          modal.style.display = 'flex';
        });
    });
    // Optional: close modal when clicking outside popup-box
    modal.addEventListener('click', function(e) {
      if (e.target === modal) modal.style.display = 'none';
    });
  }
});
</script>
<?php
// You can use session variables for user info if needed
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Avanti Thakre';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'Lorem ipsum dolor sit amet consectetur.';
?>
<nav class="navbar navbar-expand-md" style="background: linear-gradient(to right, #00F0FF 4%, #5200FF 57%, #FF2DF7 115%); border-radius: 16px; margin-bottom: 30px; box-shadow: 0 0 20px rgba(8, 7, 16, 0.99);">
  <div class="container-fluid mx-2">
    <div class="navbar-header">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle-navbar" aria-controls="toggle-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="uil-bars text-white"></i>
      </button>
      <a class="navbar-brand" href="login.php">TheCode<span style="color:#ff512f;">Crafters</span></a>
    </div>
    <div class="collapse navbar-collapse" id="toggle-navbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
             style="background: rgba(255,255,255,0.13); border-radius: 12px; box-shadow: 0 0 20px rgba(8,7,16,0.18); backdrop-filter: blur(8px); color: #fff;">
            Settings
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
              style="background: rgba(0,0,0,0.5); border-radius: 16px; box-shadow: 0 0 40px rgba(8,7,16,0.18); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.5); color: #1c343b98;">
            <li><a class="dropdown-item" style="color:#11f1ff;" href="#" id="myAccountBtn">My account</a></li>
            <li><a class="dropdown-item" style="color:#11f1ff;" href="#">My inbox</a></li>
            <li><a class="dropdown-item" style="color:#11f1ff;" href="#">Help</a></li>
            <li><hr class="dropdown-divider" style="border-color:rgba(255,255,255,0.2);"></li>
            <li><a class="dropdown-item" style="color:#ff512f;" href="index.php">Log out</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="uil-comments-alt"></i><span>23</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="openNotificationPanel"><i class="uil-bell"></i><span>98</span></a>
        </li>
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
    <!-- Notification messages go here -->
    <div id="notification-messages"></div>
  </div>
</aside>

<script>
// Sidebar close button logic
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
});
</script>

        <li class="nav-item">
          <a class="nav-link" href="show-side-navigation1"><i data-show="show-side-navigation1" class="uil-bars show-side-btn"><span>Menu</span></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar (hidden by default) -->
<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1" style="display:none; background: rgba(0,0,0,0.5); border-radius: 30px; box-shadow: 0 0 40px rgba(8,7,16,0.6); backdrop-filter: blur(10px); width: 250px; min-height: 100vh; border: 1px solid rgba(255,255,255,0.1); color: #fff;">
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
    <input type="text" class="form-control w-100 bg-transparent" placeholder="Search here" style="border: 2px solid #23a2f6; border-radius: 10px;">
    <i class="fa fa-search position-absolute d-block fs-6"></i>
  </div>
  <ul class="categories list-unstyled">
    <li class="has-dropdown">
      <i class="uil-estate fa-fw"></i><a href="#"> Dashboard</a>
      <ul class="sidebar-dropdown list-unstyled">
        <li><a href="#">Overview</a></li>
        <li><a href="#">Reports</a></li>
      </ul>
    </li>
     <li class="has-dropdown">
      <i class="uil-folder"></i><a href="#"> Practice Quiz</a>
      <ul class="sidebar-dropdown list-unstyled">
      <div class="d-flex flex-wrap gap-2 px-2 py-2">
  <a href="courses/index.php?lang=python" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Python</a>
  <a href="courses/index.php?lang=javascript" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">JavaScript</a>
  <a href="courses/index.php?lang=java" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Java</a>
  <a href="courses/index.php?lang=csharp" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">C#</a>
  <a href="courses/index.php?lang=cpp" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">C++</a>
  <a href="courses/index.php?lang=php" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Php</a>
  <a href="courses/index.php?lang=typescript" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Typescript</a>
  <a href="courses/index.php?lang=dotnet" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">.NET</a>
  <a href="courses/index.php?lang=machinelearning" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Machine Learning</a>
  <a href="courses/index.php?lang=cybersecurity" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Cyber Security</a>
  <a href="courses/index.php?lang=kotlin" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Kotlin</a>
  <a href="courses/index.php?lang=r" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">R</a>
  <a href="courses/index.php?lang=rust" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Rust</a>
  <a href="courses/index.php?lang=matlab" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Matlab</a>
  <a href="courses/index.php?lang=sql" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">SQL</a>
  <a href="courses/index.php?lang=ruby" class="btn btn-outline-primary btn-sm" style="color: white; border: 2px solid white;" onclick="window.location.href=this.href">Ruby</a>
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
  </ul>
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
    <!-- Chatbot messages go here -->
    <div id="chatbot-messages"></div>
  </div>
  <div style="padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.1);">
    <!-- Chatbot form and popup -->
    <form id="chatbot-form" style="display:flex; z-index:9000">
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

  // Sidebar toggle button logic (improved)
  var showAsideBtns = document.querySelectorAll('.show-side-btn');
  var sidebar = document.getElementById('show-side-navigation1');
  showAsideBtns.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      // Use a CSS class to toggle sidebar visibility
      sidebar.classList.toggle('sidebar-open');
      // If sidebar-open is present, ensure display:block
      if (sidebar.classList.contains('sidebar-open')) {
        sidebar.style.display = 'block';
      } else {
        sidebar.style.display = 'none';
      }
    });
  });
});
</script>

<style>
.sidebar {
  /* ...existing styles... */
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE and Edge */
}
.sidebar::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}
</style>

<script>
document.addEventListener('mousedown', function(e) {
  // Sidebar
  var sidebar = document.getElementById('show-side-navigation1');
  if (sidebar && sidebar.style.display !== 'none' && !sidebar.contains(e.target) && !e.target.classList.contains('show-side-btn')) {
    sidebar.style.display = 'none';
    sidebar.classList.remove('sidebar-open');
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