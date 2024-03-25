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
