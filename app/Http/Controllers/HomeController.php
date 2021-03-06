<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tarea;
use App\User;
use App\TareaUser;
use Auth;
use Hash;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(session()->has('idioma')){
          App::setLocale(session()->get('idioma'));
        }
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $filtro = Tarea::filterType($request->get('estado'));

      $tareas = User::find(Auth::user()->id)->tareas()->orderBy('created_at', 'desc')->paginate(10);

      //$tareas = Tarea::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
      //$tareas = User::find(Auth::user()->id)->tareas()->orderBy('created_at', 'desc')->paginate(10);
      return view('tareas', ['tareas' => $tareas]);
    }

    public function postCrear(Request $request){
        $this->validate($request, [
          'texto' => 'required|max:255'
        ]);

        $tarea = new Tarea(['texto' => $request->texto, 'user_id' => Auth::user()->id]);
        $usuario = User::find(Auth::user()->id);
        $usuario->tareas()->save($tarea);
        $message = trans('messages.tarea_creada');
        session()->flash('success', $message);
        return redirect('tareas');
    }

    public function getCompletar($id){
        $tarea = Tarea::find($id);
        if($tarea->user_id === Auth::user()->id){
          $tarea->estado = 'Completada';
          $tarea->save();
          $message1 = trans('messages.tarea_marcada');
          session()->flash('success', $message1);
        }else{
          $message2 = trans('messages.sin_permiso');
          session()->flash('error', $message2);
        }
        return redirect('tareas');
    }

    public function getBorrar($id){
        $tarea = Tarea::find($id);
        if($tarea->user_id === Auth::user()->id){
          $tarea->delete();
          $message1 = trans('messages.tarea_eliminada');
          session()->flash('success', $message1);
        }else{
          $message2 = trans('messages.sin_permiso');
          session()->flash('error', $message2);
        }
        return redirect('tareas');
    }

    public function getConfig(){
        return view('auth.config');
    }

    public function postCambiarPass(Request $request){
        $mensajes = [
          'required' => 'El campo :attribute es obligatorio',
          'min' => 'El campo :attribute debe contener al menos :min caracteres'
        ];
        $this->validate($request, [
          'passActual' => 'required',
          'pass1' => 'required|min:6',
          'pass2' => 'required|min:6'
        ], $mensajes);
        if (Hash::check($request->passActual, Auth::user()->password)) {
          if ($request->pass1 === $request->pass2) {
            $usuario = User::find(Auth::user()->id);
            $usuario->password = bcrypt($request->pass1);
            $usuario->save();
            $message1 = trans('auth.pass_cambiado');
            session()->flash('success', $message1);
          }else{
            $message2 = trans('auth.pass_no_coincide');
            session()->flash('error', $message2);
          }
        }else{
          $message3 = trans('auth.pass_no_valida');
          session()->flash('error', $message3);
        }
        return redirect('config');
    }

    public function postCompartir(Request $request){
      $usuario = User::where('email', $request->email)->firstOrFail();

      $count = TareaUser::where(['tarea_id' => $request->tarea_id, 'user_id' => $usuario->id])->count();

      if($count === 0){
          $tarea_user = new TareaUser;
          $tarea_user->user_id = $usuario->id;
          $tarea_user->tarea_id = $request->tarea_id;
          $tarea_user->save();
          session()->flash('success', 'Tarea compartida con el usuario ' . $request->email);
      }else{
          session()->flash('error', 'No se puede compartir la tarea con el usuario ' . $request->email);
      }

      return redirect('tareas');
  }
}
