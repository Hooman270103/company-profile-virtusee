<?php

namespace App\Http\Controllers\admin;

use App\Enums\Status;
use App\Models\Video;
use App\Enums\StatusPost;
use Illuminate\Http\Request;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use App\DataTables\VideosDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Repository\MenuVideosRepository;
use App\Repository\VideosRepository;

class VideosController extends Controller
{
    protected $menuRepository;
    protected $videosRepository;
    protected $menuVideosRepository;
    protected $status;
    protected $statusPost;
    public function __construct(MenuRepository $menuRepository, VideosRepository $videosRepository, MenuVideosRepository $menuVideosRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->videosRepository = $videosRepository;
        $this->menuVideosRepository = $menuVideosRepository;
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
    public function index(VideosDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.video.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Video $video)
    {
        $status = $this->status;
        $statusPost = $this->statusPost;
        $allMenu = $this->menuRepository->getAllMenu();
        return view('pages.backend.video.create_edit', compact('video', 'allMenu', 'status', 'statusPost'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoRequest $request)
    {
        DB::beginTransaction();
        try {

            $resultVideo = $this->videosRepository->insert($request->only('title', 'link', 'posting', 'status'));
            if (!$resultVideo->status) {
                return response()->json(['status' => false, 'message' => $resultVideo->message], 400);
            }

            $resultMenuVideo = $this->menuVideosRepository->insert($resultVideo->lastId, $request->only('menus'));
            if (!$resultMenuVideo->status) {
                return response()->json(['status' => false, 'message' => $resultMenuVideo->message], 400);
            }

            DB::commit();
            return redirect()->route('admin.videos.index')->with('success', 'Successfully Added Data!');
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
    public function edit(Video $video)
    {
        $status = $this->status;
        $statusPost = $this->statusPost;
        $allMenu = $this->menuRepository->getAllMenu();
        return view('pages.backend.video.create_edit', compact('allMenu', 'statusPost', 'status', 'video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoRequest $request, Video $video)
    {
        DB::beginTransaction();
        try {

            $resultVideo = $this->videosRepository->update($request->only('title', 'link', 'posting', 'status'), $video);
            if (!$resultVideo->status) {
                return response()->json(['status' => false, 'message' => $resultVideo->message], 400);
            }

            $resultMenuVideo = $this->menuVideosRepository->insert($resultVideo->lastId, $request->only('menus'));
            if (!$resultMenuVideo->status) {
                return response()->json(['status' => false, 'message' => $resultMenuVideo->message], 400);
            }

            DB::commit();
            return redirect()->route('admin.videos.index')->with('success', 'Successfully Updating Data!');
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
            $this->menuVideosRepository->delete($id);
            $this->videosRepository->delete($id);
            DB::commit();
            return redirect()->route('admin.videos.index')->with('success', 'Successfully Erasing Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success', 'Failed to Delete Data!');
        }
    }

    public function allData(Request $request)
    {
        return response()->json($this->videosRepository->allData($request));
    }
}
