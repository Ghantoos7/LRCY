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
                                <p>If the post type is "image" or "video", the function requires an uploaded file as "post_media".</p>
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
                                            <td>The type of the post. Must be one of "text", "image", or "video".</td>
                                        </tr>
                                        <tr>
                                            <td>post_caption</td>
                                            <td>string</td>
                                            <td>The caption for the post. Required if the post type is "text".</td>
                                        </tr>
                                        <tr>
                                            <td>post_media</td>
                                            <td>file</td>
                                            <td>The file to upload for the post media. Required if the post type is "image" or "video".</td>
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
                                            <td>The post_type field in the request must be one of: text, image, or video.</td>
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





                         <!-----------------------1 api here------------------------------------------->
















                    <!--------------------------------------------------------------------->













                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->











                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->












                    <!--------------------------------------------------------------------->















                    


                    <!--------------------------------------------------------------------->
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
                </div>

          


        </div>
        

    </div>
    </body>

</html>
