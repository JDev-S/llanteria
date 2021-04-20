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
            $nombre=$data[0]->nombre_completo;
            $id=$data[0]->id_usuario;
            $length=10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[rand(0, $charactersLength - 1)];
                }
            
                //$encryptedPassword = bcrypt($password);
            //$query2=DB::update("update  usuario set contrasenia='$password' where correo_electronico=?",[$email]);
            $query=DB::update("update  usuario set contrasenia='$password' where id_usuario=?",[$id]);
            $this->email($email, $nombre, $password);
            return redirect('/');
        }
        else{
            return redirect('/cambiar_contrasenia');
        }
    }
    
    public function email($email, $nombre, $password){
       // Configuration
       $smtpAddress = 'smtp.gmail.com';
       $port = 465;
       $encryption = 'ssl';
       $yourEmail = 'juanjesuspadrondiaz@gmail.com';
       $yourPassword = 'jjpd1996';

       // Prepare transport
        $transport = (new \Swift_SmtpTransport($smtpAddress,$port,$encryption))
        ->setUsername($yourEmail)
        ->setPassword($yourPassword )
        ;

        $mailer = new \Swift_Mailer($transport);
               // Prepare content
               $view = View::make('email_template', [
                   'message' => ' Estimado '.$nombre,
                   'message2'=>'En JDev-S cuidamos tu seguridad, por tal motivo, te estamos enviando la contraseña que nos solicitaste',
                   'message3'=>'Nombre de usuario :'.$nombre,
                   'message4'=>'Nueva Contraseña :'.$password,
                   'message5'=>'Es recomendable cambiar las contraseñas continuamente para obtener la más alta seguridad en nuestro sitio.'

               ]);

               $html = $view->render();

               // Send email
        $message = new \Swift_Message('Cambio de Contraseña');
        $message->setFrom([$yourEmail => 'Llantimax'])->setTo([$email => $nombre])->setBody($html, 'text/html');
           
       if($mailer->send($message)){
           return "Check your inbox";
       }
       return "Something went wrong :(";
       
   }

}
