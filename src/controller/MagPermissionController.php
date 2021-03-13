<?php

namespace App\Http\Controllers;

use alsa7err90\magic_role8\MagicRole;
use App\Models\Magpermission;
use Illuminate\Http\Request;

class MagPermissionController extends Controller
{
    public function index()
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagPermissionController','show') ;
        $Magpermissions = Magpermission::get(['name','slug','id']);
        return view('mag::mag_permission',compact('Magpermissions'));
    } // end index

    public function store(Request $request)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagPermissionController','store') ;
        $request->validate([
            'name' => 'required|max:30',
            'slug' => 'required|max:30',
        ]);
        Magpermission::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        return redirect()->back();
    } // end store

    public function destroy($id)
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagPermissionController','destroy1') ;
        $record = Magpermission::where('id', $id)->firstOrFail();;
        $record->delete();
        return redirect()->back();
    } // end destroy

    public function auto_insert_permission()
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagPermissionController','store') ;
        $models =  $this->getModels(app_path("http/controllers/"), "");
        foreach($models as $model)
        {
            $this->set_permission($model,['show','store','update','destroy1','destroy2']);
        }
        return redirect()->back();
    } // auto_insert_permission

    function getModels($path, $namespace)
    {
        $out = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $path
            ), \RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            if($item->isReadable() && $item->isFile() && mb_strtolower($item->getExtension()) === 'php'){
                $out[] =  $namespace .
                    str_replace("/", "\\", mb_substr($item->getRealPath(), mb_strlen($path), -4));
            }
        }
        return $out;
    } // getModels
    
    public function set_permission($model,$does):void
    {
        foreach($does as $do){
            $user = Magpermission::where('name', '=',$do.'_'.$model)->first();
            if ($user === null) {
                Magpermission::create([
                    'name' => $do.'_'.$model,
                    'slug' => $do.'_'.$model
                ]);
            }

        }

    }


}
