<?php
namespace alsa7err90\magic_role8;

use App\Models\Magrole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Auth;
class ViewRoles
{
    public static function test(){
        echo "Wonderful that it works successfully";
    }

    public function has_role(){
        $user_id = Auth::user()->id;
        $magUsers =  User::findOrFail($user_id)->with('roles')->pluck("name");
        return $magUsers[0];
    }

    public function his_role($mag_role) :bool
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return ($user->hasRole($mag_role)) ?? false;

    }

    public function his_permission($mag_permission) :bool
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        foreach ($user->roles as $role){
           $id_role = $role->id  ;
        }
        $mag_role = Magrole::findOrFail($id_role);
        return ($mag_role->hasPermission($mag_permission)) ?? false;
    }

}
