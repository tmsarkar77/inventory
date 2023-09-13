
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="save-form">
            <div class="container">
                <div class="row">
                    <div class="col-12 p-1">
                        <label class="form-label">Category Name *</label>
                        <input type="text" class="form-control" id="categoryName">
                    </div>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  id="modal-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="Save()" id="save-btn" class="btn btn-primary">Save </button>
        </div>
      </div>
    </div>
  </div>

  <script>

    async function Save() {

        let categoryName = document.getElementById('categoryName').value;

        if (categoryName.length === 0) {
            errorToast("Category Required !")
        }
        else {

            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/create-category",{name:categoryName})
            hideLoader();

            if(res.status===201){

                successToast('Request completed');

                document.getElementById("save-form").reset();

                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }

</script>
  