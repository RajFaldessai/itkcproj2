<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit;
}

include 'db.php';

$sql = "SELECT * FROM schools";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITKC - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="dashboard.png" alt="Dashboard Image" class="dashboard-img">
        <nav>
            <img src="logo.png" alt="Logo" class="logo">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="courses.html">Courses</a></li>
                <li><a href="form.html">Form</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="admin.html">Admin Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Admin Dashboard</h1>
        <table>
            <tr>
                <th>Name of the School</th>
                <th>Survey Report</th>
                <th>PDF</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['school_name'] . "</td>";
                    echo "<td><a href='survey_report.php?id=" . $row['id'] . "'>View Report</a></td>";
                    echo "<td><a href='generate_pdf.php?id=" . $row['id'] . "'>Generate PDF</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No records found.</td></tr>";
            }
            ?>
        </table>
        <a href="admin_logout.php">Logout</a>
    </main>
    <footer>
        <p>&copy; 2024 IT Knowledge Centre. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
