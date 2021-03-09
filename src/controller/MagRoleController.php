<?php

namespace App\Http\Controllers;

use alsa7err90\magic_role8\MagicRole;
use App\Models\Magpermission;
use App\Models\Magrole;
use Illuminate\Http\Request;

class MagRoleController extends Controller
{
    public function index()
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagRoleController','show') ;
        $roles = Magrole::get(['name','slug','id']);
        return view('mag::mag_role',compact('roles'));
    } // end index

    public function store(Request $request)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagRoleController','store') ;
        $request->validate([
            'name' => 'required|max:30',
            'slug' => 'required|max:30',
        ]);
        Magrole::create([
            'name' => $request->name,
            'slug' => $request->slug

        ]);
        return redirect()->back();
    } // end store

    public function show($id)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagRoleController','show') ;
        $all_permissions = Magpermission::get(['name','slug','id']) ;
        $mag_permissions_array = Magrole::findOrFail($id)->magpermissions()->pluck('name')->toArray();
        $mag_permissions = Magrole::findOrFail($id)->magpermissions()->get()  ;
        return view('mag::mag_edit_role',compact('mag_permissions','all_permissions','mag_permissions_array','id'));
    } // end show

    public function destroy($id)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagRoleController','destroy1') ;
        $record = Magrole::where('id', $id)->firstOrFail();
        $record->delete();
        return redirect()->back();
    } // end destroy

    public function unckeck_permission_from_role(Request $request)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagRoleController','update') ;
        if(!$request->unckeck == null){
              Magrole::findOrFail($request->id_role)->magpermissions()->detach($request->unckeck);
        }
        return redirect()->back();
    } // end unckeck_permission_from_role

    public function ckeck_permission_from_role(Request $request)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagRoleController','update') ;
        if(!$request->ckeck == null){
             Magrole::findOrFail($request->id_role)->magpermissions()->attach($request->ckeck);
        }
        return redirect()->back();
    } // end ckeck_permission_from_role

}
