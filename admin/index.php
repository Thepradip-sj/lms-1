<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";
        include "data/student.php";
        include "data/instructor.php";
        include "data/course.php";
        include "data/admin.php"; // NEW

        // REAL-TIME DATA
        $students    = getAllStudents($conn);
        $instructors = getAllInstructors($conn);
        $courses     = getAllCourses($conn);
        $admins      = getAllAdmins($conn);
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

            .dashboard-container { min-height: 100vh; padding: 2rem 0; }

            .welcome-card {
              background: rgba(255, 255, 255, 0.95);
              border-radius: 20px;
              box-shadow: var(--card-shadow);
              padding: 2rem;
              margin-bottom: 2rem;
              backdrop-filter: blur(10px);
            }

            .stats-card {
              background: rgba(255, 255, 255, 0.95);
              border-radius: 15px;
              padding: 1.5rem;
              box-shadow: var(--card-shadow);
              margin-bottom: 1.5rem;
              transition: all 0.3s ease;
            }

            .stats-card:hover { transform: translateY(-5px); box-shadow: var(--hover-shadow); }

            .stats-number { font-size: 2rem; font-weight: 700; }
            /* FEATURE GRID FIX */
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
            box-shadow: var(--card-shadow);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
            text-decoration: none;
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            opacity: 0.85;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
            opacity: 1;
        }

        .feature-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
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
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0.5rem;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
            text-decoration: none;
        }

        .action-icon {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }
  </style>
</head>

<body>

<?php include "inc/navbar.php"; ?>

<div class="dashboard-container">
    <div class="container">

        <!-- Welcome -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="welcome-title">Admin Dashboard</h1>
                    <p class="welcome-subtitle">Welcome back! Here's your system overview.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="btn-group">
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="fa fa-print me-2"></i>Print Report
                        </button>
                        <button class="btn btn-primary" onclick="location.reload()">
                            <i class="fa fa-refresh me-2"></i>Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- REAL-TIME STATISTICS -->
        <div class="row">

            <!-- Instructors -->
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon text-primary"><i class="fa fa-user-md"></i></div>
                    <div class="stats-number text-primary">
                        <?= $instructors ? count($instructors) : 0 ?>
                    </div>
                    <div class="stats-label">Total Instructors</div>
                </div>
            </div>

            <!-- Students -->
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon text-success"><i class="fa fa-graduation-cap"></i></div>
                    <div class="stats-number text-success">
                        <?= $students ? count($students) : 0 ?>
                    </div>
                    <div class="stats-label">Total Students</div>
                </div>
            </div>

            <!-- Admins -->
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon text-info"><i class="fa fa-users"></i></div>
                    <div class="stats-number text-info">
                        <?= $admins ? count($admins) : 0 ?>
                    </div>
                    <div class="stats-label">Total Admins</div>
                </div>
            </div>

            <!-- Courses -->
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon text-warning"><i class="fa fa-book"></i></div>
                    <div class="stats-number text-warning">
                        <?= $courses ? count($courses) : 0 ?>
                    </div>
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
                    <i class="fa fa-cogs action-icon"></i> Settings
                </a>
                <a href="reports.php" class="action-btn btn-success">
                    <i class="fa fa-bar-chart action-icon"></i> Reports
                </a>
                <a href="backup.php" class="action-btn btn-info">
                    <i class="fa fa-database action-icon"></i> Backup
                </a>
                <a href="../logout.php" class="action-btn btn-warning">
                    <i class="fa fa-sign-out action-icon"></i> Logout
                </a>
            </div>
        </div>

    </div>
</div>

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


