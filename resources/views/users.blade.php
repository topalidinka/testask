@extends('layouts.app')

@section('content')
<div class="container">
  <add-user-form token="{{ csrf_token() }}"></add-user-form>
</div>
@endsection
