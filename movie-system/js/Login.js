function clearForm() {
    document.getElementById("loginForm").reset();
}

window.onload = function() {
    clearForm();

    if (performance.navigation.type === 2) {
        window.location.reload();
    }
};