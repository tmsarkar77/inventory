<div class="row justify-content-between ">
    <div class="align-items-center col">
        <h4>Product</h4>
    </div>
    <div class="align-items-center col">
        <button type="button" data-bs-toggle="modal" data-bs-target="#productModal" class="btn btn-primary float-end m-0 btn-sm">Create</button>
    </div>
</div>
<hr class="bg-secondary"/>
<div class="table-responsive">
<table class="table  table-flush" id="tableData">
    <thead>
    <tr class="bg-light">
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Unit</th>
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
        let res=await axios.get("/list-product");
        hideLoader();
    
        let tableList=$("#tableList");
        let tableData=$("#tableData");
    
        tableData.DataTable().destroy();
        tableList.empty();
    
        res.data.forEach(function (item,index) {
            let row=`<tr>
                        <td><img class="img-fluid h-auto" width="40px" alt="" src="${item['img_url']}"></td>
                        <td>${item['name']}</td>
                        <td>${item['price']}</td>
                        <td>${item['unit']}</td>
                        <td>
                            <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                            <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                        </td>
                     </tr>`
            tableList.append(row)
        })
    
        $('.editBtn').on('click', async function () {
               let id= $(this).data('id');
               let filePath= $(this).data('path');
               await FillUpUpdateForm(id,filePath)
               $("#update1-modal").modal('show');
        })
    
        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            let path= $(this).data('path');
    
            $("#deleteModal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(path)
    
        })
    
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });
    
    }
    
    
    </script>
