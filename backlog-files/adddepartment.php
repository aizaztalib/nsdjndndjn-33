<?php
session_start();
$conn = new mysqli("localhost", "root", "", "slmsdb");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['DepartmentName'])) {
    $name = $_POST['DepartmentName'];
    $short = $_POST['DepartmentShortName'];
    $code = $_POST['DepartmentCode'];
    $sql = "INSERT INTO tbldepartments (DepartmentName, DepartmentShortName, DepartmentCode) VALUES ('$name', '$short', '$code')";
    if ($conn->query($sql)) {
        echo "<script>alert('Department added successfully'); window.location.href='managedepartments.php';</script>";
    } else {
        echo "<script>alert('Error adding department');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Department | SLMS</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
/* General */
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Roboto', sans-serif; background-color: #f4faff; }

/* Sidebar */
.sidebar {
    position: fixed; top: 0; left: 0;
    width: 250px; height: 100%;
    background: linear-gradient(180deg, #1e3c72, #2a5298);
    color: #fff; padding-top: 30px;
    overflow-y: auto;
    box-shadow: 3px 0 20px rgba(0,0,0,0.2);
}
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

.sidebar h2 { text-align: center; margin-bottom: 20px; }
.sidebar ul { list-style: none; padding-left: 0; }
.sidebar ul li { padding: 12px 25px; border-radius: 8px; margin-bottom: 6px; }
.sidebar ul li:hover { background-color: rgba(255,255,255,0.15); }
.sidebar ul li a { color: #f4faff; text-decoration: none; display: block; }

/* Submenus */
.sidebar ul li ul { list-style: none; padding-left: 20px; display: none; }
.sidebar ul li ul li { padding: 8px 20px; font-size: 14px; border-radius: 6px; }
.sidebar ul li ul li:hover { background: rgba(255,255,255,0.2); }

/* Main content */
.main-content {
    margin-left: 270px; padding: 30px 40px;
    min-height: 100vh; background-color: #f4faff;
}

/* Header */
.header {
    background: #ffffff;
    padding: 20px 30px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    text-align: center;
    margin-bottom: 30px;
}
.header h1 { font-size: 26px; color: #2a5298; }

/* Form */
form {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    width: 60%;
    margin: 0 auto;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}
label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; }
input {
    width: 100%; padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc; border-radius: 6px;
    font-size: 15px;
}
.submit-btn {
    background: #2a5298;
    color: white;
    padding: 12px 20px;
    border: none; border-radius: 6px;
    font-size: 16px; font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
.submit-btn:hover { background: #1e3c72; }

/* Responsive */
@media(max-width: 768px) {
    form { width: 100%; }
    .main-content { padding: 20px; }
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>SLMS Admin</h2>
    <ul>
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
        <li onclick="toggleMenu('student-submenu')">🧑‍🎓 Students ▼
            <ul id="student-submenu">
                <li><a href="students.php">➕ Add Student</a></li>
                <li><a href="students.php">⚙️ Manage Students</a></li>
            </ul>
        </li>
        <li onclick="toggleMenu('dept-submenu')">🏢 Departments ▼
            <ul id="dept-submenu">
                <li><a href="adddepartment.php">➕ Add Department</a></li>
                <li><a href="managedepartments.php">📋 Manage Departments</a></li>
            </ul>
        </li>
        <li onclick="toggleMenu('leave-submenu')">📝 Leaves ▼
            <ul id="leave-submenu">
                <li><a href="addleave.php">➕ Add Leave</a></li>
                <li><a href="manageleaves.php">📋 Manage Leaves</a></li>
            </ul>
        </li>
        <li><a href="change-password.php">🔑 Change Password</a></li>
        <li><a href="logout.php">🚪 Sign Out</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="header">
        <h1>Add New Department</h1>
    </div>

    <form method="POST">
        <label>Department Name</label>
        <input name="DepartmentName" required>

        <label>Short Name</label>
        <input name="DepartmentShortName" required>

        <label>Department Code</label>
        <input name="DepartmentCode" required>

        <button type="submit" class="submit-btn">Add Department</button>
    </form>
</div>

<script>
function toggleMenu(id){
    const menu = document.getElementById(id);
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>
