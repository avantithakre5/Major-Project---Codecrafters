<?php
session_start();
$user_name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'error';
$user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : 'error';

// DB connection
$con = mysqli_connect('localhost', 'root', '', 'codecrafters');
if (!$con) die('Database connection failed');

// Language mapping
$lang_map = [
  'python'=>['start'=>1, 'end'=>10],
  'c'=>['start'=>11, 'end'=>20],
  'cpp'=>['start'=>21, 'end'=>30],
  'csharp'=>['start'=>31, 'end'=>40],
  'rust'=>['start'=>41, 'end'=>50],
  'r'=>['start'=>51, 'end'=>60],
  'typescript'=>['start'=>61, 'end'=>70],
  'ruby'=>['start'=>71, 'end'=>80],
  'php'=>['start'=>81, 'end'=>90],
  'javascript'=>['start'=>91, 'end'=>100],
  'sql'=>['start'=>101, 'end'=>110],
  'kotlin'=>['start'=>111, 'end'=>120],
];
$topic = isset($_GET['topic']) ? $_GET['topic'] : 'python';
$range = isset($lang_map[$topic]) ? $lang_map[$topic] : $lang_map['python'];
$start = $range['start'];
$end = $range['end'];

// If a specific TestID is provided (e.g., PY_L1_T1), map it to a numeric quiz range
if (isset($_GET['test']) && $_GET['test'] !== '') {
  $testId = strtoupper(trim($_GET['test']));
  // Mapping table for Python tests (add more mappings here as required)
  $test_ranges = [
    // Level 1
    'PY_L1_T1' => [131,140],
    'PY_L1_T2' => [141,150],
    'PY_L1_T3' => [151,160],
    'PY_L1_T4' => [161,170],
    'PY_L1_T5' => [71,80],
    // Level 2
    'PY_L2_T1' => [81,90],
    'PY_L2_T2' => [91,100],
    'PY_L2_T3' => [101,110],
    'PY_L2_T4' => [111,120],
    'PY_L2_T5' => [221,230],
    // Level 3 (defaults / examples)
    'PY_L3_T1' => [181,190],
    'PY_L3_T2' => [191,200],
    'PY_L3_T3' => [201,210],
    'PY_L3_T4' => [211,220],
    'PY_L3_T5' => [231,240],
    // Level 4 (examples)
    'PY_L4_T1' => [241,250],
    'PY_L4_T2' => [251,260],
    'PY_L4_T3' => [261,270],
    'PY_L4_T4' => [271,280],
    'PY_L4_T5' => [281,290],
  ];

  if (isset($test_ranges[$testId])) {
    $rangeVals = $test_ranges[$testId];
    $start = intval($rangeVals[0]);
    $end = intval($rangeVals[1]);
    // override topic to the first two letters language code mapping (optional)
    if (strpos($testId, 'PY_') === 0) $topic = 'python';
  } else {
    // Unknown test mapping: show a friendly message and stop
    echo "<div style='padding:24px; font-family:Inter, Arial; color:#fff; background:#111; min-height:100vh;'><h2 style='color:#23a2f6'>Unknown Test</h2><p>The requested TestID <strong>" . htmlspecialchars($testId) . "</strong> does not have a mapping to question ranges yet.</p><p>Please contact the site admin or choose another test from the <a href='quizz.php?lang=" . urlencode($topic) . "&level=" . urlencode(isset($_GET['level'])?$_GET['level']:'') . "'>test list</a>.</p></div>";
    exit;
  }
}

// Fetch questions from DB
$questions = [];
$res = mysqli_query($con, "SELECT * FROM test_quiz WHERE CAST(SUBSTRING(quiz_id,2) AS UNSIGNED) >= $start AND CAST(SUBSTRING(quiz_id,2) AS UNSIGNED) <= $end");
while ($row = mysqli_fetch_assoc($res)) {
  $questions[] = [
    'question' => $row['questions'],
    'options' => [$row['option1'], $row['option2'], $row['option3'], $row['option4']],
    'answer' => intval($row['answer'])
  ];
}

