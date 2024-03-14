const checkbox = document.getElementById('twofa_checkbox');
const textArea = document.getElementById('twoFactorInfo');

if (checkbox.checked) {
    textArea.classList.remove('hidden');
    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            textArea.classList.remove('hidden');
        } else {
            textArea.classList.add('hidden');
        }
    });
} else {
    checkbox.addEventListener('change', function () {
        if (checkbox.checked) {
            textArea.classList.remove('hidden');
        } else {
            textArea.classList.add('hidden');
        }
    });
}

function redirectToDashboard() {
    window.location.href = "dashboard.php";
}