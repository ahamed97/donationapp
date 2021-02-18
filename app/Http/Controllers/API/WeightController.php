<?php

namespace App\Http\Controllers\API;

use App\Models\Weight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeightController extends Controller
{
    public function index()
    {

        $weights = Weight::all();

        return response()->json(['weights' => $weights,'message' => 'weight get'], 200);
    }
}
