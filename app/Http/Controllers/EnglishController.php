<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class EnglishController extends Controller
{
    public function index()
    {
        $courses = CrazyCourse::query()->get();
        $courses->load( 'createdBy');

        return Inertia::render('English/Course/Index', compact('courses'));
    }

    public function show($id)
    {
        $courses = CrazyCourse::query()->get();
        $course = CrazyCourse::query()
            ->with('crazies')
            ->find($id);

        return Inertia::render('English/Course/Show', compact('courses', 'course'));
    }

    public function read($id)
    {
        $crazy = Crazy::query()
            ->with('details', 'crazyCourse.crazies')
            ->find($id);

        return Inertia::render('English/Course/Read', compact('crazy'));
    }

    public function story($id)
    {
        $crazy = Crazy::query()
            ->with('details', 'crazyCourse.crazies')
            ->find($id);

        return Inertia::render('English/Course/Story', compact('crazy'));
    }
}
