@extends('layouts.main')

@section('content')
  {{ Session::get('permission') }}
@endsection
