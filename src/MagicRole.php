<?php
namespace alsa7err90\magic_role8;

use App\Models\Magrole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Auth;
    class MagicRole
    {
        public static function test(){
            echo "Wonderful that it works successfully";
        }

        public static function chakeRole($model,$any_curd)
        {
            $mag_role = new MagicRole();
            $Administrator = $mag_role->Administrator();
            if($Administrator === false)
            {
                if($mag_role->chakeRAP($model,$any_curd) === false)
                    {
                        return  abort(403);
                    }
            }
        }

        public static   function chakeRAP($model,$any_curd) :bool
        {
            //any_card = show ||  store ||  update || destroy1  ||destroy2
            try
            {
                $user_id = Auth::user()->id;
                $id_role_user = User::findOrFail($user_id)->roles->first()->id; // get id role user
                $final_name_model_curd = $any_curd.'_'.$model; // this for get name permission
                $status = Magrole::findOrFail($id_role_user)->magpermissions->contains('slug', $final_name_model_curd);// return true or false
                return $status ; // return true or false
            } catch (\Throwable $th) {
                return false;
            }

        }

        public function Administrator() :bool
        {
            try
            {
                $user_email = Auth::user()->email;
                $email_Administrator = env('EMAIL_ADMINISTRATOR');
                return ($user_email===$email_Administrator) ?? false;
            }
            catch (\Throwable $th)
            {
                return false;
            }
        }
    }
