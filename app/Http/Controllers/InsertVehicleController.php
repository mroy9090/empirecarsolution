<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\InsertVehicle;
use Illuminate\Support\Carbon;
use App\Category;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class InsertVehicleController extends Controller
{
    //
    function add_vehicle()
    {
        $category_data = Category::where('user_id', Auth::id())->get();
        $vehicle_data = InsertVehicle::where('user_id', Auth::id())->get();

        return view('add_vehicle.index', compact('category_data', 'vehicle_data'));
    }
    function insert_vehicle_info(Request $request)
    {

        $request->validate([
            'category_id' => 'required | max:20',
            'vehicle_company' => 'required | min:2 | max:20 ',
            'registration_number' => 'required | min:2 | max:20',
            'owner_name' => 'required | min:2 | max:20',
            'owner_company_number' => 'required | min:2 | max:20',
        ], [
            'category_id.required' => 'vehicle category should be filled in',
            'vehicle_company.required' => 'vehicle company name should be filled in',
            'registration_number.required' => 'registration number should be filled in',
            'owner_name.required' => 'owner name should be filled in',
            'owner_company_number.required' => 'owner company number should be filled in',
        ]);
        InsertVehicle::insert([
            'user_id' => Auth::id(),
            'parking_number' => random_int(1, 10),
            'category_id' => $request->category_id,
            'vehicle_company' => $request->vehicle_company,
            'registration_number' => $request->registration_number,
            'owner_name' => $request->owner_name,
            'owner_company_number' => $request->owner_company_number,
            'created_at' => Carbon::now()
        ]);
        return back()->with('vehicle_insert_status', 'Vehicle ' . $request->vehicle_company . ' added successfully');
    }
    function manage_in_vehicle()
    {
        $category_data = Category::where('user_id', Auth::id())->get();
        $manage_vehicle_data = InsertVehicle::where('user_id', Auth::id())->get();

        return view('manage_vehicle.index', compact('manage_vehicle_data', 'category_data'));
    }
    function delete_manage_vehicle($user_id)
    {
        if (InsertVehicle::where('user_id', $user_id)->exists()) {
            InsertVehicle::where('user_id', $user_id)->delete();
        }
        return back()->with('DATA HAS BEEN DELETED SUCCESSFULLY');
        
    }

    function manage_out_vehicle(){
        $soft_delete  = InsertVehicle::where('user_id', Auth::id())->onlyTrashed()->get();
        return view('manage_vehicle.manage_out', compact('soft_delete'));
    }
    
    function download_pdf($user_id){
        
        
        $total_calculation = InsertVehicle::where('user_id', Auth::id())->onlyTrashed()->first();
        
        $start = Carbon::parse($total_calculation->created_at);
        $end = Carbon::parse($total_calculation->deleted_at);
        $duration = $end->diffInMinutes($start) / 60;
        $hourlyRate = 50;
        $parkingCost = $hourlyRate * $duration;
        // $duration->format('%H:%I:%S');
        
        $pdf=PDF::loadView('pdf.invoice',compact('total_calculation', 'duration', 'parkingCost'));
        return $pdf->download('calculation.pdf');
    }
    
    function check_out($user_id){
        InsertVehicle::withTrashed()->where('user_id', Auth::id())->forceDelete();
        return back();
    }
}
