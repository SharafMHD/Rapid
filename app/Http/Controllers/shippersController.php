<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateshippersRequest;
use App\Http\Requests\UpdateshippersRequest;
use App\Repositories\shippersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class shippersController extends AppBaseController
{
    /** @var  shippersRepository */
    private $shippersRepository;

    public function __construct(shippersRepository $shippersRepo)
    {
        $this->shippersRepository = $shippersRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the shippers.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->shippersRepository->pushCriteria(new RequestCriteria($request));
        $shippers = $this->shippersRepository->all();

        return view('shippers.index')
            ->with('shippers', $shippers);
    }

    /**
     * Show the form for creating a new shippers.
     *
     * @return Response
     */
    public function create()
    {
        return view('shippers.create');
    }

    /**
     * Store a newly created shippers in storage.
     *
     * @param CreateshippersRequest $request
     *
     * @return Response
     */
    public function store(CreateshippersRequest $request)
    {
        $input = $request->all();

        $shippers = $this->shippersRepository->create($input);

        Flash::success('Shippers saved successfully.');

        return redirect(route('shippers.index'));
    }

    /**
     * Display the specified shippers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shippers = $this->shippersRepository->findWithoutFail($id);

        if (empty($shippers)) {
            Flash::error('Shippers not found');

            return redirect(route('shippers.index'));
        }

        return view('shippers.show')->with('shippers', $shippers);
    }

    /**
     * Show the form for editing the specified shippers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shippers = $this->shippersRepository->findWithoutFail($id);

        if (empty($shippers)) {
            Flash::error('Shippers not found');

            return redirect(route('shippers.index'));
        }

        return view('shippers.edit')->with('shippers', $shippers);
    }

    /**
     * Update the specified shippers in storage.
     *
     * @param  int              $id
     * @param UpdateshippersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateshippersRequest $request)
    {
        $shippers = $this->shippersRepository->findWithoutFail($id);

        if (empty($shippers)) {
            Flash::error('Shippers not found');

            return redirect(route('shippers.index'));
        }

        $shippers = $this->shippersRepository->update($request->all(), $id);

        Flash::success('Shippers updated successfully.');

        return redirect(route('shippers.index'));
    }

    /**
     * Remove the specified shippers from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shippers = $this->shippersRepository->findWithoutFail($id);

        if (empty($shippers)) {
            Flash::error('Shippers not found');

            return redirect(route('shippers.index'));
        }

        $this->shippersRepository->delete($id);

        Flash::success('Shippers deleted successfully.');

        return redirect(route('shippers.index'));
    }
}
