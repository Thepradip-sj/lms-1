<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/section.php";

       $student_id = $_SESSION['student_id'];
       $student = getStudentById($student_id, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Dashboard - Home</title>
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
      margin-bottom: 2rem;
    }
    
    .profile-card:hover {
      transform: translateY(-5px);
    }
    
    .profile-img-container {
      text-align: center;
      padding: 2rem 0;
      background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    }
    
    .profile-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: 5px solid white;
      box-shadow: var(--card-shadow);
    }
    
    .student-name {
      font-weight: 700;
      color: white;
      margin-bottom: 0.5rem;
      font-size: 1.5rem;
    }
    
    .student-username {
      color: rgba(255, 255, 255, 0.8);
      font-weight: 500;
    }
    
    .profile-content {
      padding: 2rem;
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
    
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1rem;
    }
    
    .info-item {
      background: var(--light-bg);
      padding: 1rem;
      border-radius: 8px;
      border-left: 3px solid var(--primary-color);
    }
    
    .info-label {
      font-size: 0.85rem;
      color: #6c757d;
      margin-bottom: 0.3rem;
      font-weight: 500;
    }
    
    .info-value {
      color: var(--secondary-color);
      font-weight: 500;
    }
    
    .badge-custom {
      background: var(--accent-color);
      color: white;
      padding: 0.4em 0.8em;
      border-radius: 20px;
      font-size: 0.85em;
      font-weight: 500;
    }
    
    .stats-cards {
      margin-bottom: 2rem;
    }
    
    .stats-card {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      text-align: center;
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
      border-top: 4px solid var(--primary-color);
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
      background: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
    }
    
    .action-btn {
      display: flex;
      align-items: center;
      padding: 1rem;
      background: var(--light-bg);
      border-radius: 10px;
      margin-bottom: 1rem;
      text-decoration: none;
      color: var(--secondary-color);
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }
    
    .action-btn:hover {
      background: var(--primary-color);
      color: white;
      transform: translateY(-3px);
      border-color: var(--primary-color);
    }
    
    .action-icon {
      font-size: 1.5rem;
      margin-right: 0.8rem;
      width: 30px;
      text-align: center;
    }
    
    .parent-info {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 15px;
      padding: 2rem;
      margin-top: 2rem;
    }
    
    .parent-title {
      color: white;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    
    @media (max-width: 768px) {
      .info-grid {
        grid-template-columns: 1fr;
      }
      
      .profile-img {
        width: 120px;
        height: 120px;
      }
    }
  </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($student != 0) {
     ?>
     
     <div class="profile-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h1 class="display-5">Welcome, <?=$student['fname']?>!</h1>
              <p class="lead">Student Dashboard</p>
            </div>
            <div class="col-md-4 text-md-end">
              <?php 
                $grade = $student['grade'];
                $g = getGradeById($grade, $conn);
                $section = $student['section'];
                $s = getSectioById($section, $conn);
              ?>
              <span class="badge bg-light text-dark p-2">
                <?=$g['grade_code']?>-<?=$g['grade']?> • Section <?=$s['section']?>
              </span>
            </div>
          </div>
        </div>
     </div>
     
     <div class="container">
        <div class="row">
          <!-- Left Column - Profile Information -->
          <div class="col-lg-8">
            <div class="profile-card">
              <div class="profile-img-container">
                <img src="../img/student-<?=$student['gender']?>.png" class="profile-img" alt="Student Profile">
                <h3 class="student-name mt-3"><?=$student['fname']?> <?=$student['lname']?></h3>
                <p class="student-username">@<?=$student['username']?></p>
              </div>
              
              <div class="profile-content">
                <!-- Personal Information -->
                <div class="info-section">
                  <h4 class="section-title">Personal Information</h4>
                  
                  <div class="info-grid">
                    <div class="info-item">
                      <div class="info-label">Student ID</div>
                      <div class="info-value"><?=$student['student_id']?></div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Date of Birth</div>
                      <div class="info-value"><?=$student['date_of_birth']?></div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Gender</div>
                      <div class="info-value"><?=$student['gender']?></div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Email Address</div>
                      <div class="info-value"><?=$student['email_address']?></div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Date Joined</div>
                      <div class="info-value"><?=$student['date_of_joined']?></div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Address</div>
                      <div class="info-value"><?=$student['address']?></div>
                    </div>
                  </div>
                </div>
                
                <!-- Academic Information -->
                <div class="info-section">
                  <h4 class="section-title">Academic Information</h4>
                  
                  <div class="info-grid">
                    <div class="info-item">
                      <div class="info-label">Grade Level</div>
                      <div class="info-value">
                        <?=$g['grade_code']?> - <?=$g['grade']?>
                      </div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Section</div>
                      <div class="info-value">
                        <?=$s['section']?>
                      </div>
                    </div>
                    
                    <div class="info-item">
                      <div class="info-label">Class</div>
                      <div class="info-value">
                        <span class="badge-custom"><?=$g['grade_code']?>-<?=$g['grade']?><?=$s['section']?></span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Parent/Guardian Information -->
                <div class="parent-info">
                  <h4 class="parent-title">Parent/Guardian Information</h4>
                  
                  <div class="info-grid">
                    <div class="info-item" style="background: rgba(255,255,255,0.1); border-left-color: white;">
                      <div class="info-label" style="color: rgba(255,255,255,0.8);">Parent Name</div>
                      <div class="info-value" style="color: white;">
                        <?=$student['parent_fname']?> <?=$student['parent_lname']?>
                      </div>
                    </div>
                    
                    <div class="info-item" style="background: rgba(255,255,255,0.1); border-left-color: white;">
                      <div class="info-label" style="color: rgba(255,255,255,0.8);">Phone Number</div>
                      <div class="info-value" style="color: white;">
                        <?=$student['parent_phone_number']?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Right Column - Stats and Quick Actions -->
          <div class="col-lg-4">
            <!-- Statistics Cards -->
            <div class="stats-cards">
              <div class="stats-card">
                <div class="stats-icon">
                  <i class="fa fa-book"></i>
                </div>
                <div class="stats-number">8</div>
                <div class="stats-label">Subjects</div>
              </div>
              
              <div class="stats-card">
                <div class="stats-icon">
                  <i class="fa fa-calendar-check-o"></i>
                </div>
                <div class="stats-number">95%</div>
                <div class="stats-label">Attendance</div>
              </div>
              
              <div class="stats-card">
                <div class="stats-icon">
                  <i class="fa fa-graduation-cap"></i>
                </div>
                <div class="stats-number">A-</div>
                <div class="stats-label">Current GPA</div>
              </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
              <h4 class="section-title mb-4">Quick Actions</h4>
              
              <a href="timetable.php" class="action-btn">
                <i class="fa fa-calendar action-icon"></i>
                <span>View Timetable</span>
              </a>
              
              <a href="grades.php" class="action-btn">
                <i class="fa fa-graduation-cap action-icon"></i>
                <span>Check Grades</span>
              </a>
              
              <a href="attendance.php" class="action-btn">
                <i class="fa fa-check-square-o action-icon"></i>
                <span>View Attendance</span>
              </a>
              
              <a href="data/subjects.php" class="action-btn">
                <i class="fa fa-book action-icon"></i>
                <span>My Subjects</span>
              </a>
              
              <a href="assignments.php" class="action-btn">
                <i class="fa fa-tasks action-icon"></i>
                <span>Assignments</span>
              </a>
              
              <a href="messages.php" class="action-btn">
                <i class="fa fa-envelope action-icon"></i>
                <span>Messages</span>
              </a>
            </div>
          </div>
        </div>
     </div>
     
     <?php 
        } else {
          header("Location: student.php");
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
  } else {
    header("Location: ../login.php");
    exit;
  } 
} else {
	header("Location: ../login.php");
	exit;
} 
?>