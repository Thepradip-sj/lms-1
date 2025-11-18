<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/class.php";
       include "data/grade.php";
       include "data/section.php";
       include "data/teacher.php";
       
       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);
       $classes = getAllClasses($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - My Classes</title>
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
    
    .class-card {
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      transition: all 0.3s ease;
      border: none;
      margin-bottom: 1.5rem;
      overflow: hidden;
    }
    
    .class-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }
    
    .class-header {
      background: linear-gradient(to right, var(--primary-color), var(--accent-color));
      color: white;
      padding: 1.5rem;
    }
    
    .class-code {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .class-details {
      padding: 1.5rem;
    }
    
    .detail-item {
      display: flex;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eee;
    }
    
    .detail-label {
      font-weight: 600;
      min-width: 120px;
      color: var(--secondary-color);
    }
    
    .detail-value {
      color: #555;
    }
    
    .class-actions {
      padding: 1rem 1.5rem;
      background-color: var(--light-bg);
      display: flex;
      justify-content: space-between;
    }
    
    .action-btn {
      display: inline-flex;
      align-items: center;
      padding: 0.5rem 1rem;
      background: white;
      border-radius: 8px;
      text-decoration: none;
      color: var(--secondary-color);
      font-weight: 500;
      transition: all 0.3s ease;
      border: 1px solid #e0e0e0;
    }
    
    .action-btn:hover {
      background: var(--primary-color);
      color: white;
      transform: translateY(-2px);
    }
    
    .action-icon {
      margin-right: 0.5rem;
    }
    
    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
    }
    
    .empty-icon {
      font-size: 4rem;
      color: #ddd;
      margin-bottom: 1.5rem;
    }
    
    .empty-title {
      color: #6c757d;
      margin-bottom: 1rem;
    }
    
    .stats-summary {
      background: white;
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }
    
    .stats-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    .stats-label {
      color: #6c757d;
      font-size: 1rem;
    }
    
    @media (max-width: 768px) {
      .class-actions {
        flex-direction: column;
        gap: 0.5rem;
      }
      
      .action-btn {
        justify-content: center;
      }
    }
  </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($classes != 0) {
     ?>
     
     <div class="page-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="display-5">My Classes</h1>
              <p class="lead">Manage and view your assigned classes</p>
            </div>
            <div class="col-md-4 text-md-end">
              <span class="badge bg-light text-dark p-2">Teacher: <?=$teacher['fname']?> <?=$teacher['lname']?></span>
            </div>
          </div>
        </div>
     </div>
     
     <div class="container">
        <!-- Stats Summary -->
        <?php
          $teacher_classes = str_split(trim($teacher['class']));
          $assigned_count = 0;
          foreach ($classes as $class) {
            if (in_array($class['class_id'], $teacher_classes)) {
              $assigned_count++;
            }
          }
        ?>
        
        <div class="stats-summary">
          <div class="row text-center">
            <div class="col-md-4">
              <div class="stats-number"><?=$assigned_count?></div>
              <div class="stats-label">Total Classes</div>
            </div>
            <div class="col-md-4">
              <div class="stats-number">
                <?php 
                  $subjects = str_split(trim($teacher['subjects']));
                  echo count($subjects);
                ?>
              </div>
              <div class="stats-label">Subjects</div>
            </div>
            <div class="col-md-4">
              <div class="stats-number">
                <?php 
                  // This would need to be calculated based on actual student data
                  echo "N/A";
                ?>
              </div>
              <div class="stats-label">Total Students</div>
            </div>
          </div>
        </div>
        
        <!-- Classes Grid -->
        <div class="row">
          <?php 
            $i = 0;
            foreach ($classes as $class) {
              $teacher_classes = str_split(trim($teacher['class']));
              if (in_array($class['class_id'], $teacher_classes)) {
                $i++;
                $grade = getGradeById($class['grade'], $conn);
                $section = getSectioById($class['section'], $conn);
                $class_code = $grade['grade_code'].'-'.$grade['grade'].$section['section'];
          ?>
          
          <div class="col-lg-6 col-xl-4">
            <div class="class-card">
              <div class="class-header">
                <div class="class-code"><?=$class_code?></div>
                <div>Class <?=$grade['grade']?> - Section <?=$section['section']?></div>
              </div>
              
              <div class="class-details">
                <div class="detail-item">
                  <span class="detail-label">Grade:</span>
                  <span class="detail-value"><?=$grade['grade']?> (<?=$grade['grade_code']?>)</span>
                </div>
                
                <div class="detail-item">
                  <span class="detail-label">Section:</span>
                  <span class="detail-value"><?=$section['section']?></span>
                </div>
                
                <div class="detail-item">
                  <span class="detail-label">Subjects:</span>
                  <div class="detail-value">
                    <?php 
                      $subjects = str_split(trim($teacher['subjects']));
                      foreach ($subjects as $subject) {
                        // This would need the actual subject data
                        echo '<span class="badge bg-light text-dark me-1">Subject '.$subject.'</span>';
                      }
                    ?>
                  </div>
                </div>
              </div>
              
              <div class="class-actions">
                <a href="students.php?class=<?=$class['class_id']?>" class="action-btn">
                  <i class="fa fa-users action-icon"></i>
                  Students
                </a>
                <a href="attendance.php?class=<?=$class['class_id']?>" class="action-btn">
                  <i class="fa fa-check-square-o action-icon"></i>
                  Attendance
                </a>
                <a href="grades.php?class=<?=$class['class_id']?>" class="action-btn">
                  <i class="fa fa-pencil action-icon"></i>
                  Grades
                </a>
              </div>
            </div>
          </div>
          
          <?php 
              }
            }
          ?>
        </div>
        
        <?php } else { ?>
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fa fa-inbox"></i>
            </div>
            <h3 class="empty-title">No Classes Assigned</h3>
            <p class="text-muted">You haven't been assigned to any classes yet.</p>
            <a href="home.php" class="btn btn-primary mt-3">
              <i class="fa fa-home me-2"></i>Return to Dashboard
            </a>
          </div>
        <?php } ?>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
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