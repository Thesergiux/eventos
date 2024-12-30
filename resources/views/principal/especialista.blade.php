@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '')
@section('canonical', config('app.url'))
@section('class', 'home')
@section('content')
<section class="hero">
    <div class="cover">
        <hero
            background-image="{{ url($specialist->cover) }}"
            :is-parallax-active="true"
            hero-height="60vh"
        >
            <template slot="container">
            </template>
        </hero>
        <div class="container cover__container">
            <div class="cover__image">
                <img src="{{ url($specialist->photo) }}" alt="">
            </div>
        </div> 
        
    </div>
</section>
<section class="section__info">
    <div class="container">
        <div class="row mb-16">
            <div class="md:col-1/3 info__contact specialist_container">
                <h1 class="h3 specialist__name">{{ $specialist->name }}</h1>
                <span class="specialist__speciality"> {{ $specialist->speciality }}</span>
                <p class="specialist__address">
                    Dirección: Calle de los Cedros 123, Colonia Centro, Ciudad Esperanza, CP 45678, México.
                </p>
                <a class="btn btn--brand btn--sm" href="https://wa.me/{{$specialist->phone}}">Agendar cita</a>
            </div>
            <div class="md:col-2/3">
                <p class="specialist__description">
                    {!!  $specialist->description !!} 
                </p>
            </div>
        </div>
    </div>
</section>
    
    
@endsection