@extends('layouts.app')

@section('main')
<my-component></my-component>

     <form action="/imports" method="post" enctype="multipart/form-data">
         @csrf
        <input type="file" name="payment">

        <button type="submit">Send</button>
    </form>

@endsection
