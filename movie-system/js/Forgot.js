function togglePasswordFields(show) {
    const passwordRow1 = document.querySelector('.op-Yes');
    passwordRow1.style.display = show ? 'table-row' : 'none';

}

function submitHandler(event) {
    event.preventDefault(); 
    const viewPassword = document.querySelector('input[name="CPwd"]:checked').value;
    if(viewPassword === "No"){
        alert("Your Password is [Password here]");
        
    }
    else{
        
        alert("Password Updated successfully!");
    }
}