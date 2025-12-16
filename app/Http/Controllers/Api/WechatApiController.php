<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wechat\Oauth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WechatApiController extends Controller
{
    public function getWechatSession(Request $request)
    {

        try {
            $response = '';
            if (env('APP_ENV') != 'local') {
                $response = Http::get(env('WECHAT_END'), [
                    'appid' => env('WECHAT_APP_ID'),
                    'secret' => env('WECHAT_APP_SECRET'),
                    'js_code' => $request->code,
                    'grant_type' => 'authorization_code',
                ]);
            } else {
                $response = Http::withoutVerifying()->get(env('WECHAT_END'), [
                    'appid' => env('WECHAT_APP_ID'),
                    'secret' => env('WECHAT_APP_SECRET'),
                    'js_code' => $request->code,
                    'grant_type' => 'authorization_code',
                ]);
            }

            $data = $response->json();

            $oauth = Oauth::updateOrCreate(
                ['open_id' => $data['openid']],
                ['session_id' => $data['session_key']]
            );

            $hashedOpenId = hash_hmac('sha256', $data['openid'], env('WECHAT_SEED'));

            return response()->json([
                'open_id' => $hashedOpenId,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function getContentManage(Request $request){
        
    }
}
