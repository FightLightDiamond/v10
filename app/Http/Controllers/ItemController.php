<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function create()
    {
        return Inertia::render('Dev/create');
    }

    public function store()
    {
        $data = request()->all();
        $data['code'] = request('name');
        $data['image'] = '';
        $item = Item::query()->create($data)->toArray();
        return Inertia::render('Dev/enhance', compact('item'));
    }

    public function show($id) {
        $item = Item::query()->find($id);

        return Inertia::render('Dev/enhance', compact('item'));
    }

    public function update($id)
    {
        Item::query()
            ->where('id', $id)
            ->update(request()->all());
    }
}
