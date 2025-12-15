<?php
session_start();
// The included nav_sidebar.php will handle user session display
include 'testquiz.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recommended Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" type="image/png" href="saves/123.png">

    <style>
        /* --- Base Theme Styles (from your original file) --- */
        @import 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap';
        :root {
            --dk-dark-bg: #313348;
            --dk-darker-bg: #2a2b3d;
            --dk-gray-300: #D1D5DB;
            --dk-gray-400: #9CA3AF;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--dk-darker-bg); 
            font-size: .925rem; 
            color: var(--dk-gray-300);
        }
        #wrapper { 
            margin-left: 0; 
            transition: all .3s ease-in-out; 
        }

        /* --- Custom Styles for Courses Page --- */
        .course-section {
            margin-top: 40px;
        }
        .section-title {
            color: #fff;
            margin-bottom: 24px;
            font-weight: 600;
            border-bottom: 2px solid #23a2f6;
            padding-bottom: 8px;
            display: inline-block;
        }
        .course-card {
            background: rgba(44, 46, 68, 0.85);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(8, 7, 16, 0.2);
            padding: 16px;
            margin-bottom: 24px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: 1px solid rgba(255, 255, 255, 0.05);
            text-decoration: none;
            color: var(--dk-gray-300);
            display: block;
        }
        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(35, 162, 246, 0.25);
            color: #fff;
        }
        .course-card-thumbnail {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 16px;
        }
        .course-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .course-card-description {
            font-size: 0.9rem;
            color: var(--dk-gray-400);
            height: 40px; /* Ensures consistent card height */
        }
        .course-card-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #23a2f6;
            margin-top: 12px;
        }
        .course-card .btn {
            margin-top: 16px;
            width: 100%;
        }
    </style>
