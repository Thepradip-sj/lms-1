<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/grade.php";
       include "data/class.php";
       include "data/section.php";
       include "data/setting.php";
       include "data/subject.php";
       include "data/teacher.php";
       include "data/student_score.php";

       if (!isset($_GET['student_id'])) {
           header("Location: students.php");
           exit;
       }
       $student_id = $_GET['student_id'];
       $student = getStudentById($student_id, $conn);
       $setting = getSetting($conn);
       $subjects = getSubjectByGrade($student['grade'], $conn);

       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);

       $teacher_subjects = str_split(trim($teacher['subjects']));

       
      
       $ssubject_id = 0;
       if (isset($_POST['ssubject_id'])) {
           $ssubject_id = $_POST['ssubject_id'];

           $student_score = getScoreById($student_id, $teacher_id, $ssubject_id, $setting['current_semester'], $setting['current_year'], $conn); 
       }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher - Student Grade Management</title>
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
    
    .student-card {
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      border: none;
      margin-bottom: 2rem;
    }
    
    .student-header {
      background: linear-gradient(to right, var(--primary-color), var(--accent-color));
      color: white;
      padding: 1.5rem;
      border-radius: 15px 15px 0 0;
    }
    
    .student-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid white;
      margin-right: 1rem;
    }
    
    .student-info {
      padding: 1.5rem;
    }
    
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    .info-item {
      padding: 1rem;
      background: var(--light-bg);
      border-radius: 8px;
    }
    
    .info-label {
      font-size: 0.85rem;
      color: #6c757d;
      margin-bottom: 0.3rem;
    }
    
    .info-value {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--secondary-color);
    }
    
    .grade-form-container {
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      padding: 2rem;
      margin-bottom: 2rem;
    }
    
    .form-header {
      border-bottom: 2px solid var(--light-bg);
      padding-bottom: 1rem;
      margin-bottom: 1.5rem;
    }
    
    .subject-selector {
      background: var(--light-bg);
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .score-input-group {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
      padding: 1rem;
      background: var(--light-bg);
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .score-input-group:hover {
      background: #e9ecef;
    }
    
    .score-label {
      min-width: 120px;
      font-weight: 500;
      color: var(--secondary-color);
    }
    
    .score-inputs {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .score-separator {
      font-weight: 600;
      color: var(--secondary-color);
      margin: 0 0.5rem;
    }
    
    .btn-primary-custom {
      background: var(--primary-color);
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-primary-custom:hover {
      background: var(--secondary-color);
      transform: translateY(-2px);
    }
    
    .btn-outline-custom {
      border: 2px solid var(--primary-color);
      color: var(--primary-color);
      background: transparent;
      padding: 0.7rem 1.5rem;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-outline-custom:hover {
      background: var(--primary-color);
      color: white;
      transform: translateY(-2px);
    }
    
    .alert-custom {
      border-radius: 10px;
      border: none;
      padding: 1rem 1.5rem;
    }
    
    .semester-badge {
      background: var(--accent-color);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 500;
    }
    
    @media (max-width: 768px) {
      .info-grid {
        grid-template-columns: 1fr;
      }
      
      .score-input-group {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .score-label {
        margin-bottom: 0.5rem;
      }
    }
  </style>
</head>
<body>
    <?php 
    include "inc/navbar.php";
        if ($student != 0 && $setting !=0 && $subjects !=0 && $teacher_subjects != 0) {
     ?>

     <div class="page-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="display-5">Student Grade Management</h1>
              <p class="lead">Enter and manage student grades</p>
            </div>
            <div class="col-md-4 text-md-end">
              <span class="semester-badge">
                <?=$setting['current_year']?> - Semester <?=$setting['current_semester']?>
              </span>
            </div>
          </div>
        </div>
     </div>
     
     <div class="container">
        <!-- Student Information Card -->
        <div class="student-card">
          <div class="student-header">
            <div class="d-flex align-items-center">
              <img src="../img/student-<?=$student['gender']?>.png" class="student-avatar" alt="Student Avatar">
              <div>
                <h3 class="mb-1"><?=$student['fname']?> <?=$student['lname']?></h3>
                <p class="mb-0">Student ID: <?=$student['student_id']?></p>
              </div>
            </div>
          </div>
          
          <div class="student-info">
            <div class="info-grid">
              <div class="info-item">
                <div class="info-label">Grade Level</div>
                <div class="info-value">
                  <?php  
                    $g = getGradeById($student['grade'], $conn); 
                    echo $g['grade_code'].' - '.$g['grade'];
                  ?>
                </div>
              </div>
              
              <div class="info-item">
                <div class="info-label">Section</div>
                <div class="info-value">
                  <?php  
                    $s = getSectioById($student['section'], $conn); 
                    echo $s['section'];
                  ?>
                </div>
              </div>
              
              <div class="info-item">
                <div class="info-label">Academic Year</div>
                <div class="info-value"><?=$setting['current_year']?></div>
              </div>
              
              <div class="info-item">
                <div class="info-label">Semester</div>
                <div class="info-value"><?=$setting['current_semester']?></div>
              </div>
            </div>
            
            <div class="d-flex gap-2">
              <a href="students.php" class="btn btn-outline-custom">
                <i class="fa fa-arrow-left me-2"></i>Back to Students
              </a>
              <button class="btn btn-outline-custom" onclick="window.print()">
                <i class="fa fa-print me-2"></i>Print Grades
              </button>
            </div>
          </div>
        </div>
        
        <!-- Grade Entry Form -->
        <div class="grade-form-container">
          <div class="form-header">
            <h4 class="mb-0">Enter Grades</h4>
            <p class="text-muted mb-0">Select a subject and enter assessment scores</p>
          </div>
          
          <!-- Subject Selection Form -->
          <form method="post" action="" class="subject-selector">
            <div class="row align-items-end">
              <div class="col-md-8">
                <label class="form-label fw-semibold">Select Subject</label>
                <select class="form-select" name="ssubject_id">
                  <?php foreach($subjects as $subject){ 
                    foreach($teacher_subjects as $teacher_subject){
                      if($subject['subject_id'] == $teacher_subject){ ?>
                  <option <?php if($ssubject_id == $subject['subject_id']){echo "selected";} ?> 
                    value="<?php echo $subject['subject_id'] ?>">
                    <?php echo $subject['subject_code'] ?> - <?php echo $subject['subject'] ?>
                  </option>
                  <?php } }
                  } ?>
                </select>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-primary-custom w-100">
                  <i class="fa fa-check me-2"></i>Select Subject
                </button>
              </div>
            </div>
          </form>
          
          <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger alert-custom" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>
            <?=$_GET['error']?>
          </div>
          <?php } ?>
          
          <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success alert-custom" role="alert">
            <i class="fa fa-check-circle me-2"></i>
            <?=$_GET['success']?>
          </div>
          <?php } ?>
          
          <!-- Score Entry Form -->
          <?php if ($ssubject_id != 0) { ?>
          <form method="post" action="req/save-score.php">
            <h5 class="mb-3">Assessment Scores</h5>
            <p class="text-muted mb-4">Enter scores for each assessment (0-100)</p>
            
            <?php 
              $counter = 0;
              if($student_score != 0){ 
            ?>
            <input type="hidden" name="student_score_id" value="<?=$student_score['id']?>">
            <?php
                $scores = explode(',', trim($student_score['results']));
                foreach ($scores as $score) { 
                  $temp =  explode(' ', trim($score));
                  $counter++;
            ?>
            <div class="score-input-group">
              <div class="score-label">Assessment <?=$counter?></div>
              <div class="score-inputs">
                <input type="number" min="0" max="100" class="form-control" 
                       value="<?=$temp[0]?>" name="score-<?=$counter?>" style="max-width: 100px;">
                <span class="score-separator">/</span>
                <input type="number" min="0" max="100" class="form-control" 
                       value="<?=$temp[1]?>" name="aoutof-<?=$counter?>" style="max-width: 100px;">
              </div>
            </div>
            <?php } } ?>
            
            <?php if($counter < 5){ 
              for ($i = ++$counter; $i <= 5; $i++) { 
            ?>
            <div class="score-input-group">
              <div class="score-label">Assessment <?=$i?></div>
              <div class="score-inputs">
                <input type="number" min="0" max="100" class="form-control" 
                       placeholder="Score" name="score-<?=$i?>" style="max-width: 100px;">
                <span class="score-separator">/</span>
                <input type="number" min="0" max="100" class="form-control" 
                       placeholder="Out of" name="aoutof-<?=$i?>" style="max-width: 100px;">
              </div>
            </div>
            <?php } } ?>
            
            <input type="hidden" name="student_id" value="<?=$student_id?>">
            <input type="hidden" name="subject_id" value="<?=$ssubject_id?>">
            <input type="hidden" name="current_semester" value="<?=$setting['current_semester']?>">
            <input type="hidden" name="current_year" value="<?=$setting['current_year']?>">
            
            <div class="d-flex gap-2 mt-4">
              <button type="submit" class="btn btn-primary-custom">
                <i class="fa fa-save me-2"></i>Save Grades
              </button>
              <button type="reset" class="btn btn-outline-custom">
                <i class="fa fa-refresh me-2"></i>Reset
              </button>
            </div>
          </form>
          <?php } else { ?>
          <div class="text-center py-4">
            <i class="fa fa-book fa-3x text-muted mb-3"></i>
            <p class="text-muted">Please select a subject to enter grades</p>
          </div>
          <?php } ?>
        </div>
     </div>
     
     <?php 
         }else{
            header("Location: students.php");
            exit;
         }
     ?>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
             
             // Add input validation
             $('input[type="number"]').on('input', function() {
                 const value = parseInt($(this).val());
                 if (value < 0) $(this).val(0);
                 if (value > 100) $(this).val(100);
             });
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 
?>