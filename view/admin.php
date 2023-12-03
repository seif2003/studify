<?php
// Check Auth admin
require_once('../controllers/AuthController.php');

$authController = new AuthController();
$allowedRoles = ['admin'];
$authController->checkAuthentication($allowedRoles);

include("admin-header.php");
echo("

                <!-- Begin Page Content -->
                <div class='container-fluid'>

                    <!-- Page Heading -->
                    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
                        <h1 class='h3 mb-0 text-gray-800'>Dashboard</h1>
                    </div>

                    
                    <!-- Content Row -->

                    <div class='row'>

                        <!-- Area Chart -->
                        <div class='col-xl-8 col-lg-7'>
                            <!-- Approach -->
                            <div class='card shadow mb-4'>
                                <div class='card-header py-3'>
                                    <h6 class='m-0 font-weight-bold text-primary'>Welcome</h6>
                                </div>
                                <div class='card-body'>
                                    <p>Welcome to Studify, Admin! We’re delighted to have you onboard. As an admin, you play a crucial role in shaping the educational journey of our students. Your expertise and dedication contribute to making Studify a leading online learning platform.</p>
                                    <p class='mb-0'>At Studify, we’re committed to providing high-quality educational resources, and as an admin, you’re at the forefront of this mission. You have the privilege to add, edit, or delete courses, ensuring our content remains up-to-date, relevant, and engaging. Whether it’s a course on high school math or a tutorial on a complex college subject, your contributions make a difference in our students’ learning experiences.</p>
                                    <p class='mb-0'>Our platform is interactive and user-friendly, allowing you to manage courses efficiently. You can track the progress of courses, receive feedback from students, and continuously improve the content based on their needs. Remember, your work here at Studify has the potential to impact thousands of students worldwide.</p>
                                    <p class='mb-0'>We’re excited to see the incredible courses you’ll create and the innovative ideas you’ll bring to our platform. Together, let’s make Studify a vibrant learning community and transform education for everyone, everywhere. Welcome to the team!</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class='col-xl-4 col-lg-5'>
                            <div class='card shadow mb-4'>
                                <!-- Card Header - Dropdown -->
                                <div
                                    class='card-header py-3 d-flex flex-row align-items-center justify-content-between'>
                                    <h6 class='m-0 font-weight-bold text-primary'>Progress</h6>

                                </div>
                                <!-- Card Body -->
                                <div style='width: 90%; margin: auto;'>
                                    <canvas id='myPieChart2'></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            ");
include('footer.php');
$courseprogressarray = $courseProgressController->getAllCourseProgress();
$notStartedCount = $courseProgressController->countCoursesWithStatus($userId, 'Not Started');
$inProgressCount = $courseProgressController->countCoursesWithStatus($userId, 'In Progress');
$completedCount = $courseProgressController->countCoursesWithStatus($userId, 'Completed');


echo("<script>
// Sample data for the pie chart
var data = {
    datasets: [{
        data: [0, 0, 0], // Change these values to update the pie chart
        backgroundColor: ['#e74a3b', '#f6c23e', '#1cc88a']
    }],
    labels: ['Not Started', 'In Progress', 'Completed']
};

// Get the context of the canvas element
var ctx = document.getElementById('myPieChart2').getContext('2d');

// Initialize the pie chart with the sample data
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: data
});

// Example: Update the pie chart data dynamically
function updatePieChart(newData) {
    myPieChart.data.datasets[0].data = newData;
    myPieChart.update(); // Update the chart to reflect the changes
}

// Example usage: Update the pie chart with new data [20, 30, 50]
updatePieChart([$notStartedCount, $inProgressCount, $completedCount]);
</script>");