<?php
session_start();
// The included nav_sidebar.php will handle the top navigation
include 'nav_sidebar.php';

// --- Video Data ---
// In a real application, this data would come from a database.
// For this example, we'll use a PHP array.
$videos = [
    'kqtD5dpn9C8' => [
        'title' => 'Python for Beginners - Full Course',
        'description' => 'A comprehensive 12-hour course for absolute beginners who want to learn Python programming from scratch. Covers variables, data types, functions, loops, object-oriented programming, and more.',
        'channel' => 'freeCodeCamp.org',
    ],
    'C_3d6GntP0I' => [
        'title' => 'JavaScript Full Course for Free',
        'description' => 'Learn JavaScript from scratch in this 8-hour comprehensive course. This course covers everything from the basics to advanced topics like asynchronous JavaScript, APIs, and more.',
        'channel' => 'Bro Code',
    ],
    'HXV3zeQKqGY' => [
        'title' => 'SQL Tutorial - Full Database Course for Beginners',
        'description' => 'A complete 4-hour guide to SQL and databases. Learn to manage and query data effectively using MySQL, a popular relational database management system.',
        'channel' => 'freeCodeCamp.org',
    ],
    'G3e-cpL7ofc' => [
        'title' => 'HTML & CSS Full Course for Beginners',
        'description' => 'Learn to build beautiful, responsive websites from scratch. This course covers all the essential concepts of modern HTML5 and CSS3, including Flexbox and Grid.',
        'channel' => 'SuperSimpleDev',
    ],
    'CgkZ7MvWUAA' => [
        'title' => 'React JS Full Course 2024',
        'description' => 'Master the most popular JavaScript library for building modern user interfaces. This project-based course will get you up and running with React in no time.',
        'channel' => 'Bro Code',
    ],
    'BUCiSSyxxEo' => [
        'title' => 'PHP For Absolute Beginners | 6.5 Hour Course',
        'description' => 'Get started with server-side programming with this in-depth PHP tutorial. Learn about variables, arrays, forms, sessions, and connecting to a database.',
        'channel' => 'Traversy Media',
    ],
];

// Get the video ID from the URL, default to the first one if not set
$current_video_id = isset($_GET['v']) && array_key_exists($_GET['v'], $videos) ? $_GET['v'] : 'kqtD5dpn9C8';
$current_video = $videos[$current_video_id];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($current_video['title']); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" type="image/png" href="saves/123.png">

    <style>
        /* --- Base Theme Styles --- */
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

        /* --- NEW: Main Content Wrapper Styles --- */
        .main-content {
            padding-left: 0; /* Starts with no padding as sidebar is hidden */
            transition: padding-left 0.3s ease-in-out;
        }
        .main-content:not(.expanded) {
            padding-left: 250px; /* Pushes content right when sidebar is active */
        }
        @media (max-width: 767px) {
            .main-content, .main-content:not(.expanded) {
                padding-left: 0;
            }
        }

        /* --- Video Player Styles (Unchanged) --- */
        .video-player-wrapper {
            position: relative;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            background-color: #000;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(8, 7, 16, 0.4);
        }
        .video-player-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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

        /* --- Playlist Styles (Unchanged) --- */
        .playlist-wrapper {
            background-color: var(--dk-dark-bg);
            padding: 16px;
            border-radius: 16px;
            height: 100%;
            max-height: 80vh; /* Make playlist scrollable */
            overflow-y: auto;
        }
        .playlist-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #fff;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 16px;
        }
        .playlist-item {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            text-decoration: none;
            color: var(--dk-gray-300);
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }
        .playlist-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        .playlist-thumbnail {
            width: 120px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }
        .playlist-item-details h6 {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 4px;
            color: #fff;
        }
        .playlist-item-details p {
            font-size: 0.8rem;
            color: var(--dk-gray-400);
            margin: 0;
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
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($current_video_id); ?>?autoplay=1&rel=0" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-details">
                    <h1 class="video-title"><?php echo htmlspecialchars($current_video['title']); ?></h1>
                    <p class="video-channel">By <?php echo htmlspecialchars($current_video['channel']); ?></p>
                    <hr style="border-color: rgba(255,255,255,0.1);">
                    <p class="video-description"><?php echo htmlspecialchars($current_video['description']); ?></p>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="playlist-wrapper">
                    <h4 class="playlist-title">Up Next</h4>
                    <?php
                    // Loop through all videos to create the playlist
                    foreach ($videos as $id => $video) {
                        // Skip the currently playing video
                        if ($id === $current_video_id) {
                            continue;
                        }
                        echo '<a href="watch_video.php?v=' . htmlspecialchars($id) . '" class="playlist-item">';
                        echo '<img src="https://i.ytimg.com/vi/' . htmlspecialchars($id) . '/hqdefault.jpg" alt="' . htmlspecialchars($video['title']) . '" class="playlist-thumbnail">';
                        echo '<div class="playlist-item-details">';
                        echo '<h6>' . htmlspecialchars($video['title']) . '</h6>';
                        echo '<p>' . htmlspecialchars($video['channel']) . '</p>';
                        echo '</div>';
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>