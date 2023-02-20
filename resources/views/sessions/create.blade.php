@extends('products.layout')

@section('content')
<div style="margin: 0 auto; margin-top: 50px; width: 400px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); padding: 20px; background-color: #f2f2f2;">
  <h2 style="text-align: center; margin-bottom: 20px;">Login</h2>
    <form method="POST" action="/login">
        @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" style="display: block; margin-bottom: 5px;">Email address</label>
    <input type="email" name="email" class="form-control" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" style="display: block; width: 100%; padding: 10px; border-radius: 5px; border: none; margin-bottom: 20px;">
  </div>
  @error('email')
                        <p style="color: #EF4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" style="display: block; margin-bottom: 5px;">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" style="display: block; width: 100%; padding: 10px; border-radius: 5px; border: none; margin-bottom: 20px;">
  </div>
  @error('password')
                        <p style="color: #EF4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
  <button type="submit" class="btn btn-primary" style="display: block; width: 100%; padding: 10px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
</form>
</div>
@endsection