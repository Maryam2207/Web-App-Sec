
        const formElements = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]');
        const formSubmitButton = document.querySelector('input[type="submit"]');

        const emailRegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        function checkValidity(event) {
            formElements.forEach(element => {
                if (!element.checkValidity()) {
                    const errorMessage = document.createElement('p');
                    errorMessage.className = 'error-message';
                    errorMessage.innerText = 'Please fill in this field.';

                    if (element.parentElement.querySelector('.error-message')) {
                        element.parentElement.removeChild(element.parentElement.querySelector('.error-message'));
                    }

                    element.parentElement.appendChild(errorMessage);

                    event.preventDefault();
                }

                if (element.type === 'email' && !emailRegExp.test(element.value)) {
                    const errorMessage = document.createElement('p');
                    errorMessage.className = 'error-message';
                    errorMessage.innerText = 'Please enter a valid email address.';

                    if (element.parentElement.querySelector('.error-message')) {
                        element.parentElement.removeChild(element.parentElement.querySelector('.error-message'));
                    }

                    element.parentElement.appendChild(errorMessage);
                    event.preventDefault();
                }
            });
        }

        formSubmitButton.addEventListener('click', checkValidity);

        const submitButton = document.getElementById('submitButton');
const theForm = document.getElementById('theForm');

submitButton.addEventListener('click', (event) => {
    event.preventDefault();
    alert('Form has been submitted!');
    
});

theForm.addEventListener('submit', (event) => {

});