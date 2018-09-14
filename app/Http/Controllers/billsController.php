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
class billsController extends AppBaseController
{
    /** @var  billsRepository */
    private $billsRepository;

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
        return view('bills.create')->with('shippers' , $shippers)->with('customers', $customers);
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

        Flash::success('Bills saved successfully.');

        return redirect(route('bills.index'));
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
