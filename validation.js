document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById('validateForm');
    const submitButton = document.getElementById('submitButton');
});
    // Function for displaying error messages
    const displayError = (elemName, message) => {
        const elem = document.querySelector(`#validateForm [name="${elemName}"]`);

        if (elem.parentElement.querySelector(".error")) {
            elem.parentElement.querySelector(".error").innerText = message;
        } else {
            const errorSpan = document.createElement('span');
            errorSpan.className = 'error';
            errorSpan.innerText = message;

            elem.parentNode.appendChild(errorSpan);
        }

        elem.classList.add('errorField');

        submitButton.disabled = true;
    };

    // Function to check field validations
    const checkValidity = (elemName, regex, fieldType = '', isOptional = false) => {
        const elem = document.querySelector(`#validateForm [name="${elemName}"]`);

        if (isOptional && elem.value.trim() === '' && regex.test("")) {
            return true;
        }

        if (!elem.checkValidity() || !regex.test(elem.value)) {
            if (fieldType === 'name') {
                displayError(elemName, 'Name field should only contain letters and spaces.');
            } else if (fieldType === 'email') {
                displayError(elemName, 'Email field should be valid format.');
            } else if (fieldType === 'matricNo') {
                displayError(elemName, 'Matric no. field must begin with two uppercase alphabets followed by five digits.');
            } else if (fieldType === 'currentAddress') {
                displayError(elemName, 'Current address field should be valid address format.');
            } else if (fieldType === 'homeAddress') {
                displayError(elemName, 'Home address field should be valid address format.');
            } else if (fieldType === 'phone') {
                if (isOptional) {
                    displayError(elemName, 'Phone no. field should optionally be a valid 10-digit number.');
                } else {
                    displayError(elemName, 'Phone no. field should be a valid 10-digit number.');
                }
            }

            return false;
        }

        if (elem.classList.contains('errorField')) {
            elem.classList.remove('errorField');

            const errorElem = elem.parentElement.querySelector(".error[for=" + elemName + "]");

            if (errorElem) {
                errorElem.parentNode.removeChild(errorElem);
            }
        }

        submitButton.disabled = false;

        return true;
    };

    // Event listener for form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const nameIsValid = checkValidity('name', /^[a-z A-Z]+$/, 'name', true);
        const matricNoIsValid = checkValidity('matricNo', /^[A-Z]{2}\d{5}$/, 'matricNo');
        const currentAddressIsValid = checkValidity('currentAddress', /^[a-zA-Z0-9,. ()-]+$/, 'currentAddress');
        const homeAddressIsValid = checkValidity('homeAddress', /^[a-zA-Z0-9,. ()-]+$/, 'homeAddress');
        const emailIsValid = checkValidity('email', /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/, 'email');

        const mobilePhoneNoIsValid = checkValidity('mobilePhoneNo', /^\d{10}$/, 'phone', true);
        const homePhoneNoIsValid = checkValidity('homePhoneNo', /^\d{10}$/, 'phone');
    });