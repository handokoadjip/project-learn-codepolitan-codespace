@extends('layouts.app')

@section('content')
<div class="container">
    {{-- component laravel --}}
    <x-space></x-space>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @foreach ($spaces as $space)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$space->title}}
                        {{-- Auth::user()->id = mengambil data yang sedang login  --}}
                        {{-- bisa menggunakan method, helper, level get, middlerware --}}
                        @if ($space->user_id == Auth::user()->id)
                        <form action="{{ route('space.destroy', $space->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger float-right ml-1"
                                onclick="return confirm('are you sure?')">Delete</button>
                            <a href="{{ route('space.edit', $space->id) }}"
                                class="btn btn-sm btn-info text-white float-right">Edit</a>
                        </form>
                        @endif
                    </h5>
                    <h6 class="card-subtitle">{{$space->address}} </h6>
                    <p class="card-text">{{$space->description}} </p>
                    <a href="#" onclick="openDirection({{$space->latitude}}, {{$space->longitude}}, {{$space->id}})"
                        class="card-link">Direction</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        {{$spaces->links()}}
    </div>
</div>
@endsection