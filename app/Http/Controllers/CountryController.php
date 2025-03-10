<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    // Display a listing of all countries
    public function index()
    {
        try {
            $countries = Country::all();
            return response()->json($countries);
        } catch (\Exception $e) {
            Log::error('Error fetching countries: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while fetching countries'
            ], 500);
        }
    }

    // Store a newly created country in the database
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:countries',
                'src_drapeau' => 'required|string',
                'capitale' => 'required|string',
                'population' => 'required|integer|min:0',
                'region' => 'required|string'
            ]);

            $country = Country::create($validated);
            return response()->json([
                'country' => $country,
                'message' => 'Country created successfully'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating country: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while creating the country'
            ], 500);
        }
    }

    // Display the specified country by ID
    public function show(string $id)
    {
        try {
            $country = Country::find($id);

            if (!$country) {
                return response()->json([
                    'message' => 'Country not found'
                ], 404);
            }

            return response()->json($country);
        } catch (\Exception $e) {
            Log::error('Error fetching country: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while fetching the country'
            ], 500);
        }
    }
    // Update the specified country in the database
    public function update(Request $request, string $id)
    {
        try {
            $country = Country::findOrFail($id);

            $validated = $request->validate([
                'name' => 'string|unique:countries,name,' . $country->id,
                'src_drapeau' => 'string',
                'capitale' => 'string',
                'population' => 'integer|min:0',
                'region' => 'string'
            ]);

            $country->update($validated);

            return response()->json([
                'message' => 'Country updated successfully',
                'country' => $country
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating country: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while updating the country'
            ], 500);
        }
    }
    // Remove the specified country from the database
    public function destroy(string $id)
    {
        try {
            $country = Country::find($id);

            if (!$country) {
                return response()->json([
                    'message' => 'Country not found'
                ], 404);
            }

            $country->delete();
            return response()->json([
                'message' => 'Country deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting country: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while deleting the country'
            ], 500);
        }
    }
}
