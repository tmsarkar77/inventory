<div class="card-body">
    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
      <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
    </a>
    <p class="text-center">SET NEW PASSWORD</p>
    <div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>
      
      <button onclick="VerifyEmail()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Send</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
        <a class="text-primary fw-bold ms-2" href="{{ url('/userRegistration') }}">Create an account</a>
      </div>
    </div>
  </div>

  <script>
    async function VerifyEmail() {
         let email = document.getElementById('email').value;
         if(email.length === 0){
            errorToast('Please enter your email address')
         }
         else{
             showLoader();
             let res = await axios.post('/send-otp', {email: email});
             hideLoader();
             if(res.status===200 && res.data['status']==='success'){
                 successToast(res.data['message'])
                 sessionStorage.setItem('email', email);
                 setTimeout(function (){
                     window.location.href = '/verifyOtp';
                 }, 1000)
             }
             else{
                 errorToast(res.data['message'])
             }
         }
 
     }
 </script>