<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Student Complaint Management System</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

/* GREEN BACKGROUND THEME */
body{
    margin:0;
    background:linear-gradient(135deg,#1b5e20,#66bb6a);
}
/* Small Back Arrow */
.back-arrow{
    position: fixed;
    top: 15px;
    left: 15px;
    width: 35px;
    height: 35px;
    background: #1b5e20;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-size: 16px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    transition: 0.3s;
    z-index: 1000;
}

.back-arrow:hover{
    background: #2e7d32;
    transform: scale(1.1);
}

/* FEATURES */
.features{
    background:#e8f5e9;
}

/* DEPARTMENTS */
.departments{
    background:#c8e6c9;
}

/* ABOUT */
.about{
    padding:70px 8%;
    background:#fff;
}

.about-container{
    max-width:1100px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:40px;
    align-items:center;
}

.about h2{
    color:#1b5e20;
    font-size:35px;
}

.about p{
    color:#444;
    line-height:1.8;
    font-size:17px;
}

.about-box{
    background:#e8f5e9;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.about-box h3{
    color:#1b5e20;
}

/* CONTACT */
.contact{
    padding:70px 8%;
    background:#f1f8e9;
    text-align:center;
}

.contact h2{
    color:#1b5e20;
    font-size:35px;
}

.contact-container{
    display:flex;
    justify-content:center;
    gap:25px;
    flex-wrap:wrap;
}

.contact-card{
    background:#fff;
    width:250px;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.contact-card i{
    font-size:35px;
    color:#1b5e20;
}

.contact-card h3{
    color:#1b5e20;
}

</style>

</head>

<body>
<body>
<a href="welcome/start.php" class="back-arrow">
    <i class="fas fa-arrow-left"></i>
</a> 
<header>

<div class="logo">
    <img src="images/college-logo.png" alt="Logo">
    <h2>SSCMS</h2>
</div>

<nav>
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#departments">Departments</a>
    <a href="#contact">Contact</a>
</nav>

</header>

<section class="hero" id="home">

<div class="overlay">

<h1>
SMART STUDENT COMPLAINT<br>
MANAGEMENT SYSTEM
</h1>

<p>Choose your login portal to continue.</p>

<div class="login-box">

<a href="student/login.php" class="card">
<img src="images/student.png" class="card-logo">
<h2>Student Login</h2>
<p>Submit complaints and track their status.</p>
</a>

<a href="department/department_login.php" class="card">
<img src="images/depart.png" class="card-logo">
<h2>Department Login</h2>
<p>Manage and resolve department complaints.</p>
</a>

<a href="admin/admin_login.php" class="card">
<img src="images/admin.png" class="card-logo">
<h2>Admin Login</h2>
<p>Manage students, departments and complaints.</p>
</a>

</div>
</div>
</section>

<section class="about" id="about">
<div class="about-container">

<div>
<h2>About SSCMS</h2>

<p>
The Smart Student Complaint Management System (SSCMS)
is an online platform designed to make student complaint
management simple, fast and transparent.
</p>

<p>
Students can submit complaints online and track their
complaint status. Departments can view, manage and
resolve complaints efficiently.
</p>

<p>
The system improves communication between students
and departments through a structured complaint
management process.
</p>

</div>

<div class="about-box">

<h3>🎯 Our Goal</h3>
<p>To provide a smart, transparent and efficient platform.</p>

<h3>⚡ Easy & Fast</h3>
<p>Submit and track complaints anytime.</p>

<h3>🔒 Secure</h3>
<p>Separate login portals for Students, Departments and Admins.</p>

</div>

</div>
</section>

<section class="features">

<h2>System Features</h2>

<div class="feature-container">

<div class="feature">
<i class="fas fa-file-circle-plus"></i>
<h3>Complaint Submission</h3>
<p>Students can submit complaints online.</p>
</div>

<div class="feature">
<i class="fas fa-chart-line"></i>
<h3>Complaint Tracking</h3>
<p>Track complaint status anytime.</p>
</div>

<div class="feature">
<i class="fas fa-bell"></i>
<h3>Notifications</h3>
<p>Receive instant complaint updates.</p>
</div>

<div class="feature">
<i class="fas fa-lock"></i>
<h3>Secure Login</h3>
<p>Safe and secure user authentication.</p>
</div>

</div>

</section>

<section class="departments" id="departments">

<h2>Departments</h2>

<div class="dept-container">

<div class="dept-card">
<h3>💻 CME</h3>
<p>Computer Engineering</p>
</div>

<div class="dept-card">
<h3>📡 ECE</h3>
<p>Electronics & Communication Engineering</p>
</div>

<div class="dept-card">
<h3>⚙ Mechanical</h3>
<p>Mechanical Engineering</p>
</div>

</div>

</section>

<section class="contact" id="contact">

<h2>Contact Us</h2>

<div class="contact-container">

<div class="contact-card">
<i class="fas fa-envelope"></i>
<h3>Email</h3>
<p>support@sscms.com</p>
</div>

<div class="contact-card">
<i class="fas fa-phone"></i>
<h3>Phone</h3>
<p>+91 XXXXX XXXXX</p>
</div>

<div class="contact-card">
<i class="fas fa-location-dot"></i>
<h3>Location</h3>
<p>College Campus</p>
</div>

</div>

</section>

<footer>
<p>© 2026 Smart Student Complaint Management System</p>
</footer>

<script src="js/script.js"></script>

</body>
</html>