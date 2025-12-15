<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeCrafters</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="saves/123.png">

    <style>
        /* --- Global Styles & Variables --- */
        :root {
            --bg-color: #000000;
            --text-color: #F8F7F7;
            --secondary-text-color: #a3a3a3;
            --gradient: linear-gradient(267deg, #00F0FF 4%, #5200FF 57%, #FF2DF7 115%);
            --font-primary: 'Poppins', sans-serif;
            --font-secondary: 'Montserrat', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: var(--font-secondary);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        a {
            color: var(--text-color);
            text-decoration: none;
        }

        ul {
            list-style: none;
        }

        /* --- Utility Classes --- */
        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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
        
        .btn-dark {
            background-color: #000;
            color: #fff;
        }

        .gradient-text {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        .arrow {
            display: inline-block;
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn:hover .arrow, .learn-more:hover .arrow {
            transform: translateX(5px);
        }

        /* --- Header & Navigation --- */
        .main-header {
            padding: 20px 0;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(10px);
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
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            font-size: 16px;
            padding: 5px;
            transition: color 0.3s;
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


        /* --- Hero Section --- */
        .hero-section {
            padding: 80px 0;
        }

        .hero-layout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero-content h1 {
            font-family: var(--font-primary);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            line-height: 1.1;
        }

        .hero-content h2 {
            font-family: var(--font-primary);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 600;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
            max-width: 500px;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }


        /* --- Trusted By Section --- */
        .trusted-by {
            padding: 40px 0 80px;
        }

        .logo-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 40px;
            opacity: 1;
        }

        .logo-grid img {
            max-height: 25px;
            width: auto;
        }

        /* --- Feature Section --- */
        .feature-section {
            padding: 40px 0;
        }

        .feature-layout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
        }

        .feature-layout.reversed {
            flex-direction: row-reverse;
        }

        .feature-content {
            flex: 1;
            max-width: 550px;
        }

        .feature-content h3 {
            font-family: var(--font-primary);
            font-size: 40px;
            font-weight: 600;
        }
        .feature-content h4 {
            font-family: var(--font-primary);
            font-size: 40px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .feature-content p {
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .learn-more {
            font-weight: 600;
            font-size: 18px;
        }

        .feature-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .feature-image img {
            max-width: 80%;
            height: auto;
        }

        /* --- Testimonial Section --- */
        .testimonial-section {
            padding: 80px 0;
        }

        .testimonial-card {
            background: var(--gradient);
            border-radius: 20px;
            padding: 60px;
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .testimonial-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
        }

        .testimonial-content blockquote {
            font-size: 22px;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 30px;
            font-style: italic;
        }

        .testimonial-content cite {
            font-style: normal;
        }
        .testimonial-content cite strong {
            display: block;
            font-size: 20px;
        }

        /* --- CTA Section --- */
        .cta-section {
            padding: 80px 0;
        }
        .cta-card {
            background: var(--gradient);
            border-radius: 20px;
            padding: 40px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cta-content {
            max-width: 500px;
        }

        .cta-content h2 {
            font-family: var(--font-primary);
            font-size: 42px;
            line-height: 1.2;
            margin-bottom: 30px;
        }

        .cta-image img {
            max-width: 300px;
        }

        /* --- Footer --- */
        .main-footer {
            padding: 40px 0;
            border-top: 1px solid #222;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            color: var(--secondary-text-color);
        }

        .footer-bottom a {
            color: var(--secondary-text-color);
        }
        .footer-bottom a:hover {
            color: var(--text-color);
        }


        /* --- Scroll Animation --- */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- Media Queries for Responsiveness --- */

        @media (max-width: 992px) {
            .nav-links, .nav-actions {
                display: none;
            }
            
            .hamburger {
                display: block;
            }
            
            .feature-layout, .feature-layout.reversed {
                flex-direction: column;
                text-align: center;
            }
            
            .hero-layout {
                flex-direction: column;
                text-align: center;
            }

            .hero-content, .feature-content {
                max-width: 100%;
            }
            
            .hero-content p {
                margin: 0 auto 40px auto;
            }

            .testimonial-card {
                flex-direction: column;
                text-align: center;
                padding: 40px;
            }

            .cta-card {
                flex-direction: column;
                text-align: center;
                gap: 40px;
            }
            
            .cta-image {
                order: -1;
            }
        }

        @media (max-width: 576px) {
            .footer-bottom {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
        .slider img,
    .course-card img,
    .hero-img img {
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .slider-section {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #13021d;
      padding: 40px 0;
    }
    .carousel {
      position: relative;
      width: 1100px;   /* Increased width */
      height: 500px;   /* Increased height */
      perspective: 1400px;
      overflow: visible;
    }
    .carousel-slide {
      position: absolute;
      top: 0; left: 50%;
      width: 800px;    /* Increased width */
      height: 500px;   /* Increased height */
      object-fit: cover;
      border: 6px solid rgba(255, 255, 255, 0.3); /* Transparent white border */
      border-radius: 20px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.5);
      opacity: 0;
      transform: translateX(-50%) scale(0.8) rotateY(30deg);
      transition: 
        opacity 0.8s,
        transform 0.8s;
      z-index: 1;
    }
    .carousel-slide.active {
      opacity: 1;
      transform: translateX(-50%) scale(1) rotateY(0deg);
      z-index: 3;
    }
    .carousel-slide.prev {
      opacity: 0.6;
      transform: translateX(-120%) scale(0.8) rotateY(20deg);
      z-index: 2;
    }
    .carousel-slide.next {
      opacity: 0.6;
      transform: translateX(20%) scale(0.8) rotateY(-20deg);
      z-index: 2;
    }
    /*.logo h1 {
      background: linear-gradient(90deg, #ffd700, #771794, #C8C6E3, #fff);
      background-size: 200% 200%;
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      -webkit-text-fill-color: transparent;
      animation: gradientTextMove 4s ease-in-out infinite alternate;
    }

    @keyframes gradientTextMove {
      0% { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }*/

    .logo h1 {
  background: linear-gradient(90deg, #d637a6, #ab46ca, #b60c4d, #e4b2b2);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  -webkit-text-fill-color: transparent;
  text-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
}


.logo h1 span {
  font-weight: bold;
}
/* Global and background context for the section */
.slider-section {
  background: #000000ff !important; /* Matches major sections background */
  color: #f5f5f5 !important;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 30px 0;
  overflow: hidden;
  height: 600px; /* Explicit height for the section */
}

/* Carousel container with 3D perspective */
.carousel {
  position: relative;
  width: 1100px;
  height: 500px;
  perspective: 1400px; /* Creates the 3D effect */
  overflow: visible; /* Allows slides to extend outside the main box */
}

/* Individual Slide styles */
.carousel-slide {
  position: absolute;
  top: 0;
  left: 50%;
  width: 800px;
  height: 500px;
  object-fit: cover;
  border: 6px solid rgba(255, 255, 255, 0.3);
  border-radius: 20px;
  box-shadow: 
    0 32px 48px -16px #C8C6E3, /* soft light shadow at bottom */
    0 8px 32px rgba(245, 245, 252, 0.12); /* extra softness */
  opacity: 0; /* Default hidden state */
  transform: translateX(-50%) scale(0.8) rotateY(30deg); /* Default off-screen 3D position */
  transition: opacity 0.8s, transform 0.8s;
  z-index: 1;
}

/* Active Slide (Center) */
.carousel-slide.active {
  opacity: 1;
  transform: translateX(-50%) scale(1) rotateY(0deg); /* Full size, centered */
  z-index: 3; /* Highest z-index to be on top */
}

/* Previous Slide (Left side) */
.carousel-slide.prev {
  opacity: 0.6;
  transform: translateX(-120%) scale(0.8) rotateY(20deg); /* Moved left, smaller, rotated */
  z-index: 2;
}

/* Next Slide (Right side) */
.carousel-slide.next {
  opacity: 0.6;
  transform: translateX(20%) scale(0.8) rotateY(-20deg); /* Moved right, smaller, rotated */
  z-index: 2;
}

/* Image inside the slide */
.carousel-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px;
  display: block;
}

/* Slide Caption Styles */
.slide-caption {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  padding: 40px 60px;
  background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.2) 100%);
  color: #fff;
  border-radius: 0 0 20px 20px;
  box-sizing: border-box;
}

.slide-caption h2 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.slide-caption h4 {
  font-size: 1.3rem;
  font-weight: 500;
  margin-bottom: 12px;
  color: #C8C6E3;
}

.slide-caption p {
  font-size: 1.1rem;
  font-weight: 400;
  margin-bottom: 0;
  color: #e0e0e0;
}
    </style>
</head>
<body>

    <header class="main-header">
        <div class="container">
            <nav class="main-nav">
                <a href="#" class="logo" style="display: flex; align-items: center; gap: 10px;">
                    <img src="saves/123.png" alt="Logo" style="width:60px; height:60px; border-radius:50%; background:#fff; border: 1px solid #ffffffff; padding:0px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                     <p></p>  TheCodeCrafters
                </a>
                <ul class="nav-links">
                    <li><a href="#">Features</a></li>
                    <li><a href="#how-it-works-section" id="howItWorksBtn">How It Works</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#about-us-section" id="aboutUsBtn">About Us</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="login.php" class="btn btn-secondary glide-btn" style="transition: background 0.3s;">
                        Sign in
                    </a>
                    <style>
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
                    </style>
                </div>
                <button class="hamburger" id="hamburger-menu">
                    &#9776;
                </button>
            </nav>
            <div class="mobile-nav-menu" id="mobile-nav">
                <a href="#">Features</a>
                <li><a href="#">How It Works</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a href="#">About Us</a></li>
                <hr style="width:100%; border-color: #333;">
                <a href="#" class="btn btn-secondary">Sign in</a>
            </div>
        </div>
    </header>
    
    <main>
        <section class="hero-section">
            <div class="container hero-layout">
                <div class="hero-content">
                    <h1 class="gradient-text">Learn With Pride</h1>
                    <h2>Optimized Training.</h2>
                    <p>Our vision is to revolutionize the way users learn and train by providing a platform that delivers valuable education in a highly efficient and customized manner with the use of AI and ML.</p>
                    <a href="login.php" class="btn btn-primary">Get Started <span class="arrow">&rarr;</span></a>
                </div>
                <div class="hero-image">
                    <img src="saves/animation1.gif" alt="AI Globe Animation" style="max-width:100%; height:auto;" loop>
                </div>
                <script>
                    // Ensure GIF restarts if it ever stops (fallback for browsers that pause GIFs)
                    const heroGif = document.querySelector('.hero-image img');
                    heroGif.addEventListener('load', function() {
                        // No action needed, GIFs loop by default
                    });
                    // Optionally, force reload on visibility change (rarely needed)
                    document.addEventListener('visibilitychange', function() {
                        if (!document.hidden) {
                            heroGif.src = heroGif.src;
                        }
                    });
                </script>
            </div>
        </section>

        <section class="trusted-by">
            <div class="container">
                <div class="logo-grid">
                    <a href="https://www.youtube.com/" target="_blank" rel="noopener">
                        <img src="saves/youtube.png" alt="YouTube Logo" style="max-height:80px;">
                    </a>
                    <a href="https://www.pw.live/" target="_blank" rel="noopener">
                        <img src="saves/pw.png" alt="Physics Wallah Logo" style="max-height:90px;">
                    </a>
                    <a href="https://www.udemy.com/" target="_blank" rel="noopener">
                        <img src="saves/udamy.png" alt="Udemy Logo" style="max-height:60px;">
                    </a>
                    <a href="https://unacademy.com/" target="_blank" rel="noopener">
                        <img src="saves/un.png" alt="Unacademy Logo" style="max-height:40px;">
                    </a>
                    <a href="https://www.udacity.com/" target="_blank" rel="noopener">
                        <img src="saves/udacity.png" alt="udacity" style="max-height:40px;">
                    </a>
                    <a href="https://www.freecodecamp.org/" target="_blank" rel="noopener">
                        <img src="saves/FreeCodeCamp_logo.svg.png" alt="freeCodeCamp Logo" style="max-height:30px;">
                    </a>
                    <a href="https://www.edx.org/" target="_blank" rel="noopener">
                        <img src="saves/edx.png" alt="edx" style="max-height:40px;">
                    </a>
                    <a href="https://www.sololearn.com/" target="_blank" rel="noopener">
                        <img src="saves/SoloLearn_logo.svg.png" alt="SoloLearn" style="max-height:40px;">
                    </a>
                    <a href="https://www.khanacademy.org/" target="_blank" rel="noopener">
                        <img src="saves/khanacademy.png" alt="Khan Academy" style="max-height:40px;">
                    </a>
                    <a href="https://www.coursera.com/" target="_blank" rel="noopener">
                        <img src="saves/coursera.png" alt="Coursera" style="max-height:30px;">
                    </a>
                </div>
                <style>
                .logo-grid img {
                    transition: transform 0.9s cubic-bezier(.4,0,.2,1), box-shadow 0.3s cubic-bezier(.4,0,.2,1);
                    box-shadow: 0 0 0px rgba(0,255,255,0);
                }
                .logo-grid img:hover {
                    transform: scale(1.2);
                    box-shadow: 0 0 32px 0px #000000, 0 0 16px 0px #000000;
                    z-index: 1;
                }
                </style>
            </div>
        </section>
    <!-- --- How it works --- -->
    <section id="how-it-works-section" class="feature-section animate-on-scroll">
            <div class="container feature-layout">
                <div class="feature-content">
                    <h3 class="gradient-text">Practice Quizzes</h3>
                    <h4>Optimized For Your Training</h4>
                    <p>Practice quizzes are tailored to your learning style and progress, helping you master concepts efficiently. Our optimized training adapts in real-time, ensuring every session is focused on your growth and success.</p>
                    <a href="#" class="learn-more">Learn more <span class="arrow">&rarr;</span></a>
                                        <!-- Glassmorphic Practice Quiz Popup -->
                                        <div id="practiceQuizPopup" style="display:none; position:fixed; top:-200px; left:0; width:100vw; height:100vh; z-index:99999; background:rgba(8,7,16,0.45); backdrop-filter:blur(8px); align-items:center; justify-content:center;">
                                            <div class="glassmorphic-popup">
 <button id="closePracticeQuizPopup" style="position:absolute; top:18px; right:24px; background:none; border:none; color:#fff; font-size:2rem; cursor:pointer;">&times;</button>
            <h3 style="color:#23a2f6; margin-bottom:8px;">How Practice Quizzes Work</h3>
            <div style="display:flex; gap:24px; justify-content:center; flex-wrap:wrap;">
                <div style="background:rgba(255,255,255,0.09); border-radius:16px; box-shadow:0 0 16px rgba(44,46,68,0.18); padding:24px 18px; min-width:180px; flex:1;">
                    <h4 style="color:#ff512f; margin-bottom:10px;">Step 1</h4>
                       <p style="font-size:1.05rem;">Select your topic and difficulty. The quiz adapts to your current skill level.</p>
                </div>
                <div style="background:rgba(255,255,255,0.09); border-radius:16px; box-shadow:0 0 16px rgba(44,46,68,0.18); padding:24px 18px; min-width:180px; flex:1;">
                    <h4 style="color:#23a2f6; margin-bottom:10px;">Step 2</h4>
                    <p style="font-size:1.05rem;">Answer questions and get instant feedback. Track your progress in real time.</p>
                </div>
                <div style="background:rgba(255,255,255,0.09); border-radius:16px; box-shadow:0 0 16px rgba(44,46,68,0.18); padding:24px 18px; min-width:180px; flex:1;">
                    <h4 style="color:#f09819; margin-bottom:10px;">Step 3</h4>
                    <p style="font-size:1.05rem;">Review results and get personalized recommendations for next steps.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
     document.addEventListener('DOMContentLoaded', function() {
        var learnMoreBtn = document.querySelector('.feature-section .learn-more');
        var popup = document.getElementById('practiceQuizPopup');
        var closeBtn = document.getElementById('closePracticeQuizPopup');
                                            var learnMoreBtn = document.querySelector('.feature-section .learn-more');
                                            if (learnMoreBtn && popup) {
                                                learnMoreBtn.addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    popup.style.display = 'flex';
                                                    var glass = popup.querySelector('.glassmorphic-popup');
                                                    if (glass) {
                                                        glass.style.opacity = '0';
                                                        glass.style.transform = 'scale(0.95)';
                                                        setTimeout(function(){
                                                            glass.style.opacity = '1';
                                                            glass.style.transform = 'scale(1)';
                                                        }, 10);
                                                    }
                                                });
                                            }
                                            if (closeBtn && popup) {
                                                closeBtn.addEventListener('click', function() {
                                                    popup.style.display = 'none';
                                                });
                                            }
                                            popup.addEventListener('click', function(e) {
                                                if (e.target === popup) popup.style.display = 'none';
                                            });
                                        });
                                        </script>
                </div>
                <div class="">
                    <img src="saves/animation2.gif" alt="Abstract 3D Cube" style="width:500px; height:auto;" loop>
                </div>
            </div>
        </section>
        
<section class="feature-section animate-on-scroll">
<div class="container feature-layout reversed">
                
                <div id="courses" class="feature-content">
        <h3 class="gradient-text">Course Recommendation</h3>
<h4>Personalized Learning Paths</h4>
<p>Our AI-powered recommendation system analyzes your quiz performance to suggest the best courses for your skill level and goals. Get tailored learning paths designed to help you improve faster and stay ahead.</p>
<a href="#" class="learn-more">Explore Courses <span class="arrow">&rarr;</span></a>
<!-- Glassmorphic Explore Courses Popup -->
<div id="exploreCoursesPopup" style="display:none; position:fixed; top:-200px; left:0; width:100vw; height:100vh; z-index:99999; background:rgba(8,7,16,0.45); backdrop-filter:blur(8px); align-items:center; justify-content:center;">
    <div class="glassmorphic-popup">
        <button id="closeExploreCoursesPopup" style="position:absolute; top:18px; right:24px; background:none; border:none; color:#fff; font-size:2rem; cursor:pointer;">&times;</button>
        <h3 style="color:#23a2f6; margin-bottom:8px;">How Course Recommendations Work</h3>
        <div style="display:flex; gap:24px; justify-content:center; flex-wrap:wrap;">
            <div style="background:rgba(255,255,255,0.09); border-radius:16px; box-shadow:0 0 16px rgba(44,46,68,0.18); padding:24px 18px; min-width:180px; flex:1;">
                <h4 style="color:#ff512f; margin-bottom:10px;">Step 1</h4>
                <p style="font-size:1.05rem;">Our ML model analyzes your quiz performance and learning goals.</p>
            </div>
            <div style="background:rgba(255,255,255,0.09); border-radius:16px; box-shadow:0 0 16px rgba(44,46,68,0.18); padding:24px 18px; min-width:180px; flex:1;">
                <h4 style="color:#23a2f6; margin-bottom:10px;">Step 2</h4>
                <p style="font-size:1.05rem;">It uses the YouTube API to search for top-rated, relevant courses matching your needs.</p>
            </div>
            <div style="background:rgba(255,255,255,0.09); border-radius:16px; box-shadow:0 0 16px rgba(44,46,68,0.18); padding:24px 18px; min-width:180px; flex:1;">
                <h4 style="color:#f09819; margin-bottom:10px;">Step 3</h4>
                <p style="font-size:1.05rem;">You get a personalized list of the best courses, with direct links and ratings, so you can start learning right away.</p>
            </div>

        </div>
    <div style="margin-top:24px; font-size:1.1rem; color:#a3a3a3;">Powered by AI & YouTube API for smart, up-to-date recommendations.</div>
        
                                        

    </div>
</div>
        
</div>
    <div class="">

        <img src="saves/animation3.gif" alt="Abstract 3D shape" style="width:500px; height:auto;" loop>
        
    </div>                 
</div>


<style>
    #practiceQuizPopup, #exploreCoursesPopup {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        z-index: 2147483647;
        background: rgba(8,7,16,0.45);
        backdrop-filter: blur(16px);
        align-items: center; justify-content: center;
        animation: fadeInPopup 0.5s cubic-bezier(.4,0,.2,1);
    }
    .glassmorphic-popup {
        background: rgba(44,46,68,0.65);
        border-radius: 24px;
        box-shadow: 0 0 40px 0 rgba(8,7,16,0.35), 0 0 0 2px rgba(255,255,255,0.08);
        border: 1.5px solid rgba(255,255,255,0.18);
        padding: 20px 32px;
        min-width: 340px;
        max-width: 90vw;
        color: #fff;
        text-align: center;
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 32px;
        backdrop-filter: blur(24px);
        transition: transform 0.4s cubic-bezier(.4,0,.2,1), opacity 0.4s cubic-bezier(.4,0,.2,1);
        opacity: 0;
        transform: scale(0.95);
        animation: popupAppear 0.5s cubic-bezier(.4,0,.2,1) forwards;
    }
    @keyframes fadeInPopup {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes popupAppear {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var exploreBtn = document.querySelectorAll('.feature-section .learn-more')[1];
    var popup = document.getElementById('exploreCoursesPopup');
    var closeBtn = document.getElementById('closeExploreCoursesPopup');
    if (exploreBtn && popup) {
        exploreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            popup.style.display = 'flex';
            var glass = popup.querySelector('.glassmorphic-popup');
            if (glass) {
                glass.style.opacity = '0';
                glass.style.transform = 'scale(0.95)';
                setTimeout(function(){
                    glass.style.opacity = '1';
                    glass.style.transform = 'scale(1)';
                }, 10);
            }
        });
    }
    if (closeBtn && popup) {
        closeBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    }
    popup.addEventListener('click', function(e) {
        if (e.target === popup) popup.style.display = 'none';
    });
});
</script>

                </div>
            </div>
        </section>
        
        <section class="testimonial-section animate-on-scroll">
            <div class="container">
                <div class="testimonial-card">
                    
                    <div class="testimonial-content">
                        <blockquote>
                            "It's all about getting your Codeing tech up front of the right demands and creating those valuable skills. TheCodecrafters helped us do just that - all with a simple, easy-to-use platform."
                        </blockquote>
                        <cite>
                            <strong>Devs</strong>
                            Training and Learning in single platform
                        </cite>
                    </div>
                    <div class="testimonial-image">
                        <img src="Resources/img1.png" alt="Amaka Micheal">
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section animate-on-scroll">
             <div class="container">
                <div class="cta-card">
                    <div class="testimonial-image">
                        <img src="Resources/img2.png" alt="Amaka Micheal">
                    </div>
                    <div class="cta-content">
                        <h2>Get exponential Learning leap through AI driven courses recomendation.</h2>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=thecodecrafters%40gmail.com" class="btn btn-dark" target="_blank" rel="noopener">Get in touch <span class="arrow">&rarr;</span></a>
                    </div>
                </div>
            </div>
                    </section>

        <section class="slider-section">
  <div class="carousel">
    <div class="carousel-slide active">
      <img src="Resources/slide1.webp" alt="Slider 1">
      <div class="slide-caption">
        <h2>Shape Your Coding Career With CodeCrafters</h2>
        <h4>100% Skill-Based Learning for Better Opportunities</h4>
        <p>Get trained, certified, and ready for internships and job placements in top IT companies.</p>
      </div>
    </div>
    <div class="carousel-slide">
      <img src="Resources/slide2.webp" alt="Slider 2">
      <div class="slide-caption">
        <h2>AI Curated Learning Paths</h2>
        <h4>Learn from Industry Experts</h4>
        <p>Our trainers bring real-world experience and guidance to help you succeed in your IT career.</p>
      </div>
    </div>
    <div class="carousel-slide">
      <img src="Resources\analysis.avif" alt="Slider 3">
      <div class="slide-caption">
        <h2>Live Score Analysis and Skill based Mentored Courses</h2>
        <h4>Hands-On Practical Training</h4>
        <p>Learn with live feedback and gain expertise to build your portfolio and confidence.</p>
      </div>
    </div>
    <div class="carousel-slide">
      <img src="Resources/slide4.jpg" alt="Slider 4">
      <div class="slide-caption">
        <h2>Training Assistance</h2>
        <h4>Launch Your IT Career</h4>
        <p>We help you to reach the level of top IT companies for job placements and career growth.</p>
      </div>
    </div>
  </div>
</section>
        
    </main>
        <!-- About Us Section -->
        <section id="about-us-section" class="about-us-section animate-on-scroll" style="padding:80px 0;">
    <div class="container">
        <h2 class="gradient-text" style="text-align:center; margin-bottom:48px;">About Us</h2>
        <div class="about-us-cards" style="display:flex; gap:32px; justify-content:center; flex-wrap:wrap;">
            
            <!-- Card 1 -->
            <div class="about-card" style="flex:1; min-width:220px; max-width:340px; background:linear-gradient(135deg,#1845ad 0%,#23a2f6 100%); border-radius:24px; box-shadow:0 0 24px rgba(8,7,16,0.18); color:#fff; padding:32px 24px; text-align:center; cursor:pointer; transition:transform 0.2s;">
                <img src="saves/abt/about3.png" alt="Logo 1" style="width:64px; margin-bottom:1px; border-radius:50%; background:#fff; padding:10px;">
                <h4 style="margin-bottom:12px;">Our Mission</h4>
                <p>Empowering learners with AI-driven, personalized education for everyone.</p>
            </div>
            
            <!-- Card 2 -->
            <div class="about-card" style="flex:1; min-width:220px; max-width:340px; background:linear-gradient(135deg,#ff512f 0%,#f09819 100%); border-radius:24px; box-shadow:0 0 24px rgba(8,7,16,0.18); color:#fff; padding:32px 24px; text-align:center; cursor:pointer; transition:transform 0.2s;">
                <img src="saves/abt/about1.png" alt="Logo 2" style="width:64px; margin-bottom:18px; border-radius:50%; background:#fff; padding:10px;">
                <h4 style="margin-bottom:12px;">Our Team</h4>
                <p>Passionate educators, developers, and designers working together for your success.</p>
            </div>
            
            <!-- Card 3 -->
            <div class="about-card" style="flex:1; min-width:220px; max-width:340px; background:linear-gradient(135deg,#5200FF 0%,#FF2DF7 100%); border-radius:24px; box-shadow:0 0 24px rgba(8,7,16,0.18); color:#fff; padding:32px 24px; text-align:center; cursor:pointer; transition:transform 0.2s;">
                <img src="saves/abt/about2.png" alt="Logo 3" style="width:64px; margin-bottom:18px; border-radius:50%; background:#fff; padding:10px;">
                <h4 style="margin-bottom:12px;">Our Vision</h4>
                <p>Transforming learning with technology, making knowledge accessible and engaging.</p>
            </div>
            
            <!-- Card 4 -->
            <div class="about-card" style="flex:1; min-width:220px; max-width:340px; background:linear-gradient(135deg,#1845ad 0%,#23a2f6 100%); border-radius:24px; box-shadow:0 0 24px rgba(8,7,16,0.18); color:#fff; padding:32px 24px; text-align:center; cursor:pointer; transition:transform 0.2s;">
                <img src="saves/abt/about3.png" alt="Logo 4" style="width:64px; margin-bottom:18px; border-radius:50%; background:#fff; padding:10px;">
                <h4 style="margin-bottom:12px;">Our Agenda</h4>
                <p>Empowering learners with AI-driven, personalized education for everyone.</p>
            </div>
            
            <!-- Card 5 -->
            <div class="about-card" style="flex:1; min-width:220px; max-width:340px; background:linear-gradient(135deg,#ff512f 0%,#f09819 100%); border-radius:24px; box-shadow:0 0 24px rgba(8,7,16,0.18); color:#fff; padding:32px 24px; text-align:center; cursor:pointer; transition:transform 0.2s;">
                <img src="saves/abt/about2.png" alt="Logo 5" style="width:64px; margin-bottom:18px; border-radius:50%; background:#fff; padding:10px;">
                <h4 style="margin-bottom:12px;">Qualification</h4>
                <p>Passionate educators, developers, and designers working together for your success.</p>
            </div>
            
            <!-- Card 6 -->
            <div class="about-card" style="flex:1; min-width:220px; max-width:340px; background:linear-gradient(135deg,#5200FF 0%,#FF2DF7 100%); border-radius:24px; box-shadow:0 0 24px rgba(8,7,16,0.18); color:#fff; padding:32px 24px; text-align:center; cursor:pointer; transition:transform 0.2s;">
                <img src="saves/abt/about1.png" alt="Logo 6" style="width:64px; margin-bottom:18px; border-radius:50%; background:#fff; padding:10px;">
                <h4 style="margin-bottom:12px;">Our Project story</h4>
                <p>Transforming learning with technology, making knowledge accessible and engaging.</p>
            </div>

        </div>
    </div>
      <div class="ai-marketing-banner">
    <div class="liquid-design">
        <img src="Resources/contactus.webp" alt="AI Liquid Design" style="width:100%; height:100%; object-fit:contain; border-radius:12px;">
    </div>
    <div class="content">
        <h1>Get exponential reach <br> via AI Courses</h1>
        <div class="input-group">
            <input type="email" class="email-input" placeholder="Enter your work email">
            <button class="cta-button">Get in touch <span class="arrow">&rarr;</span></button>
        </div>
    </div>
</div>
</section>

            <!-- Card 5------------------------------------------------------------------------------ -->


<script>

        document.addEventListener('DOMContentLoaded', function() {
            var aboutBtn = document.getElementById('aboutUsBtn');
            var aboutSection = document.getElementById('about-us-section');
            if (aboutBtn && aboutSection) {
                aboutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    aboutSection.scrollIntoView({behavior:'smooth'});
                });
            }

            // Smooth scroll for "How It Works" nav link (fallback if anchor doesn't jump)
            var howBtn = document.getElementById('howItWorksBtn');
            var howSection = document.getElementById('how-it-works-section');
            if (howBtn && howSection) {
                howBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    howSection.scrollIntoView({behavior:'smooth'});
                });
            }
        });

