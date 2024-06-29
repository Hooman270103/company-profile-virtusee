<?php

namespace App\Http\Controllers\admin;

use App\Models\Faq;
use App\Enums\Status;
use App\Enums\StatusPost;
use Illuminate\Http\Request;
use function Termwind\render;
use App\DataTables\FaqsDataTable;
use App\Repository\FaqRepository;

use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Repository\MenuFaqRepository;

class FaqController extends Controller
{
    protected $faqRepository;
    protected $menuRepository;
    protected $menuFaqRepository;
    protected $status;
    protected $statusPost;
    public function __construct(FaqRepository $faqRepository, MenuFaqRepository $menuFaqRepository, MenuRepository $menuRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->menuRepository = $menuRepository;
        $this->menuFaqRepository = $menuFaqRepository;
        $this->status = array(
            '1' => 'Inactive',
            '2' => 'Active',
        );
        $this->statusPost = array(
            '1' => 'Draft',
            '2' => 'Publish',
        );
    }

    public function getData(Request $request)
    {
        $datas = $this->faqRepository->getData($request);
        return $datas;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FaqsDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Faq $faq)
    {
        $menuRepository = $this->menuRepository->getAllMenu();
        $statusPost = $this->statusPost;
        $status = $this->status;
        return view('pages.backend.faq.create_edit', compact('faq', 'statusPost', 'status', 'menuRepository'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $resultFaq = $this->faqRepository->insert($request->only('questions', 'answers', 'published', 'status'));
            if (!$resultFaq->status) {
                return response()->json(['status' => false, 'message' => $resultFaq->message], 400);
            }
            $resultMenuCounter = $this->menuFaqRepository->insert($resultFaq->lastId, $request->only(['menus']));
            if (!$resultMenuCounter->status) {
                return response()->json(['status' => false, 'message' => $resultMenuCounter->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Successfully Added Data!');
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
    public function edit(Faq $faq)
    {
        $menuRepository = $this->menuRepository->getAllMenu();
        $statusPost = $this->statusPost;
        $status = $this->status;
        return view('pages.backend.faq.create_edit', compact('faq', 'statusPost', 'status', 'menuRepository'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        DB::beginTransaction();
        try {

            $resultFaq = $this->faqRepository->update($request->only('questions', 'answers', 'published', 'status'), $faq);
            if (!$resultFaq->status) {
                return response()->json(['status' => false, 'message' => $resultFaq->message], 400);
            }

            $resultMenuFaq = $this->menuFaqRepository->insert($resultFaq->lastId, $request->only(['menus']));
            if (!$resultMenuFaq->status) {
                return response()->json(['status' => false, 'message' => $resultMenuFaq->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Successfully Updating Data!');
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
            $this->faqRepository->delete($id);
            $this->menuFaqRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Failed to Delete Data!');
        }
    }
}
