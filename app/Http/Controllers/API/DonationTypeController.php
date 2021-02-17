<?php

namespace App\Http\Controllers\API;

use App\Models\DonationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationTypeController extends Controller
{
    public function index()
    {

        $donationTypes = DonationType::all();

        return response()->json(['donationTypes' => $donationTypes,'message' => 'Donation Types get'], 200);
    }
}
