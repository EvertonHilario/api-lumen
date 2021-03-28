<?php

namespace App\Http\Controllers;

use App\Domain\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'cpf' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users'
            ]);

            if ($validator->fails()) {
                throw new \DomainException ($validator->errors(), 422);
            }

            $user = $this->usersService->create($request->all());

            return $this->successResponse('Usuário cadastrado', $user);

        } catch (\DomainException $exception) {
            return $this->errorResponse($exception->getMessage());
        } catch (\Exception $exception) {
            return $this->errorResponse('Erro ao cadastrar o usuário');
        }
    }

    public function find($user): JsonResponse
    {
        try {
            $user = $this->usersService->find($user);

            if (!$user) {
                throw new \DomainException ('Usuário não encontrado', 422);
            }

            return $this->successResponse('Usuário encontrado', $user);
        } catch (\DomainException $exception) {
            return $this->errorResponse($exception->getMessage());
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao buscar o usuário" . $exception->getMessage());
        }
    }

    public function update($user, Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'cpf' => 'required',
                'telephone' => 'required',
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                throw new \DomainException ($validator->errors(), 422);
            }

            $user = $this->usersService->find($user);

            if (!$user) {
                return $this->errorResponse('Usuário não encontrado');
            }

            $model = $this->usersService->update($user, $request->all());
            return $this->successResponse($model, 'Usuário atualizado');
        } catch (\DomainException $exception) {
            return $this->errorResponse($exception->getMessage());
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao alterar o usuário");
        }
    }

    public function delete($user): JsonResponse
    {
        try {
            $user = $this->usersService->find($user);

            if (!$user) {
                throw new \DomainException ('Usuário não encontrado', 422);
            }

            $user = $this->usersService->delete($user);

            return $this->successResponse('Usuário removido');
        } catch (\DomainException $exception) {
            return $this->errorResponse($exception->getMessage());
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao remover o usuário");
        }
    }

    public function all(): JsonResponse
    {
        try {
            $users =  $this->usersService->all();

            return $this->successResponse('Listagem de usuários', $users);
        } catch (\DomainException $exception) {
            return $this->errorResponse($exception->getMessage());
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao listar os usuário");
        }
    }
}
