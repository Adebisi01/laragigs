<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
         Listing::create($formFields);
         return redirect('/listings')->with('welcome', 'Listing created succesfully');
    }
    public function edit(Listing $listing){
        return view('listings.edit', ['listing'=> $listing]) ; 
    }
    public function update(Request $request, Listing $listing){
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
   return back()->with('welcome', 'Listing updates succefully');
}
public function destroy(Listing $listing){
    $listing->delete();
    return redirect('/listings')->with('welcome', 'Listing deleted successfully');
}
}