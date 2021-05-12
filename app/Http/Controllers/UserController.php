<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
//importar
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::all();
        $loggedId = intval(Auth::id());

        return view('Admin.users.index', [
            'users' => $users,
            'loggedId' => $loggedId
             ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('Admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //pegando os dados da base de dados 
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);
        //Validando os dados dentro da funcao store().
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'max:200', 'unique:users'],
            'password' => ['required', 'min:4', 'string', 'confirmed']
        ]);
        //definindo comportamento do sistema caso a validacao de erro
        if($validator->fails()){
            return redirect()-> route('users.create')
            ->withErrors($validator)
            ->withInput();
        } 
        //Accoes que vai tomar caso a validacao nao de nenhum erro
        $user = new User;
        $user -> name = $data['name'];
        $user -> email = $data['email'];
        $user -> password = Hash::make($data['password']);
        $user ->save();

        //Aqui retorna a lista de todos os usuarios ja cadastrados
        return redirect()->route('users.index');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($user){
            return view('Admin.users.edit', ['user'=>$user]); 
        }
        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);
            $validator = Validator::make([
                'name'=> $data['name'],
                'email'=> $data['email']
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email'=> ['required', 'string', 'email', 'max:100']
               ]);

             //1. Alteracao do nome
               $user -> name =$data['name'];

            //2. Alteracao do email
            //2.1 Primeiro, verificamos se o email foi alterado
               if($user->emal != $data['email']){
                //2.2.Verificamos se o novo email ja existe
                $hasEmail = User::where('email', $data['email'])->get();
                 //2.3. Se nao existir, nos alteramos.
                if(count($hasEmail) === 0) {
                  $user ->email = $data['email']; 
                } else {
                    $validator ->errors()-> add('email', __('validation.unique', [
                        'attribute'=> 'email'            
                    ]));
                }
             }
            //3. Alteracao da senha
            //3.1 Verificar se foi dgitado um email
             if(!empty($data['password'])){
                 if(strlen($data['password']) >= 4){
                     //3.2 Verificar se a confirmacao esta OK
                        if($data['password']=== $data['password_confirmation']){
                          //3.3 Alterar a senha 
                           $user-> password = Hash::make($data['password']); 
                        } else 
                        {
                            $validator ->errors()-> add('password', __('validation.confirmed', [
                                'attribute'=> 'password'
                        ]));

                            }
                   }  else {
                            $validator ->errors()-> add('password', __('validation.min.string', [
                                'attribute'=> 'password',
                                'min' => 4
                            ]));

                            }
                }

                if(count($validator->errors() ) > 0) {
                    return redirect()-> route('users.edit', [
                        'user' => $id
                    ])->withErrors($validator);
                }
            
                $user->save();
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $loggedId  = intval(Auth::id());
       if($loggedId !== intval($id)){
            $user= User::find($id);
            $user->delete();
       }
       return redirect()-> route('users.index');
    }
}