// Handle score submission
// Handle score submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
  $score = intval($_POST['score']);
  $emailRaw = isset($user_email) ? $user_email : '';
  $email = mysqli_real_escape_string($con, $emailRaw);

  // 1. Determine TestID used for this practice run
  $testIdForSave = '';
  if (isset($testId) && $testId !== '') {
    $testIdForSave = $testId;
  } elseif (isset($_GET['test']) && $_GET['test'] !== '') {
    $testIdForSave = strtoupper(trim($_GET['test']));
  }

  // 2. Database Logic (The new code goes here)
  if ($emailRaw !== '' && $emailRaw !== 'error' && $testIdForSave !== '') {
    $psTestId = mysqli_real_escape_string($con, $testIdForSave);
    $psScore = intval($score);

    // Create table if it doesn't exist (Safe to keep this just in case)
    mysqli_query($con, "CREATE TABLE IF NOT EXISTS practice_score (
      email VARCHAR(255) NOT NULL,
      TestID VARCHAR(64) NOT NULL,
      Attempts INT DEFAULT 0,
      HighestScore INT DEFAULT 0,
      LastScore INT DEFAULT 0,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (email, TestID)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // A. Explicitly check if the row exists
    $checkQuery = "SELECT * FROM practice_score WHERE email = '$email' AND TestID = '$psTestId'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Row exists: UPDATE it
        $updateQuery = "UPDATE practice_score 
                        SET Attempts = Attempts + 1, 
                            HighestScore = GREATEST(HighestScore, $psScore), 
                            LastScore = $psScore, 
                            updated_at = NOW() 
                        WHERE email = '$email' AND TestID = '$psTestId'";
        
        $resUp = mysqli_query($con, $updateQuery);
        $action = "UPDATE"; 
    } else {
        // Row does not exist: INSERT it
        $insertQuery = "INSERT INTO practice_score 
                        (email, TestID, Attempts, HighestScore, LastScore, updated_at) 
                        VALUES 
                        ('$email', '$psTestId', 1, $psScore, $psScore, NOW())";
        
        $resUp = mysqli_query($con, $insertQuery);
        $action = "INSERT"; 
    }

    if ($resUp === false) {
        $dbError = mysqli_error($con); 
    }
  } else {
      $dbError = "Missing Data: Email: $emailRaw, TestID: $testIdForSave";
  }

  // 3. Return Response
  $response = ['success' => true];
  $response['debug_action'] = isset($action) ? $action : 'NONE';
  $response['saved'] = isset($resUp) && $resUp !== false;
  if (isset($dbError)) $response['db_error'] = $dbError;

  header('Content-Type: application/json');
  echo json_encode($response);
  exit; // Stop script here so HTML isn't sent back
}

  // Build return URL back to the test list (quizz.php) for this topic/level
  $returnUrl = 'quizz.php?lang=' . urlencode($topic);
  if (isset($_GET['level']) && $_GET['level'] !== '') {
    $returnUrl .= '&level=' . urlencode($_GET['level']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Python Quiz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap & Unicons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
  <style>
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
    #wrapper { 
      margin-left: 0; 
      transition: all .3s ease-in-out; 
      height: 90%; 
      width: 100%; 
      position: absolute; 
      top: 5vh; 
      left: 0; 
    }
    #wrapper.fullwidth { margin-left: 0; 
    
       height: 90%; 
      width: 80%; 
      position: absolute; 
    }
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
    .quiz-container {
      background-color: var(--dk-dark-bg);
      border-radius: 18px;
      box-shadow: 0 0 30px rgba(8,7,16,0.3);
      color: #fff;
      padding: 40px 30px;
      margin: 40px 0 0 0; /* Top margin only, align left */
      width: 80%;
      height: 100%;
      border: 1px solid rgba(255,255,255,0.1);
      position: relative;
      left: 0;
    }
    .quiz-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }
    .quiz-timer {
      font-size: 1.2rem;
      font-weight: 600;
      color: #ffc107;
      background: #252636;
      padding: 8px 18px;
      border-radius: 8px;
      letter-spacing: 1px;
    }
    .quiz-question {
      font-size: 1.15rem;
      font-weight: 500;
      margin-bottom: 18px;
      color: #F3F4F6;
    }
    .quiz-options label {
      display: block;
      background: rgba(255,255,255,0.07);
      border-radius: 8px;
      padding: 10px 18px;
      margin-bottom: 12px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .quiz-options input[type="radio"] {
      margin-right: 10px;
    }
    .quiz-options label:hover {
      background: rgba(255,255,255,0.15);
    }
    .quiz-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }
    .btn-gradient {
      background: linear-gradient(to right, #1845ad, #23a2f6, #ff512f, #f09819);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      padding: 10px 30px;
      transition: background 0.2s;
    }
    .btn-gradient:hover {
      background: linear-gradient(to right, #ff512f, #f09819, #1845ad, #23a2f6);
      color: #fff;
    }
    .quiz-result {
      text-align: center;
      font-size: 1.3rem;
      font-weight: 600;
      color: #23a2f6;
      margin-top: 30px;
    }
    #scorePopup {
  position: fixed !important;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  display: none;
  z-index: 999 !important;
}

#scorePopup > div {
  position: relative;
  z-index: 1000; /* force above */
}

  </style>
