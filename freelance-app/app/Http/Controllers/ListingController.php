<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
use App\Services\EmailValidationService;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource with sorting and filtering.
     */
    public function index()
    {
        $query = Listing::with('category');

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        if (request('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif (request('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return view('listings.index', [
            'listings'=> $query->get(),
            'categories'  => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'email'       => 'required|email',
            'category_id' => 'required|exists:categories,id',
        ]);

        Listing::create($validated);

        return redirect()
            ->route('listings.index')
            ->with('success', 'Listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return view('listings.edit', [
            'listing'    => $listing,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'email'       => 'required|email',
            'category_id' => 'required|exists:categories,id',
        ]);

        $listing->update($validated);

        return redirect()
            ->route('listings.index')
            ->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()
            ->route('listings.index')
            ->with('success', 'Listing deleted successfully.');
    }

    /**
     * Store a message for a listing (no actual email sending).
     */
    public function sendMessage(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'sender_email' => 'required|email',
            'message'      => 'required|string|min:10',
        ]);

        $listing->messages()->create($validated);

        return back()->with('success', 'Message sent successfully.');
    }
}
