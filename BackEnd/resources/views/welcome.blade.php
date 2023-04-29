<<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>API Documentation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }

            .navbar {
                background-color: #f5f5f5;
                border-bottom: 1px solid #0066cc;
            }

            .centered-tabs {
                display: flex;
                justify-content: center;
            }

            .header {
                background-color: #b11433;
                color: white;
                text-align: center;
                padding: 2rem;
                font-size: 2.5rem;
                font-weight: bold;
                margin-bottom: 2rem;
            }

            .container {
                max-width: 1000px;
                margin: 0 auto;
            }

            h2,
            h1 {
                color: #45579A;
                margin-top: 2rem;
                font-weight: bold;
            }

            .api-card {
                background-color: #fff;
                border-radius: 5px;
                padding: 1.5rem;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
                transition: transform 0.3s;
            }

            .api-card:hover {
                transform: translateY(-5px);
            }

            .api-card h3 {
                margin-bottom: 1rem;
            }

            .parameter-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 1rem;
            }

            th,
            td {
                border: 1px solid #ccc;
                padding: 0.5rem;
                text-align: left;
            }

            th {
                background-color: #45579A;
                color: white;
            }

            .nav-tabs {
                border-bottom: 1px solid #45579A;
            }

            .nav-tabs .nav-link {
                color: #45579A;
                border: 1px solid transparent;
                border-top-left-radius: .25rem;
                border-top-right-radius: .25rem;
                font-weight: bold;
                transition: background-color 0.3s;
            }

            .nav-tabs .nav-link:hover {
                background-color: #e9ecef;
            }

            .nav-tabs .nav-link.active {
                color: #495057;
                background-color: #fff;
                border-color: #45579A #45579A #fff;
            }
        </style>
    </head>

    <body>
        <div class="header">
            API Documentation
        </div>

        <div class="container">
            <!-- Main page -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <!-- Content for the main page -->
                </div>
                <!-- Controller 1 -->
                <div class="tab-pane fade" id="controller1" role="tabpanel" aria-labelledby="controller1-tab">
                    <h1>User Controller</h1>
                    <div class="api-card">
                        <h2>1.1 signup</h2>
                        <h3>Post</h3>
                        <h3>http://example.com/api/v0.1/auth/signup</h3>
                        <div class="card mb-3">
                            <div class="card-header">



                                <h4>Parameters:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$credentials</td>
                                            <td>Request</td>
                                            <td>A Request object containing the ‘organization_id’ input parameter.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The signup(Request $credentials) function takes a Request object as input, which
                                    includes the 'organization_id' input parameter. The function retrieves a volunteer
                                    user record from the database based on the 'organization_id' input parameter. If the
                                    record exists, the function determines the status message based on the registration
                                    status of the volunteer user. If the user is already registered, the status message
                                    will be "Organization ID found, user already registered". If the user is not
                                    registered, the status message will be "Organization ID found, user not registered".
                                    If the record does not exist, the status message will be "Organization ID not found"
                                </p>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Returns:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JSON</td>
                                            <td>A JSON response containing the status message based on the existence and
                                                registration status of the volunteer user. The response has a single
                                                key-value pair, where the key is 'status' and the value is the status
                                                message.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Errors:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Error</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Organization ID found, user already registered</td>
                                            <td>If the user exists and is already registered</td>
                                        </tr>
                                        <tr>
                                            <td>Organization ID not found</td>
                                            <td>If the user does not exist</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!---------------------------------------------------------------------->
                    <div class="api-card">
                        <h2>1.2 register</h2>
                        <h3>Post</h3>
                        <h3>http://example.com/api/v0.1/auth/register</h3>
                        <div class="card mb-3">
                            <div class="card-header">


                                <h4>Parameters:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$request</td>
                                            <td>Request</td>
                                            <td>A Request object containing the 'organization_id', 'username',
                                                'password', and 'confirm_password' input parameters.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The register(Request $request) function takes a Request object as input, which
                                    includes the 'organization_id', 'username', 'password', and 'confirm_password' input
                                    parameters. The function validates the input parameters and checks for password
                                    validity using the validatePassword() function. If the input is valid and the
                                    password meets the requirements, the function retrieves a volunteer user record from
                                    the database based on the 'organization_id' input parameter. If the user record
                                    exists and the user is not registered, it updates the user's registration status,
                                    username, and password, and saves the changes to the database. The function then
                                    returns a JSON response containing the status message, "Organization ID found, user
                                    registered successfully", and an authentication token.</p>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Returns:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JSON</td>
                                            <td>A JSON response containing the status message based on the existence,
                                                registration status, and input validation of the volunteer user. The
                                                response includes the 'status' key with the status message, and the
                                                'token' key with the authentication token if the user registration is
                                                successful.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Errors:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Error</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Invalid input</td>
                                            <td>Invalid input' with the associated validation errors
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Invalid password</td>
                                            <td>Invalid password' with the associated validation errors</td>
                                        </tr>
                                        <tr>
                                            <td>Organization ID not found</td>
                                            <td>If the user does not exist</td>
                                        </tr>

                                        <tr>
                                            <td>User already registered </td>
                                            <td>Organization ID found, user already registered</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!---------------------------------------------------------------------->

                    <div class="api-card">
                        <h2>1.3 login</h2>
                        <h3>Post</h3>
                        <h3>http://example.com/api/v0.1/auth/login</h3>
                        <div class="card mb-3">
                            <div class="card-header">


                                <h4>Parameters:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$credentials</td>
                                            <td>Request</td>
                                            <td>A Request object containing the 'organization_id' and 'password' input
                                                parameters.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The login(Request $credentials) function takes a Request object as input, which
                                    includes the 'organization_id' and 'password' input parameters. The function checks
                                    if the volunteer user exists in the database, is registered, and is active. It also
                                    verifies if the user has exceeded the maximum number of login attempts. If the user
                                    is allowed to log in and the password is correct, the function resets the user's
                                    login attempts, generates a new token, and returns a JSON response containing the
                                    status message, "Login successful", and the user information. If the password is
                                    incorrect, the function adds a failed login attempt to the database and returns a
                                    JSON response with the status message "Invalid credentials".</p>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Returns:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JSON</td>
                                            <td>A JSON response containing the status message and user information if
                                                the login is successful. The response includes the 'status' key with the
                                                status message, and other keys with user information such as 'token',
                                                'user_id', 'username', 'user_profile_pic', 'branch_id', and 'full_name'.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Errors:</h4>
                            </div>
                            <div class="card-body">
                                <table class="parameter-table">
                                    <thead>
                                        <tr>
                                            <th>Error</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Invalid credentials</td>
                                            <td>The user credentials provided in the request are invalid.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>The user credentials provided in the request are invalid.
                                            </td>
                                            <td>The user has exceeded the maximum number of login attempts allowed.</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!---------------------------------------------------------------------->





                    <!-- Add more API descriptions as needed -->
                </div>
                <!-- Controller 2 -->
                <div class="tab-pane fade" id="controller2" role="tabpanel" aria-labelledby="controller2-tab">
                    <!-- Content for Controller 2 -->

                </div>
                <!-- Controller 3 -->
                <div class="tab-pane fade" id="controller3" role="tabpanel" aria-labelledby="controller3-tab">
                    <!-- Content for Controller 3 -->
                </div>
            </div>

        </div>
        <!-- Controller 4 -->
        <div class="tab-pane fade" id="controller4" role="tabpanel" aria-labelledby="controller4-tab">
            <!-- Content for Controller 3 -->
        </div>
        </div>




        <body>
            <div class="container mt-5">
                <h1 class="text-center mb-4">API Documentation</h1>
                <nav class="navbar navbar-expand-lg">
                    <div class="centered-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main"
                                    role="tab" aria-controls="main" aria-selected="true">Main</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="controller1-tab" data-toggle="tab" href="#controller1"
                                    role="tab" aria-controls="controller1" aria-selected="false">User
                                    Controller</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="controller2-tab" data-toggle="tab" href="#controller2"
                                    role="tab" aria-controls="controller2" aria-selected="false">Event
                                    Controller</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="controller3-tab" data-toggle="tab" href="#controller3"
                                    role="tab" aria-controls="controller3" aria-selected="false">Post
                                    Controller</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="controller4-tab" data-toggle="tab" href="#controller4"
                                    role="tab" aria-controls="controller4" aria-selected="false">Admin
                                    Controller</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script>
                $(function() {
                    $('#myTab li:first-child a').tab('show');
                });
            </script>

        </body>

    </html>
