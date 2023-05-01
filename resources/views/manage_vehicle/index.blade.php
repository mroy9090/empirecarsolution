@extends('layouts.adminox')






@section('page_name')
Manage In Vehicle  
@endsection

@section('breadcumb')
<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ url('category') }}">Manage In Vehicle</a></li>
</ol> 
@endsection



@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Parking number</th>
                            <th scope="col">Vehicle Category</th>
                            <th scope="col">Vehicle Company Name</th>
                            <th scope="col">Registration Number</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">IN Time</th>
                            <th scope="col">Action</th>                                                              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manage_vehicle_data as $item)
                            <tr>
                                <td>{{ $item->parking_number }}</td>
                                <td>
                                    @if (App\Category::find($item->category_id))
                                        {{ App\Category::find($item->category_id)->category_name }}
                                    @else
                                        NULL
                                    @endif
                                </td>
                                <td>{{ $item->vehicle_company }}</td>
                                <td>{{ $item->registration_number }}</td>
                                <td>{{ $item->owner_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y, g:i a') }}</td>
                                <td>
                                    <a href="{{ route('delete_manage_vehicle',[$item->user_id]) }}" class="badge bg-danger text-dark" >Manage Out Vehicle</a>
                                </td>
                                
                            </tr>
                            @endforeach
                    </tbody>
                </table>

        </div>

    </div>

</div>
    
@endsection