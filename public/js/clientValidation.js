
function Test() {  

print();

 }


       function registerValidation () {


        var username = document.forms['register-form']['username'];
        var email = document.forms['register-form']['email'];
        var password = document.forms['register-form']['password'];
        var confirmPassword = document.forms['register-form']['confirmPassword'];

        var usernameError = document.createElement("p");
        var textUsername = document.createTextNode("Username must be 5 letters long");    
        usernameError.appendChild(textUsername);
        usernameError.style.color="red";

        
        var emailError = document.createElement("p");
        var textEmail = document.createTextNode("Invalid email format");    
        emailError.appendChild(textEmail);
        emailError.style.color="red";
        
        var passwordError = document.createElement("p");
        var textPassword = document.createTextNode("Password myst be 6 letters long");    
        passwordError.appendChild(textPassword);
        passwordError.style.color="red";

        var confirmPasswordError = document.createElement("p");
        var textConfirmPassword = document.createTextNode("Passwords do not match");    
        confirmPasswordError.appendChild(textConfirmPassword);
        confirmPasswordError.style.color="red";

        

        username.addEventListener('focusout',usernameValidate);
        email.addEventListener('focusout',checkEmailValidation);
        password.addEventListener('focusout',passwordValidation);
        confirmPassword.addEventListener('focusout',confirmPasswordValidation);


        function usernameValidate() { 


        if(username.value == "" && username.value.length < 5){

            username.style.border= "2px solid red";
          //  username.outerHTML+='<p style="color:red;"><small>I am the new element</small></p>'
          username.parentNode.insertBefore(usernameError, username.nextSibling);
        }

        else {

            username.style.border="2px solid green";
            usernameError.style.display="none";

        }



         }

         function emailValidate(email){

            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    
            if (reg.test(email.value) == false) 
            {
               
                return false;
            }
    
            return true;
    
        }

        function checkEmailValidation(){

            if(!emailValidate(email)){

              email.style.border="2px solid red";
              email.parentNode.insertBefore(emailError, email.nextSibling);

            }
            else {

                email.style.border="2px solid green";
                emailError.style.display="none";
                

            }

        }

        function passwordValidation(){

            if(password.value == "" && password.value.length < 6){

                   password.style.border="2px solid red" ;
                   password.parentNode.insertBefore(passwordError, password.nextSibling);

            }
            else {

                password.style.border="2px solid green" ;
                passwordError.style.display="none";

            }


        }   

        function checkIfTwoPasswordsMatch() {

            if(password.value === confirmPassword.value){

              return true;

            }

            else {

             return false;

            }

      }

       function confirmPasswordValidation() {

            if(!checkIfTwoPasswordsMatch() || confirmPassword.value == ""){

                confirmPassword.style.border= " 2px solid red";
                confirmPassword.parentNode.insertBefore(confirmPasswordError, confirmPassword.nextSibling);

            }

            else {

                confirmPassword.style.border= " 2px solid green";
                confirmPasswordError.style.display="none";

            }

         }





       }


       
    
       registerValidation();
       