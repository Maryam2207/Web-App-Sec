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

Authorization Layer:
1) User authentication: Make a login page (login_process.php) that allows users to input their password and username/email.
- Verify the user's credentials by comparing them to a user database.
- Create a session for the user and temporarily save their email address and password if the credentials are correct.
- isset($_SESSION['email']) && isset($_SESSION['password']): This checks if the user is logged in. This verifies that the user has signed in before and that their credentials are saved in the session by checking to see if the session variables password and email are set. The user is not logged in if these variables are not set.
- heading ("Location: login_process.php"): This line sends the user to the login page (login_process.php) if they are not logged in, or if the session variables are not set. By doing this, protected pages are shielded from unwanted access.

2) Session Management: Use session_start() to launch a new session on every page that needs authentication.
- Check if the user is logged in using the session before granting access to protected pages.
- session_start(): This function begins or continues a previously started session. Data is persistent between queries thanks to sessions. To track whether a user is logged in or not in this scenario, we use sessions.

3) Define roles and permissions for users in your system (e.g., visitor, user, administrator) using role-based access control (RBAC).
- Determine which actions each user is capable of performing by implementing access control checks based on their responsibilities.
- To check the users role and permissions : The user's role is retrieved from the session variable using $_SESSION['role']. What the user may and cannot do depends on their role.
- Next, the code uses an if-elseif-else block to determine the user's role:
- The visitor is sent to the login page if they are a guest. Usually, guests can only access particular functions and have restricted access.
- You can apply particular permission logic for a typical user, enabling them to add, edit, and remove their own data, for example.
- If the user is an administrator, you can provide them access to view, edit, and remove user data, among other permission logic.

4) Safe Pages: Verify the session to see if the user is logged in on pages that need authentication.
- If a user is not authenticated, send them to the login page.

5) Set Access Control in Place:
- Verify the user's role and permissions prior to granting them access to specific functions.
- Limit a user's role-based access to particular sites or features.

- Display Student details page: The user can access the student details page if they successfully complete the authorization checks. This line only indicates that the visitor has successfully accessed the website by displaying a welcome message.

XSS AND CSRF:
Policy for Content Security (CSP):The CSP for the page is set using the <meta> tag. By only permitting scripts from the same origin ('self,') this policy prevents cross-site scripting attacks (XSS attacks) by limiting the sources from which different resources (including stylesheets, scripts, etc.) can be loaded.

XSS Protection: To escape special HTML characters (\, >, &, ", ') in user inputs before displaying them back on the website, a JavaScript function called escapeHtml() is defined. This stops dangerous scripts from being injected by attackers through form inputs.

CSRF Defense: PHP echo is used to obtain the CSRF token from the PHP session ($_SESSION["_csrf"]) and insert it into the form. This guarantees that the proper CSRF token is included in every form submission.
Just before the form is submitted, the setCsrfToken() JavaScript method dynamically sets the CSRF token.

Server side 
CSRF Token Generation: The PHP script initiates or continues a session (session_start()) upon execution.
It generates a new random token (bin2hex(random_bytes(32))) and puts it in the session if the CSRF token ($_SESSION['_csrf']) doesn't exist.

Form Submission Handling: The PHP script verifies the CSRF token when the form is submitted ($_SERVER['REQUEST_METHOD'] === 'POST').
Using hash_equals() for a secure comparison, it determines whether the CSRF token kept in the session ($_SESSION['_csrf']) and the one sent with the form ($_POST['_csrf']) match.
It processes the form data securely (e.g., by escaping HTML characters using htmlspecialchars()) if the CSRF token is valid.











