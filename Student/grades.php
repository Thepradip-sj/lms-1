<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
     include "../DB_connection.php";
     include "data/score.php";
     include "data/subjects.php";

     $student_id = $_SESSION['student_id'];
     $scores = getScoreById($student_id, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Dashboard - Grade Summary</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    :root {
      --primary-color: #3498db;
      --secondary-color: #2c3e50;
      --accent-color: #1abc9c;
      --warning-color: #f39c12;
      --light-bg: #f8f9fa;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    body {
      background-color: #f5f7fb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .page-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 2rem 0;
      border-radius: 0 0 20px 20px;
      margin-bottom: 2rem;
    }
    
    .year-section {
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
      overflow: hidden;
    }
    
    .year-header {
      background: linear-gradient(to right, var(--primary-color), var(--accent-color));
      color: white;
      padding: 1.5rem;
    }
    
    .year-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
    }
    
    .subject-card {
      border: 1px solid #e9ecef;
      border-radius: 10px;
      margin-bottom: 1rem;
      transition: all 0.3s ease;
    }
    
    .subject-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .subject-header {
      background: var(--light-bg);
      padding: 1rem 1.5rem;
      border-bottom: 1px solid #e9ecef;
    }
    
    .subject-code {
      font-weight: 700;
      color: var(--secondary-color);
      font-size: 1.1rem;
    }
    
    .subject-name {
      color: #6c757d;
      margin-bottom: 0;
    }
    
    .subject-content {
      padding: 1.5rem;
    }
    
    .results-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    .result-item {
      text-align: center;
      padding: 1rem;
      background: var(--light-bg);
      border-radius: 8px;
    }
    
    .result-label {
      font-size: 0.85rem;
      color: #6c757d;
      margin-bottom: 0.5rem;
    }
    
    .result-value {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--secondary-color);
    }
    
    .assessment-badges {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }
    
    .assessment-badge {
      background: white;
      border: 1px solid #dee2e6;
      border-radius: 20px;
      padding: 0.4rem 0.8rem;
      font-size: 0.85rem;
      color: var(--secondary-color);
    }
    
    .grade-display {
      text-align: center;
      padding: 1rem;
      background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
      color: white;
      border-radius: 10px;
      margin-top: 1rem;
    }
    
    .grade-letter {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .grade-label {
      font-size: 0.9rem;
      opacity: 0.9;
    }
    
    .semester-badge {
      background: var(--warning-color);
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 15px;
      font-size: 0.8rem;
      font-weight: 500;
    }
    
    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
    }
    
    .empty-icon {
      font-size: 4rem;
      color: #ddd;
      margin-bottom: 1.5rem;
    }
    
    .empty-title {
      color: #6c757d;
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }
    
    .stats-summary {
      background: white;
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }
    
    .stats-number {
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    .stats-label {
      color: #6c757d;
      font-size: 0.9rem;
    }
    
    .progress-ring {
      width: 80px;
      height: 80px;
    }
    
    .progress-ring-circle {
      transition: stroke-dashoffset 0.35s;
      transform: rotate(-90deg);
      transform-origin: 50% 50%;
    }
    
    @media (max-width: 768px) {
      .results-grid {
        grid-template-columns: 1fr;
      }
      
      .assessment-badges {
        justify-content: center;
      }
    }
  </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($scores != 0) {
    ?>
     
     <div class="page-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="display-5">Grade Summary</h1>
              <p class="lead">View your academic performance and results</p>
            </div>
            <div class="col-md-4 text-md-end">
              <button class="btn btn-light" onclick="window.print()">
                <i class="fa fa-print me-2"></i>Print Report
              </button>
            </div>
          </div>
        </div>
     </div>
     
     <div class="container">
        <!-- Statistics Summary -->
        <div class="stats-summary">
          <div class="row text-center">
            <div class="col-md-3">
              <div class="stats-number">
                <?php
                  $subjectCount = 0;
                  $years = [];
                  foreach ($scores as $score) {
                    if (!in_array($score['year'], $years)) {
                      $years[] = $score['year'];
                    }
                    $subjectCount++;
                  }
                  echo $subjectCount;
                ?>
              </div>
              <div class="stats-label">Total Subjects</div>
            </div>
            <div class="col-md-3">
              <div class="stats-number"><?= count($years) ?></div>
              <div class="stats-label">Academic Years</div>
            </div>
            <div class="col-md-3">
              <div class="stats-number">
                <?php
                  $passedCount = 0;
                  foreach ($scores as $score) {
                    $total = 0;
                    $results = explode(',', trim($score['results']));
                    foreach ($results as $result) {
                      $temp = explode(' ', trim($result));
                      $total += $temp[0];
                    }
                    if ($total >= 50) { // Assuming 50 is passing
                      $passedCount++;
                    }
                  }
                  echo $passedCount;
                ?>
              </div>
              <div class="stats-label">Passed Subjects</div>
            </div>
            <div class="col-md-3">
              <div class="stats-number">
                <?php
                  $totalMarks = 0;
                  $totalSubjects = 0;
                  foreach ($scores as $score) {
                    $total = 0;
                    $results = explode(',', trim($score['results']));
                    foreach ($results as $result) {
                      $temp = explode(' ', trim($result));
                      $total += $temp[0];
                    }
                    $totalMarks += $total;
                    $totalSubjects++;
                  }
                  echo $totalSubjects > 0 ? round($totalMarks / $totalSubjects, 1) : '0';
                ?>
              </div>
              <div class="stats-label">Average Score</div>
            </div>
          </div>
        </div>
        
        <!-- Grades by Year -->
        <?php  
          $check = 0;
          foreach ($scores as $score) { 
            if ($score['year'] != $check) {
              $check = $score['year'];
        ?>
        
        <div class="year-section">
          <div class="year-header">
            <h2 class="year-title">Academic Year <?=$score['year']?></h2>
          </div>
          
          <div class="p-4">
            <?php 
              // Display all subjects for this year
              foreach ($scores as $subjectScore) {
                if ($subjectScore['year'] == $check) {
                  $csubject = getSubjectById($subjectScore['subject_id'], $conn);
                  $total = 0;
                  $outOf = 0;
                  $results = explode(',', trim($subjectScore['results']));
                  
                  foreach ($results as $result) {
                    $temp = explode(' ', trim($result));
                    $total += $temp[0];
                    $outOf += $temp[1];
                  }
            ?>
            
            <div class="subject-card">
              <div class="subject-header">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="subject-code"><?=$csubject['subject_code']?></div>
                    <div class="subject-name"><?=$csubject['subject']?></div>
                  </div>
                  <span class="semester-badge">Semester <?=$subjectScore['semester']?></span>
                </div>
              </div>
              
              <div class="subject-content">
                <!-- Assessment Results -->
                <div class="assessment-badges">
                  <?php 
                    foreach ($results as $result) {
                      $temp = explode(' ', trim($result));
                  ?>
                  <span class="assessment-badge">
                    <?=$temp[0]?> / <?=$temp[1]?>
                  </span>
                  <?php } ?>
                </div>
                
                <!-- Summary Stats -->
                <div class="results-grid">
                  <div class="result-item">
                    <div class="result-label">Total Score</div>
                    <div class="result-value"><?=$total?> / <?=$outOf?></div>
                  </div>
                  
                  <div class="result-item">
                    <div class="result-label">Percentage</div>
                    <div class="result-value">
                      <?= $outOf > 0 ? round(($total / $outOf) * 100, 1) : 0 ?>%
                    </div>
                  </div>
                  
                  <div class="result-item">
                    <div class="result-label">Grade</div>
                    <div class="result-value"><?= gradeCalc($total) ?></div>
                  </div>
                </div>
                
                <!-- Grade Display -->
                <div class="grade-display">
                  <div class="grade-letter"><?= gradeCalc($total) ?></div>
                  <div class="grade-label">Final Grade</div>
                </div>
              </div>
            </div>
            
            <?php 
                }
              }
            ?>
          </div>
        </div>
        
        <?php 
            }
          } 
        ?>
        
     </div>
     
     <?php } else { ?>
       <div class="container mt-5">
         <div class="empty-state">
            <div class="empty-icon">
              <i class="fa fa-graduation-cap"></i>
            </div>
            <h3 class="empty-title">No Grades Available</h3>
            <p class="text-muted mb-4">Your grade information will appear here once your teachers submit your results.</p>
            <a href="index.php" class="btn btn-primary">
              <i class="fa fa-home me-2"></i>Return to Dashboard
            </a>
         </div>
       </div>
     <?php } ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(2) a").addClass('active');
            
            // Add animation to grade displays
            $('.grade-display').each(function(i) {
                $(this).delay(i * 200).animate({
                    opacity: 1,
                    marginTop: 0
                }, 800);
            });
        });
    </script>
</body>
</html>
<?php 
  } else {
    header("Location: ../login.php");
    exit;
  } 
} else {
    header("Location: ../login.php");
    exit;
} 
?>