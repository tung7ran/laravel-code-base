<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Finace\Banks;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Finace\BanksCreateRequest;
use App\Http\Requests\Finace\BanksUpdateRequest;
use App\Repositories\Finace\BanksRepository;
use App\Validators\Finace\BanksValidator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BanksController.
 *
 * @package namespace App\Http\Controllers\Finace;
 */
class BanksController extends Controller
{
    /**
     * @var BanksRepository
     */
    protected $repository;

    /**
     * @var BanksValidator
     */
    protected $validator;

    /**
     * BanksController constructor.
     *
     * @param BanksRepository $repository
     * @param BanksValidator $validator
     */
    public function __construct(BanksRepository $repository, BanksValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    protected function module(){
        return [
            'name' => 'Tài khoản ngân hàng',
            'module' => 'banks',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh',
                    'with' => '70px',
                ],
                'name_bank' => [
                    'title' => 'Tên ngân hàng',
                    'with' => '',
                ],
                'name_account' => [
                    'title' => 'Tên chủ thẻ',
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
            $list_bank = Banks::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_bank)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })
                ->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('name_bank', function ($data) {
                    return $data->name_bank;
                })->addColumn('name_account', function ($data) {
                    return $data->name_account;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('banks.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy"
                            data-href="' . route('banks.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })
                ->rawColumns(['checkbox', 'image', 'status', 'action', 'name_bank', 'name_account'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BanksCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BanksCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bank = $this->repository->create($request->all());

            $response = [
                'message' => trans('messages.create_success'),
                'data'    => $bank->toArray(),
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
        $bank = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bank,
            ]);
        }

        return view('banks.show', compact('bank'));
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
        $bank = $this->repository->find($id);

        return view('banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BanksUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BanksUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bank = $this->repository->update($request->all(), $id);

            $response = [
                'message' => trans('messages.update_success'),
                'data'    => $bank->toArray(),
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

        return redirect()->back()->with('message', 'Banks deleted.');
    }

    /**
     * Remove multiple
     */
    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Banks::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }
}
