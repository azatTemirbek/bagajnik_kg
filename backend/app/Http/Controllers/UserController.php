<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResources\UserFullResource;
use App\Http\Resources\UserResources\UserResource;
use App\Http\Resources\UserResources\UserResourceCollection;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        //$request->has ('name') && $query->where('to_user_id', '>=', 45);
        //error_log($request->name);
        $user = $query->paginate(15);
        return new UserResourceCollection($user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//  public function store( $request)
//  {
//    $rating = new Rating($request->all());
//    if ($rating->save()) {
//      return New RatingsResource($rating);
//    }
//  }
    /**
     * Display the specified resource.
     * @param User $user
     * @return UserFullResource
     */
    public function show(User $user)
    {
        UserResource::withoutWrapping();
        return new UserFullResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param UserRequest $request
     * @param $id
     * @return UserResource
     */
    public function update(UserRequest $request, $id)
    {
        $userUpdate = User::findOrFail($id);
        $inputs = $request->all([
            'surname',
            'name',
            'phone'
        ]);
        $userUpdate->fill($inputs)->save();
        return new UserResource($userUpdate);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//  public function destroy(Rating $rating)
//  {
//    if ($rating->delete()) {
//      return new RatingsResource($rating);
//    }
//  }

}