</script>
    
    <footer class="main-footer">
        <div class="container">
            <div class="footer-logos">
                </div>
            <div class="footer-bottom">
                <ul style="list-style: none; padding: 0; margin: 0; font-family: Arial, sans-serif; font-size: 18px;">
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #fff;">Copyright &copy; 2025 TheCodeCrafters. All rights reserved.</li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Account Security</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Eligibility</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff">Data Security</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Third-Party Links</a></li>
    <li><a href="#" style="text-decoration: none; color: #aaaaaaff;">What’s new</a></li></ul>
            
             <p>
            <ul style="list-style: none; padding: 0; margin: 0; font-family: Arial, sans-serif; font-size: 18px;">
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #fff;">About</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Contact us</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Our license</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff">Blog</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Plans and Pricing</a></li>
    <li><a href="#" style="text-decoration: none; color: #aaaaaaff;">What’s new</a></li>
</ul>
</p>

                <p></p>
                <ul style="list-style: none; padding: 0; margin: 0; font-family: Arial, sans-serif; font-size: 18px;">
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #fff;">Terms of Use</a> <a href="#" style="text-decoration: none; color: #fff;"> & </a><a href="#" style="text-decoration: none; color: #fff;">Privacy Policy</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Account Security</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Eligibility</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff">Data Security</a></li>
    <li style="margin-bottom: 10px;"><a href="#" style="text-decoration: none; color: #aaaaaaff;">Third-Party Links</a></li>
    <li><a href="#" style="text-decoration: none; color: #aaaaaaff;">What’s new</a></li>
