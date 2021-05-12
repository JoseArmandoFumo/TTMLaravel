@extends ('adminlte::page')
@section('title','Menu Principal')

@section ('content_header')
<h1> Registo de Clientes</h1>
<a href = "{{Route('costumers.create')}}" class = "btn btn-info"> Novo Cadastro</a>
@endsection

@section('content')
<div class = "row">
    <table class = "table table-hover call-sm-6"> 
      <tr> 
        <th> ID  </th>
        <th> Name  </th>
        <th> Email  </th>
        <th> Phone  </th>
        <th> Adress </th>
        <th> Actions </th>
     </tr> 
        @foreach($costumer as $c)
            <tr> 
                <td> {{$c->id}} </td>
                <td> {{$c->name}} </td>
                <td> {{$c->email}} </td>
                <td> {{$c->phone}} </td>
                <td> {{$c->adress}} </td>
                <td> <a href = "{{Route('costumers.edit', ['costumer'=> $c->id])}}"  class = "btn btn-success">  Editar</a> |
                <a href = "{{Route('costumers.destroy',['costumer'=> $c->id] )}}" class = "btn btn-danger">Eliminar</a> </td>

            </tr>
        @endforeach
   
    </table> 
</div>
@endsection