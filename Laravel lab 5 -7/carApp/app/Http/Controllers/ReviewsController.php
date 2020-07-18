<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class ReviewsController extends Controller
{
    public function create(Request $request){
        $carReviews=new Review;
        $carReviews->car_id=Car::car()->id;
        $carReviews->reviewText=$request->reviewText;
       
    
        $carReviews->save();
        $carReviews->car;
        return response()->json([
            'success'=>true,
            'message'=>'Car Reviews added ',
            'carReviews'=>$carReviews
        ]);
        
    }
    public function carReviews(){
        $carReviews=Reviews::where('car_id',Car::car()->id)->orderBy('id','desc')->get();
        $car=Car::car();
        return response()->json([
            'success'=>true,
            'carReviews'=>$carReviews,
            'car'=>$car
        ]);
    }
    public function carDetails(){
        $carDetails=Car::where('review_id',Reviews::reviews()->id)->orderBy('id','desc')->get();
        $carReviews=Reviews::reviews();
        return response()->json([
            'success'=>true,
            'carDetails'=>$carDetails,
            'review'=>$carReviews
        ]);
    }
}
