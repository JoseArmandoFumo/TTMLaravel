@extends ('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1> Meus Usuarios 
        <a href="{{Route('users.create')}}" class = "btn btn-sm btn-success">  +Usuario </a>
    </h1>

@endsection

@section('content')

  <table class ="table table-hover"> 
     <tr>

        <th>ID</th>
        <th>Nome</th>
        <th>Email</th> 
        <th>Accoes</th> 
      </tr>
      
        @foreach($users as $user)
         <tr>
           <td>{{$user->id}}</td>
           <td>{{$user->name}}</td>
           <td>{{$user->email}}</td>
           <td>
                <a href="{{Route('users.edit', ['user'=>$user->id])}}" class="btn btn-sm btn-info"a> Editar</a>

                @if($loggedId !== intval($user->id))
                  <form class= "d-inline" method="POST" action = "{{Route('users.destroy', ['user'=>$user->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @method('DELETE')
                    @csrf
                      <button class="btn btn-sm btn-danger"> Excluir</button>
                  </form>
                @endif

                
           </td>
           
         </tr>         
        @endforeach
        
  </table>
@endsection

