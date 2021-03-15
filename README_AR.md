# ماوظيفة هذه الحزمة 

حزمة magic role هي حزمة  تساعدك وتسهل عليك التحكم بصلاحيات المستخدمين  وتختصر عليك كتابة الكثير من الاكواد

# طريقة التنصيب
يتم تنصيب الحزمة عن طريق الكمبوزر 
اولا نفتح الترمنال او git terminal 
وننفذ الامر التالي 
  
      composer require alsa7err90/magic_role8
      
الخطوة التالية :
نفتح ملف app.php داخل مجلد config 
وداخل مصفوفة provider نضيف السطر التالي :

      alsa7err90\magic_role8\rolesServiceProvider::class,
      
وبنفس الصفحة لكن بمصفوفة aliases 
نضيف السطر التالي :

      'ViewRoles' => alsa7err90\magic_role8\ViewRolesFacade::class,
      
 الان نرجع الى الترمنال وننفذ الامر التالي  :
 
      php artisan vendor:publish --all
      
وننفذ الامر التالي :
  
      php artisan migrate
      
الان نفتح ملف User.php داخل مجلد app\models
وننسخ التالي :
      
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
        
الان لتعيين دور اساسي للمستخدم بعد تسجيل الاشتراك نفتح ملف CreateNewUser.php داخل مجلد app/Actions/Fortify
لنستبدل الكود القديم :

        return User::create([
              'name' => $input['name'],
              'email' => $input['email'],
              'password' => Hash::make($input['password']),
          ]);
          
بالكود الجديد : 

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
            
الخطوة الاخيرة :
نفتح ملف .env ونضيف  ايميل الادمن
صاحب هذا الايميل سوف يتمكن من الدخول الى اي صفحة بالموقع مهما كان الرول الذي يمتلكه 

      EMAIL_ADMINISTRATOR=yourEmailAdmin@example.com
      
# كيف تعمل الحزمة :
بعد اضافة الحزمة على المشروع سوف يكون لدينا 3 صفحات 
وهي roles , users , permissions
كل يوزر لديه رول واحد
وكل رول لديه مجموعة من الاذونات 
ف اعطاء المستخدم احد الرولات يعني اعطائه مجموعة من الاذونات 
ويمكن تعديل اذونات الرول بسهولة مما يمكننا امكانية كبيرة من التحكم بصلاحيات المستخدمين

# تسمية الا permissionds الاذونات 
عند الدخول الى صفحة permissions 
بهذه الصفحة يمكنك اضافة الاذونات بشكل الى او بشكل يدوي:
بشكل الي فقط اضغط ع لى  auto_insert_permission 
سوف يتم ااضافة مجموعة من الاذونات خاصة بكل كنترولر 
مثل show, store, update ,destroy1 ,destroy2
او يمكنك الاضافة يدويا 
لكن يجب ان يكون الاسم عبارة عن قسمين وتفصل بينهم ب اشاءة _ 
مثل :
          
          show_kek
          

# استخدام الحزمة داخل الكنترولر 
نستخدم الحزمة داخل الكنترولر للتحقق اذا كان المستخدم لديه الاذن بالوصول الى هذا المكان اول لا 
طريقة الاستخدام بسيطة وهي اضافة الكود التالي مع تغير اسم الكنترولر والفعل مثلا :

     $magic_role = new MagicRole();
     $magic_role->chakeRole('nameController','do') ;
     
nameController : وهو اسم الكنترولر الذي نحن بداخله 
do : الفعل مثلا نريد التخزين فالفعل هنا store 

