<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("users.index" , [
            "users"=> User::paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    { 
       try {
        $user->delete();   
        return response()->json([
            'status'=>'success'
        ]);
       } catch (\Throwable $th) {
        return response()->json([
            'status'=>'error',
            'message'=> 'Wystąpił błąd!'
        ])->setStatusCode (500);
       }
    }
}
