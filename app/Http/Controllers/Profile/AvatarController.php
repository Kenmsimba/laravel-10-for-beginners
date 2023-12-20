<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAvatarRequest; //added to support the function below

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request){

        /*
        Validating within a controller which is not good practice...
        function is later moved to app\Http\Requests\UpdateAvatarRequest.php

        $request->validate ([
            'avatar' => 'required|image',

        ]);
        */

        /*
        store avatar
        return response()->redirectTo(route('profile.edit'));
        */

        // dd($request->all());
        // dd(auth()->user());

        $path = $request->file('avatar')->store('avatars','public');
        // $path = Storage::disk('public')->put('avatars', $request->file('avatar'));  another possible approach

        if($oldAvatar = $request->user()->avatar){

            Storage::disk('public')->delete($oldAvatar);
        }
        auth()->user()->update(['avatar' => $path]);
        
        // dd(auth()->user());
        // /$path = $request->file('avatar')->store('avatars');
        
        //second possible approach
        return redirect(route('profile.edit'))->with ('message','Avatar is updated');

        /*
        save and return a message
        return back()->with('message',"Avatar is changed.");
        */
    }
}
