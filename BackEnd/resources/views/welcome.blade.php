<!DOCTYPE html>
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
        <div class="container mt-5">
            <h1 class="text-center mb-4">API Documentation</h1>
            <nav class="navbar navbar-expand-lg">
                <div class="centered-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab"
                                aria-controls="main" aria-selected="true">Main</a>
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
                        <li class="nav-item">
                            <a class="nav-link" id="controller5-tab" data-toggle="tab" href="#controller5"
                                role="tab" aria-controls="controller5" aria-selected="false">Download
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






    <body>
        <div class="container">
            <!-- Main page -->
            <div class="tab-content" id="myTabContent">



                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <h1>MAIN page</h1>
                </div>

                <!-- Controller 1 -->
                <div class="tab-pane fade" id="controller1" role="tabpanel" aria-labelledby="controller1-tab">


                    <h1>User Controller</h1>
                    <div class="api-card">
                        <h2>1.1 signup</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/auth/signup</h3>

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
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/auth/register</h3>








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
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/auth/login</h3>




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


                    <div class="api-card">
                        <h2>1.4 recoverRequest</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/auth/recover_request</h3>






                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The `recoverRequest(Request $request)` function takes a Request object as input,
                                    which includes the 'organization_id' input parameter. The function retrieves a
                                    volunteer user record from the database based on the `organization_id` input
                                    parameter, and checks whether the user exists and is registered. If the user exists
                                    and is registered, the function checks whether the user has already submitted a
                                    recovery request. If the user has not already submitted a recovery request, the
                                    function creates a new recovery request and returns a JSON response containing the
                                    status message "Recovery request sent successfully!". If the user has already
                                    submitted a recovery request, the function returns a JSON response with the status
                                    message "User has already submitted a request." If the user does not exist or is not
                                    registered, the function returns a JSON response with the relevant error message.
                                </p>
                            </div>
                        </div>


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
                                            <td>A Request object containing the 'organization_id' input parameter.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the status message if the recovery request is
                                                successful. The response includes the 'status' key with the status
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
                                            <td>Organization ID not found</td>
                                            <td>The organization ID provided in the request does not exist in the
                                                database.</td>
                                        </tr>
                                        <tr>
                                            <td>User is not registered</td>
                                            <td>The user with the provided organization ID is not registered.</td>
                                        </tr>
                                        <tr>
                                            <td>User has already submitted a request.</td>
                                            <td>The user with the provided organization ID has already submitted a
                                                recovery request.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!---------------------------------------------------------------------->

                    <div class="api-card">
                        <h2>1.5 changePassword</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/auth/change_password</h3>



                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The changePassword(Request $request) function takes a Request object as input,
                                    which includes the 'organization_id', 'password', and 'confirm_password' input
                                    parameters. The function first validates the input parameters. Then, it
                                    retrieves
                                    the user ID from the organization ID of the request, and checks the user's
                                    recover
                                    request status. If the status is false(0), it returns an error response stating
                                    that
                                    the password recovery request has not been accepted. If the status is null, it
                                    returns an error response stating that the user has not submitted a password
                                    recovery request. If the status is true(1), the function proceeds with changing
                                    the
                                    user's password. It updates the password field in the volunteer_user table and
                                    returns a JSON response containing the status message, "Password changed
                                    successfully!"</p>
                            </div>
                        </div>

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
                                            <td>A Request object containing the 'organization_id', 'password', and
                                                'confirm_password' input parameters.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the status message, "Password changed
                                                successfully!"</td>
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
                                            <td>User has not submitted a password recovery request</td>
                                            <td>The user has not submitted a password recovery request.</td>
                                        </tr>
                                        <tr>
                                            <td>Password recovery request has not been accepted</td>
                                            <td>The user's password recovery request has not been accepted.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!---------------------------------------------------------------------->


                    <div class="api-card">
                        <h2>1.6 checkRequestStatus</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/auth/check_request_status</h3>




                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The checkRequestStatus(Request $request) function takes a Request object as input,
                                    which
                                    includes the 'organization_id' input parameter. The function retrieves the volunteer
                                    user record from the database based on the 'organization_id', and checks if the user
                                    has
                                    already submitted a password recovery request. If the user has submitted a request,
                                    the
                                    function returns a JSON response indicating whether the request has been accepted or
                                    not. If the user has not submitted a request, the function returns a JSON response
                                    with
                                    an error message.</p>
                            </div>
                        </div>
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
                                            <td>A Request object containing the 'organization_id' input parameter.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the status message indicating whether the
                                                password recovery request has been accepted or not.</td>
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
                                            <td>User has not submitted a request.</td>
                                            <td>The user has not submitted a password recovery request yet.</td>
                                        </tr>
                                        <tr>
                                            <td>Request not yet accepted</td>
                                            <td>The password recovery request has been submitted but not yet accepted by
                                                the
                                                administrator.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!--------------------------------------------------------------------->


                    <div class="api-card">
                        <h2>1.7 logout</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/user/logout</h3>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The logout(Request $request) function takes a Request object as input and deletes the
                                    user's token from
                                    the database, effectively logging the user out of the application. The function then
                                    returns a JSON
                                    response with the status message "Logged out".</p>
                            </div>
                        </div>

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
                                            <td>A Request object</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the status message "Logged out".</td>
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
                                            <td>Unauthorized</td>
                                            <td>The user is not authorized to access this endpoint.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!--------------------------------------------------------------------->



                    <div class="api-card">
                        <h2>1.8 editProfile</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/user/edit_profile</h3>




                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The `editProfile` function takes a Request object as input, which includes the user
                                    profile information to be updated, such as the user's profile picture, username, and
                                    bio. The function first checks if the user exists in the database, and if not,
                                    returns an error response. If the user exists, the function validates the input data
                                    and updates the user's profile picture, username, and bio if provided. The updated
                                    profile picture file is saved to the storage and the hash name is stored in the
                                    database. Finally, the function returns a success response with the updated profile
                                    picture hash name.</p>
                            </div>
                        </div>

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
                                            <td>A Request object containing the user profile information to be updated.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Parameters:</h4>
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
                                            <td>A JSON response containing the status message and updated profile
                                                picture hash name if the profile is updated successfully. The response
                                                includes the 'status' key with the status message, 'message' key with
                                                the success message, and 'new_pic' key with the updated profile picture
                                                hash name.</td>
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
                                            <td>User not found</td>
                                            <td>The user does not exist in the database.</td>
                                        </tr>
                                        <tr>
                                            <td>Validation errors</td>
                                            <td>The input data provided does not pass validation. The response includes
                                                the 'errors' key with the validation errors.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>








                    <!--------------------------------------------------------------------->


                    <div class="api-card">
                        <h2>1.9 getUserInfo</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_user_info/{branch_id}/{user_id?}</h3>





                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getUserInfo function retrieves user information from the database based on the
                                    provided branch_id and user_id (optional) parameters. If no user is found, it
                                    returns an error response. If user_id is not provided, it returns an array of user
                                    objects, otherwise it returns a single user object. Password, field1, field2,
                                    created_at, and updated_at fields are removed from the user object(s), and a
                                    'user_type' field is added, indicating whether the user is an admin or volunteer.
                                </p>
                            </div>
                        </div>


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
                                            <td>branch_id</td>
                                            <td>int</td>
                                            <td>The ID of the branch to retrieve users for.</td>
                                        </tr>
                                        <tr>
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve information for (optional). If not
                                                provided, returns information for all users in the branch.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing either an array of user objects or a single
                                                user object, depending on whether user_id is provided. The response
                                                includes the 'status' key with the status message and other keys with
                                                user information, such as 'user_id', 'full_name', 'username',
                                                'user_bio', and 'user_type'.</td>
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
                                            <td>No user(s) found</td>
                                            <td>No user(s) were found in the database based on the provided branch_id
                                                and user_id parameters.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>









                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                        <h2>1.10 getTrainingsInfo</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_trainings_info/{user_id}</h3>



                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getTrainingsInfo function retrieves information about a user's trainings based on
                                    their user_id. If the user is not found, it returns an error response. The function
                                    returns an array of trainings the user has taken, as well as an array of trainings
                                    they have not taken. Trainings are sorted by program ID and each training object
                                    includes an ID, name, description, and program ID. The function also returns the
                                    count of trainings the user has not taken and the count of trainings in each
                                    program.</p>
                            </div>
                        </div>

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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve training information for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing an array of trainings the user has taken, an
                                                array of trainings they have not taken, the count of trainings they have
                                                not taken, and the count of trainings in each program. The response
                                                includes the 'status' key with the status message and other keys with
                                                training information.</td>
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
                                            <td>User not found</td>
                                            <td>The user ID provided does not match any user in the database.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>









                    <!--------------------------------------------------------------------->




                    <div class="api-card">
                        <h2>1.11 getEventsOrganized</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_events_organized/{user_id}</h3>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getEventsOrganized function retrieves a list of events organized by the user with
                                    the provided user_id. It returns an error response if the user is not found, or a
                                    message indicating no events were found if the user did not organize any events. The
                                    response includes the 'status' key with the status message and an array of events
                                    organized by the user, sorted by date from newest to oldest. Each event includes the
                                    'id', 'event_date', 'event_title', 'program_id', 'event_type_id', and 'role_name'
                                    fields.</p>
                            </div>
                        </div>

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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve events for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing an array of events organized by the user,
                                                sorted by date from newest to oldest. The response includes the 'status'
                                                key with the status message and an array of events organized by the
                                                user, sorted by date from newest to oldest. Each event includes the
                                                'id', 'event_date', 'event_title', 'program_id', 'event_type_id', and
                                                'role_name' fields.</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database based on the provided user_id
                                                parameter.</td>
                                        </tr>
                                        <tr>
                                            <td>No events found for this user</td>
                                            <td>No events were found for the user with the provided user_id parameter.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>







                    <!--------------------------------------------------------------------->



                    <div class="api-card">
                        <h2>1.12 getEventsOrganizedCount</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_events_organized_count/{user_id}</h3>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getEventsOrganizedCount function retrieves the total number of events organized
                                    by a user based on the provided user_id parameter. If no user is found, it returns
                                    an error response. If the user has not organized any events, it returns a response
                                    with a message indicating that no events were found.</p>
                            </div>
                        </div>

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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve information for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the total number of events organized by the
                                                user. The response includes the 'status' key with the status message and
                                                'total_events' key with the count of events.</td>
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
                                            <td>No user found</td>
                                            <td>No user was found in the database based on the provided user_id
                                                parameter.</td>
                                        </tr>
                                        <tr>
                                            <td>No events found for this user</td>
                                            <td>The user has not organized any events.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>








                    <!--------------------------------------------------------------------->



                    <div class="api-card">
                        <h2>1.13 getTotalVolunteeringTime</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_total_volunteering_time/{user_id}</h3>



                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getTotalVolunteeringTime function calculates and returns the total amount of time
                                    the specified user has volunteered, based on their user_start_date and user_end_date
                                    (if provided) fields in the database. It returns a response in JSON format,
                                    including a 'status' key with the status message and a 'total_time' key with the
                                    total volunteering time in the format of "[years] Y [months] M".</p>
                            </div>
                        </div>

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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve volunteering time for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing a 'status' key with the status message and a
                                                'total_time' key with the total volunteering time in the format of
                                                "[years] Y [months] M".</td>
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
                                            <td>User not found</td>
                                            <td>The specified user_id parameter does not correspond to a valid user in
                                                the database.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!--------------------------------------------------------------------->


                    <div class="api-card">
                        <h2>1.14 getCompletedTrainingsCount</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_completed_trainings_count/{user_id}</h3>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getCompletedTrainingsCount function retrieves the total count of completed
                                    trainings for a given user based on the provided user_id parameter. If no user is
                                    found, it returns an error response. It returns the total count of completed
                                    trainings as a JSON response.</p>
                            </div>
                        </div>
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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve the completed trainings count for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the total count of completed trainings for
                                                the given user. The response includes the 'total_trainings' key with the
                                                total count of completed trainings.</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database based on the provided user_id
                                                parameter.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!--------------------------------------------------------------------->

                    <div class="api-card">
                        <h2>1.15 getPostsCount</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_posts_count/{user_id}</h3>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getPostsCount function returns the total count of posts for the given user_id.
                                </p>
                            </div>
                        </div>
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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve post count for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the 'total_posts' key with the total count of
                                                posts for the given user_id.</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database based on the provided user_id
                                                parameter.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                    <!--------------------------------------------------------------------->


                    <div class="api-card">
                        <h2>1.16 getCommentsCount</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_comments_count/{user_id}</h3>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getCommentsCount function retrieves the total number of comments made by the user
                                    with the provided user_id parameter. If no user is found, it returns an error
                                    response.</p>
                            </div>
                        </div>

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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve the total number of comments for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the total number of comments made by the user
                                                with the provided user_id parameter. The response includes the
                                                'total_comments' key with the count of comments.</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database with the provided user_id parameter.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>






                    <!--------------------------------------------------------------------->


                    <div class="api-card">
                        <h2>1.17 getTotalLikesReceived</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_total_likes_received/{user_id}</h3>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getTotalLikesReceived function returns the total number of likes received by the
                                    given user_id, which includes the sum of likes on posts and comments.</p>
                            </div>
                        </div>
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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve the total number of likes received for.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the 'total_likes_received' key with the total
                                                number of likes received by the given user_id.</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database based on the provided user_id
                                                parameter.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>









                    <!--------------------------------------------------------------------->

                    <div class="api-card">
                        <h2>1.18 getOwnPosts</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_own_posts/{user_id}</h3>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getOwnPosts function returns all the posts created by the user with the given user_id.</p>
                            </div>
                        </div>
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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve the posts for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing an array of posts that the user with the given user_id has created. Each post includes the following fields: id, post_title, post_body, post_date, full_name (full name of the user who created the post).</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database based on the provided user_id parameter.</td>
                                        </tr>
                                        <tr>
                                            <td>No posts found for this user</td>
                                            <td>The user with the given user_id did not create any posts.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                    <!--------------------------------------------------------------------->



                    <div class="api-card">
                        <h2>1.19 getBranchInfo</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/user/get_branch_info/{user_id}</h3>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The getBranchInfo function retrieves the branch information of a given user_id by matching the user's branch_id with the id in the branch table.</p>
                            </div>
                        </div>
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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user to retrieve the branch information for.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response containing the 'branch_name' key with the name of the branch and the 'branch_location' key with the location of the branch matching the user's branch_id.</td>
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
                                            <td>User not found</td>
                                            <td>No user was found in the database based on the provided user_id parameter.</td>
                                        </tr>
                                        <tr>
                                            <td>Branch not found</td>
                                            <td>No branch was found in the database based on the user's branch_id.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           
                    <!--------------------------------------------------------------------->

                    <!--------------------------------------------------------------------->





                <!-- Controller 2 -->
                <div class="tab-pane fade" id="controller2" role="tabpanel" aria-labelledby="controller2-tab">
                    <!-- Content for Controller 2 -->

                </div>




























                

                    <!--------------------------------------------------------------------->
                    <!--------------------------------------------------------------------->

                
                <!-- Controller 3 -->
                <div class="tab-pane fade" id="controller3" role="tabpanel" aria-labelledby="controller3-tab">
                    <!-- Content for Controller 3 -->

                    <h1>Post Controller</h1>

                    <div class="api-card">
                        <h2>3.1 createPost</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/post/create_post</h3>


                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Description:</h4>
                            </div>
                            <div class="card-body">
                                <p>The createPost function creates a new post in the database with the specified user ID, post type, and caption.</p>
                                <p>If the post type is "image", the function requires an uploaded file as "post_media".</p>
                            </div>
                        </div>

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
                                            <td>user_id</td>
                                            <td>int</td>
                                            <td>The ID of the user creating the post.</td>
                                        </tr>
                                        <tr>
                                            <td>post_type</td>
                                            <td>string</td>
                                            <td>The type of the post. Must be one of "text" or "image".</td>
                                        </tr>
                                        <tr>
                                            <td>post_caption</td>
                                            <td>string</td>
                                            <td>The caption for the post. Required if the post type is "text".</td>
                                        </tr>
                                        <tr>
                                            <td>post_media</td>
                                            <td>file</td>
                                            <td>The file to upload for the post media. Required if the post type is "image.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td>A JSON response indicating whether the post was created successfully, and including the post ID if successful.</td>
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
                                            <td>User not found</td>
                                            <td>The user ID provided in the request does not exist in the database.</td>
                                        </tr>
                                        <tr>
                                            <td>Invalid post type</td>
                                            <td>The post_type field in the request must be one of: text or image.</td>
                                        </tr>
                                        <tr>
                                            <td>Invalid file type</td>
                                            <td>If the post_type is 'image', the post_media field must be an image file (JPEG, BMP, PNG, or JPG).</td>
                                        </tr>
                                        <tr>
                                            <td>Missing required fields</td>
                                            <td>The user_id and post_type fields are required in the request. If the post_type is 'text', the post_caption field is also required.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                        <!--------------------------------------------------------------------->
                        <div class="api-card">
                            <h2>3.2 editPost</h2>
                            <h3>POST</h3>
                            <h3>http://example.com/api/v0.1/post/edit_post</h3>
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
                                                <td>Request</td>
                                                <td>Request object</td>
                                                <td>A Request object containing the following input parameters:</td>
                                            </tr>
                                            <tr>
                                                <td>post_id</td>
                                                <td>Integer</td>
                                                <td>The ID of the post to be edited.</td>
                                            </tr>
                                            <tr>
                                                <td>post_caption</td>
                                                <td>String</td>
                                                <td>The new caption for the post.</td>
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
                                <p>The <code>editPost(Request $request)</code> function takes a Request object as input, which includes the post ID and the new caption for the post. The function checks if the post exists in the database based on the post ID. If the post exists, the function updates the post's caption to the new value. If the update is successful, the function returns a JSON response with a "Post updated successfully" message. If the update fails, the function returns a JSON response with a "Post could not be updated" message.</p>
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
                                            <td>A JSON response containing a status message. The response has two key-value pairs, where the keys are 'status' and 'message', and the values are the status message.</td>
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
                                            <td>Post not found</td>
                                            <td>If the post with the specified ID does not exist in the database.</td>
                                        </tr>
                                        <tr>
                                            <td>Post could not be updated</td>
                                            <td>If the post caption could not be updated in the database.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                         <!------------------------------------------------------------------>

                         <div class="api-card">
                        <h2>3.3 deletePost</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/post/delete_post</h3>
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
                                            <td>Request</td>
                                            <td>Request object</td>
                                            <td>A Request object containing the following input parameters:</td>
                                        </tr>
                                        <tr>
                                            <td>post_id</td>
                                            <td>Integer</td>
                                            <td>The ID of the post to be deleted.</td>
                                        </tr>
                                        <tr>
                                            <td>user_id</td>
                                            <td>Integer</td>
                                            <td>The ID of the user who wants to delete the post.</td>
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
                            <p>The <code>deletePost(Request $request)</code> function takes a Request object as input, which includes the post ID and the ID of the user who wants to delete the post. The function checks if the post exists in the database based on the post ID. If the post exists, the function checks if the user ID from the request matches the user ID of the post. If the user ID matches, the function deletes the post, as well as all associated likes, comments, and replies from the database. If the delete is successful, the function returns a JSON response with a "Post deleted successfully" message. If the delete fails, the function returns a JSON response with a "Post could not be deleted" message.</p>
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
                                        <td>A JSON response containing a status message. The response has two key-value pairs, where the keys are 'status' and 'message', and the values are the status message.</td>
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
                                        <td>Post not found</td>
                                        <td>If the post with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>You are not authorized to delete this post</td>
                                        <td>If the user ID from the request does not match the user ID of the post.</td>
                                        </tr>
                                    <tr>
                                    <td>Post could not be deleted</td>
                                <td>If the post could not be deleted from the database.</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.4 getPosts</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/post/get_posts/{user_id?}</h3>
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
                                        <td>user_id</td>
                                        <td>Integer</td>
                                        <td>The ID of the user whose posts will be retrieved. If not provided, all posts will be retrieved.</td>
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
                        <p>The <code>getPosts($user_id = null)</code> function retrieves posts from the database based on the user ID. If a user ID is provided, the function checks if the user exists in the database. If the user does not exist, the function returns an error response. If no user ID is provided, the function retrieves all posts from the database. The retrieved posts are sorted in descending order based on the post date. The function removes unwanted fields from each post and retrieves the name, profile picture, and username of the post owner based on the user ID. If no user is found for a post, the function returns null. The function returns a JSON response containing a status message, and an array of post objects, each containing the post details and the user details.</p>
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
                                    <td>A JSON response containing a status message, and an array of post objects, each containing the post details and the user details. The response has three key-value pairs, where the keys are 'status', 'message', and 'posts', and the values are the status message, the message explaining the result of the API request, and the array of post objects respectively.</td>
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
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>No posts found</td>
                                    <td>If no posts were found in the database.</td>
                                </tr>
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
                                <td>User not found</td>
                                <td>If the user with the specified ID does not exist in the database.</td>
                            </tr>
                            <tr>
                                <td>No posts found</td>
                                <td>If no posts were found in the database.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

                    <!--------------------------------------------------------------------->

                    <div class="api-card">
                    <h2>3.5 getPost</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/post/get_post/{post_id}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The getPost() function retrieves a single post from the database based on the post ID provided in the
                                URL parameter. If the post is found, the function returns the post data along with the name of the user who
                                posted the post. If the post is not found, the function returns an error response.</p>
                        </div>
                    </div>
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
                                    <td>post_id</td>
                                    <td>integer</td>
                                    <td>The ID of the post to retrieve from the database.</td>
                                </tr>
                            </tbody>
                        </table>
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
                                    <td>A JSON response containing the post data and name of the user who posted the post. The
                                        response has three key-value pairs:
                                        <ul>
                                            <li>'status': A string indicating the status of the response, either "success" or "error".</li>
                                            <li>'message': A string containing a message describing the status of the response.</li>
                                            <li>'post': An object containing the post data and name of the user who posted the post.</li>
                                        </ul>
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
                                    <td>Post not found</td>
                                    <td>If the post with the specified ID does not exist in the database.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                        <h2>3.6 likePost</h2>
                        <h3>POST</h3>
                        <h3>http://example.com/api/v0.1/post/like_post</h3>
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
                                        <td>post_id</td>
                                        <td>integer</td>
                                        <td>The ID of the post to like</td>
                                    </tr>
                                    <tr>
                                        <td>user_id</td>
                                        <td>integer</td>
                                        <td>The ID of the user liking the post</td>
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
                            <p>The likePost() function is used to like a post. The function takes in the post ID and user ID as parameters and checks if both the post and the user exist in the database. If either the post or the user is not found, the function returns an error response. If the user has already liked the post, the function returns an error response. If the user has not liked the post yet, a new like instance is created with the post ID, user ID, and the current date, and is saved to the database. If the like is saved successfully, the function increments the post like count and returns a success response. If the like cannot be saved, the function returns an error response. If the post like count cannot be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the like was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                        <td>Post not found</td>
                                        <td>If the post with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>You have already liked this post</td>
                            <td>If the user has already liked the post.</td>
                            </tr>
                            <tr>
                                <td>success</td>
                                <td>If the post was liked successfully.</td>
                            </tr>
                            <tr>
                                <td>error</td>
                                td>If the post could not be liked or the like count could not be updated.</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.7 unlikePost</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/unlike_post</h3>

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
                                        <td>post_id</td>
                                        <td>int</td>
                                        <td>The ID of the post to unlike</td>
                                    </tr>
                                    <tr>
                                        <td>user_id</td>
                                        <td>int</td>
                                        <td>The ID of the user unliking the post</td>
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
                            <p>The unlikePost API function unlikes a post by a user. The function takes in two parameters: the post ID and the user ID. If the post and user exist in the database, the function checks if the user has already liked the post. If the user has not liked the post, the function returns an error response. If the user has liked the post, the function deletes the like from the database, decrements the post like count, and returns a success response. If the like could not be deleted or the post like count could not be updated, the function returns an error response.</p>
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
                                        <td>A JSON response containing the status of the unlike operation and a message. The response has two key-value pairs: 'status' and 'message'.</td>
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
                                        <td>Post not found</td>
                                        <td>If the post with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>You have not liked this post</td>
                                        <td>If the user has not liked the post.</td>
                                    </tr>
                                    <tr>
                                        <td>Post could not be unliked</td>
                                        <td>If the like instance could not be deleted from the database.</td>
                                        </tr>
                                        <tr>
                                    <td>Post like count could not be updated</td>
                                    <td>If the like instance was successfully deleted from the database but the post like count could not be decremented.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.8 commentPost</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/comment_post</h3>
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
                                    <td>post_id</td>
                                    <td>integer</td>
                                    <td>The ID of the post to comment on</td>
                                </tr>
                                <tr>
                                    <td>user_id</td>
                                    <td>integer</td>
                                    <td>The ID of the user making the comment</td>
                                </tr>
                                <tr>
                                    <td>comment_content</td>
                                    <td>string</td>
                                    <td>The content of the comment</td>
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
                        <p>The `commentPost()` function is used to create a new comment on a post. The function takes in the post ID, user ID, and comment content as parameters and validates them. If any of the parameters are missing, the function returns an error response. If both the post and the user exist in the database, the function creates a new comment instance with the post ID, user ID, comment content, current date, and default values for the comment like count and reply count. The comment is then saved to the database. If the comment is saved successfully, the function increments the post comment count and returns a success response. If the comment cannot be saved, the function returns an error response. If the post comment count cannot be updated, the function returns an error response.</p>
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
                                    <td>A JSON response indicating whether the comment was posted successfully or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                    <td>Post not found</td>
                                    <td>If the post with the specified ID does not exist in the database.</td>
                              </tr>
                                <tr>
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>Comment could not be posted</td>
                                    <td>If the comment instance could not be saved to the database.</td>
                                </tr>
                                <tr>
                                    <td>Post comment count could not be updated</td>
                                    <td>If the comment instance was successfully saved to the database but the post comment count could not be incremented.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                <h2>3.9 replyComment</h2>
                <h3>POST</h3>
                <h3>http://example.com/api/v0.1/post/reply_comment</h3>

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
                                    <td>comment_id</td>
                                    <td>int</td>
                                    <td>The ID of the comment to reply to</td>
                                </tr>
                                <tr>
                                    <td>user_id</td>
                                    <td>int</td>
                                    <td>The ID of the user replying to the comment</td>
                                </tr>
                                <tr>
                                    <td>reply_content</td>
                                    <td>string</td>
                                    <td>The content of the reply</td>
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
                        <p>The replyComment API function is used to reply to a comment. The function takes in the comment ID, user ID, and reply content as parameters and checks if both the comment and the user exist in the database. If either the comment or the user is not found, the function returns an error response. If the user has not replied to the comment yet, a new reply instance is created with the comment ID, user ID, and the current date, and is saved to the database. If the reply is saved successfully, the function increments the comment reply count and returns a success response. If the reply cannot be saved, the function returns an error response. If the comment reply count cannot be updated, the function returns an error response.</p>
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
                                    <td>A JSON response indicating whether the reply was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                    <td>Comment not found</td>
                                    <td>If the comment with the specified ID does not exist in the database.</td>
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>success</td>
                                    <td>If the reply was posted successfully.</td>
                                </tr>
                                <tr>
                                    <td>error</td>
                                    <td>If the reply could not be posted or the comment reply count could not be updated.</td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.10 likeComment</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/like_comment</h3>

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
                                        <td>comment_id</td>
                                        <td>integer</td>
                                        <td>The ID of the comment to like</td>
                                    </tr>
                                    <tr>
                                        <td>user_id</td>
                                        <td>integer</td>
                                        <td>The ID of the user liking the comment</td>
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
                            <p>The likeComment() function is used to like a comment. The function takes in the comment ID and user ID as parameters and checks if both the comment and the user exist in the database. If either the comment or the user is not found, the function returns an error response. If the user has already liked the comment, the function returns an error response. If the user has not liked the comment yet, a new Comment_like instance is created with the comment ID, user ID, and the current date, and is saved to the database. If the like is saved successfully, the function increments the comment like count and returns a success response. If the like cannot be saved, the function returns an error response. If the comment like count cannot be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the like was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                        <td>Comment not found</td>
                                        <td>If the comment with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                        </tr>
                                        <tr>
                                        <td>You have already liked this comment</td>
                                        <td>If the user has already liked the comment.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                <h2>3.11 unlikeComment</h2>
                <h3>POST</h3>
                <h3>http://example.com/api/v0.1/post/unlike_comment</h3>
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
                                <td>comment_id</td>
                                <td>integer</td>
                                <td>The ID of the comment to unlike</td>
                            </tr>
                            <tr>
                                <td>user_id</td>
                                <td>integer</td>
                                <td>The ID of the user unliking the comment</td>
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
                    <p>The unlikeComment() function is used to unlike a comment. The function takes in the comment ID and user ID as parameters and checks if both the comment and the user exist in the database. If either the comment or the user is not found, the function returns an error response. If the user has not already liked the comment, the function returns an error response. If the user has already liked the comment, the corresponding Comment_like instance is deleted from the database. If the like is deleted successfully, the function decrements the comment like count and returns a success response. If the like cannot be deleted, the function returns an error response. If the comment like count cannot be updated, the function returns an error response.</p>
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
                                <td>A JSON response indicating whether the unlike was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                <td>Comment not found</td>
                                <td>If the comment with the specified ID does not exist in the database.</td>
                            </tr>
                            <tr>
                                <td>User not found</td>
                                <td>If the user with the specified ID does not exist in the database.</td>
                            </tr>
                            <tr>
                                <td>You have not liked this comment</td>
                            <td>If the user has not liked the comment yet and tries to unlike it.</td>
                            </tr>
                            <tr>
                            <td>Comment not found</td>
                            <td>If the comment with the specified ID does not exist in the database.</td>
                            </tr>
                            <tr>
                            <td>User not found</td>
                            <td>If the user with the specified ID does not exist in the database.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.12 deleteComment</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/delete_comment</h3>
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
                                    <td>comment_id</td>
                                    <td>integer</td>
                                    <td>The ID of the comment to delete</td>
                                </tr>
                                <tr>
                                    <td>user_id</td>
                                    <td>integer</td>
                                    <td>The ID of the user deleting the comment</td>
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
                    <p>The deleteComment() function is used to delete a comment. The function takes in the comment ID and user ID as parameters and checks if both the comment and the user exist in the database. If either the comment or the user is not found, the function returns an error response. If the user is not the owner of the comment, the function returns an error response. The function deletes the comment and all associated likes and replies from the database. If the comment is deleted successfully, the function decrements the comment count of the post associated with the comment and returns a success response. If the comment cannot be deleted, the function returns an error response. If the post comment count cannot be updated, the function returns an error response.</p>
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
                                <td>A JSON response indicating whether the comment was deleted successfully or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                <td>Comment not found</td>
                                <td>If the comment with the specified ID does not exist in the database.</td>
                            </tr>
                            <tr>
                                <td>User not found</td>
                                <td>If the user with the specified ID does not exist in the database.</td>
                            </tr>
                            <tr>
                                <td>You are not the owner of this comment</td>
                                <td>If the user trying to delete the comment is not the owner of the comment.</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
         
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.13 deleteReply</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/delete_reply</h3>
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
                                        <td>reply_id</td>
                                        <td>integer</td>
                                        <td>The ID of the reply to delete</td>
                                    </tr>
                                    <tr>
                                        <td>user_id</td>
                                        <td>integer</td>
                                        <td>The ID of the user deleting the reply</td>
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
                            <p>The deleteReply() function is used to delete a reply. The function takes in the reply ID and user ID as parameters and checks if both the reply and the user exist in the database. If either the reply or the user is not found, the function returns an error response. If the user is not the owner of the reply, the function returns an error response. If the user is the owner of the reply, the corresponding Reply instance is deleted from the database. If the reply is deleted successfully, the function decrements the comment reply count and returns a success response. If the comment reply count cannot be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the deletion was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                        <td>Reply not found</td>
                                        <td>If the reply with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>You are not the owner of this reply</td>
                                        <td>If the user trying to delete the reply is not the owner of the reply.</td>
                                        </tr>
                                        <tr>
                                        <td>Reply not found</td>
                                        <td>If the reply with the specified ID does not exist in the database.</td>
                                        </tr>
                                        <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.14 editComment</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/edit_comment</h3>
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
                                        <td>comment_id</td>
                                        <td>integer</td>
                                        <td>The ID of the comment to edit</td>
                                    </tr>
                                    <tr>
                                        <td>user_id</td>
                                        <td>integer</td>
                                        <td>The ID of the user editing the comment</td>
                                    </tr>
                                    <tr>
                                        <td>comment_content</td>
                                        <td>string</td>
                                        <td>The new content of the comment</td>
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
                            <p>The editComment() function is used to edit a comment. The function takes in the comment ID, user ID, and new comment content as parameters and checks if both the comment and the user exist in the database. If either the comment or the user is not found, the function returns an error response. If the user is not the owner of the comment, the function returns an error response. If the user is the owner of the comment, the corresponding Comment instance is updated with the new content. If the update is successful, the function returns a success response. If the update cannot be performed, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the edit was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                        <td>Comment not found</td>
                                        <td>If the comment with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                    <td>You are not the owner of this comment</td>
                                    <td>If the user trying to edit the comment is not the owner of the comment.</td>
                                </tr>
                            </tbody>
                        </table>
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
                                    <td>A JSON response indicating whether the update was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                    <td>Comment not found</td>
                                    <td>If the comment with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>You are not the owner of this comment</td>
                                    <td>If the user trying to edit the comment is not the owner of the comment.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.15 editReply</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/edit_reply</h3>
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
                                        <td>reply_id</td>
                                        <td>integer</td>
                                        <td>The ID of the reply to edit</td>
                                    </tr>
                                    <tr>
                                        <td>user_id</td>
                                        <td>integer</td>
                                        <td>The ID of the user editing the reply</td>
                                    </tr>
                                    <tr>
                                        <td>reply_content</td>
                                        <td>string</td>
                                        <td>The new content of the reply</td>
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
                        <p>The editReply() function is used to edit a reply. The function takes in the reply ID, user ID, and new content as parameters and checks if both the reply and the user exist in the database. If either the reply or the user is not found, the function returns an error response. If the user is not the owner of the reply, the function returns an error response. If the reply is found and the user is the owner, the reply content is updated with the new content and the function returns a success response. If the reply cannot be updated, the function returns an error response.</p>
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
                                    <td>A JSON response indicating whether the edit was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                    <td>Reply not found</td>
                                    <td>If the reply with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
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
                        <p>The editReply() function is used to edit a reply. The function takes in the reply ID, user ID, and new reply content as parameters and checks if both the reply and the user exist in the database. If either the reply or the user is not found, the function returns an error response. If the user is not the owner of the reply, the function returns an error response. If the user is the owner of the reply, the corresponding reply is updated with the new content in the database. If the reply is updated successfully, the function returns a success response. If the reply cannot be updated, the function returns an error response.</p>
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
                                    <td>A JSON response indicating whether the reply was edited successfully or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'message' provides additional information about the operation.</td>
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
                                    <td>Reply not found</td>
                                    <td>If the reply with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>You are not the owner of this reply</td>
                                    <td>If the user trying to edit the reply is not the owner of the reply.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.16 getComments</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/post/get_comments/{post_id}</h3>
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
                                        <td>post_id</td>
                                        <td>integer</td>
                                        <td>The ID of the post to retrieve comments for</td>
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
                            <p>The getComments() function is used to retrieve all comments associated with a given post. The function takes in a post ID as a parameter and checks if the post exists in the database. If the post is found, the function retrieves all comments associated with the post, removes any unnecessary fields, and retrieves the user who made the comment. If no comments are found, the function returns an error response. Otherwise, the function returns a success response along with the comments.</p>
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
                                    <td>A JSON response indicating whether the operation was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'comments' provides the list of comments associated with the post.</td>
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
                                    <td>Post not found</td>
                                    <td>If the post with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>No comments found for this post</td>
                                    <td>If no comments are associated with the post.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.17 getReplies</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/post/get_replies/{comment_id}</h3>
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
                                        <td>comment_id</td>
                                        <td>integer</td>
                                        <td>The ID of the comment to retrieve replies for</td>
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
                            <p>The getReplies() function is used to retrieve all replies for a given comment. The function takes in the comment ID as a parameter and checks if the comment exists in the database. If the comment is found, the function retrieves all the replies associated with it, removes unwanted fields, and gets user information for each reply. The function then returns a JSON response containing the replies or an error message if no replies were found for the comment.</p>
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
                                    <td>A JSON response indicating whether the operation was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'replies' provides an array of replies if any are found.</td>
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
                                    <td>Comment not found</td>
                                    <td>If the comment with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>No replies found for this comment</td>
                                    <td>If there are no replies associated with the comment in the database.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.18 getPostLikes</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/post/get_post_likes/{post_id}</h3>
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
                                        <td>post_id</td>
                                        <td>integer</td>
                                        <td>The ID of the post to retrieve likes for.</td>
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
                            <p>The getPostLikes() function is used to retrieve the likes associated with a post. The function takes in the post ID as a parameter and checks if the post exists in the database. If the post is found, the likes associated with the post are retrieved and returned. If no likes are found, the function returns an error response.</p>
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
                                    <td>A JSON response indicating whether the likes were retrieved successfully or not. The response has three key-value pairs, where 'status' indicates the status of the operation, 'likes' provides the retrieved likes, and 'total_likes' provides the total number of likes. The 'likes' key contains an array of like objects with the 'field1', 'field2', 'created_at', 'updated_at', and 'like_date' fields removed.</td>
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
                                    <td>Post not found</td>
                                    <td>If the post with the specified ID does not exist in the database.</td>
                                </tr>
                                <tr>
                                    <td>No likes found for this post</td>
                                    <td>If no likes are found for the post.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    <!--------------------------------------------------------------------->
                    <div class="api-card">
                    <h2>3.19 getCommentLikes</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/post/get_comment_likes/{comment_id}</h3>
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
                                        <td>comment_id</td>
                                        <td>integer</td>
                                        <td>The ID of the comment to get likes for</td>
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
                            <p>The getCommentLikes() function is used to get the likes for a specific comment. The function takes in the comment ID as a parameter and checks if the comment exists in the database. If the comment is found, the function retrieves the likes associated with the comment and removes unwanted fields. The function then returns the likes and the total like count. If no likes are found for the comment, the function returns an error response.</p>
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
                                    <td>A JSON response indicating whether the operation was successful or not. The response has two key-value pairs, where 'status' indicates the status of the operation and 'likes' provides an array of likes associated with the comment, and 'total_likes' gives the total number of likes for the comment.</td>
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
                                            <td>Comment not found</td>
                                            <td>If the comment with the specified ID does not exist in the database.</td>
                                        </tr>
                                        <tr>
                                            <td>No likes found for this comment</td>
                                            <td>If no likes are found for the comment.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>







                    <!--------------------------------------------------------------------->



                </div>

























            
          
      


            


                <!-- Controller 4 -->
                <div class="tab-pane fade" id="controller4" role="tabpanel" aria-labelledby="controller4-tab">
                    <!-- Content for Controller 4 -->
                </div>


                <!-- Controller 5 -->
                <div class="tab-pane fade" id="controller5" role="tabpanel" aria-labelledby="controller5-tab">
                    <!-- Content for Controller 5 -->
                    <h1>Download Controller</h1>
                    <div class="api-card">
                        <h2>5.1 downloadPictureByURL</h2>
                        <h3>GET</h3>
                        <h3>http://example.com/api/v0.1/event/download_picture_url/{pictureUrl}</h3>
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
                                            <td>pictureUrl</td>
                                            <td>String</td>
                                            <td>The URL of the picture to be downloaded.</td>
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
                            <p>The <code>downloadPictureByUrl($pictureUrl)</code> function takes a URL string as input, which includes the location of the picture to be downloaded. The function checks if the picture exists in the specified location on the server. If the picture exists, the function retrieves the picture, converts it to base64 format, and returns a JSON response containing the base64-encoded content. If the picture does not exist, the function returns a JSON response with a "Image not found" message.</p>
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
                                        <td>A JSON response containing the base64-encoded content of the picture. The response has a single key-value pair, where the key is 'data' and the value is the base64-encoded content of the picture.</td>
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
                                        <td>Image not found</td>
                                        <td>If the picture does not exist in the specified location on the server.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                </div>
                <!--------------------------------------------------------------------->
          


        </div>
        

    </div>
    </body>

</html>