</head>
<body>
<section id="wrapper">
  <div class="p-4 d-flex" style="gap: 32px; align-items: flex-start; height: 100%; width: 100%;">
    <!-- Main Quiz Container (Left) -->
    <div class="quiz-container flex-grow-1" id="quiz-container" style="width:100%; margin-top:0;">
      <div class="quiz-header">
        <div><?php echo ucfirst($topic); ?> Programming Quiz</div>
      </div>
      <form id="quiz-form">
        <div id="quiz-question-block"></div>
        <div class="quiz-actions">
          <!-- Previous button removed -->
          <button type="submit" class="btn-gradient" id="submit-btn">Submit</button>
        </div>
      </form>
      <div class="quiz-result" id="quiz-result" style="display:none;"></div>
      <!-- Score Popup -->
      <div id="scorePopup" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:500; background:rgba(8,7,16,0.65); backdrop-filter:blur(8px); align-items:center; justify-content:center; border: 4px solid red;">
        <div style="background:rgba(44,46,68,0.98); border-radius:18px; box-shadow:0 0 40px rgba(8,7,16,0.3); padding:40px 32px; min-width:320px; max-width:90vw; color:#fff; text-align:center; position:relative;">
          <h3 style="color:#23a2f6; margin-bottom:18px;">Quiz Completed!</h3>
          <div id="scorePopupText" style="font-size:1.2rem; margin-bottom:24px;"></div>
          <a href="<?php echo htmlspecialchars($returnUrl); ?>" class="btn btn-primary" style="font-weight:600; border-radius:8px;">Back to Tests</a>
        </div>
      </div>
    </div>
     <!-- Side Info Panel (Below/Right on wide screens) -->
    <div class="quiz-info-panel" style="min-width:260px; max-width:1000px; height:100%; background-color: var(--dk-dark-bg); border-radius:16px; box-shadow:0 0 24px rgba(8,7,16,0.18); padding:28px 22px; color:#fff; position:sticky; top:100px;">
      <div style="font-size:1.1rem; font-weight:60%; margin-bottom:18px; margin-top:10%">Quiz Info</div>
      <span>Time Remaining</span>
      <div class="quiz-timer mb-3"  id="quiz-timer">15:00</div>
      <div style="margin-bottom:12px;">Questions: <span id="total-questions"></span></div>
      <div style="margin-bottom:12px;">Answered: <span id="answered-questions"></span></div>
      <div style="margin-bottom:12px;">Current: <span id="current-question"></span></div>
      <div style="margin-bottom:18px; font-size:0.98rem;">Go to Question:</div>
      <div id="question-nav-btns" style="display:flex; flex-wrap:wrap; gap:8px 8px; margin-bottom:18px;"></div>
      <div class="d-flex justify-content-between mt-2" style="position: absolute; bottom: 24px; left: 22px; right: 22px;">
        <button type="button" class="btn-gradient" id="side-prev-btn">Previous</button>
        <button type="button" class="btn-gradient" id="side-next-btn">Next</button>
      </div>
    </div>
  </div>
</section>

<!-- Quiz Score Popup Card (separate from quiz container) -->
<div id="quizScorePopup" style="display:none; min-width:500px; position:fixed; left:50%; top:0; transform:translateX(-50%); width:100vw; height:100vh; z-index:1000; background:rgba(8,7,16,0.55); backdrop-filter:blur(8px); align-items:center; justify-content:center;">
  <div style="background:rgba(44,46,68,0.98); border-radius:18px; box-shadow:0 0 40px rgba(8,7,16,0.3); padding:40px 32px; min-width:320px; max-width:90vw; color:#fff; text-align:center; position:relative; display:flex; flex-direction:column; align-items:center;">
    <h3 style="color:#23a2f6; margin-bottom:18px;">Quiz Completed!</h3>
    <div id="quizScorePopupText" style="font-size:1.2rem; margin-bottom:24px;"></div>
  <a href="<?php echo htmlspecialchars($returnUrl); ?>" class="btn btn-primary" style="font-weight:600; border-radius:8px;">Back to Tests</a>
  </div>
</div>
<script>
const quizData = <?php echo json_encode($questions); ?>;
const returnUrl = <?php echo json_encode($returnUrl); ?>;

let currentQuestion = 0;
let userAnswers = Array(quizData.length).fill(null);
let timer = 15 * 60; // 15 minutes in seconds
let timerInterval;

function pad(n) { return n < 10 ? '0' + n : n; }

