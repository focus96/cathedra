<?php

namespace App\Http\Controllers;

use App\Models\Group;

class CuratorController extends Controller
{
    public function index()
    {
        $groups = Group::with(['curator'])->get(['name_group', 'curator_id']);
        return View('curators.index', compact(['groups']));
    }
}
