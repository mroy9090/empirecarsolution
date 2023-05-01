@extends('layouts.adminox')

@section('page_name')
Add Vehicle  
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ url('category') }}">Add Vehicle </a></li>
</ol> 
@endsection



@section('content')

<div class="container">
    <div class="row">
        <div class="col-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Vehicle Company</th>
                            <th scope="col">Registration Number</th>
                            <th scope="col">Owner name</th>
                            <th scope="col">Owner Company Number</th>
                            <th scope="col">Category</th>                                                              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicle_data as $category)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $category->vehicle_company }}</td>
                            <td>{{ $category->registration_number }}</td>
                            <td>{{ $category->owner_name }}</td>
                            <td>{{ $category->owner_company_number }}</td>
                            <td>
                                @if (App\Category::find($category->category_id))
                                    {{ App\Category::find($category->category_id)->category_name }}
                                @else
                                    NULL
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            
            
        </div>
        
        <div class="col-2">
            <div class="card-box">
                <div class="card-header  bg-primary text-white">ADD VEHICLE</div>
                    <div class="card-body text-dark">
                       <form action="{{ route('insert_vehicle_info') }}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label class="form-label">SELECT</label>
                                <select name="category_id"  class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option>--choose one--</option>
                                    @foreach ($category_data as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                 @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                                @enderror
                                <label class="form-label">Vehicle Company</label>
                                <input type="text" class="form-control" name="vehicle_company">
                                @error('vehicle_company')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                                @enderror

                                <label class="form-label">Registration Number</label>
                                <input type="number" class="form-control" name="registration_number">
                                @error('registration_number')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                                @enderror

                                <label class="form-label">Owner name</label>
                                <input type="text" class="form-control" name="owner_name">
                                @error('owner_name')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                                @enderror


                                <label class="form-label">Owner Company Number</label>
                                <input type="number" class="form-control" name="owner_company_number">
                                @error('owner_company_number')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                                <br>
                                @enderror
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                            @if (session('vehicle_insert_status'))
                                <br>
                                <br>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-danger">{{ session('vehicle_insert_status') }}</span>
                                    
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
    
@endsection