# magic roles 
This package enables you to add and define user roles and permissions with ease
 
#  Installation :
Install the package through Composer.

Run the Composer require command from the Terminal:

    composer require alsa7err90/magic_role8

- Open config/app.php and add this line to your Service Providers Array.

      alsa7err90\magic_role8\rolesServiceProvider::class,

- Open config/app.php and add this line to your Aliases:

      'ViewRoles' => alsa7err90\magic_role8\ViewRolesFacade::class,

- Publish  files with 

      php artisan vendor:publish --all
      
- Run the php artisan migrate command from the Terminal:
               
      php artisan migrate

- Open app\Models\User.php and add this methods to "class User":

       public function hasRole(... $roles) 
       {
            foreach ($roles as $role) 
            {
                  if ($this->roles->contains('slug', $role)) 
                  {
                      return true;
                  }
           }
           return false;
      }

      public function roles()
      {
          return $this->belongsToMany(Magrole::class);
      }
      
      public function assignRole(Magrole $role)
      {
          return $this->roles()->save($role);
      }


- to assign Role delault for user after register :
   open file "CreateNewUser.php" in foler "app/Actions/Fortify" and edit function register from:
   
      this old code :
      return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        
      to new code :
       use App\Models\Magrole; // this before class CreateNewUser
       .. 
       ..
        $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $role = Magrole::where('name', 'user')->first();
        $user->assignRole($role);
        return $user;
   

 - open file .env and add the line don't forget to replace the email by email adminstrator:

       EMAIL_ADMINISTRATOR=yourEmailAdmin@example.com
      
      
#  useing :
 -go to the link:
 
    http://127.0.0.1:8000/mag_permissions
here you can add permission Manual or auto
if  you want to do that automatically  just  click button: auto_refresh_permission
or if you want to add Manually you shold write first name class controller or any class you use after that
write "_" after that write do as "show, store, save, ....." or any name you need :
     
              Ex:   show_Controller 

-go to the link:

    http://127.0.0.1:8000/mag_roles

add role ex: admin, editor, user
After add that click on "edit permissions"
to add or remove permission this role
-go to the link:

    http://127.0.0.1:8000/mag_users
and add role to users

1- route:

        resource: mag_roles
        resource: mag_permissions
        resource: mag_users

   as link: 
   
        <a href=" {{ URL::to('mag_roles') }}" > roles </a> 


  2 - controller:
 
   To check if the user has permission to use this function:
         
         $magic_role = new MagicRole();
         $magic_role->chakeRole('nameController','do') ;
      
-nameController: name class controller ex:
we have controller by name:

       use alsa7err90\magic_role8\MagicRole; 
       class Postcontroller extends Component
       {
          public function show ()
          {
                  $magic_role = new MagicRole();
                  $magic_role->chakeRole('Postcontroller ', 'show');
             ...............
           }
        }

 -do: if used auto_insert_permission this add 4 word you can be used:
 
       -show: use in function index and show ($ id)
       -update: use in function edit and update (Request $ request, $ id)
       -destroy1: use for softy delete
       -destroy2: use for delete
       -store: use in function create and store

 
 # use in blade
 to get role of the user 
 
       $role_user = ViewRoles::has_role();
 this will return name role as "admin" or "editor" etc
       
 to check if user have any role as "admin":
       
       $has_admin = ViewRoles::his_role("admin");
 this will return true or false 
       
 to check if user have permission as "show_Controller" :
 
       ViewRoles::his_permission("show_MagPermissionController");
  this will return true or false 
  
 example for check  if he has permission to show links :
  
               @if(ViewRoles::his_permission("show_PostController"))
                    <a href='" {{ URL::to('Post') }} Post </a>
               @endif
               
if you do not want use the defualt route you can use blade directory inside any page in view  :

     @mag_user
     @mag_role
     @mag_permission

just write anyone from this and will get a table or a form or both of them.
if you want edit style this tables or forms go to folder vendor/alsa7err90/mag_role/src/view
and select any file you want to edit.


         