</ul>
            </div>
        </div>
    </footer>

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


            // --- Scroll Animations ---
            const scrollElements = document.querySelectorAll('.animate-on-scroll');

            const elementInView = (el, dividend = 1) => {
                const elementTop = el.getBoundingClientRect().top;
                return (
                    elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
                );
            };

            const displayScrollElement = (element) => {
                element.classList.add('visible');
            };

            const hideScrollElement = (element) => {
                element.classList.remove('visible');
            }

            const handleScrollAnimation = () => {
                scrollElements.forEach((el) => {
                    if (elementInView(el, 1.25)) {
                        displayScrollElement(el);
                    } 
                });
            };

            // Initial check
            handleScrollAnimation();
            window.addEventListener('scroll', handleScrollAnimation);

        });
    </script>

  

<style>
    /* --- START: AI Marketing Banner Styles --- */
.ai-marketing-banner {
    display: flex;
    align-items: center;
    background: linear-gradient(90deg, #3e98ffff,#a855f7, #ee82ee); /* Gradient background */
    border-radius: 15px;
    padding: 20px;
    width: 90%; /* Adjust as needed */
    max-width: 1000px; /* Max width for the banner */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    color: white;
    box-sizing: border-box;
    position: relative;
    overflow: hidden; /* Hide overflowing liquid design */
    margin: 40px auto; /* Adds some spacing and centers the banner on the page */
    font-family: Arial, sans-serif; /* Ensure consistent font */
}

.liquid-design {
    flex-shrink: 0; /* Prevent it from shrinking */
    width: 250px; /* Adjust size of the liquid design area */
    height: 250px; /* Adjust size */
    margin-right: 40px;
    /* Placeholder image for the liquid design */
    /* You will need to replace this with the actual image URL for the exact graphic */
    background-image: url('https://via.placeholder.com/250x250/ee82ee/8a2be2?text=Liquid'); /* Or your actual image path */
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

.content {
    flex-grow: 1; /* Allows content to take up remaining space */
}

.content h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    line-height: 1.2;
}

.input-group {
    display: flex;
    align-items: center;
    gap: 15px; /* Space between input and button */
}

.email-input {
    padding: 15px 20px;
    border: none;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent white */
    color: white;
    font-size: 1em;
    flex-grow: 1; /* Allows input to grow */
}

.email-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.email-input:focus {
    outline: none;
    background-color: rgba(255, 255, 255, 0.4);
}

.cta-button {
    background-color: black;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 15px 25px;
    font-size: 1em;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #333;
}

.arrow {
    font-size: 1.2em;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .ai-marketing-banner {
        flex-direction: column;
        text-align: center;
        padding: 30px;
    }

    .liquid-design {
        margin-right: 0;
        margin-bottom: 30px;
        width: 150px;
        height: 150px;
    }

    .content h1 {
        font-size: 2em;
    }

    .input-group {
        flex-direction: column;
    }

    .email-input, .cta-button {
        width: 100%;
    }
}
/* --- END: AI Marketing Banner Styles --- */
</style>
<script>
    // --- START: AI Marketing Banner Script ---
document.addEventListener('DOMContentLoaded', () => {
    // Using more specific selectors to avoid conflicts with other elements on the page
    const ctaButton = document.querySelector('.ai-marketing-banner .cta-button');
    const emailInput = document.querySelector('.ai-marketing-banner .email-input');

    // Only add event listener if elements exist
    if (ctaButton && emailInput) {
        ctaButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default form submission if it's inside a form
            const email = emailInput.value;

            if (email && email.includes('@') && email.includes('.')) {
                alert(`Submitting email: ${email}`);
                // In a real application, you would typically send this data to a server
                // using a fetch() API call. Example commented out below:
                /*
                fetch('/api/subscribe', { // Replace with your actual API endpoint
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    alert('Thank you for subscribing!');
                    emailInput.value = ''; // Clear input on success
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('There was an error subscribing. Please try again.');
                });
                */
                emailInput.value = ''; // Clear input field
            } else {
                alert('Please enter a valid email address.');
            }
        });
    }
});
// --- END: AI Marketing Banner Script ---
</script>

<script>
  const slides = document.querySelectorAll('.carousel-slide');
  let current = 0;

  function showSlides() {
    slides.forEach((slide, idx) => {
      slide.classList.remove('active', 'prev', 'next');
      
      // The currently active slide
      if (idx === current) {
        slide.classList.add('active');
      
      // The slide before the active one
      } else if (idx === (current - 1 + slides.length) % slides.length) {
        slide.classList.add('prev');
      
      // The slide after the active one
      } else if (idx === (current + 1) % slides.length) {
        slide.classList.add('next');
      }
      
      // All other slides (more than one position away) will have no classes and remain at z-index 1, opacity 0
    });
  }

  // Initial display
  showSlides();
  
  // Auto-rotate every 5 seconds
  setInterval(() => {
    current = (current + 1) % slides.length; // Cycle to the next slide
    showSlides();
  }, 5000); // 5 seconds
</script>

</body>
</html>