<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use App\Category;
use App\ContactInfos;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class AdminController extends Controller
{
    

    function start()
    {
        $category = Category::all();
        return view('index',compact('category'));
    }

    function about()
    {
        return view('about');
    }
    function contact()
    {
        return view('contact');
    }
    function cart()
    {
        return view('cart');
    }
    function checkout()
    {
        return view('checkout');
    }
    // function contact_info(Request $request){
    //     print_r($request->all());
    //     ContactInfos::insert([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'subject' => $request->subject,
    //         'message' => $request->message,
    //         'created_at' => Carbon::now()
    //     ]);
    //     return back()->with('info_insert_status', 'Sent your information successfully');

    // }
    function contact_info(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;
        Mail::to('mridulr172@gmail.com')->send(new ContactMail($name, $email, $subject, $message));
        return back();
    }
}