</head>
<body>
<section id="wrapper">
    <div class="p-4">
        <div class="welcome">
            <div class="content rounded-3 p-3" style="background-color: var(--dk-dark-bg); margin-top: 2%; margin-bottom: 2%;">
                <h1 class="fs-3 mb-0">Recommended Courses</h1>
                <p class="mb-0">Enhance your skills with our curated list of free and premium courses.</p>
            </div>
        </div>

        <section class="course-section">
            <h2 class="section-title">Free Courses</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
                    <a href="watch_video.php?v=kqtD5dpn9C8" class="course-card">
                        <img src="https://i.ytimg.com/vi/kqtD5dpn9C8/hqdefault.jpg" alt="Python Tutorial Thumbnail" class="course-card-thumbnail">
                        <h5 class="course-card-title">Python for Beginners - Full Course</h5>
                        <p class="course-card-description">A comprehensive course for absolute beginners who want to learn Python programming.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
                    <a href="watch_video.php?v=C_3d6GntP0I" class="course-card">
                        <img src="https://i.ytimg.com/vi/e-VTui5-hRE/sddefault.jpg" alt="JavaScript Tutorial Thumbnail" class="course-card-thumbnail">
                        <h5 class="course-card-title">Python Integration with JavaScript Full Course</h5>
                        <p class="course-card-description">Learn JavaScript from scratch. This course covers everything from basics to advanced topics.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
                    <a href="watch_video.php?v=HXV3zeQKqGY" class="course-card">
                        <img src="https://i.ytimg.com/vi/HXV3zeQKqGY/hqdefault.jpg" alt="SQL Tutorial Thumbnail" class="course-card-thumbnail">
                        <h5 class="course-card-title">Python + SQL Tutorial - Full Database Course</h5>
                        <p class="course-card-description">A complete guide to SQL and databases with python for beginners. Learn to manage and query data effectively.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
                    <a href="watch_video.php?v=G3e-cpL7ofc" class="course-card">
                        <img src="https://i.ytimg.com/vi/G3e-cpL7ofc/hqdefault.jpg" alt="HTML & CSS Tutorial Thumbnail" class="course-card-thumbnail">
                        <h5 class="course-card-title">HTML & CSS Full Course for Beginners</h5>
                        <p class="course-card-description">Build beautiful, responsive websites from scratch by mastering the fundamentals of HTML and CSS.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
                    <a href="watch_video.php?v=CgkZ7MvWUAA" class="course-card">
                        <img src="https://i.ytimg.com/vi/CgkZ7MvWUAA/hqdefault.jpg" alt="React JS Tutorial Thumbnail" class="course-card-thumbnail">
                        <h5 class="course-card-title">Python and React JS Full Course 2024</h5>
                        <p class="course-card-description">Learn the most popular JavaScript library for building modern user interfaces.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
                    <a href="watch_video.php?v=BUCiSSyxxEo" class="course-card">
                        <img src="https://www.clariontech.com/hubfs/Python%20vs%20PHP-%20Battle%20is%20On.webp" alt="PHP Tutorial Thumbnail" class="course-card-thumbnail">
                        <h5 class="course-card-title">PHP and python integration For Absolute Beginners</h5>
                        <p class="course-card-description">Get started with server-side programming with this in-depth PHP tutorial for beginners.</p>
                    </a>
                </div>
            </div>
        </section>

        <section class="course-section">
    <h2 class="section-title">Paid Courses</h2>
    <div class="row">
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
            <a href="course_details.php?course=advanced-dsa" class="course-card">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221114175057/10BestDataStructuresandAlgorithmsCourses.png" alt="Data Structures Course" class="course-card-thumbnail">
                <h5 class="course-card-title">Advanced Data Structures & Algorithms</h5>
                <p class="course-card-description">Master complex algorithms and ace your technical interviews with this in-depth course.</p>
                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                    <div class="course-card-price">Rs.499</div>
                    <span class="btn btn-primary">Enroll Now</span>
                </div>
            </a>
        </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
            <a href="course_details.php?course=full-stack-bootcamp" class="course-card">
                <img src="https://img-c.udemycdn.com/course/750x422/1565838_e54e_18.jpg" alt="Full-Stack Course" class="course-card-thumbnail">
                <h5 class="course-card-title">The Complete Full-Stack Bootcamp</h5>
                <p class="course-card-description">Learn to build and deploy complete web applications with the MERN stack.</p>
                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                    <div class="course-card-price">Rs.899</div>
                    <span class="btn btn-primary">Enroll Now</span>
                </div>
            </a>
        </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
            <a href="course_details.php?course=machine-learning-az" class="course-card">
                <img src="https://www.classcentral.com/report/wp-content/uploads/2022/06/andrew-ng-2022-machine-learning-banner.png" alt="Machine Learning Course" class="course-card-thumbnail">
                <h5 class="course-card-title">Machine Learning A-Z™: AI & Data Science</h5>
                <p class="course-card-description">Build a career in data science by mastering machine learning models and Python.</p>
                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                    <div class="course-card-price">Rs.999</div>
                    <span class="btn btn-primary">Enroll Now</span>
                </div>
            </a>
        </div>
                <div class="col-lg-4 col-md-6" style="margin-top: 10px; margin-bottom: 10px;">
            <a href="course_details.php?course=machine-learning-az" class="course-card">
                <img src="https://www.classcentral.com/report/wp-content/uploads/2022/06/andrew-ng-2022-machine-learning-banner.png" alt="Machine Learning Course" class="course-card-thumbnail">
                <h5 class="course-card-title">Machine Learning A-Z™: AI & Data Science</h5>
                <p class="course-card-description">Build a career in data science by mastering machine learning models and Python.</p>
                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                    <div class="course-card-price">Rs.999</div>
                    <span class="btn btn-primary">Enroll Now</span>
                </div>
            </a>
        </div>
    </div>
</section>
</section>

        </div>

<style>
    .course-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        text-decoration: none;
    }
</style>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>