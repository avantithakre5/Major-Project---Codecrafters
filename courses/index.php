<?php
// Ensure session is available so nav/sidebar can access logged-in user data
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : '';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Python Learning Path</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="saves/123.png">

    <style>
        :root {
            --bg-color: #000000;
            --text-color: #F8F7F7;
            --secondary-text-color: #a3a3a3;
            --gradient: linear-gradient(267deg, #00F0FF 4%, #5200FF 57%, #FF2DF7 115%);
            --font-primary: 'Poppins', sans-serif;
            --font-secondary: 'Montserrat', sans-serif;
        }

        /* --- Utility Classes --- */
        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none; /* Added to ensure consistency */
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
        }

        .btn-secondary {
            border: 1px solid #9E9C9C;
            color: var(--text-color);
        }
        
        /* Glide button style (moved from inline) */
        .btn.btn-secondary:hover {
            background: var(--gradient);
            color: #ffffff;
            border-color: 5px solid transparent;
        }
        .glide-btn {
            position: relative;
            overflow: hidden;
        }
        .glide-btn::after {
            content: "";
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.15);
            transition: left 0.5s cubic-bezier(.4,0,.2,1);
            pointer-events: none;
        }
        .glide-btn:hover::after {
            left: 100%;
        }

        .arrow {
            display: inline-block;
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn:hover .arrow, .learn-more:hover .arrow {
            transform: translateX(5px);
        }
               
        
        /* Container for header */
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            font-family: var(--font-primary);
            color: var(--text-color);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none; /* Added for consistency */
            margin: 0; /* Added for consistency */
            padding: 0; /* Added for consistency */
        }

        .nav-links a {
            font-size: 16px;
            padding: 5px;
            transition: color 0.3s;
            color: var(--text-color);
            text-decoration: none;
        }

        .nav-links a:hover {
            color: var(--secondary-text-color);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-signin {
            font-size: 16px;
        }

        .hamburger {
            display: none;
            font-size: 30px;
            background: none;
            border: none;
            color: var(--text-color);
            cursor: pointer;
        }
        
        .mobile-nav-menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 80px; /* Adjust based on header height */
            left: 0;
            right: 0;
            background: #111;
            padding: 20px;
            text-align: center;
            gap: 20px;
        }

        .mobile-nav-menu.active {
            display: flex;
        }
        .mobile-nav-menu a {
            color: var(--text-color);
            text-decoration: none;
            font-size: 1.2rem;
        }

        /* --- END: CSS from PREVIOUS HEADER --- */


        /* --- START: CSS from NEW PAGE --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #212130 !important;
            color: #E0E0E0;
            margin: 0;
            /* Padding top now handled by header, removed padding */
            display: flex;
            flex-direction: column;
            align-items: stretch; /* allow header and sidebar to span full width */
        }

        /* Page inner wrapper to center main content without affecting header/sidebar */
        .page-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .python-button {
            background-color: #4A70C2;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 1.2em;
            margin-top: 40px; /* Added margin-top to separate from sticky header */
            margin-bottom: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .level-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 1200px;
            width: 100%;
            padding: 0 20px; /* Added padding for spacing */
            box-sizing: border-box; /* Added for consistency */
            margin-bottom: 40px; /* Added space at the bottom */
        }

        .level-card {
            background-color: #2B2B3E;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .level-header {
            font-size: 1.8em;
            font-weight: 600;
            margin-bottom: 25px;
            color: #f0f0f0;
        }

        .welcome-text {
            color: #a0a0a0;
            margin-bottom: 25px;
            align-self: flex-end; /* Pushes to the right */
            font-size: 0.9em;
        }

        .lesson-list {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1; /* Allows the list to take available space */
        }

        .lesson-list li {
            margin-bottom: 12px;
            position: relative;
            padding-left: 20px;
            color: #C0C0C0;
            font-size: 0.95em;
        }

        .lesson-list li::before {
            content: '•';
            color: #7A7AFF; /* Small dot color */
            font-size: 1.2em;
            position: absolute;
            left: 0;
            top: -2px;
        }

        .practice-button {
            /* --- UPDATED: Used --gradient variable --- */
            background: var(--gradient);
            color: white;
            padding: 10px 25px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.95em;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            width: fit-content; /* Make button fit content */
            align-self: flex-end; /* Pushes to the right */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            
            /* --- Animation transition --- */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .practice-button svg {
            fill: white;
            width: 18px;
            height: 18px;
            
            /* --- Animation transition --- */
            transition: transform 0.3s ease;
        }

        /* Specific positioning for Welcome texts to match the image */
        .level-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Align welcome text to top */
            margin-bottom: 20px;
        }

        .level-content .lesson-list {
            flex-grow: 1;
            margin-right: 20px; /* Space between list and welcome */
        }

        .level-content .welcome-text {
            flex-shrink: 0;
            margin-left: auto; /* Push to the right */
            text-align: right;
        }

        /* --- Button Animation --- */
        .practice-button:hover {
            transform: translateY(-3px); /* Lifts the button up */
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.4); /* Enhances the shadow */
        }

        .practice-button:hover svg {
            transform: translateX(5px); /* Moves the arrow to the right */
        }



        @media (max-width: 992px) {

            .nav-links, .nav-actions {
                display: none;
            }
            .hamburger {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .level-container {
                grid-template-columns: 1fr;
            }
            .python-button {
                margin-top: 30px;
                margin-bottom: 30px;
            }
            .level-card {
                padding: 25px;
            }
            .level-header {
                font-size: 1.6em;
            }
            .practice-button {
                font-size: 0.9em;
                padding: 9px 20px;
            }
        }
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
        /* Make navbar full-width and override page-specific constraints */
        .navbar { 
            background-color: var(--navbar-bg-color) !important; 
            border: none !important; 
            margin: 0 !important; 
            width: 100% !important;
            max-width: 100% !important;
            align-items: center !important;
            border-radius: 0 !important;
            height: 60px !important;
            margin-top: 5px !important;
            position: sticky !important;
        }
    .navbar .dropdown-menu { right: auto !important; left: 0 !important; }
    .navbar .navbar-nav>li>a { color: #EEE !important; line-height: 55px !important; padding: 0 10px !important; }
    .navbar .navbar-brand {color:#FFF !important}
    .navbar .navbar-nav>li>a:focus, .navbar .navbar-nav>li>a:hover {color: #EEE !important}
    .navbar .navbar-nav>.open>a, .navbar .navbar-nav>.open>a:focus, .navbar .navbar-nav>.open>a:hover {background-color: transparent !important; color: #FFF !important}
    .navbar .navbar-brand {line-height: 55px !important; padding: 0 !important}
    .navbar .navbar-brand:focus, .navbar .navbar-brand:hover {color: #FFF !important}
    .navbar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {margin: 0 !important}
    /* remove container padding so navbar truly spans edge-to-edge */
    .navbar .container-fluid { padding-left: 0 !important; padding-right: 0 !important; }
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

<?php
// Include the shared navigation and sidebar (adjust path because this file is in /courses)
include __DIR__ . '/../testquiz.php';
// Load quiz level data for selected language
$selectedLang = isset($_GET['lang']) ? $_GET['lang'] : 'python';
$selectedLangEsc = '';
$levelData = null;
$db = mysqli_connect('localhost','root','','codecrafters');
if ($db) {
    $selectedLangEsc = mysqli_real_escape_string($db, $selectedLang);
    $res = mysqli_query($db, "SELECT * FROM quizlevels WHERE Language='" . $selectedLangEsc . "' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $levelData = mysqli_fetch_assoc($res);
    }
}

function levelVal($levelData, $col, $fallback='') {
    if (is_array($levelData) && isset($levelData[$col]) && $levelData[$col] !== null && $levelData[$col] !== '') return $levelData[$col];
    return $fallback;
}
?>

    <section id="wrapper">

    <div class="page-inner">

    <h1 class="python-button" style="display:inline-block; margin-top:40px; margin-bottom:40px;">
        <?php echo htmlspecialchars(ucfirst($selectedLang)); ?>
    </h1>

    <div class="level-container">
        <div class="level-card">
            <div class="level-content">
                <h2 class="level-header" style="display:inline-block; white-space:nowrap; margin:0;">Level 1</h2>
                <p><br>   .. </p></div>
                <p><span class="welcome-text" style="font-size: medium; color:#ffffff"><?php echo htmlspecialchars(levelVal($levelData, 'L1Welcome', 'L1Welcome')); ?></span></p>

            <ul class="lesson-list">
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L1P1', 'L1P1')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L1P2', 'L1P2')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L1P3', 'L1P3')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L1P4', 'L1P4')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L1P5', 'L1P5')); ?></li>
            </ul>
            <a href="quizz.php?lang=<?php echo urlencode($selectedLang); ?>&level=1" class="practice-button">
                Practice Now
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="level-card">
            <div class="level-content">
                <h2 class="level-header" style="display:inline-block; white-space:nowrap; margin:0;">Level 2</h2>
                <p><br>   .. </p></div>
                <p><span class="welcome-text" style="font-size: medium; color:#ffffff"><?php echo htmlspecialchars(levelVal($levelData, 'L2Welcome', 'L2Welcome')); ?></span></p>

            <ul class="lesson-list">
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L2P1', 'L2P1')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L2P2', 'L2P2')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L2P3', 'L2P3')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L2P4', 'L2P4')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L2P5', 'L2P5')); ?></li>
            </ul>
            <a href="quizz.php?lang=<?php echo urlencode($selectedLang); ?>&level=2" class="practice-button">
                Practice Now
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="level-card">
            <div class="level-content">
                <h2 class="level-header" style="display:inline-block; white-space:nowrap; margin:0;">Level 3</h2>
                <p><br>   .. </p></div>
                <p><span class="welcome-text" style="font-size: medium; color:#ffffff"><?php echo htmlspecialchars(levelVal($levelData, 'L3Welcome', 'L3Welcome')); ?></span></p>

            <ul class="lesson-list">
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L3P1', 'L3P1')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L3P2', 'L3P2')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L3P3', 'L3P3')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L3P4', 'L3P4')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L3P5', 'L3P5')); ?></li>
            </ul>
            <a href="quizz.php?lang=<?php echo urlencode($selectedLang); ?>&level=3" class="practice-button">
                Practice Now
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="level-card">
            <div class="level-content">
                <h2 class="level-header" style="display:inline-block; white-space:nowrap; margin:0;">Level 4</h2>
                <p><br>   .. </p></div>
                <p><span class="welcome-text" style="font-size: medium; color:#ffffff"><?php echo htmlspecialchars(levelVal($levelData, 'L4Welcome', 'L4Welcome')); ?></span></p>

            <ul class="lesson-list">
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L4P1', 'L4P1')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L4P2', 'L4P2')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L4P3', 'L4P3')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L4P4', 'L4P4')); ?></li>
                <li><?php echo htmlspecialchars(levelVal($levelData, 'L4P5', 'L4P5')); ?></li>
            </ul>
            <a href="quizz.php?lang=<?php echo urlencode($selectedLang); ?>&level=4" class="practice-button">
                Practice Now
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L16 12L9 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
    </div> 
    <!-- .page-inner -->

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- Responsive Hamburger Menu ---
            const hamburgerMenu = document.getElementById('hamburger-menu');
            const mobileNav = document.getElementById('mobile-nav');

            hamburgerMenu.addEventListener('click', () => {
                mobileNav.classList.toggle('active');
                // Change hamburger icon to 'X' when menu is open
                if (mobileNav.classList.contains('active')) {
                    hamburgerMenu.innerHTML = '&#10005;'; // 'X' character
                } else {
                    hamburgerMenu.innerHTML = '&#9776;'; // Hamburger character
                }
            });
        });
    </script>
    </body>
</html>