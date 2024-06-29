<?php

namespace App\Http\Controllers\admin;

use App\Enums\Status;
use App\Enums\StatusPost;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\MenuTestimoni;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\TestimonisDataTable;
use App\Http\Requests\TestimoniRequest;
use App\Repository\TestimoniRepository;
use App\Repository\MenuTestimoniRepository;

class TestimoniController extends Controller
{

    protected $menuTestimoniRepository;
    protected $testimoniRepository;
    protected $menuRepository;
    protected $status;
    protected $statusPost;
    public function __construct(TestimoniRepository $testimoniRepository, MenuTestimoniRepository $menuTestimoniRepository, MenuRepository $menuRepository)
    {
        $this->testimoniRepository = $testimoniRepository;
        $this->menuTestimoniRepository = $menuTestimoniRepository;
        $this->menuRepository = $menuRepository;
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
        $datas = $this->testimoniRepository->getData($request);
        return $datas;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TestimonisDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.testimoni.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Testimoni $testimoni)
    {
        $menuRepository = $this->menuRepository->getAllMenu();
        $statusPost = $this->statusPost;
        $status = $this->status;
        return view('pages.backend.testimoni.create_edit', compact('testimoni', 'menuRepository', 'status', 'statusPost'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimoniRequest $request)
    {
        DB::beginTransaction();
        try {
            $resultTestimoni = $this->testimoniRepository->insert($request);
            if (!$resultTestimoni->status) {
                return response()->json(['status' => false, 'message' => $resultTestimoni->message], 400);
            }
            $resultMenuTestimoni = $this->menuTestimoniRepository->insert($resultTestimoni->lastId, $request->only(['menus']));
            if (!$resultMenuTestimoni->status) {
                return response()->json(['status' => false, 'message' => $resultMenuTestimoni->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.testimoni.index')->with('success', 'Successfully Added Data!');
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
    public function edit(Testimoni $testimoni)
    {
        $menuRepository = $this->menuRepository->getAllMenu();
        $statusPost = $this->statusPost;
        $status = $this->status;
        return view('pages.backend.testimoni.create_edit', compact('testimoni', 'menuRepository', 'status', 'statusPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimoniRequest $request, Testimoni $testimoni)
    {
        DB::beginTransaction();
        try {
            $resultTestimoni = $this->testimoniRepository->update($request, $testimoni);
            if (!$resultTestimoni->status) {
                return response()->json(['status' => false, 'message' => $resultTestimoni->message], 400);
            }
            $resultMenuTestimoni = $this->menuTestimoniRepository->insert($resultTestimoni->lastId, $request->only(['menus']));
            if (!$resultMenuTestimoni->status) {
                return response()->json(['status' => false, 'message' => $resultMenuTestimoni->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.testimoni.index')->with('success', 'Successfully Updating Data!');
        } catch (\Throwable $th) {
            DB::rollback();
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
            $this->testimoniRepository->delete($id);
            $this->menuTestimoniRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Failed to Delete Data!');
        }
    }
}
