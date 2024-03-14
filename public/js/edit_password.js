const checkbox = document.getElementById('twofa_checkbox');
const textArea = document.getElementById('twoFactorInfo');

checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
        textArea.classList.remove('hidden');
    } else {
        textArea.classList.add('hidden');
    }
});
function redirectBack() {
    let category = document.getElementById("category").value;
    window.location.href = "view_pass_menu.php?category=" + category;
}