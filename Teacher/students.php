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
    <title>Teacher Dashboard - Students</title>
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
      position: relative;
    }
    
    .class-code {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .class-badge {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: rgba(255, 255, 255, 0.2);
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.9rem;
    }
    
    .class-content {
      padding: 1.5rem;
    }
    
    .class-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eee;
    }
    
    .info-item {
      text-align: center;
      flex: 1;
    }
    
    .info-label {
      font-size: 0.85rem;
      color: #6c757d;
      margin-bottom: 0.3rem;
    }
    
    .info-value {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--secondary-color);
    }
    
    .class-description {
      color: #555;
      margin-bottom: 1.5rem;
      line-height: 1.5;
    }
    
    .class-link {
      display: block;
      text-align: center;
      padding: 0.8rem;
      background: var(--primary-color);
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .class-link:hover {
      background: var(--secondary-color);
      color: white;
      transform: translateY(-2px);
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
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    .stats-label {
      color: #6c757d;
      font-size: 1rem;
    }
    
    .search-box {
      background: white;
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
    }
    
    .search-input {
      border: none;
      border-bottom: 2px solid #e0e0e0;
      border-radius: 0;
      padding: 0.5rem 0;
      transition: all 0.3s ease;
    }
    
    .search-input:focus {
      border-bottom-color: var(--primary-color);
      box-shadow: none;
    }
    
    @media (max-width: 768px) {
      .class-info {
        flex-direction: column;
        gap: 1rem;
      }
      
      .info-item {
        text-align: left;
        display: flex;
        justify-content: space-between;
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
              <h1 class="display-5">Student Management</h1>
              <p class="lead">View and manage students in your classes</p>
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
                  // This would need to be calculated based on actual student data
                  echo "N/A";
                ?>
              </div>
              <div class="stats-label">Total Students</div>
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
          </div>
        </div>
        
        <!-- Search Box -->
        <div class="search-box">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h5 class="mb-3">Find Students</h5>
              <div class="input-group">
                <input type="text" class="form-control search-input" placeholder="Search by class, student name...">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <div class="col-md-6 text-md-end">
              <div class="btn-group">
                <button class="btn btn-outline-primary active">All Classes</button>
                <button class="btn btn-outline-primary">Active</button>
                <button class="btn btn-outline-primary">Recent</button>
              </div>
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
                <div>Grade <?=$grade['grade']?> - Section <?=$section['section']?></div>
                <span class="class-badge">Class <?=$i?></span>
              </div>
              
              <div class="class-content">
                <div class="class-info">
                  <div class="info-item">
                    <div class="info-label">Grade Level</div>
                    <div class="info-value"><?=$grade['grade']?></div>
                  </div>
                  <div class="info-item">
                    <div class="info-label">Section</div>
                    <div class="info-value"><?=$section['section']?></div>
                  </div>
                  <div class="info-item">
                    <div class="info-label">Students</div>
                    <div class="info-value">N/A</div>
                  </div>
                </div>
                
                <div class="class-description">
                  <small class="text-muted">
                    <i class="fa fa-info-circle me-1"></i>
                    Click below to view all students in this class and manage their records.
                  </small>
                </div>
                
                <a href="students_of_class.php?class_id=<?=$class['class_id']?>" class="class-link">
                  <i class="fa fa-users me-2"></i>View Students
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
              <i class="fa fa-users"></i>
            </div>
            <h3 class="empty-title">No Classes Assigned</h3>
            <p class="text-muted mb-4">You haven't been assigned to any classes yet. Please contact administration.</p>
            <a href="home.php" class="btn btn-primary">
              <i class="fa fa-home me-2"></i>Return to Dashboard
            </a>
          </div>
        <?php } ?>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(3) a").addClass('active');
            
            // Add search functionality
            $('.search-input').on('input', function() {
                const searchText = $(this).val().toLowerCase();
                $('.class-card').each(function() {
                    const classText = $(this).text().toLowerCase();
                    if (classText.includes(searchText)) {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
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