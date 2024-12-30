@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '')
@section('canonical', config('app.url'))
@section('class', 'home')
@section('content')
    <section class="hero">
        <hero
            background-image=""
            :is-parallax-active="false"
            hero-height="50vh"
        >
            <template slot="container">
                <h1 class="hero-title hero--black">Conéctate con un Especialista en Salud Mental</h1>
                <p class="hero-p hero--black">Consulta con expertos que te acompañarán en tu bienestar emocional.</p>
        
            </template>
        </hero>
    </section>
    <section class="section">
        <div class="container">
            <div class="row">
                @foreach ($specialists as $specialist) 
                    <div class="md:col-1/2">
                        <div class="card">
                            <div class="card-image">
                                <img src="{{ url($specialist->photo) }}" alt="">
                            </div>
                            <div class="card-name">
                                {{ $specialist->name }}
                                <span class="card-speciality">{{ $specialist->speciality}}</span>
                            </div>
                            <div class="card-description">
                                <except-text text="{!! $specialist->description !!}" max-length="305"></except-text>
                            </div>
                            <div class="card-more">
                                <a class="btn btn--brand btn--xs" href="{{ url('especialista/'.$specialist->id) }}">Ver más</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    
@endsection