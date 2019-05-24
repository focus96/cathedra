<?php

namespace App\Admin\Controllers;

use App\Http\Requests\CheckPointRequest;
use App\Models\CheckPoint;
use App\Http\Controllers\Controller;

class CheckPointController extends Controller
{
    public function store(CheckPointRequest $checkpoint)
    {
        CheckPoint::create(request(['name', 'max_point', 'date', 'deadline', 'journal_id']));

        return redirect(route('journal', $checkpoint->journal_id));
    }

    public function edit($id)
    {
        $checkpoint = CheckPoint::findOrFail($id);

        return view('admin.online-journal.edit', compact('checkpoint'));
    }

    public function update(CheckPointRequest $request, $id)
    {
        $checkpoint = CheckPoint::findOrFail($id);

        $checkpoint->update(request(['name', 'max_point', 'date', 'deadline', 'journal_id']));

        return redirect(route('journal', $request->journal_id));
    }

    public function destroy($id)
    {
        CheckPoint::findOrFail($id)->delete();

        return redirect()->back();
    }
}
