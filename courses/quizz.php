<?php
// Ensure session is started so nav/sidebar can access logged-in user data
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : '';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '';

// Include the shared navigation and sidebar
include __DIR__ . '/../testquiz.php';

// Database Connection (Keep your existing logic)
$con = mysqli_connect("localhost", "root", "", "codecrafters");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$selectedLang = isset($_GET['lang']) ? $_GET['lang'] : 'Tests';
$selectedLevel = isset($_GET['level']) ? intval($_GET['level']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Test</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="saves/123.png">

    <style>
        /* --- 1. Variables from Reference Code --- */
        :root {
            --bg-color: #000000;
            --text-color: #F8F7F7;
            --secondary-text-color: #a3a3a3;
            --gradient: linear-gradient(267deg, #00F0FF 4%, #5200FF 57%, #FF2DF7 115%);
            --font-primary: 'Poppins', sans-serif;
            --font-secondary: 'Montserrat', sans-serif;
            --font-body: 'Inter', sans-serif;
            
            /* Dark Theme Colors */
            --dk-dark-bg: #313348;
            --dk-darker-bg: #2a2b3d;
            --card-bg: #2B2B3E;
            --input-bg: #1F2937;
            --border-color: #4B5563;
        }

        body {
            font-family: var(--font-primary);
            background-color: var(--dk-darker-bg) !important;
            color: var(--text-color);
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- 2. Layout Containers --- */
        .page-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .header-title {
            background-color: #4A70C2;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            display: inline-block;
            font-size: 1.5em;
            margin: 40px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }

        /* --- 3. Action Bar (Search & Dashboard) --- */
        .actions-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            display: flex;
            flex-grow: 1;
            gap: 10px;
            max-width: 600px;
        }

        input[type="text"] {
            flex-grow: 1;
            background-color: var(--card-bg);
            border: 2px solid var(--border-color);
            color: #fff;
            padding: 12px 20px;
            border-radius: 50px;
            outline: none;
            font-family: var(--font-body);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus {
            border-color: #7A7AFF;
            box-shadow: 0 0 10px rgba(122, 122, 255, 0.2);
        }

        /* --- 4. Button Styles --- */
        .btn {
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            font-family: var(--font-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            background-color: transparent;
            border: 2px solid #4A70C2;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #4A70C2;
        }

        /* --- 5. Table Card Design --- */
        .table-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            overflow-x: auto; /* Handle horizontal scroll on mobile */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: var(--font-body);
        }

        thead tr {
            border-bottom: 2px solid #4B5563;
        }

        th {
            text-align: left;
            padding: 20px 15px;
            color: #a3a3a3;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 20px 15px;
            color: #E0E0E0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }

        tbody tr {
            transition: background-color 0.3s ease;
        }

        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Pills (Optional styling for data) */
        .badge-score {
            background-color: #313348;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.9em;
            color: #00F0FF;
            font-weight: bold;
        }

        /* Start Button in Table */
        .btn-start {
            background: var(--gradient);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9em;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-start:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(82, 0, 255, 0.4);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .actions-container {
                flex-direction: column;
                align-items: stretch;
            }
            .header-title {
                margin: 20px 0;
                font-size: 1.2em;
                text-align: center;
                display: block;
            }
            th, td {
                padding: 15px 10px;
                font-size: 0.9em;
            }
        }
        .navbar {
            position: -webkit-sticky; /* Safari */
            position: sticky !important;
            top: 0;
            z-index: 9999; /* Ensure it stays on top of everything */
            width: 100%;
        }

        /* 2. Make the Sidebar Fixed (if your include has a sidebar) */
        .sidebar {
            position: fixed !important; /* Locks it to the screen */
            height: 100vh; /* Full height */
            overflow-y: auto; /* Scroll internally if menu is long */
            top: 0;
            left: 0;
            z-index: 10000; /* Sidebar usually sits above navbar */
        }

        /* 3. Adjust Main Content so it doesn't hide behind the fixed Sidebar */
        /* Only needed if your sidebar covers the content */
        #wrapper {
            padding-top: 0; 
            /* If sidebar is fixed, you might need margin-left on wrapper 
               depending on your sidebar's width (e.g., 250px) */
            /* margin-left: 250px; */ 
        }
    </style>
</head>
<body>

    <section id="wrapper">
        <div class="page-inner">
            
            <div class="header-title">
                <?php
                if ($selectedLevel > 0) {
                    echo htmlspecialchars(ucfirst($selectedLang)) . ' — Level ' . $selectedLevel . ' Tests';
                } else {
                    echo 'Available Tests';
                }
                ?>
            </div>

            <main>
                <section class="actions-container">
                    <a href="../dash.php" class="btn btn-secondary">
                        &#8592; Dashboard
                    </a>
                    
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search Topics...">
                        <button class="btn btn-primary" onclick="alert('Search functionality to be implemented via JS')">Search</button>
                    </div>
                </section>

                <section class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>Test ID</th>
                                <th>Topics</th>
                                <th>Attempts</th>
                                <th>Highest Score</th>
                                <th>Last Score</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query Database: if lang+level provided, filter by language and TestID pattern
                            $sql = "SELECT * FROM tests";
                            if (!empty($selectedLang) && $selectedLevel > 0) {
                                $langEsc = mysqli_real_escape_string($con, $selectedLang);
                                $like = '%_L' . $selectedLevel . '_%';
                                $likeEsc = mysqli_real_escape_string($con, $like);
                                // Use case-insensitive comparison for Language
                                $sql = "SELECT * FROM tests WHERE LOWER(Language)=LOWER('" . $langEsc . "') AND TestID LIKE '" . $likeEsc . "' ORDER BY TestID ASC";
                            }
                            $result = mysqli_query($con, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>#" . htmlspecialchars($row['TestID']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Topics']) . "</td>";

                                    // Determine current logged-in user's email (testquiz.php sets $user_email)
                                    $currentUserEmail = (isset($user_email) && $user_email !== 'error') ? $user_email : null;

                                    // Default display values when no practice_score row exists
                                    $displayAttempts = 0;
                                    $displayHighest = '-';
                                    $displayLast = '-';

                                    if ($currentUserEmail) {
                                        $psTestId = mysqli_real_escape_string($con, $row['TestID']);
                                        $psEmail = mysqli_real_escape_string($con, $currentUserEmail);
                                        $psSql = "SELECT Attempts, HighestScore, LastScore FROM practice_score WHERE email = '" . $psEmail . "' AND TestID = '" . $psTestId . "' LIMIT 1";
                                        $psRes = mysqli_query($con, $psSql);
                                        if ($psRes && mysqli_num_rows($psRes) > 0) {
                                            $psRow = mysqli_fetch_assoc($psRes);
                                            $displayAttempts = htmlspecialchars($psRow['Attempts']);
                                            $displayHighest = htmlspecialchars($psRow['HighestScore']);
                                            $displayLast = htmlspecialchars($psRow['LastScore']);
                                        }
                                    }

                                    // Show Attempts and Scores from practice_score (or defaults)
                                    echo "<td>" . $displayAttempts . "</td>";
                                    echo "<td><span class='badge-score'>" . $displayHighest . "</span></td>";
                                    echo "<td><span class='badge-score' style='color:#a3a3a3'>" . $displayLast . "</span></td>";

                                    // Styled Action Button: will redirect to course-local quiz runner with topic & test params
                                    echo '<td>';
                                    $testIdEsc = htmlspecialchars($row['TestID']);
                                    echo '<button class="btn-start" onclick="startTest(\'' . $testIdEsc . '\')">Start Test &#10140;</button>';
                                    echo '</td>';

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' style='text-align:center; padding: 40px; color: #a3a3a3;'>No tests found available at this moment.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </main>
        
        </div> </section>

    <script>
        function startTest(testId) {
            // Redirect to the local quiz runner (quizpractice.php) with the selected test
            if (confirm("Are you ready to start Test #" + testId + "?")) {
                const lang = <?php echo json_encode($selectedLang); ?>;
                // Redirect to the course-local quizpractice.php which runs the quiz
                const url = "quizpractice.php?topic=" + encodeURIComponent(lang) + "&test=" + encodeURIComponent(testId);
                window.location.href = url;
            }
        }

        // Optional: Simple JS Search Filter
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelector("table tbody").rows;
            
            for (let i = 0; i < rows.length; i++) {
                let topicCol = rows[i].cells[1].textContent || rows[i].cells[1].innerText;
                if (topicCol.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    </script>
</body>
</html>