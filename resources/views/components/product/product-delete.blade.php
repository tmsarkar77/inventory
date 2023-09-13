  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class=" mt-3 text-warning">Delete !</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="save-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 p-1">
                        <p class="mb-3">Once delete, you can't get it back.</p>
                        <input class="d-none" id="deleteID"/>
                        <input class="d-none" id="deleteFilePath"/>
                    </div>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  id="delete-modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" onclick="itemDelete()" id="save-btn" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    async  function  itemDelete(){
           let id=document.getElementById('deleteID').value;
           let deleteFilePath=document.getElementById('deleteFilePath').value;
           document.getElementById('delete-modal-close').click();
           showLoader();
           let res=await axios.post("/delete-product",{id:id,file_path:deleteFilePath})
           hideLoader();
           if(res.data===1){
               successToast("Request completed")
               await getList();
           }
           else{
               errorToast("Request fail!")
           }
    }
</script>

