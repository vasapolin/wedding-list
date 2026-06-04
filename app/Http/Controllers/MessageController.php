<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SiteAsset;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::query()
            ->where('is_approved', true)
            ->latest()
            ->limit(20)
            ->get();

        return view('messages.index', [
            'messages' => $messages,
            'heroUrl' => SiteAsset::url('messages.hero'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = Validator::make($request->all(), [
            'author' => ['required', 'string', 'max:80'],
            'body' => ['required', 'string', 'max:2000'],
        ])->validate();

        Message::query()->create([
            'author' => $data['author'],
            'body' => $data['body'],
            'is_approved' => true,
        ]);

        return redirect()->route('messages.index')->with('message.posted', true);
    }
}
