<div>
    <form id="logOutform" method="POST" action="{{ route('logout') }}" style="display:none;">
        @csrf 
    </form>

<script>

window.addEventListener('openLoginForm', event => {   

    Swal.fire({
      //  title: "",
        title: "Login your account",
        input: 'text',
        inputLabel: 'Enter your phone number to Login/Sign up',
        inputPlaceholder: 'Enter your mobile no',
        confirmButtonText: 'Login',
        showCancelButton: true        
    }).then((result) => {
        if (result.isConfirmed) { 
            if (result.value) { 
               // console.log("Result: " + result.value);
                @this.loginUserAccount(result.value);  

            }else{  
                Swal.fire({
                title: 'Error',
                text: 'Please enter mobile no', 
                icon: 'error',  
                }).then((result) => {  
                   @this.loginAccountForm();   
                }); 
            }
        } 
    });
});  
window.addEventListener('loginSuccess', event => {   
    window.location.reload();
    });


/*        function loginUser()
        {

            (async () => {

 const { value: mobile } = await Swal.fire({
  title: 'Login your account',
  input: 'text',
  inputLabel: 'Enter your phone number to Login/Sign up',
  inputPlaceholder: 'Enter your mobile no'
});

if (mobile) { 
  Swal.fire(`Entered mobile no: ${mobile}`)
};


})()
 }
window.addEventListener('openLoginForm', event => {   
    loginUser();
});  */
    </script>
</div>