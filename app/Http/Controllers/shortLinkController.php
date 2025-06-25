<?php

namespace App\Http\Controllers;

use App\Events\TemporaryLinkCreated;
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
use Illuminate\Support\Facades\Auth;



class shortLinkController extends Controller
{

    public function index()
    {
       if (auth('api')->check()) {
          $userId =auth('api')->id();

        $links = Link::where('user_id', $userId)->get();

        return response()->json([
            'links' => $links
        ]);
    }

    return response()->json([
        'message' => 'Unauthorized'
    ], 401);

    }

    public function store(Request $request)
    {
        try {
        $validated = $request->validate([
            'link' => 'required|url',
        ]);

        $short = Str::random(7);
       
      do {
            $short = Str::random(8);
        } while (ShortLink::where('shortLink', $short)->exists());


        if( auth('api')->check()) {
            
            $user =auth('api')->id();
            $link = Link::create(['link' => $validated['link'],
                                  'user_id' => $user,
                                   ]);
            $link->save();
            
        }else{
            $link = Link::create(['link' => $validated['link'],
                                  'expires_at' =>now()->addSecond(30)]);
            $link->save();
           
            
        }

        $shortLink = Shortlink::create([
            'shortLink' => $short,
            'link_id' => $link->id
        ]);
        $shortLink->save();
        
        return response()->json([
            'original_link' => $link->link,
            'short_link' => url('/' . $shortLink->shortLink)
        ], 201); // 201 Created

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'error' => 'Datos inválidos',
            'messages' => $e->errors(),
        ], 422); // Unprocessable Entity

    } catch (\Exception $e) {
        // Opcional: guardar el error en logs
        Log::error('Error al generar link: ' . $e->getMessage());

        return response()->json([
            'error' => 'Error interno del servidor',
            'message' => $e->getMessage(), // Quitar en producción por seguridad
        ], 500); // Internal Server Error
    }
        

    }

    public function redirect($url)
    {
        $shortLink = Shortlink::where('shortLink', $url)->firstOrFail();
        $link = Link::find($shortLink->link_id);
        // $shortLink->count ++;
        // $shortLink->save();
    
        // Redirigir al enlace original
        return redirect()->to($link->link);
    }
   
   
    public function destroy(ShortLink $shortLink)
    {
      
    }
}
