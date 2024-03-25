<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = $_POST["name"];
        $matricNo = $_POST["matricNo"];
        $currentAddress = $_POST["currentAddress"];
        $homeAddress = $_POST["homeAddress"];
        $email = $_POST["email"];
        $mobilePhoneNo = $_POST["mobilePhoneNo"];
        $homePhoneNo = $_POST["homePhoneNo"];

        $errors = [];

        // Validate Name
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors["name"] = "Name should only contain letters and spaces.";
        }

        // Validate Matric no.
        if (!preg_match("/^[A-Z]{2}\d{5}$/", $matricNo)) {
            $errors["matricNo"] = "Matric no. should begin with two uppercase alphabets followed by five digits.";
        }

        // Validate Current Address
        if (!preg_match("/^[a-zA-Z0-9,. ()-]+$/", $currentAddress)) {
            $errors["currentAddress"] = "Current address is not in a valid format.";
        }

        // Validate Home Address
        if (!preg_match("/^[a-zA-Z0-9,. ()-]+$/", $homeAddress)) {
            $errors["homeAddress"] = "Home address is not in a valid format.";
        }

        // Validate Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email is not in a valid format.";
        }

        // Validate Mobile Phone No
        if (!preg_match("/^\d{10}$/", $mobilePhoneNo)) {
            $errors["mobilePhoneNo"] = "Mobile Phone no. should be a valid 10-digit number.";
        }

        // Validate Home Phone No
        if (!preg_match("/^\d{10}$/", $homePhoneNo)) {
            $errors["homePhoneNo"] = "Home Phone no. should be a valid 10-digit number.";
        }

        if (count($errors) > 0) {
            // Display errors
            echo json_encode($errors);
        } else {
            // Form is valid
            echo json_encode(array("status" => "Form is valid."));
        }

    }

?>