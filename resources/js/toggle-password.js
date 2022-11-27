// toggle password
const togglePassword = $("#toggle-password");
const password = $("input[name='password']");
$(togglePassword).click(function(){
    const type = password.attr('type') === 'password' ? 'text' : 'password'
    password.attr('type',type);
    this.classList.toggle('fa-eye-slash')
    this.classList.toggle('fa-eye')
    
})

// toggle confirm password
const toggleConfirmPassword = $("#toggle-confirm-password");
const passwordConfirm = $("input[name='password_confirmation']");
$(toggleConfirmPassword).click(function(){
    const typeConfirm = passwordConfirm.attr('type') === 'password' ? 'text' : 'password'
    passwordConfirm.attr('type',typeConfirm);
    this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye')
})