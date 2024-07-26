<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): JsonResponse {
        //$users = Bill::orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->paginate(1);

        return response()->json([
            'status' => true,
            'users' => $users
        ]);
    }

    public function show(User $user): JsonResponse {
        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }

    public function store(UserRequest $request): JsonResponse {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user): JsonResponse {
        DB::beginTransaction();
        try {
            $user = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully',
                'bill' => $user
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
