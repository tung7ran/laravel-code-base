<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Orders\OrderCreateRequest;
use App\Http\Requests\Orders\OrderUpdateRequest;
use App\Repositories\Orders\OrderRepository;
use App\Validators\Orders\OrderValidator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers\Orders;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $repository
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $repository, OrderValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    protected function module(){
        return [
            'name' => 'Đơn hàng',
            'module' => 'orders',
            'table' =>[
                'code' => [
                    'title' => 'Mã đơn hàng',
                    'with' => '',
                ],
                'name' => [
                    'title' => 'Tên khách hàng',
                    'with' => '',
                ],
                'phone' => [
                    'title' => 'Số điện thoại',
                    'with' => '',
                ],
                'total_price' => [
                    'title' => 'Tổng tiền',
                    'with' => '',
                ],
                'type_pay' => [
                    'title' => 'Hình thức thanh toán',
                    'with' => '',
                ],
                'date_create' => [
                    'title' => 'Ngày đặt',
                    'with' => '',
                ],
                'date_receive' => [
                    'title' => 'Ngày nhận',
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái',
                    'with' => '',
                ],
                'view' => [
                    'title' => 'Chi tiết',
                    'with' => '',
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
        if($request->ajax()){
            $order = Order::orderBy('id','DESC')->get();
            return Datatables::of($order)
                ->addColumn('total_price', function ($data) {
                    return number_format($data->total_price).'đ';
                })->addColumn('name', function ($data) {
                    return @$data->Customers->name;
                })->addColumn('phone', function ($data) {
                    return @$data->Customers->phone;
                })->addColumn('date_create', function ($data) {
                    return $data->created_at;
                })->addColumn('date_receive', function ($data) {
                    if($data->status == 4){
                        return $data->updated_at;
                    }
                    return '-------';
                })->addColumn('type_pay', function ($data) {
                    if($data->type == 2){
                        return '<span class="badge label-success">Thanh toán khi nhận hàng</span>';
                    }else {
                        return '<span class="badge label-success">Chuyển khoản ngân hàng</span>';
                    }
                })->editColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return '<span class="badge label-warning"> Mới đặt</span>';
                    }elseif ($data->status == 2) {
                        return '<span class="badge label-primary"> Xác nhận</span>';
                    }elseif ($data->status == 3) {
                        return '<span class="badge label-info"> Đang giao hàng</span>';
                    }elseif ($data->status == 4) {
                        return '<span class="badge label-success"> Hoàn thành</span>';
                    }elseif ($data->status == 5) {
                        return '<span class="badge label-danger">Hủy</span>';
                    }
                })->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="'.$data->id.'">';
                })->addColumn('code', function ($data) {
                    return '<a href="'.route('orders.edit', $data->id).'">#ORDER_'.$data->id.'</a>';
                })->addColumn('action', function ($data) {
                    return '<a href="javascript:;" class="btn-destroy"
                  data-href="'.route( 'orders.destroy',  $data->id ).'"
                      data-toggle="modal" data-target="#confim">
                    <i class="fa fa-trash-o fa-fw"></i> Xóa
                </a>';
                })->addColumn('view', function ($data) {
                    return '<a href="'.route('orders.edit', $data->id).'"><i class="fa fa-eye"></i> Xem</a></td>';
                })
                ->rawColumns(['checkbox','code','action','view','status', 'type_pay', 'date_receive', 'date_create'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view('backend.orders.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $order = $this->repository->create($request->all());

            $response = [
                'message' => trans('messages.create_success'),
                'data'    => $order->toArray(),
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
        $order = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $order,
            ]);
        }

        return view('orders.show', compact('order'));
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
        $order = $this->repository->find($id);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $order = $this->repository->update($request->all(), $id);

            $response = [
                'message' => trans('messages.update_success'),
                'data'    => $order->toArray(),
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

        return redirect()->back()->with('message', 'Order deleted.');
    }

    /**
      * Remove multiple
      */
    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                OrderDetail::where('id_order', $id)->delete();
                Order::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }
}
