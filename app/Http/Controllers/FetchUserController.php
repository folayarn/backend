<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userlist;

class FetchUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Userlist::orderBy('created_at','desc')->take(5)->get();
        return response()->json($list);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function indexNumber($number)
    {
        $list=Userlist::orderBy('created_at','desc')->take($number)->get();
        return response()->json($list);
        }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validateData=  $this->validate($request,[
  "name"=>"required",
  "email"=>"required|email|unique:userlists",
  "age"=>"required",
  "address"=>"required"
        ]);
$list= new Userlist;
$list->create($validateData);
return response()->json(['message'=>'saved to the database']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $single=Userlist::find($id);
        return response()->json(['user'=>$single]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
