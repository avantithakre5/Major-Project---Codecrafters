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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
  $score = intval($_POST['score']);
  $email = mysqli_real_escape_string($con, $user_email);
  $lang = mysqli_real_escape_string($con, $topic);
  mysqli_query($con, "CREATE TABLE IF NOT EXISTS user_score (
    email VARCHAR(255),
    language VARCHAR(32),
    score INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (email, language)
  )");
  // Delete previous row for this user/language
  mysqli_query($con, "DELETE FROM user_score WHERE email='$email' AND language='$lang'");
  // Insert new score row
  mysqli_query($con, "INSERT INTO user_score (email, language, score) VALUES ('$email', '$lang', $score)");
  echo json_encode(['success'=>true]);
  exit;
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
          <a href="dash.php" class="btn btn-primary" style="font-weight:600; border-radius:8px;">Go to Dashboard</a>
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
    <a href="dash.php" class="btn btn-primary" style="font-weight:600; border-radius:8px;">Go to Dashboard</a>
  </div>
</div>
<script>
const quizData = <?php echo json_encode($questions); ?>;

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
  // Submit score to backend
  fetch(window.location.href, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'score=' + encodeURIComponent(score)
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('quiz-form').style.display = 'flex';
    document.getElementById('quiz-result').style.display = 'block';
    document.getElementById('quiz-result').textContent = `You scored ${score} out of ${quizData.length}!`;
    // Show new popup card
    var popup = document.getElementById('quizScorePopup');
    var popupText = document.getElementById('quizScorePopupText');
    if (popup && popupText) {
      popupText.textContent = `You scored ${score} out of ${quizData.length}!`;
      popup.style.display = 'flex';
    }
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

