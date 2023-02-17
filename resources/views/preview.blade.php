@extends('welcome')
@section('content')

<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Details
                            <a href="/" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">        
                    <div class="mb-3">
                            <label>Name</label>
                            <p class="form-control">
                               {{$pname}}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Category</label>
                            <p class="form-control">
                               {{$category}}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <p class="form-control">
                                {{$pprice}}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <p class="form-control">
                                <img src="images/{{$image}}" width="175px"
                                    alt="{{$pname}}">
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>

@endsection