function showQuestion(index) {
  const q = quizData[index];
  let html = `<div class="quiz-question" style="max-width:50%;">${index + 1}. ${q.question}</div><div class="quiz-options" style="max-width:50%;">`;
  q.options.forEach((opt, i) => {
    html += `<label><input type="radio" name="option" value="${i}" ${userAnswers[index] == i ? 'checked' : ''}>${opt}</label>`;
  });
  html += '</div>';
  document.getElementById('quiz-question-block').innerHTML = html;
  // Hide timer and next button in quiz container, show only in side panel
  document.getElementById('submit-btn').style.display = (index === quizData.length - 1) ? 'inline-block' : 'none';
  // Previous button logic removed
  // Update info panel
  document.getElementById('total-questions').textContent = quizData.length;
  document.getElementById('answered-questions').textContent = userAnswers.filter(x => x !== null).length;
  document.getElementById('current-question').textContent = (index + 1);
  // Render question navigation buttons
  const navBtns = document.getElementById('question-nav-btns');
  navBtns.innerHTML = '';
  for (let i = 0; i < quizData.length; i++) {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.textContent = i + 1;
    btn.className = 'btn btn-sm';
    btn.style.margin = '0 2px 2px 0';
    btn.style.fontWeight = '600';
    btn.style.borderRadius = '6px';
    btn.style.width = '32px';
    btn.style.background = (i === index) ? '#23a2f6' : (userAnswers[i] !== null ? '#04cf0eff' : '#252636');
    btn.style.color = (i === index) ? '#fff' : (userAnswers[i] !== null ? '#222' : '#fff');
    btn.onclick = function() {
      currentQuestion = i;
      showQuestion(currentQuestion);
    };
    navBtns.appendChild(btn);
  }
}

function updateTimer() {
  let min = Math.floor(timer / 60);
  let sec = timer % 60;
  document.getElementById('quiz-timer').textContent = pad(min) + ':' + pad(sec);
  if (timer <= 0) {
    clearInterval(timerInterval);
    submitQuiz();
  }
  timer--;
}

function submitQuiz() {
  clearInterval(timerInterval);
  let score = 0;
  for (let i = 0; i < quizData.length; i++) {
    if (userAnswers[i] == quizData[i].answer) score++;
  }
  // Show immediate submitting popup and disable submit button to give feedback
  const popup = document.getElementById('quizScorePopup');
  const popupText = document.getElementById('quizScorePopupText');
  const submitBtn = document.getElementById('submit-btn');
  if (submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = '0.6'; }
  if (popup && popupText) {
    popupText.textContent = 'Submitting your score...';
    popup.style.display = 'flex';
  }

  // Submit score to backend
  fetch(window.location.href, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'score=' + encodeURIComponent(score)
  })
  .then(res => res.json().catch(err => ({ parseError: true, rawText: null })))
  .then(data => {
    console.log('Score submission response raw:', data);
    document.getElementById('quiz-result').style.display = 'block';
    document.getElementById('quiz-result').textContent = `You scored ${score} out of ${quizData.length}!`;

    if (popup && popupText) {
      if (!data) {
        popupText.textContent = `You scored ${score} out of ${quizData.length}!`;
      } else if (data.parseError) {
        popupText.textContent = `You scored ${score} out of ${quizData.length}! (Server returned non-JSON)`;
      } else {
        // Show server message and any DB errors
        popupText.textContent = `You scored ${score} out of ${quizData.length}!`;
        if (data.saved === false) {
          popupText.textContent += ' (Result not saved: ' + (data.db_error || 'unknown') + ')';
        }
      }
      popup.style.display = 'flex';
      // Auto-redirect back to test list after 3 seconds
      setTimeout(function() {
        window.location.href = returnUrl;
      }, 3000);
    }
    if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = ''; }
  }).catch(err => {
    console.error('Submit error', err);
    if (popup && popupText) {
      popupText.textContent = 'Submission failed — please check your connection or try again.';
      popup.style.display = 'flex';
    }
    if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = ''; }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  showQuestion(currentQuestion);
  timerInterval = setInterval(updateTimer, 1000);

  document.getElementById('quiz-form').addEventListener('change', function(e) {
    if (e.target.name === 'option') {
      userAnswers[currentQuestion] = parseInt(e.target.value);
      // Update answered count in info panel
      document.getElementById('answered-questions').textContent = userAnswers.filter(x => x !== null).length;
    }
  });

  // Previous button in quiz container removed

  // Side panel navigation
  document.getElementById('side-prev-btn').addEventListener('click', function() {
    if (currentQuestion > 0) {
      currentQuestion--;
      showQuestion(currentQuestion);
    }
  });
  document.getElementById('side-next-btn').addEventListener('click', function() {
    
    if (currentQuestion < quizData.length - 1) {
      currentQuestion++;
      showQuestion(currentQuestion);
    }
  });

  document.getElementById('quiz-form').addEventListener('submit', function(e) {
  e.preventDefault();
  submitQuiz();
});

});
</script>
</body>
</html>

