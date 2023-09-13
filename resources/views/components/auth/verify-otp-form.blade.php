<div class="card-body">
    <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
      <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
    </a>
    <p class="text-center">ENTER OTP CODE</p>
    <div>
      <div class="mb-3">
        <label for="otp" class="form-label">4 Digit Code Here</label>
        <input type="text" class="form-control" id="otp" >
      </div>
      
    
      <button onclick="VerifyOtp()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Next</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
        <a class="text-primary fw-bold ms-2" href="{{ url('/userRegistration') }}">Create an account</a>
      </div>
    </div>
  </div>

  <script>
    async function VerifyOtp() {
         let otp = document.getElementById('otp').value;
         if(otp.length !==4){
            errorToast('Invalid OTP')
         }
         else{
             showLoader();
             let res=await axios.post('/verify-otp', {
                 otp: otp,
                 email:sessionStorage.getItem('email')
             })
             hideLoader();
 
             if(res.status===200 && res.data['status']==='success'){
                 successToast(res.data['message'])
                 sessionStorage.clear();
                 setTimeout(() => {
                     window.location.href='/resetPassword'
                 }, 1000);
             }
             else{
                 errorToast(res.data['message'])
             }
         }
     }
 </script>