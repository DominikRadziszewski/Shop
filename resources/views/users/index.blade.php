@extends('Layouts.app')
@section('content')
<div class="container">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email</th>
      <th scope="col">Imię</th>
      <th scope="col">Nazwisko</th>
      <th scope="col">Numer Telefonu</th>
      <th scope="col">Akcje</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
         <tr>
            <th scope="row">{{  $user -> id  }}</th>
            <td>{{  $user -> email  }}</td>
            <td>{{  $user -> name  }}</td>
            <td>{{  $user -> surname  }}</td>
            <td>{{  $user -> phone_number  }}</td>
            <td>
            <button class="btn btn-danger btn-sm delete" data-id="{{ $user -> id }}">X</button>
            </td>
         </tr>
    @endforeach
  </tbody>
</table>
{{ $users->links() }}
</div>
@endsection
@section('scripts')

$(function(){
 $(".delete").on("click",function(){ 
      $.ajax({
      method: "delete",
      url: "http://localhost/CV/public/users/"+$(this).data("id"),
      //data: { name: "John", location: "Boston" }
      })
      .done(function(response) {
      location.reload();
      alert("SUKCES");
       });
       });
});

@endsection