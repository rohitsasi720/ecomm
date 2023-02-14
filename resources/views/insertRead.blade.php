@extends('welcome')
@section('content')


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Add Product
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="insertData" method="POST" enctype="multipart/form-data">
            @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="name" name="pname">
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Product Price</label>
    <input type="number" min="0" class="form-control" id="price" name="pprice">
  </div>
  <div class ="mb-3">
    <select class="form-select my-4" required name="category">
        <option selected>Select Category</option>
        <option value="Clothing">Clothing</option>
        <option value="Footwear">Footwear</option>
        <option value="Electronic">Electronic</option>
        <option value="Book">Book</option>
    </select>
  </div>
  <div class="mb-3">
  <label for="image" class="form-label">Product Image</label>
  <input class="form-control" type="file" id="image" name="image">
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Details
                            <a href="#" class="btn btn-primary float-end">Add Product</a>
                        </h4>
                    </div>
<div class="card-body">

                        <table id="products" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>RUD Operations</th>
                                </tr>
                            </thead>
                            <tbody>
@foreach ($data as $item)
<tr>
    <form action="edit" method="get">
        <input type="hidden" value="{{$item['Id']}}" name="id">
    <td><input type="hidden" value="{{ucfirst($item['PName'])}}" name="name"> {{ucfirst($item['PName'])}}</td>
    <td><input type="hidden" value="{{$item['PCategory']}}" name="category"> {{$item['PCategory']}}</td>
    <td><input type="hidden" value="{{$item['PPrice']}}" name="price"> $ {{number_format($item['PPrice'])}}</td>
    <td style="text-align: center;"><img src="images/{{$item['PImage']}}" width="175px" height="175px" alt="{{$item['PName']}}"></td>
    <td>
        <input type="submit" class="btn btn-primary" value="Update" name="update">
        &nbsp; &nbsp;
        <input type="submit" class="btn btn-danger" value="Delete" name="delete">
    </td>
    </form>
</tr>
    
@endforeach


                            </tbody>
                        </table>
</div>
                </div>
            </div>
        </div>
</div>
@endsection