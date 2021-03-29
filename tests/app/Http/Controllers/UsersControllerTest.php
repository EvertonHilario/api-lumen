<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

final class UsersControllerTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;
    /**
     * Create User.
     *
     * @return void
     */
    public function testCreate(): void
    {
        $request = $this->mockRequest();

        $this->json('POST', '/users', $request)->seeJson(['code' => 200]);
    }

    /**
     * Attempting to register without entering the name attribute.
     *
     * @return void
     */
    public function testCreateWithoutTheName(): void
    {
        $request = $this->mockRequest();
        unset($request['name']);

        $this->json('POST', '/users', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['name' => ["The name field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Attempting to register without entering the cpf attribute.
     *
     * @return void
     */
    public function testCreateWithoutTheCpf(): void
    {
        $request = $this->mockRequest();
        unset($request['cpf']);
        $this->json('POST', '/users', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['cpf' => ["The cpf field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Attempting to register without entering the telephone attribute.
     *
     * @return void
     */
    public function testCreateWithoutTheTelephone(): void
    {
        $request = $this->mockRequest();
        unset($request['telephone']);
        $this->json('POST', '/users', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['telephone' => ["The telephone field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Attempting to register without entering the email attribute.
     *
     * @return void
     */
    public function testCreateWithoutTheEmail(): void
    {
        $request = $this->mockRequest();
        unset($request['email']);
        $this->json('POST', '/users', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['email' => ["The email field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }




    /**
     * Attempting to update without entering the name attribute.
     *
     * @return void
     */
    public function testUpdateWithoutTheName(): void
    {
        $request = $this->mockRequest();
        unset($request['name']);

        $this->json('PUT', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['name' => ["The name field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Attempting to update without entering the cpf attribute.
     *
     * @return void
     */
    public function testUpdateWithoutTheCpf(): void
    {
        $request = $this->mockRequest();
        unset($request['cpf']);
        $this->json('PUT', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['cpf' => ["The cpf field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Attempting to update without entering the telephone attribute.
     *
     * @return void
     */
    public function testUpdateWithoutTheTelephone(): void
    {
        $request = $this->mockRequest();
        unset($request['telephone']);
        $this->json('PUT', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['telephone' => ["The telephone field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Attempting to update without entering the email attribute.
     *
     * @return void
     */
    public function testUpdateWithoutTheEmail(): void
    {
        $request = $this->mockRequest();
        unset($request['email']);
        $this->json('PUT', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => ['email' => ["The email field is required."]],
            'message' => "Verifique os atributos",
            'status' => "error",
        ]);
    }

    /**
     * Update User.
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $request = $this->mockRequest();
        $this->post('/users',$request);
        
        $request['email'] = 'emai@teste.com';

        $this->json('PUT', '/users/1', $request)->seeJson(['code' => 200]);
    }

    /**
     * Update - User not found .
     *
     * @return void
     */
    public function testUpdateUserNotFound(): void
    {
        $request = $this->mockRequest();
        
        $this->json('PUT', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => [],
            'message' => "Usuário não encontrado",
            'status' => "error",
        ]);
    }

    /**
     * Delete - User not found .
     *
     * @return void
     */
    public function testDeleteUserNotFound(): void
    {
        $request = $this->mockRequest();
        
        $this->json('DELETE', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => [],
            'message' => "Usuário não encontrado",
            'status' => "error",
        ]);
    }

    /**
     * Delete.
     *
     * @return void
     */
    public function testDelete(): void
    {
        $request = $this->mockRequest();
        $this->post('/users',$request);
        
        $this->json('DELETE', '/users/1', $request)->seeJsonEquals([
            'code' => 200,
            'data' => [],
            'message' => "Usuário removido",
            'status' => "success",
        ]);
    }

    /**
     * Find.
     *
     * @return void
     */
    public function testFind(): void
    {
        $request = $this->mockRequest();
        $this->post('/users',$request);
        
        $this->json('GET', '/users/1', $request)->seeJson(['code' => 200]);
    }

    /**
     * Find - user not found.
     *
     * @return void
     */
    public function testFindUserNotFound(): void
    {
        $request = $this->mockRequest();
        
        $this->json('GET', '/users/1', $request)->seeJsonEquals([
            'code' => 422,
            'data' => [],
            'message' => "Usuário não encontrado",
            'status' => "error",
        ]);
    }

    /**
     * All.
     *
     * @return void
     */
    public function testAll(): void
    {
        $request = $this->mockRequest();
        $this->post('/users',$request);
        
        $this->json('GET', '/users', $request)->seeJson(['code' => 200]);
    }

    private function mockRequest()
    {
        return [
            'id' => 1,
            'name' => 'required',
            'cpf' => 'required',
            'telephone' => 'required',
            'email' => 'email@empresas.com.br',
            'obs' => 'email@empresas.com.br',
        ];
    }
}
