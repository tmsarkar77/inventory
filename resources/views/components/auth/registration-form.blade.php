<div class="card-body">
    <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
      <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
    </a>
    <p class="text-center">Sign Up</p>
    <div>
      <div class="mb-3">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" aria-describedby="textHelp">
      </div> 
      <div class="mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" aria-describedby="textHelp">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>
       <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" id="mobile" aria-describedby="textHelp">
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password">
      </div>
      <button onclick="onRegistration()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
        <a class="text-primary fw-bold ms-2" href="{{ url('/') }}">Sign In</a>
      </div>
    </div>
  </div>


  <script>


    async function onRegistration() {
  
          let email = document.getElementById('email').value;
          let firstName = document.getElementById('firstName').value;
          let lastName = document.getElementById('lastName').value;
          let mobile = document.getElementById('mobile').value;
          let password = document.getElementById('password').value;
  
          if(email.length===0){
              errorToast('Email is required')
          }
          else if(firstName.length===0){
              errorToast('First Name is required')
          }
          else if(lastName.length===0){
              errorToast('Last Name is required')
          }
          else if(mobile.length===0){
              errorToast('Mobile is required')
          }
          else if(password.length===0){
              errorToast('Password is required')
          }
          else{
              showLoader();
              let res=await axios.post("/user-registration",{
                  email:email,
                  firstName:firstName,
                  lastName:lastName,
                  mobile:mobile,
                  password:password
              })
              hideLoader();
              if(res.status===200 && res.data['status']==='success'){
                  successToast(res.data['message']);
                  setTimeout(function (){
                      window.location.href='/'
                  },2000)
              }
              else{
                  errorToast(res.data['message'])
              }
          }
      }
  </script>