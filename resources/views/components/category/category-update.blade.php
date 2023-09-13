  <!-- Modal -->
  <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class=" mt-3 text-warning">Update Category</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="update-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 p-1">
                        <label class="form-label">Category Name *</label>
                        <input type="text" class="form-control" id="categoryNameUpdate">
                        <input class="d-none" id="updateID">
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
         let res=await axios.post("/category-by-id",{id:id})
         hideLoader();
         document.getElementById('categoryNameUpdate').value=res.data['name'];
     }
 
     async function Update() {
 
         let categoryName = document.getElementById('categoryNameUpdate').value;
         let updateID = document.getElementById('updateID').value;
 
         if (categoryName.length === 0) {
             errorToast("Category Required !")
         }
         else{
             document.getElementById('update-modal-close').click();
             showLoader();
             let res = await axios.post("/update-category",{name:categoryName,id:updateID})
             hideLoader();
 
             if(res.status===200 && res.data===1){
                 document.getElementById("update-form").reset();
                 successToast("Request success !")
                 await getList();
             }
             else{
                 errorToast("Request fail !")
             }
 
 
         }
 
 
 
     }
 
 
 
 </script>