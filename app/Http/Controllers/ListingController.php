<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ListingController extends Controller
{
    //
    public function index()
    {
        return view('listings.index', [
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplepaginate()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(2)
        ]);
    }

    public function show(Listing $id)
    {
        return view('listings.show', [
            'listing' => $id
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);
        // dd($request->all());
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        // Session::flash('message', 'Listing created');

        return redirect('/listings')->with('message', 'Listing Created Successfully');
    }


    public function edit(Listing $id)
    {
        if ($id->user_id != auth()->id()) {
            return back()->with('message', 'You are not authorized to edit this item ⛔️');
        }
        return view('listings.edit', [
            'listing' => $id
        ]);
    }

    public function update(Request $request, Listing $id)
    {
        $listing = $id;
        if ($listing->user_id != auth()->id()) {
            return abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);
        return back()->with('message', 'Listing updated successfully');
    }

    public function destroy(Listing $id)
    {
        if ($id->user_id != auth()->id()) {
            return abort(403, 'Unauthorized Action ⛔️');
        }
        $id->delete();
        return redirect('/listings')->with("message", "Gig deleted successfully");
    }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
