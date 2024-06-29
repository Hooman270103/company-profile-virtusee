<?php

namespace App\Http\Controllers\admin;

use App\Enums\Status;
use App\Models\Counter;
use App\Enums\StatusPost;
use Illuminate\Http\Request;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\CountersDataTable;
use App\Http\Requests\CounterRequest;
use App\Repository\CounterRepository;
use App\Repository\MenuCounterRepository;

class CounterController extends Controller
{
    protected $allMenu;
    protected $menuCounterRepository;
    protected $counterRepository;
    protected $status;
    protected $statusPost;
    public function __construct(MenuRepository $menuRepository, MenuCounterRepository $menuCounterRepository, CounterRepository $counterRepository)
    {
        $this->allMenu = $menuRepository;
        $this->counterRepository = $counterRepository;
        $this->menuCounterRepository = $menuCounterRepository;
        $this->status = array(
            '1' => 'Inactive',
            '2' => 'Active',
        );
        $this->statusPost = array(
            '1' => 'Draft',
            '2' => 'Publish',
        );
    }

    public function getData(Request $request)  {
        $datas = $this->counterRepository->getData($request);
        return $datas;
    }

    public function getTable(Request $request)  {
        
        $counter = Counter::find($request->id) ?? null;
        return view('pages.backend.counter.table-data', compact('counter'))->render();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CountersDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.counter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Counter $counter)
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->allMenu->getAllMenu();
        return view('pages.backend.counter.create_edit', compact('counter', 'statusPost', 'status', 'allMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CounterRequest $request)
    {
        DB::beginTransaction();
        try {
            $resultCounter = $this->counterRepository->insert($request->only('title', 'posting', 'status', 'title_data', 'number_data'));
            if (!$resultCounter->status) {
                return response()->json(['status' => false, 'message' => $resultCounter->message], 400);
            }
            $resultMenuCounter = $this->menuCounterRepository->insert($resultCounter->lastId, $request->only(['menus']));
            if (!$resultMenuCounter->status) {
                return response()->json(['status' => false, 'message' => $resultMenuCounter->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.counter.index')->with('success', 'Create Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('danger', 'Failed to Add Data!');
        }
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
    public function edit(Counter $counter)
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->allMenu->getAllMenu();
        return view('pages.backend.counter.create_edit', compact('counter', 'statusPost', 'status', 'allMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CounterRequest $request, Counter $counter)
    {
        DB::beginTransaction();
        try {

            $resultCounter = $this->counterRepository->update($request->only('title', 'posting', 'status', 'title_data', 'number_data'), $counter);
            if (!$resultCounter->status) {
                return response()->json(['status' => false, 'message' => $resultCounter->message], 400);
            }

            $resultMenuCounter = $this->menuCounterRepository->insert($resultCounter->lastId, $request->only(['menus']));
            if (!$resultMenuCounter->status) {
                return response()->json(['status' => false, 'message' => $resultMenuCounter->message], 400);
            }

            DB::commit();
            return redirect()->route('admin.counter.index')->with('success', 'Successfully Updating Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to Update Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $this->menuCounterRepository->delete($id);
            $this->counterRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.counter.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Failed to Delete Data!');
        }
    }
}
