<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\UsersRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
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
                return $this->errorResponse('Verifique os dados enviados.', $validator->errors());
            }

            $user = $this->usersRepository->create($request->all());

            return $this->successResponse('Usuário cadastrado', $user);

        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao cadastrar o usuário");
        }
    }

    public function find($user): JsonResponse
    {
        try {
            $user = $this->usersRepository->find($user);

            if (!$user) {
                return $this->errorResponse('Usuário não encontrado');
            }

            return $this->successResponse('Usuário encontrado', $user);
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao buscar o usuário");
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
                return $this->errorResponse('Verifique os dados enviados.', $validator->errors());
            }

            $user = $this->usersRepository->find($user);

            if (!$user) {
                return $this->errorResponse('Usuário não encontrado');
            }

            $model = $this->usersRepository->update($user, $request->all());
            return $this->successResponse($model, 'Usuário atualizado');
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao alterar o usuário");
        }
    }

    public function delete($user): JsonResponse
    {
        try {
            $user = $this->usersRepository->find($user);

            if (!$user) {
                return $this->errorResponse('Usuário não encontrado');
            }

            $user = $this->usersRepository->delete($user);

            return response()->json([
                'message' => ['message' => 'Usuário removido']
            ]);
            return $this->successResponse('Usuário removido');
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao remover o usuário");
        }
    }

    public function all(): JsonResponse
    {
        try {
            $users =  $this->usersRepository->all()->toArray();

            return $this->successResponse('Listagem de usuários', $users);
        } catch (\Exception $exception) {
            return $this->errorResponse("Erro ao listar os usuário");
        }
    }
}
