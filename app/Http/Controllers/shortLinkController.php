<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserController;
use Illuminate\Container\Attributes\Log as AttributesLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class shortLinkController extends Controller
{


    public function store(Request $request)
    {

        Log::info('Authorization Header:', [$request->header('Authorization')]);
        Log::info('User authenticated:', [auth('api')->check()]);
        Log::info('User ID:', [auth('api')->id()]);

        $user = null;
        try {
        $validated = $request->validate([
            'link' => 'required|url',
        ]);
       
      do {
            $short = Str::random(7);
        } while (ShortLink::where('shortLink', $short)->exists());

        if( auth('api')->check()) {
            
            $user =auth('api')->id();
            $link = Link::create(['link' => $validated['link'],
                                  'user_id' => $user,
                                   ]);
            
            
        }else{
            $link = Link::create(['link' => $validated['link'],
                                  'expires_at' =>now()->addSecond(30)]);
         
           
            
        }

        $shortLink = Shortlink::create([
            'shortLink' => $short,
            'link_id' => $link->id,
            'user_id'=> $user
        ]);
       
        
        return response()->json([
            'original_link' => $link->link,
            'short_link' => url('/' . $shortLink->shortLink,)
        ], 201); // 201 Created

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'error' => 'Datos inválidos',
            'messages' => $e->errors(),
        ], 422); // Unprocessable Entity

    } catch (\Exception $e) {
        
        Log::error('Error al generar link: ' . $e->getMessage());

        return response()->json([
            'error' => 'Error interno del servidor',
            'message' => $e->getMessage(),
        ], 500); // Internal Server Error
    }
        

    }


    public function redirect($url)
    {
        $shortLink = Shortlink::where('shortLink', $url)->firstOrFail();
        $link = Link::find($shortLink->link_id);
        return redirect()->to($link->link);
    }
   
   
    public function destroy($linkId)
    {
       try{
            auth('api')->check();
            $user =auth('api')->id();
            $user_id = Link::find($linkId)->user_id;
            if($user == $user_id && Link::where('user_id', $user_id)->exists()){
                $linkDelete = Link::find($linkId);
                $linkDelete->delete();

                return response()->json([
                    'message' => 'Eliminado con éxito'
                ],200);
            }
        throw new \Exception("Algo salió mal");
 
        }catch(\Exception $e){
           
            return response()->json([
            'error' => 'No tienes acceso',
            'message' => $e->getMessage(), 
        ], 403); 
            
        }
    }


    public function getLinkCount(){
     if (auth('api')->check()) {
        $userId = auth('api')->id();
        $links = Link::where('user_id', $userId)->get();
        $shortLinks = ShortLink::where('user_id', $userId)->get();
        //  $link =  $links->pluck('link');
        // $shortLink = url('/' . $shortLinks->pluck('shortLink'));
        // $clicks = $shortLinks ->pluck('count');

        $result = [];

         foreach ($shortLinks as $shortLink) {
            $link = $links->where('id', $shortLink->link_id)->first();
            $result[] = [
                'link' => $link ? $link->link : null,
                'shortLink' => url('/' . $shortLink->shortLink),
                'clicks' => $shortLink->count,
                'id' => $link->id
            ];
        }
        
        
        return response()->json($result, 200);
    }


    return response()->json([
        'message' => 'Unauthorized'
    ], 401);

    }

    public function logout() {
    Auth::guard('api')->logout();
    return response()->json([
        'status' => 'success',
        'message' => 'logout'
    ], 200);
}
}
