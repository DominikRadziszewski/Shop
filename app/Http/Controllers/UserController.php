<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
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
    public function edit(User $user)
    {
        return view("users.edit" , [
            "user"=> $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $addressvalidated = $request->validated()['address'];
        if($user->hasAdress()){
            $address = $user->address;
            $address->fill($addressvalidated);
        }else{
            $address=new Address($addressvalidated);
        }

        $user->address()->save($address);
        return redirect()->route("users.index")->with('status', __('shop.product.status.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    { 
       try {
        $user->delete();
        session()->flash('status', __('shop.user.status.delete.success')) ;   
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
