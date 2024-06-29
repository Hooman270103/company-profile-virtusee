<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use App\DataTables\EventsDataTable;
use App\Enums\Status;
use App\Enums\StatusPost;
use App\Models\Event;
use App\Repository\EventsRepository;
use App\Repository\MenuPostRepository;
use App\Repository\MenuRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repository\SettingRepository;

class EventsController extends Controller
{
    protected $menuRepository;
    protected $eventsRepository;
    protected $menuPostRepository;
    protected $settingRepository;
    protected $status;
    protected $statusPost;
    protected $position;
    public function __construct(EventsRepository $eventsRepository, MenuPostRepository $menuPostRepository, MenuRepository $menuRepository, SettingRepository $settingRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->eventsRepository = $eventsRepository;
        $this->menuPostRepository = $menuPostRepository;
        $this->settingRepository = $settingRepository;
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
    /**
     * Display a listing of the resource.
     */
    public function index(EventsDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusPublish = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->menuRepository->getAllMenu();
        return view('pages.backend.events.form', compact('statusPublish', 'status', 'allMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $resultEvent = $this->eventsRepository->insert($request);
            if (!$resultEvent->status) {
                return response()->json(['status' => false, 'message' => $resultEvent->message], 400);
            }

            $resultMenu = $this->menuPostRepository->insert($resultEvent->lastId, explode(',', $request->menus), 'events');

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
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event = Event::with('menu_event')->where('id', $event->id)->first();
        $statusPublish = $this->statusPost;
        $status = $this->status;
        $allMenu = $this->menuRepository->getAllMenu();
        return view('pages.backend.events.form', compact('event', 'statusPublish', 'status', 'allMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            $resultEvent = $this->eventsRepository->update($event, $request);
            if (!$resultEvent->status) {
                return response()->json(['status' => false, 'message' => $resultEvent->message], 400);
            }

            $resultMenu = $this->menuPostRepository->insert($resultEvent->lastId, explode(',', $request->menus), 'events');

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
    public function destroy(Event $event)
    {
        return $this->eventsRepository->delete($event);
    }

    public function getData(Request $request)
    {
        $datas = $this->eventsRepository->getData($request);
        return $datas;
    }

    public function detailData($slug)
    {
        return view('pages.frontend.home.components.events.detail', [
            'event' => Event::where('slug', $slug)->first(),
            'menus' => $this->menuRepository->menus(),
            'setting' => $this->settingRepository->getAllData(),
            'otherEvents' => $this->eventsRepository->getData((object)['limit' => 3, 'slug' => $slug])
        ]);
    }

    public function allData()
    {
        $events = $this->eventsRepository->getData();
        return view('pages.frontend.home.components.events.all', [
            'events' => $events,
            'menus' => $this->menuRepository->menus(),
            'setting' => $this->settingRepository->getAllData(),
        ]);
    }
}
