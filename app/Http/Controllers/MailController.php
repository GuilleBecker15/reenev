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
use App\Encuesta;
use App\Realizada;
use Illuminate\Support\Facades\Redirect;
use \PDF;

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
    public function sendemail(Request $request, $user_id, $docente_id, $curso_id, $urlprevia)
    {   
 
            $user = User::findOrFail($user_id);
            $docente = Docente::findOrFail($docente_id);
            $curso = Curso::findOrFail($curso_id);
            // $a = "http://localhost:8000/Realizadas/4/quienes?idEncuesta=4&idCurso=4&idDocente=6";

            $url = explode('Realizadas', $urlprevia);
            $url = "/Realizadas".$url[1];

            // dd($url);

            $data_toview = array();
            $data_toview['bodymessage'] = "Hola esto es un mensaje para: ".$user->name1;
            $data_toview['docente'] = $docente->nombre." ".$docente->apellido ;
            $data_toview['curso'] = $curso;
 
            // $email_sender   = 'encuestastip@gmail.com';
            // $email_pass     = 'tecnologo2017';
            $email_to       = $user->email;
 
            // $email_sender   = env('MAIL_NEW_USERNAME', getenv("MAIL_NEW_USERNAME"));
            // $email_pass     = env('MAIL_NEW_PASSWORD', getenv("MAIL_NEW_PASSWORD"));
            $email_sender   = env('MAIL_USERNAME', getenv("MAIL_USERNAME"));
            $email_pass     = env('MAIL_PASSWORD', getenv("MAIL_PASSWORD"));
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
 
                            //$request = new Request;
 
                        });
                        // dd($urlprevia);
                        $request->session()->flash('message', 'Se ha enviado correctamente un mail al alumno '.$user->name1." ".$user->apellido1);
                        return redirect()->back();
 
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                //echo $response;
                //$request = new Request;
                $request->session()->flash(
                    'error', 'Ha ocurrido un problema al enviar un mail al alumno '.$user->name1." ".$user->apellido1
                    );
                return redirect()->back();
            }
 
 
            // Restore your original mailer
            Mail::setSwiftMailer($backup);
 
 
    }
 
 public function sendemailprofes(Request $request, $id_docente, $id_encuesta, $id_curso)
    {   

            $docente = Docente::find($id_docente);
            $encuesta = Encuesta::find($id_encuesta);
            $curso = Curso::find($id_curso);
            $cantidad = $encuesta->realizadas->where('curso_id',$id_curso)->where('docente_id',$id_docente)->count();
            if (!$docente)  return "No se encontro el docente de id=".$id_docente;
            if (!$encuesta) return "No se encontro la encuesta de id=".$id_encuesta;
            if (!$curso)    return "No se encontro el curso de id=".$id_curso;

            $data_toview                = array();
            $data_toview['docente']     = $docente;
            $data_toview['encuesta']    = $encuesta;
            $data_toview['curso']       = $curso;
            $data_toview['anio']        = substr($encuesta->vence, 0, strpos($encuesta->vence, "-"));
            $data_toview['cantidad']    = $cantidad;
            if($curso->semestre % 2 == 0){
                $data_toview['semestre'] = "primer";
            }else{
                $data_toview['semestre'] = "segundo";
            }
            
            
            // $email_to       = "carlosfrostte@gmail.com";
            $email_to       = $docente->email;
 
            $email_sender   = env('MAIL_USERNAME', getenv("MAIL_USERNAME"));
            $email_pass     = env('MAIL_PASSWORD', getenv("MAIL_PASSWORD"));
            // $email_sender   = env('MAIL_USERNAME', getenv("MAIL_USERNAME"));
            // $email_pass     = env('MAIL_PASSWORD', getenv("MAIL_PASSWORD"));
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
 
                        Mail::send('emails.emailprofes', $data_toview, function($message) use ($data, $data_toview)
                        {
 
                            $pdf = \PDF::loadView('emails.pdfprofes', $data_toview);
                            $message->from($data['sender'], 'Encuestas Tip');
                            $message->to($data['emailto'])
                            ->replyTo($data['sender'], 'Encuestas Tip')
                            ->subject('Encuestas Tip');
                            $message->attachData($pdf->output(), 'filename.pdf');
                            // echo 'The mail has been sent successfully';
 
                        });
 
                            $request->session()->flash(
                                'message', 'Se ha enviado correctamente un mail al docente '.$docente->name." ".$docente->apellido
                                );
                            return redirect()->back();
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                //echo $response;
                $request->session()->flash(
                    'error', 'Ha ocurrido un problema al enviar un mail al docente '.$docente->name." ".$docente->apellido
                    );
                return redirect()->back();
            }
 
 
            // Restore your original mailer
            Mail::setSwiftMailer($backup);
 
 
    }
 
 
}