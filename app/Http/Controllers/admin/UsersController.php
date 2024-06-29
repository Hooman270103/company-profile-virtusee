<?php

namespace App\Http\Controllers\admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UsersRequest;
use App\Repository\UsersRepository;

class UsersController extends Controller
{
    protected $usersRepository;
    public function __construct(UsersRepository $usersRepository)
    {

        $this->usersRepository = $usersRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('pages.backend.users.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request)
    {
        return $this->usersRepository->insert($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.backend.users.form', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.backend.users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersRequest $request, User $user)
    {
        return $this->usersRepository->update($user, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $this->usersRepository->delete($user);
    }
}
