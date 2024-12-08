<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\UserModel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        try {
            $validateData = $request->validate([
                'username' => 'required',
                'password' => 'required|min:6',
            ]);
            if (!auth()->attempt($validateData)) {
                return $this->errorResponse('Invalid credentials', 401);
            }

            $user = UserModel::where('username', $request->get('username'))->first();

            if (!$user || !Hash::check($request->get('password'), $user->password)) {
                return $this->errorResponse('Credentials not match', 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse(['token' => $token], 'Login success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
    public function getUser(Request $request)
    {
        try {
            return $this->successResponse(new UserResource($request->user()), 'User data');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse([], 'Logout success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

    public function updateProfile(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:m_user,username,' . $request->user()->user_id . ',user_id',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg',
            'nip' => 'required',
            'password' => 'nullable|min:6',
        ]);
        try {
            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $filename);
                $validateData['foto_profil'] = 'images/' . $filename;

                if ($request->user()->foto_profil) {
                    Storage::delete('public/' . $request->user()->foto_profil);
                }
            }

            if ($request->password) {
                $validateData['password'] = Hash::make($request->password);
            }

            $request->user()->update($validateData);

            return $this->successResponse([], 'Profile has been updated');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}
