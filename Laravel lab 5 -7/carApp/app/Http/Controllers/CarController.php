<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
    public function newcar(Request $request){
        $this->validate(
            $request,
            ['make'=>'required',
            'model'=>'required|unique:cars,model',
            'produced_on'=>'required',
            'image'=>'required']
        );
        $car= new Car;
        $car->make=request('make');
        $car->model=request('model');
        $car->produced_on=request('produced_on');
        $car->image_url=request()->file('image')->store('public/images');
        $car->save();
        request()->session()->flash("form_submit","Car saved successfully");
        //return view('newcar');
        return response()->json([
            'success'=>true,
            'message'=>'Car added',
            'car'=>$car
        ]);
    }
    public function particularCar($id){
        $car=Car::find($id);
        return view('particularcar',['cars'=>$car]);
    }
    public function allCars(){
        $cars=Car::all();
        //return view('car',['cars'=>$cars]);
        return response()->json([
            'success'=>true,
            'cars'=>$cars
        ]);
    }
    public function carReviews($id){
        $car=Car::find($id);
        $reviews=$car->reviews;
        return $reviews;
    }
    public function carDetails($id){
        $review=Review::find($id);
        $carDetails=$review->carDetails;
        return $carDetails;
    }
    
    
    public function cars(){
        $cars=Car::orderBy('id','desc')->get();
        return response()->json([
            'success'=>true,
            'cars'=>$cars
        ]);
    }
    public function myDonations(){
        $donations=Donation::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $user=Auth::user();
        return response()->json([
            'success'=>true,
            'donations'=>$donations,
            'user'=>$user
        ]);
    }
}
