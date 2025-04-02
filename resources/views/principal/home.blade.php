@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '')
@section('canonical', config('app.url'))
@section('class', 'home')
@section('content')
    <section class="hero">
        <hero
        background-image="{{ url('img/hero/hero.png') }}"
        :is-parallax-active="true"
        hero-height="90vh"
        >
            <template slot="container">
                <h1 class="hero-title">Eventos</h1>
                <p class="hero-p">Esta es una pagina sobre eventos de la Unipoli.</p>
               <!--  <a class="btn hero-button" href="">Aprende más</a>--> 
            </template>
        </hero>
    </section>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="md:col-1/2">
                    <h2 class="h3">Apoyo para administrar eventos</h2>
                    <p>
                    Nuestra plataforma no solo facilita la gestión de eventos tecnológicos como hackatones, conferencias y ferias de innovación, sino que también permite la ponderación y evaluación de calificaciones para determinar ganadores y destacar el desempeño de los participantes. Los organizadores pueden crear y administrar eventos, gestionar inscripciones, enviar notificaciones y hacer un seguimiento en tiempo real desde un panel intuitivo. Además, ofrece herramientas avanzadas para el registro y evaluación de proyectos, integración con redes sociales y generación de reportes detallados. Con un enfoque en la eficiencia y la transparencia, nuestra plataforma garantiza una organización fluida y una evaluación justa en cada evento.
                    </p>
                </div>
                <div class="md:col-1/2">
                    <img class="subject-img" src="{{ url('img/deporte-landing.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="section actividades section--border-top">
        <div class="container">
            <div class="row">
                <h2 class="h3">
                    Eventos
                </h2>               
            </div>
            <div class="row mt-4">
                <div class="events__grid">
                    @foreach ($events as $event)
                        <div class="events__item card">
                            <div class="card__status-tab {{ $event->status == 'active' ? 'active' : 'inactive' }}">
                                {{ $event->status == 'active' ? 'Activo' : 'Inactivo' }}
                            </div>
                            <img src="{{ $event->cover }}" alt="{{ $event->name }}" class="card__image">
                            <div class="card__content">
                                <div class="card__dates">
                                    <p>
                                        Inicio: 
                                        <span>{{ $event->formated_start_date }}</span>
                                    </p>
                                    <p>
                                        Cierre: 
                                        <span>{{ $event->formated_finish_date }}</span>
                                    </p>
                                </div>
                                <h3 class="card__title">
                                    {{ $event->name }}
                                </h3>
                                <div class="card__description">
                                    {!! $event->description !!}
                                </div>
                                <a href="{{ url('evento/'. $event->id) }}" class="btn btn--primary btn--sm card__link">Ver más</a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    
@endsection