<?php
namespace App\Domain\Repositories;

use App\Domain\Models\Users;
use Illuminate\Support\Collection;

interface UsersRepositoryInterface
{
   public function all(): Collection;
}