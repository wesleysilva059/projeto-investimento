<?php 

namespace App\Services;

use App\Repositories\UserRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\UserValidator;



class UserService
{
		private $repository;
		private $validator;

	public function __construct(UserRepository $repository, UserValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function store($data)
	{
		try 
		{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$usuario = $this->repository->create($data);

			return [
				'success' => true,
				'messages' => "Usuario Cadastrado",
				'data' => $usuario,
			];	
		} 
		catch (Exception $e) 
		{
			return [
				'success' => false,
				'messages' => "Erro de execução",
			];
		}
	}

	public function update()
	{

	}

	public function destroy($user_id)
	{
		try 
		{
            $this->repository->delete($user_id);

			return [
				'success' => true,
				'messages' => "Usuario Deletado",
				'data' => null,
			];	
		} 
		catch (Exception $e) 
		{
			return [
				'success' => false,
				'messages' => "Erro de execução",
			];
		}
	}

}

 ?>