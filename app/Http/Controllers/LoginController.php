<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Connection;
use DB;
use Mail;
use View;
use Swift_Mailer;
use Swift_MailTransport;
use Swift_Message;
class LoginController extends Controller
{
     public function Login(Request $input)

	{
         
         if(session('correo_electronico')!= "")
         {
             echo 'hay alguien activo';
            
             return redirect('/principal');
         }
         else
         {
                 $email = $input['email'];
    $contrasenia = $input['contrasenia'];

    $query = "select * from usuario where correo_electronico='$email'";
        $data=DB::select($query);
        $cantidad= sizeof($data);

        if($cantidad>0)
        {        
            $query2 = "select usuario.contrasenia,usuario.correo_electronico,usuario.id_sucursal,usuario.id_usuario from usuario where correo_electronico='$email'";
            $data2=DB::select($query2);            
            //if (Hash::check($contrasenia, $data2[0]->password)) {
            if($contrasenia==$data2[0]->contrasenia){
           echo 'essta registrado';
            Session::put('correo_electronico',$email);
            Session::put('contrasenia',$contrasenia);
            Session::put('id_sucursal_usuario',$data2[0]->id_sucursal);
            Session::put('id_usuario',$data2[0]->id_usuario);
            $correo_electronico=Session::get('correo_electronico');
            $pass=Session::get('contrasenia');
            $id_sucursal_usuario=Session::get('id_sucursal_usuario');
            $id_usuario=Session::get('id_usuario');    
            //echo '<br/>';
            //echo $correo_electronico."          ".$pass."  ".$id_sucursal_usuario.' '.$id_usuario;
                
            return redirect('/principal');

            }else{
                return redirect('/');
                 //echo 'contraseña incorrecta ';
            }
        }
        else{
            return redirect('/');
            //echo 'no essta registrado';
        }  
         }
  
    }
    
    public function Logout()
	{
		
		Session::flush();
		return redirect('/');
	}
    
    public function mostrar_principal()
    {
         return view('/principal/index');
    }
    
    public function mostrar_login()
    {
        if(session('correo_electronico')!= "")
         {
             //echo 'hay alguien activo';
            
             return redirect('/principal');
         }
        else
        {
            return view('login');
        }
    }
    
    public function obtener_contraseña(Request $input)
	{
        $email = $input['email'];
      

        $query = "select * from usuario where correo_electronico='$email'";
        $data=DB::select($query);
       
        
        $cantidad= sizeof($data);
      
        if($cantidad>0)
        {
            $nombre=$data[0]->nombre;
            $length=10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, $charactersLength - 1)];
                }
            
                $encryptedPassword = bcrypt($password);
                $query2=DB::update("update  usuario set contrasenia='$encryptedPassword' where correo_electronico=?",[$email]);
            $this->email($email, $nombre, $password);
            return redirect('/iniciar_sesion');
        }
        else{
            return redirect('/mi_contraseña');
        }
    }

}
