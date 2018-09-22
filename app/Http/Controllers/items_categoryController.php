<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createitems_categoryRequest;
use App\Http\Requests\Updateitems_categoryRequest;
use App\Repositories\items_categoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class items_categoryController extends AppBaseController
{
    /** @var  items_categoryRepository */
    private $itemsCategoryRepository;

    public function __construct(items_categoryRepository $itemsCategoryRepo)
    {
        $this->itemsCategoryRepository = $itemsCategoryRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the items_category.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->itemsCategoryRepository->pushCriteria(new RequestCriteria($request));
        $itemsCategories = $this->itemsCategoryRepository->all();

        return view('items_categories.index')
            ->with('itemsCategories', $itemsCategories);
    }

    /**
     * Show the form for creating a new items_category.
     *
     * @return Response
     */
    public function create()
    {
        return view('items_categories.create');
    }

    /**
     * Store a newly created items_category in storage.
     *
     * @param Createitems_categoryRequest $request
     *
     * @return Response
     */
    public function store(Createitems_categoryRequest $request)
    {
        $input = $request->all();

        $itemsCategory = $this->itemsCategoryRepository->create($input);

        Flash::success('Items Category saved successfully.');

        return redirect(route('itemsCategories.index'));
    }

    /**
     * Display the specified items_category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itemsCategory = $this->itemsCategoryRepository->findWithoutFail($id);

        if (empty($itemsCategory)) {
            Flash::error('Items Category not found');

            return redirect(route('itemsCategories.index'));
        }

        return view('items_categories.show')->with('itemsCategory', $itemsCategory);
    }

    /**
     * Show the form for editing the specified items_category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itemsCategory = $this->itemsCategoryRepository->findWithoutFail($id);

        if (empty($itemsCategory)) {
            Flash::error('Items Category not found');

            return redirect(route('itemsCategories.index'));
        }

        return view('items_categories.edit')->with('itemsCategory', $itemsCategory);
    }

    /**
     * Update the specified items_category in storage.
     *
     * @param  int              $id
     * @param Updateitems_categoryRequest $request
     *
     * @return Response
     */
    public function update($id, Updateitems_categoryRequest $request)
    {
        $itemsCategory = $this->itemsCategoryRepository->findWithoutFail($id);

        if (empty($itemsCategory)) {
            Flash::error('Items Category not found');

            return redirect(route('itemsCategories.index'));
        }

        $itemsCategory = $this->itemsCategoryRepository->update($request->all(), $id);

        Flash::success('Items Category updated successfully.');

        return redirect(route('itemsCategories.index'));
    }

    /**
     * Remove the specified items_category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itemsCategory = $this->itemsCategoryRepository->findWithoutFail($id);

        if (empty($itemsCategory)) {
            Flash::error('Items Category not found');

            return redirect(route('itemsCategories.index'));
        }

        $this->itemsCategoryRepository->delete($id);

        Flash::success('Items Category deleted successfully.');

        return redirect(route('itemsCategories.index'));
    }
}
