<?php 
include "DB_connection.php";
include "data/setting.php";
$setting = getSetting($conn);

if ($setting != 0) {

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to Learn Mate</title>
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
			--gradient-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			--card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			line-height: 1.6;
			color: #333;
		}

		.hero-section {
			background: var(--gradient-bg);
			min-height: 100vh;
			color: white;
			position: relative;
			overflow: hidden;
		}

		.hero-section::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
			background-size: cover;
		}

		.navbar-custom {
			background: rgba(255, 255, 255, 0.95) !important;
			backdrop-filter: blur(10px);
			box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
			padding: 1rem 0;
			transition: all 0.3s ease;
		}

		.navbar-brand img {
			border-radius: 50%;
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
			transition: transform 0.3s ease;
		}

		.navbar-brand img:hover {
			transform: scale(1.1);
		}

		.nav-link {
			font-weight: 500;
			color: var(--secondary-color) !important;
			margin: 0 10px;
			transition: color 0.3s ease;
			position: relative;
		}

		.nav-link:hover {
			color: var(--primary-color) !important;
		}

		.nav-link::after {
			content: '';
			position: absolute;
			bottom: -5px;
			left: 0;
			width: 0;
			height: 2px;
			background: var(--primary-color);
			transition: width 0.3s ease;
		}

		.nav-link:hover::after {
			width: 100%;
		}

		.btn-login {
			background: var(--primary-color);
			color: white;
			border: none;
			padding: 8px 20px;
			border-radius: 25px;
			font-weight: 500;
			transition: all 0.3s ease;
		}

		.btn-login:hover {
			background: var(--secondary-color);
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
		}

		.welcome-section {
			min-height: 80vh;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			position: relative;
			z-index: 2;
		}

		.school-logo {
			width: 120px;
			height: 120px;
			border-radius: 50%;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
			margin-bottom: 2rem;
			border: 5px solid rgba(255, 255, 255, 0.2);
			animation: float 3s ease-in-out infinite;
		}

		@keyframes float {
			0%, 100% { transform: translateY(0); }
			50% { transform: translateY(-20px); }
		}

		.welcome-title {
			font-size: 3.5rem;
			font-weight: 700;
			margin-bottom: 1rem;
			text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
		}

		.welcome-subtitle {
			font-size: 1.3rem;
			margin-bottom: 2rem;
			opacity: 0.9;
			max-width: 600px;
		}

		.scroll-indicator {
			position: absolute;
			bottom: 30px;
			left: 50%;
			transform: translateX(-50%);
			color: white;
			font-size: 2rem;
			animation: bounce 2s infinite;
		}

		@keyframes bounce {
			0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
			40% { transform: translateX(-50%) translateY(-10px); }
			60% { transform: translateX(-50%) translateY(-5px); }
		}

		.content-section {
			padding: 80px 0;
			background: white;
		}

		.section-title {
			font-size: 2.5rem;
			font-weight: 700;
			color: var(--secondary-color);
			margin-bottom: 3rem;
			text-align: center;
			position: relative;
		}

		.section-title::after {
			content: '';
			position: absolute;
			bottom: -10px;
			left: 50%;
			transform: translateX(-50%);
			width: 80px;
			height: 4px;
			background: var(--accent-color);
			border-radius: 2px;
		}

		.about-card {
			border: none;
			border-radius: 20px;
			box-shadow: var(--card-shadow);
			overflow: hidden;
			transition: transform 0.3s ease;
			margin-bottom: 2rem;
		}

		.about-card:hover {
			transform: translateY(-10px);
		}

		.about-image {
			height: 300px;
			object-fit: cover;
		}

		.about-content {
			padding: 2rem;
		}

		.about-title {
			font-size: 1.8rem;
			font-weight: 600;
			color: var(--secondary-color);
			margin-bottom: 1rem;
		}

		.contact-section {
			background: var(--light-bg);
			padding: 80px 0;
		}

		.contact-form {
			background: white;
			padding: 3rem;
			border-radius: 20px;
			box-shadow: var(--card-shadow);
			max-width: 600px;
			margin: 0 auto;
		}

		.form-control {
			border: 2px solid #e9ecef;
			border-radius: 10px;
			padding: 12px 15px;
			font-size: 1rem;
			transition: all 0.3s ease;
			margin-bottom: 1.5rem;
		}

		.form-control:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
		}

		.btn-primary-custom {
			background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
			border: none;
			color: white;
			padding: 12px 30px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 1rem;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
		}

		.btn-primary-custom:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
		}

		.alert-custom {
			border-radius: 10px;
			border: none;
			padding: 1rem 1.5rem;
			margin-bottom: 1.5rem;
		}

		.features-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 2rem;
			margin-top: 3rem;
		}

		.feature-card {
			background: white;
			padding: 2rem;
			border-radius: 15px;
			text-align: center;
			box-shadow: var(--card-shadow);
			transition: transform 0.3s ease;
		}

		.feature-card:hover {
			transform: translateY(-5px);
		}

		.feature-icon {
			font-size: 3rem;
			color: var(--primary-color);
			margin-bottom: 1rem;
		}

		.feature-title {
			font-size: 1.3rem;
			font-weight: 600;
			color: var(--secondary-color);
			margin-bottom: 1rem;
		}

		.footer {
			background: var(--secondary-color);
			color: white;
			padding: 2rem 0;
			text-align: center;
		}

		@media (max-width: 768px) {
			.welcome-title {
				font-size: 2.5rem;
			}

			.welcome-subtitle {
				font-size: 1.1rem;
			}

			.contact-form {
				padding: 2rem;
			}

			.section-title {
				font-size: 2rem;
			}
		}
	</style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
    	<!-- Navigation -->
    	<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
		  <div class="container">
		    <a class="navbar-brand" href="#">
		    	<img src="logo.png" width="50" alt="Learn Mate">
		    </a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" href="#home">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#about">About</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#contact">Contact</a>
		        </li>
		      </ul>
		      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
		      	<li class="nav-item">
		          <a class="nav-link btn-login" href="login.php">
		          	<i class="fas fa-sign-in-alt me-2"></i>Login
		          </a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<!-- Welcome Section -->
		<section id="home" class="welcome-section">
			<div class="container">
				<div class="welcome-content">
					<img src="logo.png" class="school-logo" alt="Lear Mate">
					<h1 class="welcome-title">Welcome to Learn Mate</h1>
					<p class="welcome-subtitle"><?=$setting['slogan']?></p>
					<div class="mt-4">
						<a href="#about" class="btn btn-primary-custom me-3">Learn More</a>
						<a href="login.php" class="btn btn-outline-light">Get Started</a>
					</div>
				</div>
			</div>
			<div class="scroll-indicator">
				<i class="fas fa-chevron-down"></i>
			</div>
		</section>
    </div>

    <!-- About Section -->
    <section id="about" class="content-section">
    	<div class="container">
    		<h2 class="section-title">About Us</h2>
    		
    		<div class="about-card">
			  <div class="row g-0">
			    <div class="col-md-6">
			      <img src="logo.png" class="img-fluid about-image w-100 h-100" alt="Learn Mate">
			    </div>
			    <div class="col-md-6">
			      <div class="about-content">
			        <h3 class="about-title">Our Story & Mission</h3>
			        <p class="card-text"><?=$setting['about']?></p>
			        <div class="mt-4">
			        	<div class="row text-center">
			        		<div class="col-md-4">
			        			<div class="feature-icon">
			        				<i class="fas fa-graduation-cap"></i>
			        			</div>
			        			<h5>Quality Education</h5>
			        		</div>
			        		<div class="col-md-4">
			        			<div class="feature-icon">
			        				<i class="fas fa-users"></i>
			        			</div>
			        			<h5>Expert Faculty</h5>
			        		</div>
			        		<div class="col-md-4">
			        			<div class="feature-icon">
			        				<i class="fas fa-trophy"></i>
			        			</div>
			        			<h5>Proven Excellence</h5>
			        		</div>
			        	</div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>

			<!-- Features Grid -->
			<div class="features-grid">
				<div class="feature-card">
					<div class="feature-icon">
						<i class="fas fa-book-open"></i>
					</div>
					<h4 class="feature-title">Comprehensive Curriculum</h4>
					<p>Well-structured academic programs designed for holistic development</p>
				</div>
				<div class="feature-card">
					<div class="feature-icon">
						<i class="fas fa-laptop"></i>
					</div>
					<h4 class="feature-title">Modern Facilities</h4>
					<p>State-of-the-art infrastructure and technology-enhanced learning</p>
				</div>
				<div class="feature-card">
					<div class="feature-icon">
						<i class="fas fa-heart"></i>
					</div>
					<h4 class="feature-title">Student Support</h4>
					<p>Comprehensive support system for academic and personal growth</p>
				</div>
			</div>
    	</div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
    	<div class="container">
    		<h2 class="section-title">Get In Touch</h2>
    		<div class="contact-form">
    			<form method="post" action="req/contact.php">
    				<h3 class="text-center mb-4">Contact Us</h3>
    				
    				<?php if (isset($_GET['error'])) { ?>
	    			<div class="alert alert-danger alert-custom" role="alert">
					  <i class="fas fa-exclamation-circle me-2"></i>
					  <?=$_GET['error']?>
					</div>
					<?php } ?>
					
					<?php if (isset($_GET['success'])) { ?>
			          <div class="alert alert-success alert-custom" role="alert">
			          	<i class="fas fa-check-circle me-2"></i>
			           	<?=$_GET['success']?>
			          </div>
			        <?php } ?>

				  <div class="mb-3">
				    <label class="form-label">Full Name</label>
				    <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
				  </div>

				  <div class="mb-3">
				    <label class="form-label">Email Address</label>
				    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
				    <div class="form-text">We'll never share your email with anyone else.</div>
				  </div>

				  <div class="mb-3">
				    <label class="form-label">Message</label>
				    <textarea class="form-control" name="message" rows="5" placeholder="Enter your message" required></textarea>
				  </div>

				  <button type="submit" class="btn btn-primary-custom w-100">
				  	<i class="fas fa-paper-plane me-2"></i>Send Message
				  </button>
				</form>
    		</div>
    	</div>
    </section>

    <!-- Footer -->
    <footer class="footer">
    	<div class="container">
    		<p>Copyright &copy; <?=$setting['current_year']?> Learn Mate. All rights reserved.</p>
    		<div class="mt-3">
    			<a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
    			<a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
    			<a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
    			<a href="#" class="text-light"><i class="fab fa-linkedin-in"></i></a>
    		</div>
    	</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    	// Smooth scrolling for navigation links
    	document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    		anchor.addEventListener('click', function (e) {
    			e.preventDefault();
    			document.querySelector(this.getAttribute('href')).scrollIntoView({
    				behavior: 'smooth'
    			});
    		});
    	});

    	// Navbar background change on scroll
    	window.addEventListener('scroll', function() {
    		const navbar = document.querySelector('.navbar-custom');
    		if (window.scrollY > 100) {
    			navbar.style.background = 'rgba(255, 255, 255, 0.98)';
    			navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.15)';
    		} else {
    			navbar.style.background = 'rgba(255, 255, 255, 0.95)';
    			navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    		}
    	});

    	// Animation on scroll
    	const observerOptions = {
    		threshold: 0.1,
    		rootMargin: '0px 0px -50px 0px'
    	};

    	const observer = new IntersectionObserver((entries) => {
    		entries.forEach(entry => {
    			if (entry.isIntersecting) {
    				entry.target.style.opacity = '1';
    				entry.target.style.transform = 'translateY(0)';
    			}
    		});
    	}, observerOptions);

    	document.querySelectorAll('.feature-card, .about-card').forEach(card => {
    		card.style.opacity = '0';
    		card.style.transform = 'translateY(20px)';
    		card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    		observer.observe(card);
    	});
    </script>
</body>
</html>
<?php } else {
	header("Location: login.php");
	exit;
}  ?>