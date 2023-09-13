<div class="card-body">
    <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
      <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
    </a>
    <p class="text-center">SET NEW PASSWORD</p>
    <div>
      <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="password">
      </div>

      <div class="mb-3">
        <label for="cpassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="cpassword">
      </div>
      
      <button onclick="ResetPass()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Next</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
        <a class="text-primary fw-bold ms-2" href="{{ url('/userRegistration') }}">Create an account</a>
      </div>
    </form>
  </div>


  <script>
    async function ResetPass() {
          let password = document.getElementById('password').value;
          let cpassword = document.getElementById('cpassword').value;
  
          if(password.length===0){
              errorToast('Password is required')
          }
          else if(cpassword.length===0){
              errorToast('Confirm Password is required')
          }
          else if(password!==cpassword){
              errorToast('Password and Confirm Password must be same')
          }
          else{
            showLoader()
            let res=await axios.post("/reset-password",{password:password});
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                setTimeout(function () {
                    window.location.href="/";
                },1000);
            }
            else{
              errorToast(res.data['message'])
            }
          }
  
      }
  </script>