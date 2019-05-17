<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subscription;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request,[
            'email' =>'required|email|unique:subscriptions'
        ]);

         Subscription::add($request->get('email'));

        return redidect()->back()->with('status','Перевірте будь ласка вашу пошту!');
    }


}
