<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
                ]);
    }
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    public function create(){
        return view('listings.create');
    }
    public function store(Request $request){

         $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' =>['required', 'email'],
            'tags' => 'required',
            'website' => 'required',
            'description' => 'required'
         ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();

         Listing::create($formFields);
         return redirect('/', 201)->with('message', 'Listing created succesfully');
    }

    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing] );
    }
    public function update(Request $request, Listing $listing){

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

          $updateFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'email' =>['required', 'email'],
            'tags' => 'required',
            'website' => 'required',
            'description' => 'required'
         ]);
   if($request->hasFile('logo')){
        $updateFields['logo'] = $request->file('logo')->store('logos', 'public');
    }
   $listing->update($updateFields);
   return back()->with('message', 'Listing updated succefully');
}
public function destroy(Listing $listing){
    if($listing->user_id != auth()->id()){

        abort(403, 'Unauthorized Action');
    }

    $listing->delete();
    return redirect('/')->with('message', 'Listing deleted successfully');
}
public function manage(){
    // dd(auth()->id());
    $listings = Listing::latest()->where('user_id', auth()->id())->get();
    return view('listings.manage',['listings'=> $listings]);
}
}