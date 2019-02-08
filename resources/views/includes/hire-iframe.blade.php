@extends('layouts.master-layout')
@section('title')
    Home | Subjects
@endsection

@section('style')

@endsection

@section('content')
    <section>
        <iframe src="{{url('hire-request/'.$id)}}" height="900px"></iframe>
    </section>

@endsection


@section('scripts')

@endsection
