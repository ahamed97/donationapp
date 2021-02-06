<?php

namespace App\Http\Controllers\API;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * district type get
     */
    public function index()
    {

        $districts = District::all();

        return response()->json(['districts' => $districts,'message' => 'Districts get'], 200);
    }
}
