<?php
session_start();
// The included nav_sidebar.php will handle the top navigation
include 'testquiz.php';

// --- Paid Courses Data ---
// This array holds the information for your paid courses.
$paid_courses = [
    'advanced-dsa' => [
        'title' => 'Advanced Data Structures & Algorithms',
        'description' => 'Master complex algorithms and ace your technical interviews with this in-depth course. This course covers everything from advanced tree structures and graph algorithms to dynamic programming and complexity analysis.',
        'instructor' => 'Jane Doe, Ex-Google Engineer',
        'trailer_id' => 'BBpAmxU_RiQ', // Example YouTube trailer ID
        'price' => '499',
    ],
    'full-stack-bootcamp' => [
        'title' => 'The Complete Full-Stack Bootcamp',
        'description' => 'Learn to build and deploy complete web applications with the MERN stack (MongoDB, Express, React, Node.js). This project-based bootcamp will take you from beginner to job-ready developer.',
        'instructor' => 'John Smith, Full-Stack Expert',
        'trailer_id' => 'ANzPM5-lwNQ', // Example YouTube trailer ID
        'price' => '899',
    ],
    'machine-learning-az' => [
        'title' => 'Machine Learning A-Z™: AI & Data Science',
        'description' => 'Build a career in data science by mastering machine learning models and Python. This course provides a complete toolkit for handling data, building predictive models, and understanding AI concepts.',
        'instructor' => 'Dr. Emily Carter',
        'trailer_id' => 'J_I_g_m2_Nc', // Example YouTube trailer ID
        'price' => '999',
    ],
];

// Get the course ID from the URL
$course_id = isset($_GET['course']) && array_key_exists($_GET['course'], $paid_courses) ? $_GET['course'] : 'advanced-dsa';
$current_course = $paid_courses[$course_id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($current_course['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" type="image/png" href="saves/123.png">

    <style>
        /* --- Base Theme & Layout Styles (same as watch_video.php) --- */
        @import 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap';
        :root {
            --dk-dark-bg: #313348;
            --dk-darker-bg: #2a2b3d;
            --dk-gray-300: #D1D5DB;
            --dk-gray-400: #9CA3AF;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dk-darker-bg);
            color: var(--dk-gray-300);
        }
        .main-content {
            padding-left: 0;
            transition: padding-left 0.3s ease-in-out;
        }
        .main-content:not(.expanded) {
            padding-left: 250px;
        }
        @media (max-width: 767px) {
            .main-content, .main-content:not(.expanded) {
                padding-left: 0;
            }
        }
        .video-player-wrapper {
            position: relative;
            padding-top: 56.25%;
            height: 0;
            background-color: #000;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(8, 7, 16, 0.4);
        }
        .video-player-wrapper iframe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border: 0;
        }
        .video-details {
            background-color: var(--dk-dark-bg);
            padding: 24px;
            border-radius: 16px;
            margin-top: 24px;
        }
        .video-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #fff;
        }
        .video-channel {
            font-size: 1rem;
            color: #23a2f6;
            font-weight: 500;
            margin-top: 8px;
        }
        .video-description {
            margin-top: 16px;
            line-height: 1.6;
            color: var(--dk-gray-400);
        }
        .playlist-wrapper {
            background-color: var(--dk-dark-bg);
            padding: 16px;
            border-radius: 16px;
            height: 100%;
        }
        /* --- NEW STYLES for Buy Section --- */
        .buy-section {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .buy-section .price {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
        }
        .buy-section .btn-buy {
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 30px;
        }
    </style>
</head>
<body>

<main id="main-content" class="main-content expanded">
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="video-player-wrapper">
                    <iframe 
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($current_course['trailer_id']); ?>?rel=0" 
                        title="YouTube video player" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-details">
                    <h1 class="video-title"><?php echo htmlspecialchars($current_course['title']); ?></h1>
                    <p class="video-channel">By <?php echo htmlspecialchars($current_course['instructor']); ?></p>
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <p class="video-description"><?php echo htmlspecialchars($current_course['description']); ?></p>
                    
                    <div class="buy-section">
                        <div class="price">Rs.<?php echo htmlspecialchars($current_course['price']); ?></div>
                        <a href="checkout.php?course=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-primary btn-buy">Buy Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="playlist-wrapper">
                    <h4 class="playlist-title">Other Premium Courses</h4>
                    </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>