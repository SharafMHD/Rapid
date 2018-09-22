<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreatebillsRequest;
use App\Http\Requests\UpdatebillsRequest;
use App\Models\billdetails;
use App\Models\orderdetails;
use App\Models\bills;
use App\Models\orders;
use App\Models\customers;
use App\Models\items;
use App\Models\shippers;
use App\Models\units;
use App\Repositories\billsRepository;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class billsController extends AppBaseController
{
    /** @var  billsRepository */
    private $billsRepository;
    private $customersRepository;

    public function __construct(billsRepository $billsRepo)
    {
        $this->billsRepository = $billsRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the bills.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->billsRepository->pushCriteria(new RequestCriteria($request));
        $bills = $this->billsRepository->all();

        return view('bills.index')->with('bills', $bills);
    }

    /**
     * Show the form for creating a new bills.
     *
     * @return Response
     */
    public function create()
    {
        $customers = customers::pluck('name', 'id');
        $shippers = shippers::pluck('name', 'id');
        $items = items::pluck('name', 'id');
        return view('bills.create')->with('shippers', $shippers)->with('customers', $customers)->with('items', $items);

    }

    /**
     * Store a newly created bills in storage.
     *
     * @param CreatebillsRequest $request
     *
     * @return Response
     */
    public function savebill(Request $request)
    {
        if ($request->ajax()) {
            $bill = new bills;
            $bill->bill_date = $request->bill_date;
            $bill->amount = $request->amount;
            $bill->payed = $request->payed;
            $bill->remainig = $request->remainig;
            $bill->code = $request->code;
            $bill->customer_id = $request->customer_id;
            $bill->shipper_id = $request->shipper_id;
            $bill->status = $request->status;
            $bill->discount = $request->discount;
            $bill->user_id = Auth::id();
            $bill->save();
            ///save order

            $order =new orders;
            $order->bill_id =$bill->id;
            $order->order_code = $request->Neworder['order_code'];
            $order->order_date = $request->Neworder['order_date'];
            $order->shipping_date = $request->Neworder['shipping_date'];
            $order->delivery_date = $request->Neworder['delivery_date'];
            $order->recipient = $request->Neworder['recipient'];
            $order->recipient_phone = $request->Neworder['recipient_phone'];
            $order->recipient_address = $request->Neworder['recipient_address'];
            $order->pickup_location = $request->Neworder['pickup_location'];
            $order->drop_location = $request->Neworder['drop_location'];
            $order->status = $request->Neworder['status'];
            $order->save();

            if ($bill->save()) {
                return response()->json([
                    'id' => $bill->id,
                    'order_id'=> $order->id
                
                ]);
            } else {
                return response()->json([
                    'status' => 'error']);
            }
        }

    }
    /**
     * Store a newly created bills in storage.
     *
     * @param CreatebillsRequest $request
     *
     * @return Response
     */
    public function save_billdetails(Request $request)
    {
        if ($request->ajax()) {
            $bill_details = new billdetails;
         
            foreach ($request->invoiceDetails as $data) {
                try {
                    $charges[] = [
                        'bill_id' =>  $request->billid,
                        'item_id' => $data['item_id'],
                        'unit_id' => $data['unit_id'],
                        'unit_price' => $data['unit_price'],
                        'total_price' => $data['total_price'],
                        'qty' => $data['qty'],
                        'remark' => $data['remark']
                    ];

                       $orderdetails[] = [
                        'order_id' =>  $request->orderid,
                        'item_id' => $data['item_id'],
                        'unit_id' => $data['unit_id'],
                        'qty' => $data['qty'],
                        'status' => 'Pending'
                    ];
                    
                  
                } catch (QueryException $ex) {
                   return response()->json([
                        'status' =>  $ex]);
                }
            }
            billdetails::insert($charges);
            orderdetails::insert($orderdetails);

        }

    }
    /**
     * Store a newly created bills in storage.
     *
     * @param CreatebillsRequest $request
     *
     * @return Response
     */
    public function store(CreatebillsRequest $request)
    {

        $input = $request->all();

        $bills = $this->billsRepository->create($input);

        // Flash::success('Bills saved successfully.');

        // return redirect(route('bills.index'));
        if ($bills) {
            return response()->json([
                'id' => $id]);
        } else {
            return response()->json([
                'status' => 'error']);
        }
    }
    /**
     * Display the specified bills.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bills =  bills::findorfail($id);
        $bill_detaisl =  billdetails::all()->where('bill_id',$id);
        $customers=customers::find($bills->customer_id);
        $orders= orders::wherebill_id($id)->first();
        if (empty($bills)) {
            Flash::error('Bills not found');

            return redirect(route('bills.index'));
        }
 //return Response::json($orders);
     return view('bills.show')->with('bills', $bills )->with('customers' , $customers)->with('bill_detaisl',$bill_detaisl)->with('orders',$orders);
    }
  /**
     * Display the specified bills.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function Print($id)
    {
        $bills =  bills::findorfail($id);

        $bill_detaisl =  billdetails::all()->where('bill_id',$id);
        $customers=customers::find($bills->customer_id);
        $orders= orders::wherebill_id($id)->first();
        if (empty($bills)) {
            Flash::error('Bills not found');

            return redirect(route('bills.index'));
        }
        //return Response::json($bill_detaisl);
        return view('bills.invoice-print')->with('bills', $bills )->with('customers' , $customers)->with('bill_detaisl',$bill_detaisl)->with('orders',$orders);
    }
    /**
     * Display the specified customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showCustomer($id)
    {

        $customers = customers::findorfail($id)->toarray();

        if (empty($customers)) {
            Flash::error('Customers not found');
        }
        return Response::json($customers);

    }
    /**
     * Display the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function getitem($id)
    {

        $item = items::with('units')->findorfail($id);
        $units = units::findorfail($item->unit_id);
        if (empty($item)) {
            Flash::error('Item not found');
        }
        return Response::json($item);

    }
    /**
     * Show the form for editing the specified bills.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bills = $this->billsRepository->findWithoutFail($id);

        if (empty($bills)) {
            Flash::error('Bills not found');

            return redirect(route('bills.index'));
        }

        return view('bills.edit')->with('bills', $bills);
    }

    /**
     * Update the specified bills in storage.
     *
     * @param  int              $id
     * @param UpdatebillsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebillsRequest $request)
    {
        $bills = $this->billsRepository->findWithoutFail($id);

        if (empty($bills)) {
            Flash::error('Bills not found');

            return redirect(route('bills.index'));
        }

        $bills = $this->billsRepository->update($request->all(), $id);

        Flash::success('Bills updated successfully.');

        return redirect(route('bills.index'));
    }

    /**
     * Remove the specified bills from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bills = $this->billsRepository->findWithoutFail($id);

        if (empty($bills)) {
            Flash::error('Bills not found');

            return redirect(route('bills.index'));
        }

        $this->billsRepository->delete($id);

        Flash::success('Bills deleted successfully.');

        return redirect(route('bills.index'));
    }
}
