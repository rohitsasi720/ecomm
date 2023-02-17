@extends('welcome')
@section('content')

<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Edit
                            <a href="/" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="updatedata" method="get" enctype="multipart/form-data">
                              <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" value="{{$pname}}" name="name">
                              </div>
                              <div class="mb-3">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="number" min="0" class="form-control" id="price" value="{{$pprice}}" name="price">
                              </div>
                              <div class ="mb-3">
                                <select class="form-select my-4" value="{{$category}}" required name="category">
                                  <option value="{{$category}}">Select Category</option>
                                  <option value="Clothing">Clothing</option>
                                  <option value="Footwear">Footwear</option>
                                  <option value="Electronic">Electronic</option>
                                  <option value="Book">Book</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="image" name="image" value="{{$image}}">
                              </div>
                              <input type="hidden" name="id" value="{{$pid}}">
                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection