<?php

namespace App\Http\Controllers;

use App\Models\Formatter;
use App\Models\RestfulAPI;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use StorageImageTrait;

    private $plainToken = 'infinity_pham_son';

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        User::firstOrCreate([
            'phone' => $request->phone,
        ], [
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => "wrong token"
            ], 401);
        }

        $token = $user->createToken($this->plainToken)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response);
    }

    public function update(Request $request)
    {
        $dataUpdate = [];

        foreach ($request->all() as $key => $item) {
            if (!in_array($key, ['id', 'email_verified_at', 'number_pair', 'number_date', 'number_date_accept', 'number_lover', 'user_finder_find_id', 'user_status_id', 'role_id', 'package_service_id', 'date_use_package_service', 'user_suggestion_id', 'user_agent_find_id', 'level_id', 'fcm_token', 'is_admin', 'created_at', 'updated_at', 'deleted_at'])) {
                if (isset($item) || strlen($item) > 0) {
                    $dataUpdate[$key] = $request->$key;
                }
            }
        }

        $isUpdated = auth()->user()->update($dataUpdate);

        if (!$isUpdated) {
            return response()->json([
                'message' => 'error',
                'code' => 400,
            ], 400);
        }

        return auth()->user();
    }

    public function updateImage(Request $request)
    {
        if (!$request->hasFile('feature_image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $allowedfileExtension = ['jpg', 'png'];
        $file = $request->file('feature_image');
        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension, $allowedfileExtension);
        if (!$check) {
            return response()->json(['invalid_file_format'], 422);
        }

        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image', 'user');

        $dataUpdate = [];

        if (!empty($dataUploadFeatureImage)) {
            $dataUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        auth()->user()->update($dataUpdate);
        return auth()->user();
    }

    public function signin(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response([
                'message' => "Tài khoản chưa được tạo",
                'code' => 400,
            ], 400);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response([
                'message' => "Mật khẩu không đúng",
                'code' => 400,
            ], 400);
        }
        if ($user->user_status_id == 2) {
            return response()->json(['error' => 'Tài khoản của bạn đã bị khóa'], 405);
        }

        $token = $user->createToken($this->plainToken)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'success',
            'code' => 200,
        ];
    }
}

;
