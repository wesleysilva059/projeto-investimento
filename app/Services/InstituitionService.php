<?php 

namespace App\Services;

use App\Repositories\InstituitionRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\InstituitionValidator;

class InstituitionService
{
	private $repository;
	private $validator;

	public function __construct(InstituitionRepository $repository, InstituitionValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function store(array $data)
	{
		try 
		{
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$instituition = $this->repository->create($data);

			return [
				'success'	=> true,
				'messages'	=> "Instituição Cadastrada",
				'data'		=> $instituition,
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

	public function destroy($inst_id)
	{
		try 
		{
			$this->repository->delete($inst_id);
			return [
				'success' => true,
				'messages' => "Instituição Deletada",
				'data' => null,
			];	
		} 
		catch (Exception $e) 
		{
			return [
				'success' => false,
				'messages' => "Erro de Execução",
			];
		}

	}

}
