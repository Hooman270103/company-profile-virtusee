<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\DataTables\PostsDataTable;
use App\Models\Menu;
use App\Enums\Status;
use App\Enums\StatusPost;
use App\Enums\PostsType;
use App\Repository\PostsRepository;
use App\Repository\MenuPostRepository;
use App\Repository\MenuRepository;
use App\Repository\SettingRepository;
use Illuminate\Support\Facades\DB;



class PostsController extends Controller
{
    protected $allMenu;
    protected $PostsRepository;
    protected $menuPostRepository;
    protected $status;
    protected $statusPost;
    protected $postType;
    protected $settingRepository;
    public function __construct(PostsRepository $PostsRepository, MenuPostRepository $menuPostRepository, MenuRepository $menuRepository, SettingRepository $settingRepository)
    {
        $this->allMenu = $menuRepository;
        $this->PostsRepository = $PostsRepository;
        $this->menuPostRepository = $menuPostRepository;
        $this->settingRepository = $settingRepository;
        $this->status = array(
            '1' => 'Inactive',
            '2' => 'Active',
        );
        $this->statusPost = array(
            '1' => 'Draft',
            '2' => 'Publish',
        );
        $this->postType = array(
            '1' => 'News',
            '2' => 'Article',
            '3' => 'Announcement',
            '4' => 'Section Post',
        );
    }

    public function allData(Request $request)  {
        return response()->json($this->PostsRepository->getAllData($request->type));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusPost = $this->statusPost;
        $status = $this->status;
        $postsType = $this->postType;
        $allMenu = $this->allMenu->getAllMenu();
        return view('pages.backend.posts.form', compact('statusPost', 'status', 'postsType', 'allMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $resultPost = $this->PostsRepository->insert($request);
            if (!$resultPost->status) {
                return response()->json(['status' => false, 'message' => $resultPost->message], 400);
            }

            $resultMenu = $this->menuPostRepository->insert($resultPost->lastId, explode(',', $request->menus), 'posts');

            if (!$resultMenu->status) {
                return response()->json(['status' => false, 'message' => $resultMenu->message], 400);
            }

            DB::commit();
            Session()->flash('success', 'Created Data Successfully!');
            return response()->json(['status' => true, 'message' => 'Created Data Successfully!'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post = Post::with('menu_post')->where('id', $post->id)->first();
        $statusPost = $this->statusPost;
        $status = $this->status;
        $postsType = $this->postType;
        $allMenu = $this->allMenu->getAllMenu();
        return view('pages.backend.posts.form', compact('post', 'statusPost', 'status', 'postsType', 'allMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        DB::beginTransaction();
        try {
            $resultPost = $this->PostsRepository->update($post, $request);
            if (!$resultPost->status) {
                return response()->json(['status' => false, 'message' => $resultPost->message], 400);
            }

            $resultMenu = $this->menuPostRepository->insert($resultPost->lastId, explode(',', $request->menus), 'posts');

            if (!$resultMenu->status) {
                return response()->json(['status' => false, 'message' => $resultMenu->message], 400);
            }

            DB::commit();
            Session()->flash('success', 'Changed Data Successfully!');
            return response()->json(['status' => true, 'message' => 'Changed Data Successfully!'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->PostsRepository->delete($post);
    }

    public function getDataPost(Request $request)
    {
        return $this->PostsRepository->getData($request);
    }

    public function detailDataPost($slug, $type, $pageId)
    {
        return view('pages.frontend.home.components.posts.components.detail', [
            'post' => Post::where('slug', $slug)->first(),
            'menus' => $this->allMenu->menus(),
            'setting' => $this->settingRepository->getAllData(),
            'pageId' => $pageId,
            'otherPosts' => $this->PostsRepository->getData((object)['limit' => 3, 'slug' => $slug, 'type' => $type, 'pageId' => $pageId]),
            'type' => $type,
            'title' => $type == 'news' ? 'Berita' : ($type == 'articles' ? 'Artikel' : 'Pengumuman')
        ]);
    }

    public function allDataPost($type, $pageId)
    {
        $posts = $this->PostsRepository->getData((object)['type' => $type, 'pageId' => $pageId]);
        return view('pages.frontend.home.components.posts.components.all', [
            'posts' => $posts,
            'menus' => $this->allMenu->menus(),
            'setting' => $this->settingRepository->getAllData(),
            'pageId' => $pageId,
            'type' => $type,
            'title' => $type == 'news' ? 'Berita' : ($type == 'articles' ? 'Artikel' : 'Pengumuman')
        ]);
    }
}
