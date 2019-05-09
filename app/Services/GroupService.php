<?php 

namespace App\Services;

use App\Repositories\GroupRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Validators\GroupValidator;

class GroupService
{
    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store(array $data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $group = $this->repository->create($data);

            return[
                'success'   => true,
                'messages'  => "Grupo Cadastrado",
                'data'      => $group,
            ];
        }
        catch (Exception $e)
        {
            return[
                'success' => false,
                'messages' => "Erro de Execução",
            ];
        }
    }

    public function userStore($group_id, $data)
    {
        try
        {

            $group      = $this->repository->find($group_id);
            $user_id    = $data['user_id'];

            $group->users()->attach($user_id);

            return[
                'success'   => true,
                'messages'  => "Usuario Relacionado com sucesso",
                'data'      => $group,
            ];
        }
        catch (Exception $e)
        {
            return[
                'success' => false,
                'messages' => "Erro de Execução",
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
				'messages' => "Grupo Deletado",
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