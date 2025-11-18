<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Learn Mate</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
		:root {
			--primary-color: #3498db;
			--secondary-color: #2c3e50;
			--accent-color: #1abc9c;
			--light-bg: #f8f9fa;
			--card-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
			--gradient-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: var(--gradient-bg);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		.login-container {
			display: flex;
			width: 100%;
			max-width: 1000px;
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			box-shadow: var(--card-shadow);
			overflow: hidden;
			min-height: 600px;
		}

		.login-left {
			flex: 1;
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			color: white;
			padding: 40px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			position: relative;
			overflow: hidden;
		}

		.login-left::before {
			content: '';
			position: absolute;
			top: -50%;
			right: -50%;
			width: 100%;
			height: 100%;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 50%;
			transform: scale(0);
			transition: transform 0.8s ease;
		}

		.login-left:hover::before {
			transform: scale(1);
		}

		.welcome-content {
			position: relative;
			z-index: 2;
		}

		.school-logo {
			width: 80px;
			height: 80px;
			margin-bottom: 20px;
			border-radius: 50%;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
		}

		.welcome-title {
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 10px;
			background: linear-gradient(45deg, #fff, #e3f2fd);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.welcome-subtitle {
			font-size: 1.1rem;
			opacity: 0.9;
			margin-bottom: 30px;
			line-height: 1.6;
		}

		.features-list {
			list-style: none;
			padding: 0;
		}

		.features-list li {
			display: flex;
			align-items: center;
			margin-bottom: 15px;
			font-size: 0.95rem;
		}

		.features-list li i {
			background: rgba(255, 255, 255, 0.2);
			width: 30px;
			height: 30px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 10px;
			font-size: 0.8rem;
		}

		.login-right {
			flex: 1;
			padding: 40px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			background: white;
		}

		.login-form {
			width: 100%;
			max-width: 400px;
			margin: 0 auto;
		}

		.form-header {
			text-align: center;
			margin-bottom: 30px;
		}

		.form-title {
			font-size: 2rem;
			font-weight: 700;
			color: var(--secondary-color);
			margin-bottom: 5px;
		}

		.form-subtitle {
			color: #6c757d;
			font-size: 0.95rem;
		}

		.form-group {
			margin-bottom: 20px;
			position: relative;
		}

		.form-label {
			font-weight: 600;
			color: var(--secondary-color);
			margin-bottom: 8px;
			display: block;
		}

		.form-control {
			border: 2px solid #e9ecef;
			border-radius: 10px;
			padding: 12px 15px;
			font-size: 1rem;
			transition: all 0.3s ease;
			background: var(--light-bg);
		}

		.form-control:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
			background: white;
		}

		.input-icon {
			position: absolute;
			right: 15px;
			top: 40px;
			color: #6c757d;
		}

		.alert-custom {
			border-radius: 10px;
			border: none;
			padding: 15px;
			background: #ffe6e6;
			color: #d63031;
			font-weight: 500;
		}

		.btn-login {
			background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
			border: none;
			color: white;
			padding: 12px 30px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 1rem;
			width: 100%;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
		}

		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
		}

		.home-link {
			text-align: center;
			margin-top: 20px;
		}

		.home-link a {
			color: var(--primary-color);
			text-decoration: none;
			font-weight: 500;
			transition: color 0.3s ease;
		}

		.home-link a:hover {
			color: var(--secondary-color);
		}

		.copyright {
			text-align: center;
			margin-top: 30px;
			color: #6c757d;
			font-size: 0.9rem;
		}

		.role-option {
			display: flex;
			align-items: center;
			padding: 8px 0;
		}

		.role-icon {
			width: 30px;
			height: 30px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 10px;
			font-size: 0.8rem;
			color: white;
		}

		.admin-icon { background: #e74c3c; }
		.teacher-icon { background: #3498db; }
		.student-icon { background: #2ecc71; }
		

		@media (max-width: 768px) {
			.login-container {
				flex-direction: column;
				max-width: 400px;
			}

			.login-left {
				padding: 30px 20px;
				text-align: center;
			}

			.welcome-title {
				font-size: 2rem;
			}

			.login-right {
				padding: 30px 20px;
			}
		}

		.floating-shapes {
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			overflow: hidden;
			z-index: 1;
		}

		.shape {
			position: absolute;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 50%;
		}

		.shape-1 {
			width: 100px;
			height: 100px;
			top: 10%;
			left: 10%;
			animation: float 6s ease-in-out infinite;
		}

		.shape-2 {
			width: 150px;
			height: 150px;
			bottom: 10%;
			right: 10%;
			animation: float 8s ease-in-out infinite reverse;
		}

		.shape-3 {
			width: 80px;
			height: 80px;
			top: 50%;
			right: 20%;
			animation: float 7s ease-in-out infinite 1s;
		}

		@keyframes float {
			0%, 100% { transform: translateY(0) rotate(0deg); }
			50% { transform: translateY(-20px) rotate(180deg); }
		}
	</style>
</head>
<body>
    <div class="login-container">
    	<!-- Left Side - Welcome Section -->
    	<div class="login-left">
    		<div class="floating-shapes">
    			<div class="shape shape-1"></div>
    			<div class="shape shape-2"></div>
    			<div class="shape shape-3"></div>
    		</div>
    		<div class="welcome-content">
    			<img src="logo.png" class="school-logo" alt="Y School Logo">
    			<h1 class="welcome-title">Welcome to Learn Mate</h1>
    			<p class="welcome-subtitle">
    				Your gateway to seamless education management. Access your personalized dashboard and continue your educational journey.
    			</p>
    			<ul class="features-list">
    				<li><i class="fas fa-shield-alt"></i> Secure & Private</li>
    				<li><i class="fas fa-bolt"></i> Fast & Reliable</li>
    				<li><i class="fas fa-users"></i> Multi-role Access</li>
    				<li><i class="fas fa-mobile-alt"></i> Mobile Friendly</li>
    			</ul>
    		</div>
    	</div>

    	<!-- Right Side - Login Form -->
    	<div class="login-right">
    		<form class="login-form" method="post" action="req/login.php">
    			<div class="form-header">
    				<h2 class="form-title">Welcome Back</h2>
    				<p class="form-subtitle">Sign in to your account</p>
    			</div>

    			<?php if (isset($_GET['error'])) { ?>
    			<div class="alert alert-custom" role="alert">
    				<i class="fas fa-exclamation-circle me-2"></i>
    				<?=$_GET['error']?>
    			</div>
    			<?php } ?>

    			<div class="form-group">
    				<label class="form-label">Username</label>
    				<input type="text" 
    				       class="form-control"
    				       name="uname"
    				       placeholder="Enter your username"
    				       required>
    				<i class="fas fa-user input-icon"></i>
    			</div>

    			<div class="form-group">
    				<label class="form-label">Password</label>
    				<input type="password" 
    				       class="form-control"
    				       name="pass"
    				       placeholder="Enter your password"
    				       required>
    				<i class="fas fa-lock input-icon"></i>
    			</div>

    			<div class="form-group">
    				<label class="form-label">Login As</label>
    				<select class="form-control" name="role" required>
    					<option value="1">
    						<div class="role-option">
    							<span class="role-icon admin-icon"><i class="fas fa-crown"></i></span>
    							Admin
    						</div>
    					</option>
    					<option value="2">
    						<div class="role-option">
    							<span class="role-icon teacher-icon"><i class="fas fa-chalkboard-teacher"></i></span>
    							Instructor
    						</div>
    					</option>
    					<option value="3">
    						<div class="role-option">
    							<span class="role-icon student-icon"><i class="fas fa-graduation-cap"></i></span>
    							Student
    						</div>
    					</option>
    					
    				</select>
    			</div>

    			<button type="submit" class="btn btn-login">
    				<i class="fas fa-sign-in-alt me-2"></i>Login
    			</button>

    			<div class="home-link">
    				<a href="index.php">
    					<i class="fas fa-home me-1"></i>Back to Home
    				</a>
    			</div>
    		</form>

    		<div class="copyright">
    			Copyright &copy; 2025 Learn Mate. All rights reserved.
    		</div>
    	</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    	// Add some interactive effects
    	document.addEventListener('DOMContentLoaded', function() {
    		const inputs = document.querySelectorAll('.form-control');
    		inputs.forEach(input => {
    			input.addEventListener('focus', function() {
    				this.parentElement.classList.add('focused');
    			});
    			input.addEventListener('blur', function() {
    				if (!this.value) {
    					this.parentElement.classList.remove('focused');
    				}
    			});
    		});

    		// Add loading state to login button
    		const loginForm = document.querySelector('.login-form');
    		loginForm.addEventListener('submit', function() {
    			const btn = this.querySelector('.btn-login');
    			btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing in...';
    			btn.disabled = true;
    		});
    	});
    </script>
</body>
</html>