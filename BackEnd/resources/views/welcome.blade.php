<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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
        <h1 class="text-center mb-4 animate__animated animate__fadeIn">API Documentation</h1>

        <nav class="navbar navbar-expand-lg">
            <div class="centered-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab"
                            aria-controls="main" aria-selected="true">Main</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="controller1-tab" data-toggle="tab" href="#controller1" role="tab"
                            aria-controls="controller1" aria-selected="false">User
                            Controller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="controller2-tab" data-toggle="tab" href="#controller2" role="tab"
                            aria-controls="controller2" aria-selected="false">Event
                            Controller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="controller3-tab" data-toggle="tab" href="#controller3" role="tab"
                            aria-controls="controller3" aria-selected="false">Post
                            Controller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="controller4-tab" data-toggle="tab" href="#controller4" role="tab"
                            aria-controls="controller4" aria-selected="false">Admin
                            Controller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="controller5-tab" data-toggle="tab" href="#controller5" role="tab"
                            aria-controls="controller5" aria-selected="false">Download
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
                <h1>Welcome to the Project API Documentation</h1>
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <p>This documentation provides you with information about the various APIs available in our system.
                        We have organized the APIs into five main categories:</p>
                    <ul>
                        <li><strong>User API (19):</strong> These APIs handle user-related tasks such as registration,
                            login, updating profiles, and stats about the user.</li>
                        <li><strong>Event API (5):</strong> These APIs deal with event-related tasks like creating,
                            updating, deleting, and retrieving event details.</li>
                        <li><strong>Post API (19):</strong> These APIs handle post-related tasks such as creating,
                            updating, deleting, and fetching posts, comments, and more.</li>
                        <li><strong>Admin API (22):</strong> These APIs are responsible for administrative tasks such as
                            managing users, events, and posts, as well as handling system settings.</li>
                        <li><strong>Download API (1):</strong> This API allows users to download files or resources from
                            the system.</li>
                    </ul>
                    <p>Please click on the respective tabs above to explore the available APIs and their respective
                        documentation. The documentation includes information about each API's functionality,
                        parameters, return values, and possible errors.</p>
                </div>



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
                            <p>The <code>signup(Request $credentials)</code> function takes a Request object as input,
                                which
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
                            <p>The <code>register(Request $request)</code> function takes a Request object as input,
                                which
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
                            <p>The <code>login(Request $credentials)</code> function takes a Request object as input,
                                which
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
                            <p>The <code>recoverRequest(Request $request)</code> function takes a Request object as
                                input,
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
                            <p>The <code>changePassword(Request $request)</code> function takes a Request object as
                                input,
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
                            <p>The <code>checkRequestStatus(Request $request)</code> function takes a Request object as
                                input,
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
                            <p>The <code>logout(Request $request)</code> function takes a Request object as input and
                                deletes the
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
                            <p>The <code>editProfile</code> function takes a Request object as input, which includes the
                                user
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
                            <p>The <code>getUserInfo</code> function retrieves user information from the database based
                                on the
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
                            <p>The <code>getTrainingsInfo</code> function retrieves information about a user's trainings
                                based on
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
                            <p>The <code>getEventsOrganized</code> function retrieves a list of events organized by the
                                user with
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
                            <p>The <code>getEventsOrganizedCount</code> function retrieves the total number of events
                                organized
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
                            <p>The <code>getTotalVolunteeringTime</code> function calculates and returns the total
                                amount of time
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
                            <p>The <code>getCompletedTrainingsCount</code> function retrieves the total count of
                                completed
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
                            <p>The <code>getPostsCount</code> function returns the total count of posts for the given
                                user_id.
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
                            <p>The <code>getCommentsCount</code> function retrieves the total number of comments made by
                                the user
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
                            <p>The <code>getTotalLikesReceived</code> function returns the total number of likes
                                received by the
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
                            <p>The <code>getOwnPosts </code>function returns all the posts created by the user with the
                                given user_id.</p>
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
                                        <td>A JSON response containing an array of posts that the user with the given
                                            user_id has created. Each post includes the following fields: id,
                                            post_title, post_body, post_date, full_name (full name of the user who
                                            created the post).</td>
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
                                        <td>No user was found in the database based on the provided user_id parameter.
                                        </td>
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
                            <p>The <code>getBranchInfo </code>function retrieves the branch information of a given
                                user_id by matching the user's branch_id with the id in the branch table.</p>
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
                                        <td>A JSON response containing the 'branch_name' key with the name of the branch
                                            and the 'branch_location' key with the location of the branch matching the
                                            user's branch_id.</td>
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
                                        <td>No user was found in the database based on the provided user_id parameter.
                                        </td>
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
                <h1>Event Controller</h1>


                <div class="api-card">
                    <h2>2.1 getYearlyGoals</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/event/get_yearly_goals/{branch_id}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getYearlyGoals</code> function returns the yearly goals for a given branch_id.
                                The goals are grouped based on the program_id.</p>
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
                                        <td>The ID of the branch to retrieve yearly goals for.</td>
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
                                        <td>A JSON response containing the yearly goals grouped by program_id.</td>
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
                                        <td>No goals found</td>
                                        <td>No goals were found in the database based on the provided branch_id
                                            parameter and the current year.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="api-card">
                    <h2>2.2 getEventInfo(branch_id, event_id)</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/event/get_event_info/{branch_id}/{event_id?}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getEventInfo</code> function returns information about events in the given
                                branch, grouped by program name. If an event_id is provided, only the information for
                                that event is returned.</p>
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
                                        <td>The ID of the branch to retrieve events for.</td>
                                    </tr>
                                    <tr>
                                        <td>event_id</td>
                                        <td>int</td>
                                        <td>Optional. The ID of the event to retrieve information for.</td>
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
                                        <td>If event_id is provided, returns a JSON response containing the event
                                            information including program name and a list of users responsible for the
                                            event. If event_id is not provided, returns a JSON response containing an
                                            array of events information grouped by program name, including program name
                                            and a list of users responsible for each event.</td>
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
                                        <td>Event not found</td>
                                        <td>No event(s) were found in the database based on the provided branch_id and
                                            event_id parameters.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>







                <div class="api-card">
                    <h2>2.3 getAnnouncements</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/event/get_announcements/{branch_id}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getAnnouncements</code> function returns a list of announcements for a given
                                branch. The function includes information about the announcer's name, profile picture,
                                and the importance level of the announcement.</p>
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
                                        <td>The ID of the branch to retrieve announcements for.</td>
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
                                        <td>A JSON response containing an array of announcement objects for the given
                                            branch. Each announcement object contains the announcement's information,
                                            the announcer's name and profile picture, and the importance level of the
                                            announcement.</td>
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
                                        <td>No announcements found</td>
                                        <td>No announcements were found in the database based on the provided branch_id
                                            parameter.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>2.4 getEventPictures</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/event/get_event_pictures/{event_id}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getEventPictures</code> function returns the pictures of a specific event. The
                                pictures are ordered by date.</p>
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
                                        <td>event_id</td>
                                        <td>int</td>
                                        <td>The ID of the event to retrieve pictures for.</td>
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
                                        <td>A JSON response containing the pictures of the event ordered by date.</td>
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
                                        <td>Event not found</td>
                                        <td>No event was found in the database based on the provided event_id parameter.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pictures not found</td>
                                        <td>No pictures were found in the database based on the provided event_id
                                            parameter.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>2.5 getTrainingInfo</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/training/get_training_info/{training_id?}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getTrainingInfo</code> function returns information about a specific training
                                or all trainings. The function returns the training(s) information including the program
                                name.</p>
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
                                        <td>training_id</td>
                                        <td>int (optional)</td>
                                        <td>The ID of the training to retrieve. If not provided, all trainings will be
                                            returned.</td>
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
                                        <td>A JSON response containing the training(s) information including the program
                                            name.</td>
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
                                        <td>Training not found</td>
                                        <td>No training was found in the database based on the provided training_id
                                            parameter.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


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
                            <p>The createPost function creates a new post in the database with the specified user ID,
                                post type, and caption.</p>
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
                                        <td>The file to upload for the post media. Required if the post type is "image.
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
                                        <td>A JSON response indicating whether the post was created successfully, and
                                            including the post ID if successful.</td>
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
                                        <td>If the post_type is 'image', the post_media field must be an image file
                                            (JPEG, BMP, PNG, or JPG).</td>
                                    </tr>
                                    <tr>
                                        <td>Missing required fields</td>
                                        <td>The user_id and post_type fields are required in the request. If the
                                            post_type is 'text', the post_caption field is also required.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editPost(Request $request)</code> function takes a Request object as input,
                                which includes the post ID and the new caption for the post. The function checks if the
                                post exists in the database based on the post ID. If the post exists, the function
                                updates the post's caption to the new value. If the update is successful, the function
                                returns a JSON response with a "Post updated successfully" message. If the update fails,
                                the function returns a JSON response with a "Post could not be updated" message.</p>
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
                                        <td>A JSON response containing a status message. The response has two key-value
                                            pairs, where the keys are 'status' and 'message', and the values are the
                                            status message.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deletePost(Request $request)</code> function takes a Request object as input,
                                which includes the post ID and the ID of the user who wants to delete the post. The
                                function checks if the post exists in the database based on the post ID. If the post
                                exists, the function checks if the user ID from the request matches the user ID of the
                                post. If the user ID matches, the function deletes the post, as well as all associated
                                likes, comments, and replies from the database. If the delete is successful, the
                                function returns a JSON response with a "Post deleted successfully" message. If the
                                delete fails, the function returns a JSON response with a "Post could not be deleted"
                                message.</p>
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
                                        <td>A JSON response containing a status message. The response has two key-value
                                            pairs, where the keys are 'status' and 'message', and the values are the
                                            status message.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getPosts($user_id = null)</code> function retrieves posts from the database
                                based on the user ID. If a user ID is provided, the function checks if the user exists
                                in the database. If the user does not exist, the function returns an error response. If
                                no user ID is provided, the function retrieves all posts from the database. The
                                retrieved posts are sorted in descending order based on the post date. The function
                                removes unwanted fields from each post and retrieves the name, profile picture, and
                                username of the post owner based on the user ID. If no user is found for a post, the
                                function returns null. The function returns a JSON response containing a status message,
                                and an array of post objects, each containing the post details and the user details.</p>
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
                                        <td>Integer</td>
                                        <td>The ID of the user whose posts will be retrieved. If not provided, all posts
                                            will be retrieved.</td>
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
                                        <td>A JSON response containing a status message, and an array of post objects,
                                            each containing the post details and the user details. The response has
                                            three key-value pairs, where the keys are 'status', 'message', and 'posts',
                                            and the values are the status message, the message explaining the result of
                                            the API request, and the array of post objects respectively.</td>
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
                            <p>The <code>getPost()</code> function retrieves a single post from the database based on
                                the post ID
                                provided in the
                                URL parameter. If the post is found, the function returns the post data along with the
                                name of the user who
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
                                        <td>A JSON response containing the post data and name of the user who posted the
                                            post. The
                                            response has three key-value pairs:
                                            <ul>
                                                <li>'status': A string indicating the status of the response, either
                                                    "success" or "error".</li>
                                                <li>'message': A string containing a message describing the status of
                                                    the response.</li>
                                                <li>'post': An object containing the post data and name of the user who
                                                    posted the post.</li>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>likePost()</code> function is used to like a post. The function takes in the
                                post ID and
                                user ID as parameters and checks if both the post and the user exist in the database. If
                                either the post or the user is not found, the function returns an error response. If the
                                user has already liked the post, the function returns an error response. If the user has
                                not liked the post yet, a new like instance is created with the post ID, user ID, and
                                the current date, and is saved to the database. If the like is saved successfully, the
                                function increments the post like count and returns a success response. If the like
                                cannot be saved, the function returns an error response. If the post like count cannot
                                be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the like was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                                    <tr>
                                        <td>User not found</td>
                                        <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>You have already liked this post</td>
                                        <td>If the user has already liked the post.</td>
                                    </tr>
                                    <tr>
                                        <td>error</td>
                                        <td>If the post could not be liked or the like count could not be updated.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!--------------------------------------------------------------------->
                <div class="api-card">
                    <h2>3.7 unlikePost</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/post/unlike_post</h3>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The unlikePost API function unlikes a post by a user. The function takes in two
                                parameters: the post ID and the user ID. If the post and user exist in the database,
                                the function checks if the user has already liked the post. If the user has not
                                liked the post, the function returns an error response. If the user has liked the
                                post, the function deletes the like from the database, decrements the post like
                                count, and returns a success response. If the like could not be deleted or the post
                                like count could not be updated, the function returns an error response.</p>
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
                                        <td>A JSON response containing the status of the unlike operation and a
                                            message. The response has two key-value pairs: 'status' and 'message'.
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
                                        <td>If the like instance was successfully deleted from the database but the
                                            post like count could not be decremented.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>commentPost()</code> function is used to create a new comment on a post. The
                                function
                                takes in the post ID, user ID, and comment content as parameters and validates them.
                                If any of the parameters are missing, the function returns an error response. If
                                both the post and the user exist in the database, the function creates a new comment
                                instance with the post ID, user ID, comment content, current date, and default
                                values for the comment like count and reply count. The comment is then saved to the
                                database. If the comment is saved successfully, the function increments the post
                                comment count and returns a success response. If the comment cannot be saved, the
                                function returns an error response. If the post comment count cannot be updated, the
                                function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the comment was posted successfully
                                            or not. The response has two key-value pairs, where 'status' indicates
                                            the status of the operation and 'message' provides additional
                                            information about the operation.</td>
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
                                        <td>If the comment instance was successfully saved to the database but the
                                            post comment count could not be incremented.</td>
                                    </tr>
                                </tbody>
                            </table>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>replyComment</code> API function is used to reply to a comment. The function
                                takes in the
                                comment ID, user ID, and reply content as parameters and checks if both the comment and
                                the user exist in the database. If either the comment or the user is not found, the
                                function returns an error response. If the user has not replied to the comment yet, a
                                new reply instance is created with the comment ID, user ID, and the current date, and is
                                saved to the database. If the reply is saved successfully, the function increments the
                                comment reply count and returns a success response. If the reply cannot be saved, the
                                function returns an error response. If the comment reply count cannot be updated, the
                                function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the reply was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                                        <td>Comment not found</td>
                                        <td>If the comment with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <td>User not found</td>
                                    <td>If the user with the specified ID does not exist in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>error</td>
                                        <td>If the reply could not be posted or the comment reply count could not
                                            beupdated.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>likeComment()</code> function is used to like a comment. The function takes in
                                the comment
                                ID and user ID as parameters and checks if both the comment and the user exist in the
                                database. If either the comment or the user is not found, the function returns an error
                                response. If the user has already liked the comment, the function returns an error
                                response. If the user has not liked the comment yet, a new Comment_like instance is
                                created with the comment ID, user ID, and the current date, and is saved to the
                                database. If the like is saved successfully, the function increments the comment like
                                count and returns a success response. If the like cannot be saved, the function returns
                                an error response. If the comment like count cannot be updated, the function returns an
                                error response.</p>
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
                                        <td>A JSON response indicating whether the like was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>unlikeComment()</code> function is used to unlike a comment. The function takes
                                in the
                                comment ID and user ID as parameters and checks if both the comment and the user exist
                                in the database. If either the comment or the user is not found, the function returns an
                                error response. If the user has not already liked the comment, the function returns an
                                error response. If the user has already liked the comment, the corresponding
                                Comment_like instance is deleted from the database. If the like is deleted successfully,
                                the function decrements the comment like count and returns a success response. If the
                                like cannot be deleted, the function returns an error response. If the comment like
                                count cannot be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the unlike was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteComment()</code> function is used to delete a comment. The function takes
                                in the
                                comment ID and user ID as parameters and checks if both the comment and the user exist
                                in the database. If either the comment or the user is not found, the function returns an
                                error response. If the user is not the owner of the comment, the function returns an
                                error response. The function deletes the comment and all associated likes and replies
                                from the database. If the comment is deleted successfully, the function decrements the
                                comment count of the post associated with the comment and returns a success response. If
                                the comment cannot be deleted, the function returns an error response. If the post
                                comment count cannot be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the comment was deleted successfully or
                                            not. The response has two key-value pairs, where 'status' indicates the
                                            status of the operation and 'message' provides additional information about
                                            the operation.</td>
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
                                        <td>If the user trying to delete the comment is not the owner of the comment.
                                        </td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteReply()</code> function is used to delete a reply. The function takes in
                                the reply ID
                                and user ID as parameters and checks if both the reply and the user exist in the
                                database. If either the reply or the user is not found, the function returns an error
                                response. If the user is not the owner of the reply, the function returns an error
                                response. If the user is the owner of the reply, the corresponding Reply instance is
                                deleted from the database. If the reply is deleted successfully, the function decrements
                                the comment reply count and returns a success response. If the comment reply count
                                cannot be updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the deletion was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editComment()</code> function is used to edit a comment. The function takes in
                                the comment
                                ID, user ID, and new comment content as parameters and checks if both the comment and
                                the user exist in the database. If either the comment or the user is not found, the
                                function returns an error response. If the user is not the owner of the comment, the
                                function returns an error response. If the user is the owner of the comment, the
                                corresponding Comment instance is updated with the new content. If the update is
                                successful, the function returns a success response. If the update cannot be performed,
                                the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the edit was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editReply()</code> function is used to edit a reply. The function takes in the
                                reply ID,
                                user ID, and new content as parameters and checks if both the reply and the user exist
                                in the database. If either the reply or the user is not found, the function returns an
                                error response. If the user is not the owner of the reply, the function returns an error
                                response. If the reply is found and the user is the owner, the reply content is updated
                                with the new content and the function returns a success response. If the reply cannot be
                                updated, the function returns an error response.</p>
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
                                        <td>A JSON response indicating whether the edit was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'message' provides additional information about the operation.
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getComments()</code> function is used to retrieve all comments associated with
                                a given post.
                                The function takes in a post ID as a parameter and checks if the post exists in the
                                database. If the post is found, the function retrieves all comments associated with the
                                post, removes any unnecessary fields, and retrieves the user who made the comment. If no
                                comments are found, the function returns an error response. Otherwise, the function
                                returns a success response along with the comments.</p>
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
                                        <td>The ID of the post to retrieve comments for</td>
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
                                        <td>A JSON response indicating whether the operation was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'comments' provides the list of comments associated with the
                                            post.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getReplies()</code> function is used to retrieve all replies for a given
                                comment. The
                                function takes in the comment ID as a parameter and checks if the comment exists in the
                                database. If the comment is found, the function retrieves all the replies associated
                                with it, removes unwanted fields, and gets user information for each reply. The function
                                then returns a JSON response containing the replies or an error message if no replies
                                were found for the comment.</p>
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
                                        <td>A JSON response indicating whether the operation was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'replies' provides an array of replies if any are found.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getPostLikes()</code> function is used to retrieve the likes associated with a
                                post. The
                                function takes in the post ID as a parameter and checks if the post exists in the
                                database. If the post is found, the likes associated with the post are retrieved and
                                returned. If no likes are found, the function returns an error response.</p>
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
                                        <td>The ID of the post to retrieve likes for.</td>
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
                                        <td>A JSON response indicating whether the likes were retrieved successfully or
                                            not. The response has three key-value pairs, where 'status' indicates the
                                            status of the operation, 'likes' provides the retrieved likes, and
                                            'total_likes' provides the total number of likes. The 'likes' key contains
                                            an array of like objects with the 'field1', 'field2', 'created_at',
                                            'updated_at', and 'like_date' fields removed.</td>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getCommentLikes()</code> function is used to get the likes for a specific
                                comment. The
                                function takes in the comment ID as a parameter and checks if the comment exists in the
                                database. If the comment is found, the function retrieves the likes associated with the
                                comment and removes unwanted fields. The function then returns the likes and the total
                                like count. If no likes are found for the comment, the function returns an error
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
                                        <td>A JSON response indicating whether the operation was successful or not. The
                                            response has two key-value pairs, where 'status' indicates the status of the
                                            operation and 'likes' provides an array of likes associated with the
                                            comment, and 'total_likes' gives the total number of likes for the comment.
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
                <h1>Admin Controller</h1>


                <div class="api-card">
                    <h2>4.1 adminLogin</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/admin_login</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>adminLogin</code> function allows an admin user to log in to the system and
                                obtain a token for authentication.</p>
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
                                        <td>organization_id</td>
                                        <td>string</td>
                                        <td>The ID of the admin user's organization.</td>
                                    </tr>
                                    <tr>
                                        <td>password</td>
                                        <td>string</td>
                                        <td>The admin user's password.</td>
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
                                        <td>A JSON response containing the status of the login attempt, user
                                            information, and a token for authentication.</td>
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
                                        <td>The user with the provided organization_id was not found in the database.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Permission denied</td>
                                        <td>The user with the provided organization_id is not an admin user and is not
                                            authorized to log in as an admin.</td>
                                    </tr>
                                    <tr>
                                        <td>Too many failed login attempts</td>
                                        <td>The user with the provided organization_id has exceeded the maximum number
                                            of login attempts and is temporarily locked out of the system.</td>
                                    </tr>
                                    <tr>
                                        <td>Invalid credentials</td>
                                        <td>The password provided does not match the password on file for the user with
                                            the provided organization_id.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="api-card">
                    <h2>4.2 logout</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/logout</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>logout</code> function logs out the authenticated admin user by revoking all
                                their personal access tokens.</p>
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
                                        <td>A JSON response confirming the user has been logged out.</td>
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
                                        <td>The user is not authenticated and therefore cannot log out.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>










                <div class="api-card">
                    <h2>4.3 addUser</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/add_user</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>addUser</code> function adds a new user to the system.</p>
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
                                        <td>The ID of the branch to which the user belongs.</td>
                                    </tr>
                                    <tr>
                                        <td>first_name</td>
                                        <td>string</td>
                                        <td>The first name of the user.</td>
                                    </tr>
                                    <tr>
                                        <td>last_name</td>
                                        <td>string</td>
                                        <td>The last name of the user.</td>
                                    </tr>
                                    <tr>
                                        <td>organization_id</td>
                                        <td>int</td>
                                        <td>The ID of the user in the organization's database.</td>
                                    </tr>
                                    <tr>
                                        <td>user_dob</td>
                                        <td>date</td>
                                        <td>The date of birth of the user.</td>
                                    </tr>
                                    <tr>
                                        <td>user_position</td>
                                        <td>string</td>
                                        <td>The position of the user in the organization.</td>
                                    </tr>
                                    <tr>
                                        <td>gender</td>
                                        <td>int</td>
                                        <td>The gender of the user. 0 for female, 1 for male, 2 for non-binary, and 3
                                            for other.</td>
                                    </tr>
                                    <tr>
                                        <td>user_type_id</td>
                                        <td>int</td>
                                        <td>The ID of the user's type. 0 for volunteer and 1 for admin.</td>
                                    </tr>
                                    <tr>
                                        <td>is_active</td>
                                        <td>int</td>
                                        <td>Whether the user is active or not. 0 for inactive and 1 for active.</td>
                                    </tr>
                                    <tr>
                                        <td>user_start_date</td>
                                        <td>date</td>
                                        <td>The date when the user started working in the organization.</td>
                                    </tr>
                                    <tr>
                                        <td>user_end_date</td>
                                        <td>date (optional)</td>
                                        <td>The date when the user stopped working in the organization.</td>
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
                                        <td>A JSON response containing the status, message, and the added user's
                                            information.</td>
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
                                        <td>Validation failed</td>
                                        <td>One or more input parameters failed validation. The specific error message
                                            will be included in the response.</td>
                                    </tr>
                                    <tr>
                                        <td>User could not be added</td>
                                        <td>The function was unable to add the new user to the database. The specific
                                            error message will be included in the response.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.4 editUser</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/edit_user</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editUser</code> function updates the information of a specific user.</p>
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
                                        <td>The ID of the user to be edited.</td>
                                    </tr>
                                    <tr>
                                        <td>first_name</td>
                                        <td>string</td>
                                        <td>The user's first name.</td>
                                    </tr>
                                    <tr>
                                        <td>last_name</td>
                                        <td>string</td>
                                        <td>The user's last name.</td>
                                    </tr>
                                    <tr>
                                        <td>user_dob</td>
                                        <td>date</td>
                                        <td>The user's date of birth.</td>
                                    </tr>
                                    <tr>
                                        <td>user_position</td>
                                        <td>string</td>
                                        <td>The user's position.</td>
                                    </tr>
                                    <tr>
                                        <td>gender</td>
                                        <td>int</td>
                                        <td>The user's gender. (0 = Female, 1 = Male, 2 = Other)</td>
                                    </tr>
                                    <tr>
                                        <td>user_type_id</td>
                                        <td>int</td>
                                        <td>The user's type. (0 = Volunteer, 1 = Admin)</td>
                                    </tr>
                                    <tr>
                                        <td>is_active</td>
                                        <td>int</td>
                                        <td>Whether the user is currently active. (0 = Inactive, 1 = Active)</td>
                                    </tr>
                                    <tr>
                                        <td>user_start_date</td>
                                        <td>date</td>
                                        <td>The user's start date with the organization.</td>
                                    </tr>
                                    <tr>
                                        <td>user_end_date</td>
                                        <td>date (optional)</td>
                                        <td>The user's end date with the organization, if applicable.</td>
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
                                        <td>A JSON response containing the status of the operation and a message.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>The specified user was not found in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>Error</td>
                                        <td>An error occurred while updating the user information.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.5 deleteUser</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/delete_user</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteUser</code> function deletes the specified user from the database.</p>
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
                                        <td>integer</td>
                                        <td>The unique identifier of the user to be deleted.</td>
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
                                        <td>A JSON response confirming the user has been deleted successfully.</td>
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
                                        <td>The specified user could not be found in the database.</td>
                                    </tr>
                                    <tr>
                                        <td>General error</td>
                                        <td>An error occurred while deleting the user from the database.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





                <div class="api-card">
                    <h2>4.6 getRequests</h2>
                    <h3>GET</h3>
                    <h3>http://example.com/api/v0.1/admin/get_requests/{branch_id}</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>getRequests</code> function retrieves all the recover requests made by users in
                                the specified branch, if any.</p>
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
                                        <td>integer</td>
                                        <td>The ID of the branch whose recover requests are being retrieved.</td>
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
                                        <td>A JSON response containing the recover requests made by users in the
                                            specified branch, if any.</td>
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
                                        <td>Not Found</td>
                                        <td>The specified branch does not exist or has no recover requests made by its
                                            users.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.7 acceptRequest</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/accept_request</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>acceptRequest</code> function accepts a recover request by updating the request
                                status to accepted.</p>
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
                                        <th>Parameter</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>request_id</td>
                                        <td>The ID of the recover request to accept.</td>
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
                                        <td>A JSON response confirming that the recover request has been accepted.</td>
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
                                        <td>Validation failed</td>
                                        <td>The required parameter request_id was not provided or is not an integer.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Recover request not found</td>
                                        <td>The provided request_iddoes not correspond to a recover request in the
                                            database.</td>
                                    </tr>
                                    <tr>
                                        <td>Recover request has already been accepted</td>
                                        <td>The provided request_id corresponds to a recover request that has already
                                            been accepted.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.9 declineRequest</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/decline_request</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>declineRequest</code> function declines a recover request based on the provided
                                request ID.</p>
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
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>request_id</td>
                                        <td>The ID of the recover request to decline.</td>
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
                                        <td>A JSON response confirming the recover request has been declined.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request_id parameter is missing or not an integer.</td>
                                    </tr>
                                    <tr>
                                        <td>Error</td>
                                        <td>The recover request with the provided ID was not found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="api-card">
                    <h2>4.10 sendAnnouncement</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/send_announcement</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>sendAnnouncement</code> function creates a new announcement.</p>
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
                                        <td>announcement_title</td>
                                        <td>string</td>
                                        <td>The title of the announcement</td>
                                    </tr>
                                    <tr>
                                        <td>announcement_content</td>
                                        <td>string</td>
                                        <td>The content of the announcement</td>
                                    </tr>
                                    <tr>
                                        <td>admin_id</td>
                                        <td>integer</td>
                                        <td>The ID of the admin user sending the announcement</td>
                                    </tr>
                                    <tr>
                                        <td>importance_level</td>
                                        <td>integer</td>
                                        <td>The level of importance of the announcement (0 = low, 1 = medium, 2 = high)
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
                                        <td>A JSON response confirming the announcement has been sent.</td>
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
                                        <td>Invalid admin user</td>
                                        <td>The admin user does not exist or is not an admin.</td>
                                    </tr>
                                    <tr>
                                        <td>The importance level field is required</td>
                                        <td>The importance level field is missing or has an invalid value.</td>
                                    </tr>
                                    <tr>
                                        <td>Validation error</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="api-card">
                    <h2>4.11 deleteAnnouncement</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/delete_announcement</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteAnnouncement</code> function deletes the announcement with the provided
                                ID, but only if the admin user who created the announcement and the admin user who sent
                                the delete request are the same.</p>
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
                                        <th>Parameter</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>announcement_id</td>
                                        <td>The ID of the announcement to be deleted.</td>
                                    </tr>
                                    <tr>
                                        <td>admin_id</td>
                                        <td>The ID of the admin user who sent the delete request.</td>
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
                                        <td>A JSON response confirming whether the announcement was deleted successfully
                                            or if an error occurred.</td>
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
                                        <td>Announcement not found</td>
                                        <td>The announcement with the provided ID could not be found.</td>
                                    </tr>
                                    <tr>
                                        <td>User not found</td>
                                        <td>The admin user with the provided ID could not be found.</td>
                                    </tr>
                                    <tr>
                                        <td>User is not an admin</td>
                                        <td>The admin user with the provided ID is not an admin and does not have
                                            permission to delete announcements.</td>
                                    </tr>
                                    <tr>
                                        <td>User is not the one who sent the announcement</td>
                                        <td>The admin user with the provided ID did not send the announcement with the
                                            provided ID and therefore cannot delete it.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.12 editAnnouncement</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/edit_announcement</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editAnnouncement</code> function edits an existing announcement sent by an
                                admin user.</p>
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
                                        <th>Parameter</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>announcement_id</td>
                                        <td>integer</td>
                                        <td>The ID of the announcement to be edited</td>
                                    </tr>
                                    <tr>
                                        <td>announcement_title</td>
                                        <td>string</td>
                                        <td>The new title of the announcement</td>
                                    </tr>
                                    <tr>
                                        <td>announcement_content</td>
                                        <td>string</td>
                                        <td>The new content of the announcement</td>
                                    </tr>
                                    <tr>
                                        <td>admin_id</td>
                                        <td>integer</td>
                                        <td>The ID of the admin user who sent the announcement</td>
                                    </tr>
                                    <tr>
                                        <td>importance_level</td>
                                        <td>integer</td>
                                        <td>The new importance level of the announcement (0, 1, or 2)</td>
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
                                        <td>A JSON response confirming the announcement has been edited.</td>
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
                                        <td>The user is not authorized to access this resource.</td>
                                    </tr>
                                    <tr>
                                        <td>Validation Error</td>
                                        <td>The request did not pass validation rules. The error message will contain
                                            the details.</td>
                                    </tr>
                                    <tr>
                                        <td>Not Found</td>
                                        <td>The requested resource was not found.</td>
                                    </tr>
                                    <tr>
                                        <td>Internal Server Error</td>
                                        <td>An unexpected error occurred while processing the request.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.13 addEvent</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v1/admin/add_event</h3>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>addEvent</code> function creates a new event and adds it to the database. It
                                also adds responsible people for the event and increments the goals table for goals that
                                have the same program ID and event type ID as the event</p>
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
                                        <td>program_id</td>
                                        <td>integer</td>
                                        <td>The ID of the program associated with the event.</td>
                                    </tr>
                                    <tr>
                                        <td>event_main_picture</td>
                                        <td>file</td>
                                        <td>An image file to be associated with the event. (optional)</td>
                                    </tr>
                                    <tr>
                                        <td>event_description</td>
                                        <td>string</td>
                                        <td>A description of the event.</td>
                                    </tr>
                                    <tr>
                                        <td>event_location</td>
                                        <td>string</td>
                                        <td>The location of the event.</td>
                                    </tr>
                                    <tr>
                                        <td>event_date</td>
                                        <td>date</td>
                                        <td>The date of the event.</td>
                                    </tr>
                                    <tr>
                                        <td>event_title</td>
                                        <td>string</td>
                                        <td>The title of the event.</td>
                                    </tr>
                                    <tr>
                                        <td>event_type_id</td>
                                        <td>integer</td>
                                        <td>The ID of the type of event.</td>
                                    </tr>
                                    <tr>
                                        <td>budget_sheet</td>
                                        <td>file</td>
                                        <td>An image file of the event's budget sheet. (optional)</td>
                                    </tr>
                                    <tr>
                                        <td>proposal</td>
                                        <td>file</td>
                                        <td>An image file of the event's proposal. (optional)</td>
                                    </tr>
                                    <tr>
                                        <td>meeting_minute</td>
                                        <td>file</td>
                                        <td>An image file of the event's meeting minute. (optional)</td>
                                    </tr>
                                    <tr>
                                        <td>branch_id</td>
                                        <td>integer</td>
                                        <td>The ID of the branch associated with the event.</td>
                                    </tr>
                                    <tr>
                                        <td>responsibles</td>
                                        <td>array</td>
                                        <td>An array of objects representing the people responsible for the event. Each
                                            object must contain a user ID and role name.</td>
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
                                        <td>A JSON response indicating whether the event was created successfully or
                                            not.</td>
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
                                        <td>Invalid request parameters</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>Error creating event</td>
                                        <td>An error occurred while creating the event. The error message will contain
                                            details about the error.</td>
                                    </tr>
                                    <tr>
                                        <td>Error adding responsibilities</td>
                                        <td>An error occurred while adding responsibilities for the event. The error
                                            message will contain details about the error.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.14 editEvent</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/edit_event</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editEvent</code> function updates an existing event with new information.</p>
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
                                        <td>event_id</td>
                                        <td>integer</td>
                                        <td>The ID of the event to be updated</td>
                                    </tr>
                                    <tr>
                                        <td>program_id</td>
                                        <td>integer</td>
                                        <td>The ID of the program the event is associated with</td>
                                    </tr>
                                    <tr>
                                        <td>event_main_picture</td>
                                        <td>file</td>
                                        <td>The main picture for the event</td>
                                    </tr>
                                    <tr>
                                        <td>event_description</td>
                                        <td>string</td>
                                        <td>The description of the event</td>
                                    </tr>
                                    <tr>
                                        <td>event_location</td>
                                        <td>string</td>
                                        <td>The location of the event</td>
                                    </tr>
                                    <tr>
                                        <td>event_date</td>
                                        <td>date</td>
                                        <td>The date of the event</td>
                                    </tr>
                                    <tr>
                                        <td>event_title</td>
                                        <td>string</td>
                                        <td>The title of the event</td>
                                    </tr>
                                    <tr>
                                        <td>event_type_id</td>
                                        <td>integer</td>
                                        <td>The ID of the event type</td>
                                    </tr>
                                    <tr>
                                        <td>budget_sheet</td>
                                        <td>file</td>
                                        <td>The budget sheet for the event</td>
                                    </tr>
                                    <tr>
                                        <td>proposal</td>
                                        <td>file</td>
                                        <td>The proposal for the event</td>
                                    </tr>
                                    <tr>
                                        <td>meeting_minute</td>
                                        <td>file</td>
                                        <td>The meeting minutes for the event (optional)</td>
                                    </tr>
                                    <tr>
                                        <td>responsibles</td>
                                        <td>array</td>
                                        <td>An array of responsible people, each with a user_id and role_name</td>
                                    </tr>
                                    <tr>
                                        <td>event_images</td>
                                        <td>array</td>
                                        <td>An array of event images to be added to the event</td>
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
                                        <td>A JSON response confirming the event has been updated.</td>
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
                                        <td>Event not found</td>
                                        <td>The event with the specified event_id does not exist.</td>
                                    </tr>
                                    <tr>
                                        <td>Validation error</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>File type error</td>
                                        <td>One or more of the uploaded files are not in the supported file formats
                                            (jpeg, bmp, png, jpg).</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>








                <div class="api-card">
                    <h2>4.15 deleteEvent</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/delete_event</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteEvent</code> function deletes an existing event.</p>
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
                                        <td>event_id</td>
                                        <td>integer</td>
                                        <td>The ID of the event to be deleted</td>
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
                                        <td>A JSON response confirming the event has been deleted.</td>
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
                                        <td>Event not found</td>
                                        <td>The event with the specified event_id does not exist.</td>
                                    </tr>
                                    <tr>
                                        <td>An error occurred while deleting the event</td>
                                        <td>An unexpected error occurred during the event deletion process.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="api-card">
                    <h2>4.16 addImageToEvent</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/add_event_photo</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>addImageToEvent</code> function adds an image to an existing event.</p>
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
                                        <td>event_id</td>
                                        <td>integer</td>
                                        <td>The ID of the event to which the image will be added</td>
                                    </tr>
                                    <tr>
                                        <td>image</td>
                                        <td>file</td>
                                        <td>The image file to be added to the event (JPEG, BMP, PNG, or JPG format)</td>
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
                                        <td>A JSON response confirming the image has been added to the event.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>Event not found</td>
                                        <td>The event with the specified event_id does not exist.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.17 removeImageFromEvent</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/remove_image</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>removeImageFromEvent</code> function removes an image from an existing event.
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
                                        <td>id</td>
                                        <td>integer</td>
                                        <td>The ID of the image to be removed</td>
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
                                        <td>A JSON response confirming the image has been removed from the event.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>Image not found</td>
                                        <td>The image with the specified ID does not exist.</td>
                                    </tr>
                                    <tr>
                                        <td>Failed to delete the image</td>
                                        <td>An error occurred while attempting to delete the image.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <div class="api-card">
                    <h2>4.18 setYearlyGoal</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/set_yearly_goal</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>setYearlyGoal</code> function sets a yearly goal for a specific program and
                                event type.</p>
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
                                        <td>goal_name</td>
                                        <td>string</td>
                                        <td>The name of the goal</td>
                                    </tr>
                                    <tr>
                                        <td>goal_description</td>
                                        <td>string</td>
                                        <td>The description of the goal</td>
                                    </tr>
                                    <tr>
                                        <td>program_id</td>
                                        <td>integer</td>
                                        <td>The ID of the program for which the goal is being set</td>
                                    </tr>
                                    <tr>
                                        <td>number_to_complete</td>
                                        <td>integer</td>
                                        <td>The number of events to complete the goal</td>
                                    </tr>
                                    <tr>
                                        <td>goal_year</td>
                                        <td>integer</td>
                                        <td>The year for which the goal is being set</td>
                                    </tr>
                                    <tr>
                                        <td>event_type_id</td>
                                        <td>integer</td>
                                        <td>The ID of the event type associated with the goal</td>
                                    </tr>
                                    <tr>
                                        <td>goal_deadline</td>
                                        <td>date</td>
                                        <td>The deadline for completing the goal</td>
                                    </tr>
                                    <tr>
                                        <td>start_date</td>
                                        <td>date</td>
                                        <td>The start date for the goal</td>
                                    </tr>
                                    <tr>
                                        <td>branch_id</td>
                                        <td>integer</td>
                                        <td>The ID of the branch associated with the goal</td>
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
                                        <td>A JSON response indicating the success of the goal creation.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>Error creating goal</td>
                                        <td>There was an issue creating the goal in the database. The error message will
                                            provide more details on the specific issue.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="api-card">
                    <h2>4.19 editYearlyGoal</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/edit_yearly_goal</h3>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>editYearlyGoal</code> function allows you to edit an existing yearly goal by
                                providing its ID and the updated details. The goal will be updated with the new
                                information provided in the request. If the number of completed goals is greater than or
                                equal to the number to complete, the goal status will be marked as completed (1).
                                Otherwise, the goal status will be marked as incomplete (0). The API will also update
                                the goal counter for events in the same year as the goal.
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
                                        <th>Parameter</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>goal_id</td>
                                        <td>integer</td>
                                        <td>The ID of the goal to be edited.</td>
                                    </tr>
                                    <tr>
                                        <td>goal_name</td>
                                        <td>string</td>
                                        <td>The new name of the goal.</td>
                                    </tr>
                                    <tr>
                                        <td>goal_description</td>
                                        <td>string</td>
                                        <td>The new description of the goal.</td>
                                    </tr>
                                    <tr>
                                        <td>program_id</td>
                                        <td>integer</td>
                                        <td>The ID of the program the goal is associated with.</td>
                                    </tr>
                                    <tr>
                                        <td>number_to_complete</td>
                                        <td>integer</td>
                                        <td>The new number of events required to complete the goal.</td>
                                    </tr>
                                    <tr>
                                        <td>goal_year</td>
                                        <td>integer</td>
                                        <td>The new year the goal is set for.</td>
                                    </tr>
                                    <tr>
                                        <td>event_type_id</td>
                                        <td>integer</td>
                                        <td>The ID of the event type associated with the goal.</td>
                                    </tr>
                                    <tr>
                                        <td>goal_deadline</td>
                                        <td>date</td>
                                        <td>The new deadline for the goal.</td>
                                    </tr>
                                    <tr>
                                        <td>start_date</td>
                                        <td>date</td>
                                        <td>The new start date for the goal.</td>
                                    </tr>
                                    <tr>
                                        <td>branch_id</td>
                                        <td>integer</td>
                                        <td>The ID of the branch the goal is associated with.</td>
                                    </tr>
                                    <tr>
                                        <td>number_completed</td>
                                        <td>integer</td>
                                        <td>The updated number of events completed for the goal.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Return:</h4>
                        </div>
                        <div class="card-body">
                            <p>Returns a JSON object with status and message properties, indicating the success or
                                failure of the operation.</p>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>Goal not found</td>
                                        <td>The goal with the specified ID does not exist.</td>
                                    </tr>
                                    <tr>
                                        <td>An error occurred while updating the goal</td>
                                        <td>An error occurred while attempting to update the goal. The error message
                                            will contain more information.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.20 deleteYearlyGoal</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/delete_yearly_goal</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteYearlyGoal</code> function deletes an existing yearly goal by providing
                                its ID.</p>
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
                                        <td>goal_id</td>
                                        <td>integer</td>
                                        <td>The ID of the yearly goal to be deleted</td>
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
                                        <td>A JSON response confirming the yearly goal has been deleted.</td>
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
                                        <td>Goal not found</td>
                                        <td>The yearly goal with the specified goal_id does not exist.</td>
                                    </tr>
                                    <tr>
                                        <td>An error occurred while deleting the yearly goal</td>
                                        <td>An unexpected error occurred during the yearly goal deletion process.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="api-card">
                    <h2>4.21 addTrainingForUser</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/add_training_for_user</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>addTrainingForUser</code> function adds one or more trainings to one or more
                                users by providing the training and user IDs.</p>
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
                                        <td>training_ids</td>
                                        <td>array</td>
                                        <td>An array of training IDs to be added</td>
                                    </tr>
                                    <tr>
                                        <td>user_ids</td>
                                        <td>array</td>
                                        <td>An array of user IDs to receive the trainings</td>
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
                                        <td>A JSON response confirming the trainings have been added to the users
                                            successfully or an error message if an error occurs.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>One or more trainings do not exist</td>
                                        <td>The trainings with the specified training_ids do not exist or are incorrect.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>One or more users do not exist</td>
                                        <td>The users with the specified user_ids do not exist or are incorrect.</td>
                                    </tr>
                                    <tr>
                                        <td>Error adding trainings</td>
                                        <td>An unexpected error occurred during the process of adding trainings to the
                                            users.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="api-card">
                    <h2>4.22 deleteTrainingForUser</h2>
                    <h3>POST</h3>
                    <h3>http://example.com/api/v0.1/admin/delete_training_for_user</h3>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>deleteTrainingForUser</code> function removes one or more trainings from one or
                                more users by providing the training and user IDs.</p>
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
                                        <td>training_ids</td>
                                        <td>array</td>
                                        <td>An array of training IDs to be removed</td>
                                    </tr>
                                    <tr>
                                        <td>user_ids</td>
                                        <td>array</td>
                                        <td>An array of user IDs to remove the trainings from</td>
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
                                        <td>A JSON response confirming the trainings have been removed from the users
                                            successfully or an error message if an error occurs.</td>
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
                                        <td>Validation failed</td>
                                        <td>The request parameters failed validation. The error message will contain
                                            details about the validation failure.</td>
                                    </tr>
                                    <tr>
                                        <td>One or more trainings do not exist</td>
                                        <td>The trainings with the specified training_ids do not exist or are incorrect.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>One or more users do not exist</td>
                                        <td>The users with the specified user_ids do not exist or are incorrect.</td>
                                    </tr>
                                    <tr>
                                        <td>Error removing trainings</td>
                                        <td>An unexpected error occurred during the process of removing trainings from
                                            the users.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                            <h4>Description:</h4>
                        </div>
                        <div class="card-body">
                            <p>The <code>downloadPictureByUrl($pictureUrl)</code> function takes a URL string as input,
                                which includes the location of the picture to be downloaded. The function checks if the
                                picture exists in the specified location on the server. If the picture exists, the
                                function retrieves the picture, converts it to base64 format, and returns a JSON
                                response containing the base64-encoded content. If the picture does not exist, the
                                function returns a JSON response with a "Image not found" message.</p>
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
                                        <td>A JSON response containing the base64-encoded content of the picture. The
                                            response has a single key-value pair, where the key is 'data' and the value
                                            is the base64-encoded content of the picture.</td>
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
