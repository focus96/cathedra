<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Support\Facades\URL;

class FeedbackController extends Controller
{
    public function store(FeedbackRequest $request)
    {
        Feedback::create($request->only(['name', 'contact', 'message']));

        return redirect(URL::previous() . '#feedback')
            ->with(['messageFeedback' => 'Ваш запит прийнято. Чекайте на вiдповiдь.']);
    }
}
