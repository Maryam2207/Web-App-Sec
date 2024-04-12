1) Client-side Input Validation:
   
-For each input field, this function performs the following actions:
-Retrieves the form element, its value, and the error message.
-Applies regex validation using the specified regex.
-Displays error messages if the input value doesn't match the regex pattern.

->The form.html file is the entry point for users, showing the form that will collect user inputs.

->form.css is linked within index.html to apply custom visual styles to the form.

->validation.js is used within index.html to validate form inputs both on the client-side and server-side using AJAX.


2) Server-side Input Validation:
The process_form.php script accepts the form data through the $_POST superglobal and validates the input using built-in PHP regex functions.
If the validation fails, it sends error messages in JSON format.
The JavaScript code in the previous answer handles the response from the process_form.php script and displays error messages if validation fails. 
Validate.js:
-Checks if the request method is POST.
-Initializes an empty $errors array to store any validation errors.
-Retrieves the form data from the $_POST superglobal.
-Defines input validation rules using PHP regex functions.
-Validates each form input using the regex functions and adds errors to the $errors array.
-Sends JSON-encoded errors or a success message based on the result of the validations.

Authentication Layer:

The PHP code for handling the login form submission, including session management, redirection, and authentication logic, is contained in the file login_process.php.

The HTML markup and PHP code for the student details page, together with any logic for obtaining and presenting student data, are contained in the file student_details.php.
The PHP code starts by checking if the user is logged in using the session variable $_SESSION['user_id'].
If the user is not logged in, they are redirected to the login page.
The file includes any necessary PHP files, such as the one for the database connection.
It then queries the database to retrieve the student details associated with the user ID.
The retrieved student details are displayed on the page, if available.
The HTML markup contains placeholders where the student details are inserted using PHP echo statements, and the values are sanitized using htmlspecialchars() to prevent XSS attacks.
JavaScript files can be included as needed for client-side functionality.

Database Setup:
Create a MySQL database table to store user credentials. Include fields for email, hashed password, and any other necessary information.
Hash the passwords using a strong hashing algorithm like bcrypt before storing them in the database.
Login Page:

Create a login form where users can input their email and password.
Validate the inputs (email format, password length, etc.) both client-side and server-side.
Sanitize the inputs using htmlspecialchars() to prevent XSS attacks.
Query the database to check if the provided email exists.
If the email exists, retrieve the hashed password associated with it.

Authentication:
Compare the hashed password retrieved from the database with the hashed version of the password entered by the user using a function like password_verify().
If the passwords match, create a session for the user and store their email or user ID in the session data.

Session Management:
Set up session handling at the beginning of every protected page.
Check if the user is logged in by verifying the session data.
If the user is not logged in, redirect them to the login page.
Validate session data to prevent session fixation and session hijacking.

Access Control:
Implement access control to restrict certain pages or functionalities to authenticated users only.
Redirect users to the appropriate page after successful authentication.
Logout:


Defense-In-Depth and Input Validation:
Implement input validation and sanitation for all user inputs to prevent SQL injection, XSS, and other attacks.
Use regular expressions (Regex) to whitelist acceptable input formats.
Sanitize user inputs using htmlspecialchars() or other appropriate methods.

project/
├── css/
│   └── styles.css
├── js/
│   └── script.js
├── includes/
│   └── db_connection.php
├── login.php
├── login_process.php
├── student_details.php
└── index.php

