<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Policy\Policy;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Policy\PolicyCreateRequest;
use App\Http\Requests\Policy\PolicyUpdateRequest;
use App\Repositories\Policy\PolicyRepository;
use App\Validators\Policy\PolicyValidator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PoliciesController.
 *
 * @package namespace App\Http\Controllers\Policy;
 */
class PoliciesController extends Controller
{
    /**
     * @var PolicyRepository
     */
    protected $repository;

    /**
     * @var PolicyValidator
     */
    protected $validator;

    /**
     * PoliciesController constructor.
     *
     * @param PolicyRepository $repository
     * @param PolicyValidator $validator
     */
    public function __construct(PolicyRepository $repository, PolicyValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    protected function module(){
        return [
            'name' => 'Chính sách',
            'module' => 'policy',
            'table' =>[
                'name' => [
                    'title' => 'Tên chính sách',
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái',
                    'with' => '100px',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list_policy = Policy::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_policy)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('name', function ($data) {
                    return $data->name .'<br><a href="'.route('home.single-policy', $data->slug).'" target="_blank">'.route('home.single-policy', $data->slug).'</a>';
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('policy.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy"
                            data-href="' . route('policy.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })
                ->rawColumns(['checkbox', 'status', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PolicyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PolicyCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $policy = $this->repository->create($request->all());

            $response = [
                'message' => trans('messages.create_success'),
                'data'    => $policy->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $policy = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $policy,
            ]);
        }

        return view('policies.show', compact('policy'));
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
        $policy = $this->repository->find($id);

        return view('policies.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PolicyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PolicyUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $policy = $this->repository->update($request->all(), $id);

            $response = [
                'message' => trans('messages.update_success'),
                'data'    => $policy->toArray(),
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => trans('messages.delete_success'),
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Policy deleted.');
    }
}
