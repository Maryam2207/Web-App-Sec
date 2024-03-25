 $(document).ready(function() {

        // Add event listener for submit button
            $("#submitButton").click(function(event) {
    
            // Prevent the form from being submitted normally
            event.preventDefault();
    
            // Capture all form data
            const formData = $("#validateForm").serializeArray();
    
            // Prepare query string
            const queryString = Object.fromEntries(formData);
        });
            // Send POST request
            $.ajax({
                type: "POST",
                url: "process_form.php",
                data: queryString,
                success: function(response) 
            });
    
                    if (response !== "") {
    
                        const errors = JSON.parse(response);
                        let errorMessage = "The following error(s) occurred:<br>";
    
                        for (const [name, reason] of Object.entries(errors)) {
                            displayError(name, reason);
                            errorMessage += reason + "<br>";
                        }
    
                        $("#error-notification").text(errorMessage);
                        $("#error-notification").show();
    
                    } else {
    
                        $("#error-notification").hide();
    
                        // Form submitted successfully
                        alert("Form submitted successfully");
    
                    };