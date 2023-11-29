<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PassportController extends Controller
{
    public function index()
    {
        $data = User::all();
        // Pass the data to a view
        return view('welcome', ['data' => $data]);
    }

    public function updateData(Request $request)
    {
        if($request->ajax()){
            User::find($request->pk)->update([
                $request->name => $request->value
            ]);
        }
        return response()->json(['message' => 'Record updated successfully']);
    }

    public function updateAge(Request $request)
    {
        // dd($request->all());
        $userId = $request->get('userId');
        $selectedAge = $request->get('selectedAge');
        $user = User::find($userId);
        $user->age = $selectedAge;
        $user->save();
        
    }

    
}
