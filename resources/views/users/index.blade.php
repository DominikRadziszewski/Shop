@extends('Layouts.app')
@section('content')
<div class="container">
@include('helpers.flash-messages')
<div class="row">
  <div class="col-6">
    <h1>{{ __('shop.user.index_title') }} <i class="fa-solid fa-users"></i></h1>
  </div>
</div>
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
            <td> <a href="{{ route ('users.edit', $user->id)}}">
              <button class="btn btn-primary btn-sm "><i class="fa-solid fa-file-pen"></i></button>
              </a>
            </td>
            <td>
            <button class="btn btn-danger btn-sm delete" data-id="{{ $user -> id }}"><i class="fa-solid fa-trash"></i></button>
            </td>
            
         </tr>
    @endforeach
  </tbody>
</table>
{{ $users->links() }}
</div>
@endsection
@section('scripts')
  const deleteUrl = "{{ url('users') }}/";
  const confirmDelete= "{{ __('shop.messages.delete_confirm') }}";
@endsection
@section('js-files')
@vite (['resources\js\delete.js'])
@endsection