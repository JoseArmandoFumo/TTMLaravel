@extends ('adminlte::page')

@section('title', 'Edit Usuario')

@section('content_header')
    <h1> Editar Usuarios </h1>

@endsection

@section('content')
    
    @if($errors ->any())
        <div class="alert alert-danger">
            <ul>
            <h5> Ocorreu um erro! <i class="icon fas fa-ban"></i> </h5>
                @foreach ($errors ->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>     
        </div>
     @endif 

        <div class="card">
            <div class="card-body"> 
            
            <form action="{{Route('users.update', ['user'=>$user->id])}}" method="POST" class="form-horizontal">
            @method('PUT')
       @csrf 
                <div class="form-group row"> 
                 <label  class="col-sm-2 col-form-label"> Nome Completo</label>
                <div class="col-sm-7 ">
                    <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" />
                 </div>
                </div>
              <div class="form-group row"> 
                <label  class="col-sm-2 col-form-label"> Email</label>
                <div class="col-sm-7 ">
                    <input type="email" name="email"value="{{$user->email}}"  class="form-control @error('email') is-invalid @enderror"/> 
                </div>
            </div>
                 <div class="form-group row"> 
                <label  class="col-sm-2 col-form-label"> Nova Senha</label>
                <div class="col-sm-7 ">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"/> 
                </div>
              </div>
                <div class="form-group row"> 
                <label  class="col-sm-2 col-form-label"> Confirmacao da Senha</label>
                <div class="col-sm-7 ">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"/> 
                </div>
             </div>
                 <div class="form-group row"> 
              <label  class="col-sm-2 col-form-labe"></label>
                <div class="col-sm-7 ">
                    <input type="submit" value="Salvar" class="btn btn-success" /> 
                </div>
             </div>
    </form>
            </div>
        
        </div>  
   

@endsection

