<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 col-12">
            <h1 class="mx-5">Products</h1>
            @if (isset($message))
            <div class="alert alert-{{$type ?? 'success'}} alert-dismissible fade show" role="alert">
                {{message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
     
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <button class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#addProduct"
                        >
                            Create Product
                        </button>
                    </h5>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price($)</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody id="products">
                            @if (count($products))

                            @foreach ($products as $product)
                                <tr id="product-list-{{$product['id']}}">
                                <th scope="row">{{$product['id']}}</th>
                                <td id="product-list-{{$product['id']}}-name">{{$product['name']}}</td>
                                <td id="product-list-{{$product['id']}}-price">{{$product['price']}}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary mr-2" data-id="{{$product['id']}}"
                                    id="product-list-{{$product['id']}}-edit"
                                    data-bs-toggle="modal" data-bs-target="#updateProduct"
                                    data-price="{{$product['price']}}" data-name="{{$product['name']}}"  onclick="openEdit(this)"
                                    >
                                        Edit
                                    </button>
                                    <button class="btn btn-danger mr-2" data-id="{{$product['id']}}" data-name="{{$product['name']}}"
                                    data-bs-toggle="modal" data-bs-target="#destroyProduct"
                                    onclick="openDelete(this)"
                                    >
                                        Delete
                                    </button>
                                </td>
                              </tr>
                            @endforeach
                                
                            @else
                            <tr>
                                <td colspan="4" class="text-center text-bold">Loading products..</td>
                              </tr>
                            @endif
                         
                        </tbody>
                    </table>
                </div>
              </div>
      
        </div>
    </div>
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addProductLabel">Create Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/create" method="post">
        <div class="modal-body">
                <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary  dismiss-modal" data-bs-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-success">Create</button>
        </div>
        </form>
        </div>
    </div>
</div>



<div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="updateProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateProductLabel">Update Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/update" method="post">
        <div class="modal-body">
                <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input type="text" class="form-control" name="edit_name" required>
                </div>
                <input type="hidden" name="product_id">
                <div class="mb-3">
                    <label  class="form-label">Price</label>
                    <input type="number" class="form-control" name="edit_price" required>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary  dismiss-modal" data-bs-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="destroyProduct" tabindex="-1" aria-labelledby="destroyProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="destoryProductLabel">Delete Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/delete" method="post">
        <div class="modal-body">
                <input type="hidden" name="product_id">
              <p>
                  Are you sure you want to delete <span id="product-name" class="fw-bold">Prouct name</span>
              </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary dismiss-modal" data-bs-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-danger ">Delete</button>
        </div>
        </form>
        </div>
    </div>
</div>
<script>
    // $( document ).ready(
    //     $.ajax({
    //         'method': 'get',
    //         'url': "{{env('API_URL')}}"+ '/products'
    //     })
    //     .done(function(resp){
    //         if(resp.status == 'success'){
    //             let products = resp.data;
    //             let  text = '';
    //             products.forEach(product => {
    //                 text += formatProduct(product);
    //             })

    //             if(!text.length){
    //                 text  =`
    //                     <tr>
    //                         <td colspan="4" class="text-center text-bold">No products</td>
    //                       </tr>
    //                  `;
    //             }
    //             // $("#products").text('')
    //             // $("#products").append(text)
    //         }
    //     })
    // )
    $("#createProduct,#editProduct,#deleteProduct").submit(e => {
        e.preventDefault();
    })
    function createProduct(){
        let name = $("input[name='name']").val();
        let price = $("input[name='price']").val();
        $.ajax({
            'method': 'post',
            'url': "{{env('API_URL')}}"+ '/products',
            data:{
                name,
                price
            }
        })
        .done(function(resp){
            if(resp.status == 'success'){
                let product = formatProduct(resp.data);
                $("#products").append(product)
                $('.dismiss-modal').click();
                $("input[name='name']").val('');
                $("input[name='price']").val('');
            }else{

            }
        });
    }

    function deleteProduct(){
        let product_id = $("input[name='product_id']").val();
        $.ajax({
            'method': 'delete',
            'url': "{{env('API_URL')}}"+ `/products/${product_id}`,
        })
        .done(function(resp){
            if(resp.status == 'success'){
                $(`#product-list-${product_id}`).remove();
                $('.dismiss-modal').click();
            }else{

            }
        })
    }

    function openDelete(element){
        $("#product-name").text(element.dataset.name);
        $("input[name='product_id']").val(element.dataset.id);
    }

    function editProduct(){
        let name = $("input[name='edit_name']").val();
        let price = $("input[name='edit_price']").val();
        let product_id = $("input[name='product_id']").val();
        $.ajax({
            'method': 'put',
            'url': "{{env('API_URL')}}"+ `/products/${product_id}`,
            data:{
                name,
                price
            }
        })
        .done(function(resp){
            if(resp.status == 'success'){
                let product = resp.data;
                $(`#product-list-${product_id}-name`).text(product.name);
                $(`#product-list-${product_id}-price`).text(product.price);
                document.getElementById(`product-list-${product_id}-edit`).dataset.price =product.price;
                document.getElementById(`product-list-${product_id}-edit`).dataset.name =product.name;
                $('.dismiss-modal').click();
            }else{

            }
        });
    }

    
    function openEdit(element){
        $("input[name='edit_name']").val(element.dataset.name);
        $("input[name='edit_price']").val(element.dataset.price);
        $("input[name='product_id']").val(element.dataset.id);
    }

    function formatProduct(product){
        return  `
                        <tr id="product-list-${product.id}">
                            <th scope="row">${product.id}</th>
                            <td id="product-list-${product.id}-name">${product.name}</td>
                            <td id="product-list-${product.id}-price">${product.price}</td>
                            <td class="text-center">
                                <button class="btn btn-primary mr-2" data-id=${product.id}
                                id="product-list-${product.id}-edit"
                                data-bs-toggle="modal" data-bs-target="#updateProduct"
                                data-price=${product.price} data-name="${product.name}"  onclick="openEdit(this)"
                                >
                                    Edit
                                </button>
                                <button class="btn btn-danger mr-2" data-id=${product.id} data-name=${product.name}
                                data-bs-toggle="modal" data-bs-target="#destroyProduct"
                                onclick="openDelete(this)"
                                >
                                    Delete
                                </button>
                            </td>
                          </tr>
                    `;
    }
</script>
</body>
</html>