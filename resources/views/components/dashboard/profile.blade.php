<div>
    <h4 class="text-center">User Profile</h4>
   
    <div class="row">
        <div class="col-md-6">

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" >
              </div> 
              <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" >
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input readonly type="email" class="form-control" id="email" >
              </div>

        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile" >
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
              </div>
        </div>
    
      <button onclick="onUpdate()" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Update</button>
      
    </div>
  </div>

  <script>
    getProfile();
    async function getProfile(){
        showLoader();
        let res=await axios.get("/user-profile")
        console.log(res)
        hideLoader();
        if(res.status===200 && res.data['status']==='success'){
            let data=res.data['data'];
            document.getElementById('email').value=data['email'];
            document.getElementById('firstName').value=data['firstName'];
            document.getElementById('lastName').value=data['lastName'];
            document.getElementById('mobile').value=data['mobile'];
            document.getElementById('password').value=data['password'];
        }
        else{
            errorToast(res.data['message'])
        }

    }

    async function onUpdate() {


        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if(firstName.length===0){
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
            let res=await axios.post("/user-update",{
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                password:password
            })
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                await getProfile();
            }
            else{
                errorToast(res.data['message'])
            }
        }
    }

</script>