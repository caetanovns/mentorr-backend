<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index(Request $request): array
    {
        return [
            'mentors' => Mentor::with('user:id,name')->get()
        ];
    }

    /*
    public function show(string $id): JsonResponse
    {
        return response()->json(Mentor::findOrFail($id));
    }
    */

    public function show(Mentor $mentor): JsonResponse
    {
        return response()->json($mentor);
    }

    public function store(Request $request): string
    {
        $request->validate([
            'position' => 'required',
            'company' => 'required',
            'resume' => 'required',
            'biography' => 'required',
            'price' => 'required|numeric|min:0',
            'rating' => 'required|integer|min:0|max:5',
            'user_id' => 'required'
        ]);

        return 'RETORNO DA API';
    }
}
