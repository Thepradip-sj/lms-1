<?php 
session_start();
if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard - Home</title>
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
      --danger-color: #e74c3c;
      --success-color: #27ae60;
      --light-bg: #f8f9fa;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --hover-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }
    
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      background-attachment: fixed;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
    }
    
    .dashboard-container {
      min-height: 100vh;
      padding: 2rem 0;
    }
    
    .welcome-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 2rem;
      margin-bottom: 2rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .welcome-title {
      color: var(--secondary-color);
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .welcome-subtitle {
      color: #6c757d;
      font-size: 1.1rem;
    }
    
    .stats-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }
    
    .stats-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      opacity: 0.8;
    }
    
    .stats-number {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }
    
    .stats-label {
      color: #6c757d;
      font-size: 0.9rem;
      font-weight: 500;
    }
    
    .feature-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 2rem;
      text-decoration: none;
      color: var(--secondary-color);
      display: block;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
      height: 100%;
      text-align: center;
    }
    
    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--hover-shadow);
      color: var(--secondary-color);
      text-decoration: none;
    }
    
    .feature-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
      transform: scale(1.1);
    }
    
    .feature-title {
      font-weight: 600;
      margin-bottom: 0.5rem;
      font-size: 1.1rem;
    }
    
    .feature-description {
      color: #6c757d;
      font-size: 0.9rem;
      line-height: 1.4;
    }
    
    .quick-actions {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: var(--card-shadow);
      margin-top: 2rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .action-btn {
      padding: 1rem 1.5rem;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin: 0.5rem;
    }
    
    .action-icon {
      margin-right: 0.5rem;
      font-size: 1.1rem;
    }
    
    .card-teacher { border-top: 4px solid #3498db; }
    .card-student { border-top: 4px solid #2ecc71; }
    
    .card-class { border-top: 4px solid #e67e22; }
    .card-section { border-top: 4px solid #e74c3c; }
    .card-grade { border-top: 4px solid #f1c40f; }
    .card-course { border-top: 4px solid #1abc9c; }
    .card-message { border-top: 4px solid #34495e; }
    
    .feature-card.card-teacher:hover .feature-icon { color: #3498db; }
    .feature-card.card-student:hover .feature-icon { color: #2ecc71; }
 
    .feature-card.card-class:hover .feature-icon { color: #e67e22; }
    .feature-card.card-section:hover .feature-icon { color: #e74c3c; }
    .feature-card.card-grade:hover .feature-icon { color: #f1c40f; }
    .feature-card.card-course:hover .feature-icon { color: #1abc9c; }
    .feature-card.card-message:hover .feature-icon { color: #34495e; }
    
    @media (max-width: 768px) {
      .dashboard-container {
        padding: 1rem 0;
      }
      
      .welcome-card,
      .quick-actions {
        padding: 1.5rem;
      }
      
      .feature-card {
        padding: 1.5rem;
        margin-bottom: 1rem;
      }
      
      .feature-icon {
        font-size: 2.5rem;
      }
    }
  </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
    ?>
    
    <div class="dashboard-container">
        <div class="container">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="welcome-title">Admin Dashboard</h1>
                        <p class="welcome-subtitle">Welcome back! Manage your school system efficiently.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="btn-group">
                            <button class="btn btn-outline-primary" onclick="window.print()">
                                <i class="fa fa-print me-2"></i>Print Report
                            </button>
                            <button class="btn btn-primary">
                                <i class="fa fa-refresh me-2"></i>Refresh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon text-primary">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="stats-number text-primary">24</div>
                        <div class="stats-label">Total Instructors</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon text-success">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="stats-number text-success">356</div>
                        <div class="stats-label">Total Students</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon text-info">
                            <i class="fa fa-cubes"></i>
                        </div>
                        <div class="stats-number text-info">18</div>
                        <div class="stats-label">Active Classes</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon text-warning">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="stats-number text-warning">42</div>
                        <div class="stats-label">Courses</div>
                    </div>
                </div>
            </div>
            
            <!-- Feature Grid -->
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="instructor.php" class="feature-card card-teacher">
                        <div class="feature-icon text-primary">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <h4 class="feature-title">Instructors</h4>
                        <p class="feature-description">Manage teaching staff, assignments, and profiles</p>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="student.php" class="feature-card card-student">
                        <div class="feature-icon text-success">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <h4 class="feature-title">Students</h4>
                        <p class="feature-description">Manage student records, enrollment, and progress</p>
                    </a>
                </div>
                
                
                

                
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="course.php" class="feature-card card-course">
                        <div class="feature-icon text-info">
                            <i class="fa fa-book"></i>
                        </div>
                        <h4 class="feature-title">Courses</h4>
                        <p class="feature-description">Manage curriculum, subjects, and course materials</p>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="message.php" class="feature-card card-message">
                        <div class="feature-icon" style="color: #34495e;">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <h4 class="feature-title">Messages</h4>
                        <p class="feature-description">Communicate with staff, students, and parents</p>
                    </a>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h4 class="mb-4" style="color: var(--secondary-color);">Quick Actions</h4>
                <div class="d-flex flex-wrap justify-content-center">
                    <a href="settings.php" class="action-btn btn-primary">
                        <i class="fa fa-cogs action-icon"></i>
                        System Settings
                    </a>
                    <a href="reports.php" class="action-btn btn-success">
                        <i class="fa fa-bar-chart action-icon"></i>
                        Generate Reports
                    </a>
                    <a href="backup.php" class="action-btn btn-info">
                        <i class="fa fa-database action-icon"></i>
                        Data Backup
                    </a>
                    <a href="../logout.php" class="action-btn btn-warning">
                        <i class="fa fa-sign-out action-icon"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(1) a").addClass('active');
            
            // Add animation to feature cards
            $('.feature-card').each(function(i) {
                $(this).delay(i * 100).animate({
                    opacity: 1,
                    marginTop: 0
                }, 600);
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