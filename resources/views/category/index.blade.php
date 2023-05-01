@extends('layouts.adminox')






@section('page_name')
Category  
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ url('category') }}">category</a></li>
</ol> 
@endsection



@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Category</th>                                                                 
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($category_data as $category)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $category->category_name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            
            
        </div>
        
        <div class="col-4">
            <div class="card-box">
                <div class="card-header  bg-primary text-white">Insert Category name</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('add_category') }}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name">
                                <span  class="text-danger">
                                    @error('category_name')
                                        {{ $message }}
                                        
                                    @enderror
                                </span>
                            </div>
                            {{-- @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                            @enderror --}}
                            <button type="submit" class="btn btn-primary">Add</button>
                            {{-- @if (session('category_insert_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('category_insert_status') }}</span>
                                    
                                </div>
                            @endif --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    

</div>
    
@endsection