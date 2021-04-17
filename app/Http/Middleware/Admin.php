<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use DB;
use Closure;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle($request, Closure $next,$rol)
    {
          
        $correo=Session::get('correo_electronico');
       
        if($correo==null)
        {
            return redirect('/');     
        }
        else{

            $query = "select * from usuario where correo_electronico='$correo'";
            $data=DB::select($query);
           
           
                if($data[0]->id_rol==1)
                {
                    header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT'); 
                    header('Cache-Control: no-store, no-cache, must-revalidate');
                    header('Cache-Control: post-check=0, pre-check=0', false);
                    header('Pragma: no-cache'); 
                    return $next($request);
                }
                else{
                    return redirect('/');     
                }      
        }       
       
    }
}
