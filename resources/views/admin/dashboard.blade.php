@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="text-xl font-semibold mb-4">Dashboard Admin</h3>

  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
  </form>
</div>
@endsection
