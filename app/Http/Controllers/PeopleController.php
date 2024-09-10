<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeopleRequest;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $defaultLimit = 10;

        if ($request->wantsJson()) {
            $users = People::query()
                ->when($request->get('search'), function ($query, $search) {
                    $search = strtolower(trim($search));
                    return $query->whereRaw('LOWER(name) LIKE ?', ["%$search%"]);
                })
                ->when($request->get('sort'), function ($query, $sortBy) {
                    return $query->orderBy($sortBy['key'], $sortBy['order']);
                })
                ->paginate($request->get('limit', $defaultLimit));

            return response()->json($users);
        }

        return inertia('People/Index', [
            'filters' => [
                'limit' => $defaultLimit
            ],
            'can' => [
                'createPeople' => auth()->user()->can('create', People::class)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeopleRequest $request)
    {
        $people = People::create($request->validated());
        $message = sprintf('Successfully created %s', $people->name);

        return redirect()->back()->with('success', $message);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('People/Create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(People $person)
    {
        return inertia('People/Edit', [
            'person' => $person
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(People $person, StorePeopleRequest $request)
    {
        $person->update($request->validated());
        $message = sprintf('Successfully updated %s', $person->name);

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(People $person)
    {
        $person->delete();
        $message = sprintf('Successfully deleted %s', $person->name);

        return redirect()->back()->with('success', $message);
    }
}
