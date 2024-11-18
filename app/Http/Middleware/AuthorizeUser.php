<?php
namespace App\Http\Middleware;

use App\Models\LevelModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    // JS 7 PRAKTIKUM 2
    //  public function handle(Request $request, Closure $next, $role = '' ): Response
    //  {
    //      $user = $request->user(); // ambil data user yg login
    //                                // fungsi user() diambil dari UserModel.php
    //      if($user->hasRole($role)){ // cek apakah user punya role yg diinginkan
    //          return $next($request);
    //      }


    //JS 7 PRAKTIKUM 3
    public function handle(Request $request, Closure $next, ... $roles ): Response
    {
        $user_role = $request->user()->getRole(); // ambil data user yg login
                                  // fungsi user() diambil dari UserModel.php
        $level_role = LevelModel::find($user_role);

        if(in_array($level_role->level_kode, $roles)){ // cek apakah user punya role yg diinginkan
            return $next($request);
        }

        // jika tidak punya role, maka tampilkan error 403
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}