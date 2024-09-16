const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const passwordInput = document.querySelector('#password');
const confirmPasswordInput = document.querySelector('#confirm_password');
const eyeIconConfirm = document.querySelector('#eyeIconConfirm');

toggleConfirmPassword.addEventListener('click', function () {
    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordInput.setAttribute('type', type);

    eyeIconConfirm.classList.toggle('fa-eye');
    eyeIconConfirm.classList.toggle('fa-eye-slash');
});


const signupForm = document.querySelector('.signup-form');
const errorMessage = document.querySelector('#error-message');

signupForm.addEventListener('submit', function (event) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;
    event.preventDefault();

    if (password !== confirmPassword) {
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none'; 
    
        const formData = new FormData(signupForm);
    
        fetch('index.php?action=signup', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                alert(data.message); 
            } else if (data.status === 'success') {
                alert(data.message); 
                signupForm.reset(); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});