<?php 

   namespace App\Http\ViewComposers;


use Cache;
use App\Models\Post;
use Illuminate\View\View;

   class ActivityComposer{
      public function compose(View $view){
         $mostCommented = Cache::remember('mostCommented',now()->addSeconds(10),function(){
            return \App\Models\Post::mostCommented()->take(5)->get();
        });

        $mostUsersActive = Cache::remember('mostUsersActive',now()->addSeconds(10),function(){
            return \App\Models\User::usersActive()->take(5)->get();
        });

        $mostUserActiveInLastMonths = Cache::remember('mostUserActiveInLastMonths',now()->addSeconds(10),function(){
            return \App\Models\User::userActiveInLastMonth()->take(5)->get();
        });
            
        $view->with([
               'mostCommented'=>$mostCommented,
               'mostUsersActive'=>$mostUsersActive,
               'mostUserActiveInLastMonths'=>$mostUserActiveInLastMonths
        ]);    
      }
   }
