<?php

namespace App\Http\Controllers\Admin\English;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrazyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = CrazyCourse::query()
            ->get();
        $crazies = Crazy::query()
            ->filter(\request()->all())
            ->paginate();
//        $data = ;


        return Inertia::render('Admin/English/Crazy/Index', compact('courses', 'crazies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        $crazy= Crazy::query()
            ->with('details')
            ->find($id);

        return Inertia::render('Admin/English/Crazy/Update', compact( 'crazy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
