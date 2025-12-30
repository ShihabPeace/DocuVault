<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Inertia\Inertia;

class WidgetController extends Controller
{
    public function index()
    {        
        $document = Document::with('user','user.action')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'content' => $item->content,
                'link' => $item->link,
                'checked' => $item->checked,
                'status' => $item->status,
                'created_at' => $item->created_at->format('Y-m-d g:i A'),
                'user' => $item->user ? [
                    'id' => $item->user->id,
                    'role' => $item->user->role,
                    'name' => $item->user->name,
                    'email' => $item->user->email,
                    'created_at' => $item->user->created_at->format('Y-m-d g:i A'),
                    'action' => $item->user->action->map(function ($action) {
                        return [
                            'id' => $action->id,
                            'event_type' => $action->event_type,
                            'document_content' => $action->document_content,
                            'created_at' => $action->created_at->format('Y-m-d g:i A'),
                        ];
                    }),
                ] : null,
            ];
        });
                
        return Inertia::render('dashboard', ['documents' => $document]);
    }
}
