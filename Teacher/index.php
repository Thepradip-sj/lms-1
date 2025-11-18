<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/teacher.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/section.php";
       include "data/class.php";

       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher Dashboard - Home</title>
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
    
    .profile-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 2rem 0;
      border-radius: 0 0 20px 20px;
      margin-bottom: 2rem;
    }
    
    .profile-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: transform 0.3s ease;
      border: none;
    }
    
    .profile-card:hover {
      transform: translateY(-5px);
    }
    
    .profile-img-container {
      text-align: center;
      padding: 1.5rem 0;
      background-color: var(--light-bg);
    }
    
    .profile-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: 5px solid white;
      box-shadow: var(--card-shadow);
    }
    
    .teacher-name {
      font-weight: 700;
      color: var(--secondary-color);
      margin-bottom: 0.5rem;
    }
    
    .teacher-username {
      color: var(--primary-color);
      font-weight: 500;
    }
    
    .info-section {
      margin-bottom: 2rem;
    }
    
    .section-title {
      color: var(--secondary-color);
      border-left: 4px solid var(--accent-color);
      padding-left: 10px;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    
    .info-item {
      display: flex;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eee;
    }
    
    .info-label {
      font-weight: 600;
      min-width: 180px;
      color: var(--secondary-color);
    }
    
    .info-value {
      color: #555;
    }
    
    .badge-custom {
      background-color: var(--accent-color);
      color: white;
      padding: 0.4em 0.8em;
      border-radius: 20px;
      font-size: 0.85em;
      margin-right: 0.5rem;
      margin-bottom: 0.5rem;
      display: inline-block;
    }
    
    .stats-card {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      text-align: center;
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }
    
    .stats-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .stats-icon {
      font-size: 2.5rem;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }
    
    .stats-number {
      font-size: 2rem;
      font-weight: 700;
      color: var(--secondary-color);
      margin-bottom: 0.5rem;
    }
    
    .stats-label {
      color: #6c757d;
      font-size: 0.9rem;
    }
    
    .quick-actions {
      margin-top: 2rem;
    }
    
    .action-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      background: white;
      border-radius: 10px;
      box-shadow: var(--card-shadow);
      margin-bottom: 1rem;
      text-decoration: none;
      color: var(--secondary-color);
      transition: all 0.3s ease;
    }
    
    .action-btn:hover {
      background: var(--primary-color);
      color: white;
      transform: translateY(-3px);
    }
    
    .action-icon {
      font-size: 1.5rem;
      margin-right: 0.8rem;
    }
    
    @media (max-width: 768px) {
      .info-item {
        flex-direction: column;
      }
      
      .info-label {
        min-width: auto;
        margin-bottom: 0.3rem;
      }
    }
  </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";

        if ($teacher != 0) {
     ?>
     
     <div class="profile-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="display-5">Welcome, <?=$teacher['fname']?>!</h1>
              <p class="lead">Teacher Dashboard</p>
            </div>
            <div class="col-md-4 text-md-end">
              <span class="badge bg-light text-dark p-2">Employee #<?=$teacher['employee_number']?></span>
            </div>
          </div>
        </div>
     </div>
     
     <div class="container">
        <div class="row">
          <!-- Left Column - Profile Information -->
          <div class="col-lg-8">
            <div class="profile-card mb-4">
              <div class="profile-img-container">
                <img src="../img/teacher-<?=$teacher['gender']?>.png" class="profile-img" alt="Teacher Profile">
                <h3 class="teacher-name mt-3"><?=$teacher['fname']?> <?=$teacher['lname']?></h3>
                <p class="teacher-username">@<?=$teacher['username']?></p>
              </div>
              
              <div class="card-body">
                <!-- Personal Information -->
                <div class="info-section">
                  <h4 class="section-title">Personal Information</h4>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="info-item">
                        <span class="info-label">Date of Birth:</span>
                        <span class="info-value"><?=$teacher['date_of_birth']?></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-item">
                        <span class="info-label">Gender:</span>
                        <span class="info-value"><?=$teacher['gender']?></span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="info-item">
                        <span class="info-label">Phone Number:</span>
                        <span class="info-value"><?=$teacher['phone_number']?></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-item">
                        <span class="info-label">Email Address:</span>
                        <span class="info-value"><?=$teacher['email_address']?></span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="info-item">
                    <span class="info-label">Address:</span>
                    <span class="info-value"><?=$teacher['address']?></span>
                  </div>
                </div>
                
                <!-- Professional Information -->
                <div class="info-section">
                  <h4 class="section-title">Professional Information</h4>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="info-item">
                        <span class="info-label">Qualification:</span>
                        <span class="info-value"><?=$teacher['qualification']?></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-item">
                        <span class="info-label">Date Joined:</span>
                        <span class="info-value"><?=$teacher['date_of_joined']?></span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="info-item">
                    <span class="info-label">Subjects:</span>
                    <div class="info-value">
                      <?php 
                         $s = '';
                         $subjects = str_split(trim($teacher['subjects']));
                         foreach ($subjects as $subject) {
                            $s_temp = getSubjectById($subject, $conn);
                            if ($s_temp != 0) 
                              echo '<span class="badge-custom">'.$s_temp['subject_code'].'</span>';
                         }
                      ?>
                    </div>
                  </div>
                  
                  <div class="info-item">
                    <span class="info-label">Classes:</span>
                    <div class="info-value">
                      <?php 
                         $c = '';
                         $classes = str_split(trim($teacher['class']));

                         foreach ($classes as $class_id) {
                             $class = getClassById($class_id, $conn);

                            $c_temp = getGradeById($class['grade'], $conn);
                            $section = getSectioById($class['section'], $conn);
                            if ($c_temp != 0) 
                              echo '<span class="badge-custom">'.$c_temp['grade_code'].'-'.
                                   $c_temp['grade'].$section['section'].'</span>';
                         }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Right Column - Stats and Quick Actions -->
          <div class="col-lg-4">
            <!-- Statistics Cards -->
            <div class="row">
              <div class="col-md-6 col-lg-12">
                <div class="stats-card">
                  <div class="stats-icon">
                    <i class="fa fa-book"></i>
                  </div>
                  <div class="stats-number">
                    <?php 
                      $subjects_count = count(str_split(trim($teacher['subjects'])));
                      echo $subjects_count;
                    ?>
                  </div>
                  <div class="stats-label">Subjects</div>
                </div>
              </div>
              
              <div class="col-md-6 col-lg-12">
                <div class="stats-card">
                  <div class="stats-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <div class="stats-number">
                    <?php 
                      $classes_count = count(str_split(trim($teacher['class'])));
                      echo $classes_count;
                    ?>
                  </div>
                  <div class="stats-label">Classes</div>
                </div>
              </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
              <h4 class="section-title">Quick Actions</h4>
              
              <a href="classes.php" class="action-btn">
                <i class="fa fa-users action-icon"></i>
                <span>My Classes</span>
              </a>
              
              <a href="schedule.php" class="action-btn">
                <i class="fa fa-calendar action-icon"></i>
                <span>View Schedule</span>
              </a>
              
              <a href="students.php" class="action-btn">
                <i class="fa fa-graduation-cap action-icon"></i>
                <span>Student List</span>
              </a>
              
              <a href="attendance.php" class="action-btn">
                <i class="fa fa-check-square-o action-icon"></i>
                <span>Take Attendance</span>
              </a>
              
              <a href="grades.php" class="action-btn">
                <i class="fa fa-pencil action-icon"></i>
                <span>Enter Grades</span>
              </a>
            </div>
          </div>
        </div>
     </div>
     
     <?php 
        }else {
          header("Location: logout.php?error=An error occurred");
          exit;
        }
     ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
   <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
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