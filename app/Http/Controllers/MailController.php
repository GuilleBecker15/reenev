<?php
namespace App\Http\Controllers;
 
use Mail;
use Swift_Transport;
use Swift_Message;
use Swift_Mailer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Docente;
use App\Curso;

class MailController extends Controller
{
 
    public function __construct()
    {
 
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
 
    }
 
    /**
     * Update posisi menu
     *
     * @param  int  $id
     * @return Response
     */
    public function sendemail($user_id, $docente_id, $curso_id)
    {   
 
            $user = User::findOrFail($user_id);
            $docente = Docente::findOrFail($docente_id);
            $curso = Curso::findOrFail($curso_id);

            $data_toview = array();
            $data_toview['bodymessage'] = "Hola esto es un mensaje para: ".$user->name1;
            $data_toview['docente'] = $docente->nombre." ".$docente->apellido ;
            $data_toview['curso'] = $curso->nombre;
 
            // $email_sender   = 'encuestastip@gmail.com';
            // $email_pass     = 'tecnologo2017';
            $email_to       = $user->email;
 
            $email_sender   = env('MAIL_NEW_USERNAME', getenv("MAIL_NEW_USERNAME"));
            $email_pass     = env('MAIL_NEW_PASSWORD', getenv("MAIL_NEW_PASSWORD"));
            // Backup your default mailer
            $backup = \Mail::getSwiftMailer();
 
            try{
 
                        //https://accounts.google.com/DisplayUnlockCaptcha
                        // Setup your gmail mailer
                        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                        $transport->setUsername($email_sender);
                        $transport->setPassword($email_pass);
 
                        // Any other mailer configuration stuff needed...
                        $gmail = new Swift_Mailer($transport);
 
                        // Set the mailer as gmail
                        \Mail::setSwiftMailer($gmail);
 
                        $data['emailto'] = $email_to;
                        $data['sender'] = $email_sender;
                        //Sender dan Reply harus sama
 
                        Mail::send('emails.html', $data_toview, function($message) use ($data)
                        {
 
                            $message->from($data['sender'], 'Encuestas Tip');
                            $message->to($data['emailto'])
                            ->replyTo($data['sender'], 'Encuestas Tip')
                            ->subject('Encuestas Tip');
 
                            // echo 'The mail has been sent successfully';
                            return redirect()->back()->with('message', 'El mail ha sido enviado correctamente');
 
                        });
 
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                echo $response;
            }
 
 
            // Restore your original mailer
            Mail::setSwiftMailer($backup);
 
 
    }
 
 
 
 
}