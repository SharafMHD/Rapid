<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebillsRequest;
use App\Http\Requests\UpdatebillsRequest;
use App\Repositories\billsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\shippers;
use App\Models\customers;
use App\Models\items;
use App\Models\units;
use App\Models\bills;
use Auth;

class billsController extends AppBaseController
{
    /** @var  billsRepository */
    private $billsRepository;
    private $customersRepository;

    public function __construct(billsRepository $billsRepo)
    {
        $this->billsRepository = $billsRepo;
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
        $customers = customers::pluck('name','id');
        $shippers=shippers::pluck('name','id');
        $items=items::pluck('name','id');
        return view('bills.create')->with('shippers' , $shippers)->with('customers', $customers)->with('items',$items);
        
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
        if($request->ajax())
        {
         
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
          
          if($bill->save()){
          return response()->json([
              'id'     => $bill->id]);
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
    public function store(CreatebillsRequest $request)
    {
        
        $input = $request->all();

        $bills = $this->billsRepository->create($input);

        // Flash::success('Bills saved successfully.');

        // return redirect(route('bills.index'));
        if ($bills) {
            return response()->json([
                'id'     => $id]);
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
        $bills = $this->billsRepository->findWithoutFail($id);

        if (empty($bills)) {
            Flash::error('Bills not found');

            return redirect(route('bills.index'));
        }

        return view('bills.show')->with('bills', $bills);
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
        $units= units::findorfail($item->unit_id);
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
