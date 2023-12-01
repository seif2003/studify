<?php
// Check Auth 
require('../controllers/AuthController.php');
$authController = new AuthController();
$allowedRoles = ['student'];
$authController->checkAuthentication($allowedRoles);

include("student-header.php");

echo("           
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
                                    <p>Welcome to Studify! We’re thrilled to have you here. Studify is an online learning platform dedicated to providing quality educational resources to help students excel in their studies. Whether you’re a high school student looking to bolster your math skills, a college student needing help with a challenging course, or just someone who loves to learn, Studify has something for you. With a vast library of courses, tutorials, and study guides, we’re here to help you reach your educational goals. Start your learning journey with us today!</p>
                                    <p class='mb-0'>At Studify, we believe in the power of continuous learning and the transformation it can bring. Our mission is to make learning accessible to everyone, everywhere. We understand that each student is unique, and that’s why we offer a personalized learning experience tailored to your needs. Our interactive platform allows you to learn at your own pace, track your progress, and connect with experts and peers. We’re constantly updating our content to ensure it’s up-to-date and relevant. Join us at Studify, and let’s make learning an enjoyable journey together!</p>
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


                    <!-- Approach -->
                    <div class='card shadow mb-4'>
                        <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>My Courses</h6>
                        </div>
                        <div class='card-body'>
                            <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                CSS bloat and poor page performance. Custom CSS classes are used to create
                                custom components and custom utility classes.</p>
                            <p class='mb-0'>Before working with this theme, you should become familiar with the
                                Bootstrap framework, especially the utility classes.</p>
                        </div>
                    </div>
                   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->"
);

include("footer.php");

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
updatePieChart([15, 15, 70]);
</script>");