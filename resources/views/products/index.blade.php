@extends('products.layout')
     
@section('content')
@if ($message = Session::get('created'))
        <div class="alert alert-success my-2">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb py-4">
            <div class="pull-right">
                @if (auth()->check() && auth()->user()->admin)
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endif
            </div>
            @if (auth()->check() && auth()->user()->admin)
            <div class="card shadow mb-4 my-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Import Products</h6>
        </div>
        <form method="POST" action="{{route('upload')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <input 
                            type="file" 
                            class="form-control form-control-user @error('file') is-invalid @enderror" 
                            id="exampleFile"
                            name="file" 
                            value="{{ old('file') }}" required>

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Products</button>
            </div>
        </form>
    </div>
@endif
        </div>
    </div>
    <button type="button" class="btn btn-info my-2" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Handle</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Image</th>
            <th>Shop</th>
            @if (auth()->check() && auth()->user()->admin)
            <th width="280px">RUD Operation</th>
            @endif
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->handle }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->price }}</td>
            <td><img src="/images/{{ $product->image }}" width="100px"></td>
            <td><p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p></td>
            @if(auth()->check() && auth()->user()->admin)
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> 
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
    
    {!! $products->links('pagination::bootstrap-5') !!}
        
@endsection