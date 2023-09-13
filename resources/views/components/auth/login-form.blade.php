<div class="card-body">
    <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
      <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
    </a>
    <p class="text-center">SIGN IN</p>
    <div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password">
      </div>
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
          <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
          <label class="form-check-label text-dark" for="flexCheckChecked">
            Remeber this Device
          </label>
        </div>
        <a class="text-primary fw-bold" href="{{ url('/sendOtp') }}">Forgot Password ?</a>
      </div>
      <button  onclick="SubmitLogin()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">New to Inventory?</p>
        <a class="text-primary fw-bold ms-2" href="{{ url('/userRegistration') }}">Create an account</a>
      </div>
    </div>
  </div>


  <script>

       async function SubmitLogin() {
            let email=document.getElementById('email').value;
            let password=document.getElementById('password').value;

            if(email.length===0){
                errorToast("Email is required");
            }
            else if(password.length===0){
                errorToast("Password is required");
            }else{

              showLoader();
              let res = await axios.post("/user-login",{email:email, password:password});
              hideLoader()
              if(res.status===200 && res.data['status']==='success'){
                    window.location.href="/dashboard";
                }
                else{
                    errorToast(res.data['message']);
                }
            }
          
        }

  </script>