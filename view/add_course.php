<?php
// Check Auth admin
require_once('../controllers/AuthController.php');

$authController = new AuthController();
$allowedRoles = ['admin'];
$authController->checkAuthentication($allowedRoles);

include("admin-header.php");
echo("
                <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy='origin'></script>
                <script>
                tinymce.init({
                    selector: '#mytextarea'
                });
                </script>
                <!-- Begin Page Content -->
                <div class='container-fluid'>

                    <!-- Page Heading -->
                    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
                        <h1 class='h3 mb-0 text-gray-800'>Courses</h1>
                    </div>
                        <!-- Area Chart -->
                            <!-- Approach -->
                            <div class='card shadow mb-4'>
                                <div class='card-header py-3'>
                                    <h6 class='m-0 font-weight-bold text-primary'>Add</h6>
                                </div>
                                <div style='padding:10px;'>");
                                if (isset($_GET['error'])) {
                                    echo "<p class='border-bottom-danger'>" . $_GET['error'] . "</p>";
                                }
                                if (isset($_GET['message'])) {
                                    echo "<p class='border-bottom-success'>" . $_GET['message'] . "</p>";
                                }

echo("</div>
                                <div class='card-body'>
                                    <form method='POST' action='add_course_action.php' enctype='multipart/form-data'>
                                        <input type='text' class='form-control form-control-user' name='title' id='title' placeholder='Course Title'><br>
                                        <input type='text' class='form-control form-control-user' name='description' id='description' placeholder='Course Description'><br>
                                        <textarea id='mytextarea' name='content' rows='25'></textarea>
                                        <div class='mb-3'>
                                        <label for='formFile' class='form-label'>ajouter fichier</label>
                                        <input class='form-control' type='file' id='formFile' name='file'>
                                        </div>
                                        <br>
                                        <button class='btn btn-primary btn-user btn-block' type='submit'>
                                            Add Course
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            ");
include('footer.php');