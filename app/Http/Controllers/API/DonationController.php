<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function index(Request $request)
    {

        $donations = Donation::query();

        if($request->state){
            $donations = $donations->where('state',$request->state);
        }
        if($request->donater_id){
            $donations = $donations->where('donater_id',$request->donater_id);
        }
        if($request->driver_id){
            $donations = $donations->where('driver_id',$request->driver_id);
        }
        if($request->weight_id){
            $donations = $donations->where('weight_id',$request->weight_id);
        }
        if($request->vehicle_type_id){
            $donations = $donations->where('vehicle_type_id',$request->vehicle_type_id);
        }
        if($request->donation_type_id){
            $donations = $donations->where('donation_type_id',$request->donation_type_id);
        }

        $circleRadius = 6371;
        $radius = 20;

        if(isset($request->longitude) && isset($request->latitude)){
            $donations = $donations->selectRaw('*, (? * acos(cos(radians(?)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude)))
                    ) AS distance', [$circleRadius, $request->latitude, $request->longitude, $request->latitude]);

            $donations = $donations->whereRaw('(? * acos(cos(radians(?)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude)))
                    ) < ?', [$circleRadius, $request->latitude, $request->longitude, $request->latitude, $radius]);
        }

        $donations = $donations->get();

        return response()->json(['donations' => $donations,'message' => 'Donations get'], 200);
    }

    public function show(Request $request)
    {

        $donation = Donation::find($request->id);

        return response()->json(['donation' => [$donation],'message' => 'Donation get'], 200);
    }

    public function store(Request $request)
    {
        $path_1 = null;
        if($request->hasFile('image_url_1')) {
        	$diskName = 'public';
            $disk = Storage::disk($diskName);
            $path_1 = url('storage/'.$request->image_url_1->store('images', 'public'));
        }
        $donation = Donation::create([
            'donation_type_id' => $request->donation_type_id,
            'phone' => $request->phone,
            'add_line_1' => $request->add_line_1,
            'add_line_2' => $request->add_line_2,
            'add_line_3' => $request->add_line_3,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'district_id' => $request->district_id,
            'state' => 1,
            'nic' => $request->nic,
            'image_url_1' => $path_1,
            'donater_id' => $request->donater_id,
            'weight_id' => $request->weight_id,
            'vehicle_type_id' => $request->vehicle_type_id,
        ]);

        $donator = User::where('id',$request->donater_id)->first();
        if(Donation::count() % 10 == 0){

            if($donator->rate <= 5){
                User::where('id',$request->donater_id)->increment('rate');
            }
        }

        $donation = Donation::find($donation->id);

        return response()->json(['donationCreate' => [$donation],'message'=>'Created'], 200);
    }

    public function destroy(Request $request)
    {

        $donation = Donation::where('id',$request->id)->delete();

        return response()->json(['donationDelete' => [],'message' => 'Donation deleted'], 200);
    }

    public function update(Request $request)
    {
        if($request->type == "pick"){
            $donation = Donation::where('id',$request->id)->update(['driver_id' => $request->driver_id,'state' => 2]);
        return response()->json(['donationUpdate' => [],'message' => 'Donation picked'], 200);
        }
        else if($request->type == "drop"){
            $path_2 = null;
        if($request->hasFile('image_url_2')) {
        	$diskName = 'public';
            $disk = Storage::disk($diskName);
            $path_2 = url('storage/'.$request->image_url_2->store('images', 'public'));
        }
        $donation = Donation::where('id',$request->id)->update(['image_url_2' => $path_2,'state' => 3]);
        }

        return response()->json(['donationUpdate' => [],'message' => 'Donation droped'], 200);
    }
}
