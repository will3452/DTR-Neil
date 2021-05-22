<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/v1/users', function(){
    $users = User::where('type', 'normal')->with('dtrs')->get();
    $str = '
    <?xml version="1.0" standalone="yes"?>
    <users>';

    foreach($users as $user){
        $str.='<user>';
        $str.='<idnumber>'.$user->id_number.'</idnumber>';
        $str.='<name>'.$user->name.'</name>';
        $str.='<username>'.$user->username.'</username>';
        $str.='<gender>'.$user->gender.'</gender>';
        $str.='<status>'.$user->status.'</status>';
        $str.='<dtrs>';
        foreach($user->dtrs as $dtr){
            $str.='<dtr>';
            $str.='<startdate>'.$dtr->start_date.'</startdate>';
            $str.='<enddate>'.$dtr->end_date.'</enddate>';
            $str.='<days>'.$dtr->days.'</days>';
            $str.='<timein>'.$dtr->time_in.'</timein>';
            $str.='<timeout>'.$dtr->time_out.'</timeout>';
            $str.='<ot>'.$dtr->time_out.'</ot>';
            $str.='</dtr>';
        }
        $str.='</dtrs>';
        $str.='</user>';
    }
    $str.='</users>';
    return view('xml', compact('str'));
});
