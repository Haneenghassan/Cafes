<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;

class LandingPage extends Controller
{

    public function index()
    {
        $restautant = Category::get();
        return view('layouts/landingPage' , ["restautant"=>$restautant]);
    }

    public function reservation_show()
    {
        // $restautant = Reservation::where('user_id' , auth()->user()->id)->get();
        $restautant = Reservation::where('user_id' , auth()->user()->id)->with('Category' , 'Table' , 'User')->get();
        $data = [];

        foreach ( $restautant as $singleData ){
            // $timestamp = (strtotime($singleData->res_date));
            // $date = date('Y.j.n', $timestamp);
            // $time = date('H:i:s', $timestamp);
            // dd($time);

            $data[] = [
                'id'=> $singleData->id,
                'Name' => $singleData->first_name,
                'Date' => $singleData->res_date,
                'Restaurant' => $singleData->Category->name,
                'Table' => $singleData->Table->name,
                'Guest' => $singleData->Table->guest_number,
                'Location' => $singleData->Table->location,
                'StatusRes' => $singleData->status,
                'StatusTab' => $singleData->Table->status,
            ];
        };
        // dd($data);
        return view('layouts.reservation' , ["data"=>$data]);
    }

    public function create($category_id)
    {
        $categories = Category::find($category_id);
        $tables = Table::get()->where('category_id' , $category_id);
        $reservation = Reservation::get()->where('category_id' , $category_id);
        // dd($table);
        return view("layouts.reseForm" , ['categories'=>$categories , 'tables'=>$tables , 'reservation'=>$reservation]);
    }

    public function store(Request $request)
    {
        // $xx = Carbon::parse();
        // dd($request->input('table_id'));
        $reservation = new Reservation;


        $reservation->first_name = $request->input('first_name');
        $reservation->last_name = $request->input('last_name');
        $reservation->email = $request->input('email');
        $reservation->tel_number = $request->input('tel_number');
        $reservation->res_date = $request->input('res_date');
        $reservation->guest_number = $request->input('guest_number');
        $reservation->category_id = $request->input('category_id');
        $reservation->table_id = $request->input('table_id');
        $reservation->user_id = $request->user()->id;


        $reservation->save();

        $user_reservation = Reservation::where('user_id' , $request->user()->id)->get();

        // dd($user_reservation);

        // return view('layouts.userReservation' , compact('reservation'));
        return redirect('/yourreservation');
    }

    public function delete($reservation)
    {
        $reser = Reservation::find($reservation);
        Reservation::where('id' , $reservation)->update([
            'status'=>'Deleted',
        ]);
        return redirect('/yourreservation');
    }



    public function editReservation($reservation)
    {
        $reser = Reservation::with('Category', 'User' , 'Table')->get()->where('id' , $reservation);
        // dd($reser->category);
        // $data = [];
        foreach ( $reser as $singleData ){
            // dd($singleData->Category->name);
            $data = [
                'id'=> $singleData->id,
                'first_name' => $singleData->first_name,
                'last_name'=> $singleData->last_name,
                'email'=>$singleData->email,
                'tel_number'=>$singleData->tel_number,
                'res_date' => $singleData->res_date,
                'Restaurant' => $singleData->Category->name,
                'category_id' => $singleData->Category->id,
                'Table' => $singleData->Table->name,
                'table_id' => $singleData->Table->id,
                'guest_number' => $singleData->Table->guest_number,
                'Location' => $singleData->Table->location,
                'Status' => $singleData->status,
            ];
        };

        $tables = Table::get()->where('category_id' , $data['category_id']);
        // dd($data);
        return view('layouts.editFormReservation' , compact('data' , 'tables'));
    }


    public function updateReservation(Request $request , $reservation)
    {
        $reser = Reservation::find($reservation);
        Reservation::where('id' , $reservation)->update([
            'first_name'=> $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'tel_number' => $request->input('tel_number'),
            'res_date' => $request->input('res_date'),
            'guest_number' => $request->input('guest_number'),
            'category_id' => $request->input('category_id'),
            'table_id' => $request->input('table_id'),
            'user_id' => $request->user()->id,
            'status'=>'Pending',
        ]);
        return redirect('/yourreservation');
    }
}
