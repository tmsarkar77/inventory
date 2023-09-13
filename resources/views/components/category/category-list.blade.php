          <div class="row justify-content-between ">
              <div class="align-items-center col">
                  <h6>Category</h6>
              </div>
              <div class="align-items-center col">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary float-end m-0 btn-sm">Create</button>
              </div>
          </div>
          <hr class="bg-secondary"/>
          <div class="table-responsive">
          <table class="table  table-flush" id="tableData">
              <thead>
              <tr class="bg-light">
                  <th>No</th>
                  <th>Category</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody id="tableList">

              </tbody>
          </table>
          </div>


          <script>

            getList();
            
            
            async function getList() {
            
            
                showLoader();
                let res=await axios.get("/list-category");
                hideLoader();
            
                let tableList=$("#tableList");
                let tableData=$("#tableData");
            
                tableData.DataTable().destroy();
                tableList.empty();
            
                res.data.forEach(function (item,index) {
                    let row=`<tr>
                                <td>${index+1}</td>
                                <td>${item['name']}</td>
                                <td>
                                    <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                                    <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                                </td>
                             </tr>`
                    tableList.append(row)
                })
            
                $('.editBtn').on('click', async function () {
                       let id= $(this).data('id');
                       await FillUpUpdateForm(id)
                       $("#update-modal").modal('show');
            
            
                })
            
                $('.deleteBtn').on('click',function () {
                    let id= $(this).data('id');
                    $("#deleteModal").modal('show');
                    $("#deleteID").val(id);
                })
            
                new DataTable('#tableData',{
                   order:[[0,'desc']],
                   lengthMenu:[5,10,15,20,30]
               });
            
            }
            
            
            </script>
            
  




