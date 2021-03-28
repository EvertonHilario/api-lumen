<?php 

namespace App\Providers; 

use App\Domain\Repositories\EloquentRepositoryInterface; 
use App\Domain\Repositories\UsersRepositoryInterface; 
use App\Infrastructure\Eloquent\UsersRepository; 
use App\Infrastructure\Eloquent\BaseRepository; 
use Illuminate\Support\ServiceProvider; 

/** 
* Class RepositoryServiceProvider 
* @package App\Providers 
*/ 
class RepositoryServiceProvider extends ServiceProvider 
{ 
   /** 
    * Register services. 
    * 
    * @return void  
    */ 
   public function register() 
   { 
       $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
   }
}