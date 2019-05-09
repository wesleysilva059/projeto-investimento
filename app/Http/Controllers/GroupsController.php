<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use App\Repositories\InstituitionRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;

class GroupsController extends Controller
{

    protected $repository;
    protected $validator;
    protected $service;
    protected $userRepository;
    protected $instituitionRepository;

    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service, UserRepository $userRepository, InstituitionRepository $instituitionRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
        $this->userRepository = $userRepository;
        $this->instituitionRepository = $instituitionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $groups = $this->repository->all();

        //Forma usando metodo padrao do Laravel
        //$user_list = \App\Entities\User::pluck('name', 'id')->all();
        
        $user_list          = $this->userRepository->selectBoxList();
        $instituition_list  = $this->instituitionRepository->selectBoxList();;

        return view('group.index', 
        [
            'groups'            => $groups,
            'user_list'         => $user_list,
            'instituition_list' => $instituition_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {
        $group = $request['success'] ? $request['data'] : null;

        $request = $this->service->store($request->all());

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
       ]);

       return redirect()->route('group.index');
    }

    public function userStore(Request $request, $group_id)
    {

        $request = $this->service->userStore($group_id, $request->all());

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
       ]);

       return redirect()->route('group.show', [$group_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = $this->repository->find($id);
        $user_list = $this->userRepository->selectBoxList();

         return view('group.show', [
             'group' => $group,
             'user_list' => $user_list 
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = $this->repository->find($id);

        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GroupUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $group = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'IGroup updated.',
                'data'    => $group->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = $this->service->destroy($id);

        session()->flash('success', [
            'success'   => $request['success'],
            'messages'  => $request['messages']
       ]);

        return redirect()->route('group.index');
    }
}
