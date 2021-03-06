<?php

namespace App\Http\Controllers;

use alsa7err90\magic_role8\MagicRole;
use App\Models\Magrole;
use App\Models\User;
use Illuminate\Http\Request;

class MagUserController extends Controller
{
    public function index()
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagUserController','show') ;
        $magUsers =  User::with('roles')->get();
        $magRoles =  Magrole::get(['name','slug','id']);
        return view('mag::mag_user',compact('magUsers','magRoles'));
    } // end index

    public function edit_role_user(Request $request, $id)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagUserController','update') ;
        User::findOrFail($id)->roles()->sync(array($request->new_role));
        return redirect()->back();
    } // end edit_role_user

    public function search_user(Request $request){
        $magRoles =  Magrole::get(['name','slug','id']);
        $magUsers = User::query()
        ->where('email', 'LIKE', "%{ $request->text}%")
        ->orWhere('name', 'LIKE', "%{$request->text}%")
        ->orWhere('id', '=', "$request->text")
        ->get();
        return view('mag::mag_search', compact('magUsers','magRoles'));
    } // end search_user

}
