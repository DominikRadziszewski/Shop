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
            <td></td>
         </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection