<?php

namespace App\Http\Controllers\admin;

use App\Enums\Status;
use App\Models\Section;
use App\Enums\StatusPost;
use Illuminate\Http\Request;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\SectionsDataTable;
use App\Http\Requests\SectionRequest;
use App\Repository\MenuSectionRepository;
use App\Repository\SectionRepository;

class SectionController extends Controller
{
    protected $allMenu;
    protected $sectionRepository;
    protected $menuSectionRepository;
    protected $position;
    protected $status;
    protected $statusPost;
    public function __construct(MenuRepository $menuRepository, SectionRepository $sectionRepository, MenuSectionRepository $menuSectionRepository)
    {
        $this->allMenu = $menuRepository;
        $this->sectionRepository = $sectionRepository;
        $this->menuSectionRepository = $menuSectionRepository;
        $this->position = array(
            '1' => 'Left',
            '2' => 'Right'
        );
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
        $datas = $this->sectionRepository->getData($request);
        return $datas;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SectionsDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.section.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Section $section)
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->allMenu->getAllMenu();
        $position = $this->position;
        return view('pages.backend.section.create_edit', compact('statusPost', 'status', 'allMenu', 'section', 'position'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        DB::beginTransaction();
        try {
            $resultSection = $this->sectionRepository->insert($request);
            if (!$resultSection->status) {
                return response()->json(['status' => false, 'message' => $resultSection->message], 400);
            }

            $resultMenuSection = $this->menuSectionRepository->insert($resultSection->lastId, $request->only(['menus']));
            if (!$resultMenuSection->status) {
                return response()->json(['status' => false, 'message' => $resultMenuSection->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.section.index')->with('success', 'Create Data Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('danger', 'Create Data Failed!');
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
    public function edit(Section $section)
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->allMenu->getAllMenu();
        $position = $this->position;
        return view('pages.backend.section.create_edit', compact('statusPost', 'status', 'allMenu', 'section', 'position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        DB::beginTransaction();
        try {
            $resultSection = $this->sectionRepository->update($request, $section);
            if (!$resultSection->status) {
                return response()->json(['status' => false, 'message' => $resultSection->message], 400);
            }

            $resultMenuSection = $this->menuSectionRepository->insert($resultSection->lastId, $request->only(['menus']));
            if (!$resultMenuSection->status) {
                return response()->json(['status' => false, 'message' => $resultMenuSection->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.section.index')->with('success', 'Successfully Updating Data!');
        } catch (\Throwable $th) {
            DB::commit();
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
            $this->sectionRepository->delete($id);
            $this->menuSectionRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.section.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Failed to Delete Data!');
        }
    }
}
