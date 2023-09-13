  <!-- Modal -->
  <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class=" mt-3 text-warning">Update Customer</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="update-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 p-1">
                        <label class="form-label">Customer Name *</label>
                        <input type="text" class="form-control" id="customerNameUpdate">
                        <label class="form-label">Customer Email *</label>
                        <input type="text" class="form-control" id="customerEmailUpdate">
                        <label class="form-label">Customer Mobile *</label>
                        <input type="text" class="form-control" id="customerMobileUpdate">
                        <input type="text" class="d-none" id="updateID">
                    </div>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  id="update-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" onclick="Update()" id="save-btn" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>

  <script>


    async function FillUpUpdateForm(id){
         document.getElementById('updateID').value=id;
         showLoader();
         let res=await axios.post("/customer-by-id",{id:id})
         hideLoader();
         document.getElementById('customerNameUpdate').value=res.data['name'];
        document.getElementById('customerEmailUpdate').value=res.data['email'];
        document.getElementById('customerMobileUpdate').value=res.data['mobile'];
     }
 
     async function Update() {

        let customerName = document.getElementById('customerNameUpdate').value;
        let customerEmail = document.getElementById('customerEmailUpdate').value;
        let customerMobile = document.getElementById('customerMobileUpdate').value;
        let updateID = document.getElementById('updateID').value;


        if (customerName.length === 0) {
            errorToast("Customer Name Required !")
        }
        else if(customerEmail.length===0){
            errorToast("Customer Email Required !")
        }
        else if(customerMobile.length===0){
            errorToast("Customer Mobile Required !")
        }
    else {

        document.getElementById('update-modal-close').click();

        showLoader();

        let res = await axios.post("/update-customer",{name:customerName,email:customerEmail,mobile:customerMobile,id:updateID})

        hideLoader();

        if(res.status===200 && res.data===1){

            successToast('Request completed');

            document.getElementById("update-form").reset();

            await getList();
        }
        else{
            errorToast("Request fail !")
        }
    }
}
 
  
 </script>