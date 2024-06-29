<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use App\Enums\Status;
use Illuminate\Http\Request;
use App\DataTables\MenusDataTable;
use App\Enums\MenuType;
use App\Enums\Type;
use App\Http\Requests\MenuRequest;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{

    protected $allMenu;
    protected $menuRepository;
    protected $status;
    protected $menuType;
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->status = array(
            '1' => 'Inactive',
            '2' => 'Active',
        );
        $this->menuType = array(
            '1' => 'Default',
            '2' => 'Url',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MenusDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu)
    {
        $status = $this->status;
        $allMenu = $this->menuRepository->getAllMenu();
        $menuType = $this->menuType;
        return view('pages.backend.menu.create_edit', compact('menu', 'status', 'allMenu', 'menuType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        return $this->menuRepository->storeMenu($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $status = $this->status;
        $allMenu = $this->menuRepository->getAllMenu();
        $menuType = $this->menuType;
        return view('pages.backend.menu.create_edit', compact('menu', 'status', 'allMenu', 'menuType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        return $this->menuRepository->updateMenu($menu, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        return $this->menuRepository->deleteMenu($menu);
    }
}
