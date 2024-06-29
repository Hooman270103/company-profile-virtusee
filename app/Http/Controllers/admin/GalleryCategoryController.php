<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\GalleryDataTable;
use App\Models\GalleryCategory;
use App\Enums\StatusPost;
use App\Enums\Status;
use App\Repository\MenuRepository;
use App\Repository\GalleryCategoryRepository;
use App\Repository\MenuGalleryCategoryRepository;
use App\Http\Requests\GalleryCategoryRequest;
use Illuminate\Support\Facades\DB;

class GalleryCategoryController extends Controller
{
    protected $allMenu;
    protected $galleryCategoryRepository;
    protected $menuGalleryCategoryRepository;
    protected $status;
    protected $statusPost;
    public function __construct(MenuRepository $menuRepository, GalleryCategoryRepository $galleryCategoryRepository, MenuGalleryCategoryRepository $menuGalleryCategoryRepository)
    {
        $this->allMenu = $menuRepository;
        $this->galleryCategoryRepository = $galleryCategoryRepository;
        $this->menuGalleryCategoryRepository = $menuGalleryCategoryRepository;
        $this->status = array(
            '1' => 'Inactive',
            '2' => 'Active',
        );
        $this->statusPost = array(
            '1' => 'Draft',
            '2' => 'Publish',
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index(GalleryDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.gallery-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GalleryCategory $galleryCategory)
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->allMenu->getAllMenu();
        return view('pages.backend.gallery-category.create_edit', compact('galleryCategory', 'statusPost', 'status', 'allMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $resultGalleryCategory = $this->galleryCategoryRepository->insert($request->only('name', 'posting', 'status'));
            if (!$resultGalleryCategory->status) {
                return response()->json(['status' => false, 'message' => $resultGalleryCategory->message], 400);
            }
            $resultMenuGalleryCategory = $this->menuGalleryCategoryRepository->insert($resultGalleryCategory->lastId, $request->only(['menus']));
            if (!$resultMenuGalleryCategory->status) {
                return response()->json(['status' => false, 'message' => $resultMenuGalleryCategory->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.gallery-category.index')->with('success', 'Successfully Added Data!');
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
    public function edit(GalleryCategory $galleryCategory)
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->allMenu->getAllMenu();
        return view('pages.backend.gallery-category.create_edit', compact('galleryCategory', 'statusPost', 'status', 'allMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryCategoryRequest $request, GalleryCategory $galeryCategory)
    {
        DB::beginTransaction();
        try {

            $resultGalleryCategory = $this->galleryCategoryRepository->update($request->only('name', 'posting', 'status'), $galeryCategory);
            if (!$resultGalleryCategory->status) {
                return response()->json(['status' => false, 'message' => $resultGalleryCategory->message], 400);
            }

            $resultMenuGalleryCategory = $this->menuGalleryCategoryRepository->insert($resultGalleryCategory->lastId, $request->only(['menus']));
            if (!$resultMenuGalleryCategory->status) {
                return response()->json(['status' => false, 'message' => $resultMenuGalleryCategory->message], 400);
            }

            DB::commit();
            return redirect()->route('admin.gallery-category.index')->with('success', 'Successfully Updating Data!');
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
            $this->menuGalleryCategoryRepository->delete($id);
            $this->galleryCategoryRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.gallery-category.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Failed to Delete Data!');
        }
    }

    public function getData(Request $request)
    {
        return $this->galleryCategoryRepository->getData($request);
    }
}
