<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    /**
     * vehicle type get
     */
    public function index()
    {

        $vehicleTypes = VehicleType::all();

        return response()->json(['payload' => $vehicleTypes,'message' => 'Vehicle type get'], 200);
    }
}
