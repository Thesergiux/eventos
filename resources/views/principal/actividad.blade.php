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
            background-image="{{ url($activity->cover) }}"
            :is-parallax-active="true"
            hero-height="50vh"
        >
            <template slot="container">
                <h1 class="h3 hero-title"> {{ $activity->name  }}</h1>
            </template>
        </hero>   
    </div>
</section>
<section class="section__info">
    <div class="container">
        <div class="row mb-16">
            
            <div class="md:col">
                <p class="specialist__description">
                    {!!  $activity->description !!} 
                </p>
            </div>
        </div>
    </div>
</section>
    
    
@endsection