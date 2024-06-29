<?php

namespace App\Http\Controllers\admin;

use App\Models\Heroes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroesRequest;
use App\Repository\HeroesRepository;

class HeroesController extends Controller
{
    protected $heroesRepository;
    public function __construct(HeroesRepository $heroesRepository)
    {
        $this->heroesRepository = $heroesRepository;
    }

    public function getData() {
        return $this->heroesRepository->getData();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroes = Heroes::first();
        return view('pages.backend.heroes.index', compact('heroes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HeroesRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $resultHeroes = $this->heroesRepository->update($request, $id);
            if (!$resultHeroes->status) {
                return response()->json(['status' => false, 'message' => $resultHeroes->message], 400);
            }
            DB::commit();
            return redirect()->route('admin.heroes.index')->with('success', 'Successfully Updating Data!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Failed to Update Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
