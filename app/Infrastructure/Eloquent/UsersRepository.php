<?php

namespace App\Infrastructure\Eloquent;

use App\Domain\Models\Users;
use App\Domain\Repositories\UsersRepositoryInterface;
use Illuminate\Support\Collection;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{

   /**
    * UsersRepository constructor.
    *
    * @param Users $model
    */
   public function __construct(Users $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }
}