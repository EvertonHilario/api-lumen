<?php


namespace App\Domain\Services;

use App\Domain\Repositories\UsersRepositoryInterface;

final class UsersService
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function create(array $attributes): object
    {
        return $this->usersRepository->create($attributes);
    }

    public function find(int $user): ?object
    {
        return $this->usersRepository->find($user);
    }

    public function update(object $user, array $attributes): Bool
    {
        return $this->usersRepository->update($user, $attributes);
    }

    public function delete(object $user)
    {
        return $this->usersRepository->delete($user);
    }

    public function all()
    {
        return $this->usersRepository->all()->toArray();
    }
}