<?php

namespace App\Http\Controllers;

use App\Enums\EnumsStatus;
use App\Models\Action;
use App\Models\Document;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WidgetController extends Controller
{
    public function index()
    {
        $documents = Document::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'filename' => $item->filename,
                'link' => $item->link,
                'status' => $item->status,
                'expire_date' => $item->expire_date->format('Y-m-d g:i A'),
                'created_at' => $item->created_at->format('Y-m-d g:i A'),
            ];
        });
        $actions = Action::with('user')->get();

        return Inertia::render('dashboard', ['documents' => $documents, 'actions' => $actions]);
    }

    public function actionuncheck(Request $request)
    {
        $request->validate([
            'actid' => 'required|integer|exists:actions,id',
        ]);
        try {
            $ChecekdAction = Action::where('id', $request->actid)->update(['checked' => true]);

            if ($ChecekdAction) {
                dump($request->actid);

                return response()->json([
                    'message' => 'checked successfully',
                ], 200);
            }
        } catch (QueryException $e) {
            if ($e) {
                return response()->json([
                    'message' => 'PHP error',
                    'error' => $e->getMessage(),
                ], 500);
            }
        } catch (Exception $e) {
            if ($e) {
                return response()->json([
                    'message' => 'PHP error',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

    }

    public function remove(Request $req)
    {
        $req->validate([
            'expdocid' => 'required|integer|exists:documents,id',
        ]);

        $res = Document::where('id', $req->expdocid)->delete();
        ds($res);

    }

    public function approve(Request $req)
    {
        $req->validate([
            'penddocid' => 'required|integer|exists:documents,id',
        ]);

        $res = Document::where('id', $req->penddocid)->update('status', EnumsStatus::PENDING);
    }

    public function cancel(Request $req)
    {
        $req->validate([
            'penddocid' => 'required|integer|exists:documents,id',
        ]);

        $res = Document::where('id', $req->penddocid)->update('status', EnumsStatus::CANCELLED);
    }
}
