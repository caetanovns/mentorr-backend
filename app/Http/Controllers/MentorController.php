<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

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

    public function enroll(Mentor $mentor): Mentor
    {
        $mentor->students += 1;
        $mentor->save();
        broadcast(new \App\Events\EnrollEvent($mentor->toJson()));
        return $mentor;
    }

    public function show(Mentor $mentor): JsonResponse
    {
        Log::info('Consulta do usuário.');
        return response()->json($mentor);
    }

    public function store(Request $request): JsonResponse
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

        $mentor = Mentor::create($request->all());
        $mentor->save();
        Log::info('Usuário Adicionado.');
        return response()->json([
            'success' => true,
            'message' => 'Created',
            'data' => $mentor
        ], Response::HTTP_CREATED);
    }

    public function delete(Mentor $mentor): JsonResponse
    {
        /*
        if (! Gate::allows('delete', $mentor)) {
            return response()->json([
                'success' => false,
                'message' => 'Usuário não autorizado'
            ], Response::HTTP_UNAUTHORIZED);
        }
        */

        $mentor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mentor removido com sucesso.'
        ], Response::HTTP_OK);
    }
}
