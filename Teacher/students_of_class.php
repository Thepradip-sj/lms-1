<?php 
session_start();
if (isset($_SESSION['teacher_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Teacher') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/grade.php";
        include "data/class.php";
        include "data/section.php";
        
        if (!isset($_GET['class_id'])) {
            header("Location: students.php");
            exit;
        }
        
        $class_id = $_GET['class_id'];
        $students = getAllStudents($conn);
        $class = getClassById($class_id, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - Class Students</title>
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
        
        .class-info-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .class-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light-bg);
        }
        
        .class-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
        }
        
        .class-badge {
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .class-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .detail-item {
            text-align: center;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 10px;
        }
        
        .detail-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .detail-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .students-table-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        .table-header {
            background: var(--light-bg);
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table-title {
            margin: 0;
            color: var(--secondary-color);
            font-weight: 600;
        }
        
        .student-table {
            margin: 0;
            width: 100%;
        }
        
        .student-table thead th {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }
        
        .student-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .student-table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .student-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.8rem;
        }
        
        .student-name {
            font-weight: 500;
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .student-name:hover {
            color: var(--primary-color);
        }
        
        .grade-badge {
            background: var(--accent-color);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-sm-custom {
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-primary-sm {
            background: var(--primary-color);
            color: white;
            border: none;
        }
        
        .btn-primary-sm:hover {
            background: var(--secondary-color);
            color: white;
        }
        
        .btn-outline-primary-sm {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }
        
        .btn-outline-primary-sm:hover {
            background: var(--primary-color);
            color: white;
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
        
        .search-box {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .class-details {
                grid-template-columns: 1fr;
            }
            
            .action-btns {
                flex-direction: column;
            }
            
            .student-table thead {
                display: none;
            }
            
            .student-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 10px;
                padding: 1rem;
            }
            
            .student-table tbody td {
                display: block;
                text-align: right;
                padding: 0.5rem 1rem;
                border: none;
                position: relative;
            }
            
            .student-table tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                font-weight: 600;
                color: var(--secondary-color);
            }
        }
    </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($students != 0) {
            $check = 0;
    ?>
     
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5">Class Students</h1>
                    <p class="lead">Manage and view students in your class</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="students.php" class="btn btn-light">
                        <i class="fa fa-arrow-left me-2"></i>Back to Classes
                    </a>
                </div>
            </div>
        </div>
    </div>
     
    <div class="container">
        <!-- Class Information -->
        <?php
            $g = getGradeById($class['grade'], $conn);
            $s = getSectioById($class['section'], $conn);
            $class_code = $g['grade_code'].'-'.$g['grade'].$s['section'];
            $student_count = 0;
            
            // Count students in this class
            foreach ($students as $student) {
                if ($g['grade_id'] == $student['grade'] && $s['section_id'] == $student['section']) {
                    $student_count++;
                }
            }
        ?>
        
        <div class="class-info-card">
            <div class="class-header">
                <h2 class="class-title"><?=$class_code?></h2>
                <span class="class-badge"><?=$student_count?> Students</span>
            </div>
            
            <div class="class-details">
                <div class="detail-item">
                    <div class="detail-label">Grade Level</div>
                    <div class="detail-value"><?=$g['grade']?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Section</div>
                    <div class="detail-value"><?=$s['section']?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Grade Code</div>
                    <div class="detail-value"><?=$g['grade_code']?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Students</div>
                    <div class="detail-value"><?=$student_count?></div>
                </div>
            </div>
        </div>
        
        <!-- Search Box -->
        <div class="search-box">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search students by name or ID...">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <button class="btn btn-outline-primary">
                        <i class="fa fa-download me-2"></i>Export List
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Students Table -->
        <?php if ($student_count > 0) { ?>
        <div class="students-table-container">
            <div class="table-header">
                <h4 class="table-title">Students List</h4>
            </div>
            
            <div class="table-responsive">
                <table class="table student-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student</th>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Grade Level</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 0;
                            foreach ($students as $student) { 
                                if ($g['grade_id'] == $student['grade'] && $s['section_id'] == $student['section']) { 
                                    $i++;
                                    $check++;
                                    $grade_temp = getGradeById($student['grade'], $conn);
                        ?>
                        <tr>
                            <th scope="row" data-label="#"><?=$i?></th>
                            <td data-label="Student">
                                <div class="d-flex align-items-center">
                                    <img src="../img/student-<?=$student['gender']?>.png" class="student-avatar" alt="Student Avatar">
                                    <a href="student-grade.php?student_id=<?=$student['student_id']?>" class="student-name">
                                        <?=$student['fname']?> <?=$student['lname']?>
                                    </a>
                                </div>
                            </td>
                            <td data-label="ID"><?=$student['student_id']?></td>
                            <td data-label="Username">@<?=$student['username']?></td>
                            <td data-label="Grade Level">
                                <span class="grade-badge">
                                    <?=$grade_temp['grade_code']?>-<?=$grade_temp['grade']?>
                                </span>
                            </td>
                            <td data-label="Actions">
                                <div class="action-btns">
                                    <a href="student-grade.php?student_id=<?=$student['student_id']?>" class="btn-sm-custom btn-primary-sm">
                                        <i class="fa fa-graduation-cap me-1"></i>Grades
                                    </a>
                                    <a href="#" class="btn-sm-custom btn-outline-primary-sm">
                                        <i class="fa fa-eye me-1"></i>View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } else { ?>
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa fa-users"></i>
            </div>
            <h3 class="empty-title">No Students Found</h3>
            <p class="text-muted mb-4">There are no students enrolled in this class yet.</p>
            <a href="students.php" class="btn btn-primary">
                <i class="fa fa-arrow-left me-2"></i>Back to Classes
            </a>
        </div>
        <?php } ?>
        
    </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(3) a").addClass('active');
            
            // Add search functionality
            $('.search-box input').on('input', function() {
                const searchText = $(this).val().toLowerCase();
                $('.student-table tbody tr').each(function() {
                    const studentText = $(this).text().toLowerCase();
                    if (studentText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            
            // Add responsive table labels for mobile
            if ($(window).width() < 768) {
                $('.student-table th').each(function(i) {
                    const label = $(this).text();
                    $('.student-table td').eq(i).attr('data-label', label);
                });
            }
        });
    </script>

</body>
</html>
<?php 
    } else {
        ?>
        <div class="alert alert-info .w-450 m-5" role="alert">
            Empty!
        </div>
        <?php
    }
    
    if ($check == 0) {
        header("Location: students.php");
        exit;
    }
    ?>
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