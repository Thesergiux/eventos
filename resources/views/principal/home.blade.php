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
                <h1 class="hero-title">Mantente vivo</h1>
                <p class="hero-p">Tu salud mental es importante. Descubre cómo cuidarla con nuestras guías y recursos educativos.</p>
               <!--  <a class="btn hero-button" href="">Aprende más</a>--> 
            </template>
        </hero>
    </section>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="md:col-1/2">
                    <h2 class="h3">Apoyo para el bienestar mental</h2>
                    <p>
                    Mantente Vivo ayuda a las personas que enfrentan ansiedad o pensamientos suicidas proporcionando actividades recreativas cercanas para ayudarlas a distraerse y mejorar su bienestar. 
                    Actuamos como intermediarios, conectando a los usuarios con lugares para participar en deportes y otras actividades preferidas. 
                    Además, ofrecemos información detallada y fotos de lugares recomendados, junto con rutas aproximadas basadas en su ubicación.
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
                Actividades para un mejor tú
                </h2>
                <p>
                Descubre actividades recreativas locales que eleven tu espíritu. 
                Te conectamos con los mejores lugares para participar en deportes y pasatiempos que inspiran alegría.
                </p>
            </div>
            <div class="row mt-4">
                <div class="activities__grid">
                    @foreach ($sports as $activity)
                        <div class="activities__item">
                            <img src="{{ $activity->cover }}" alt="{{ $activity->name }}">
                            <div class="activities__overlay">
                                <a class="activities__text" href="{{ url('actividades/'. $activity->id) }}">
                                    {{ $activity->name }}
                                </a>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="section talleres section--border-top">
        <div class="container">
            <div class="row">
                <h2 class="h3">
                Talleres para el control del estrés y ansiedad
                </h2>
                <p>
                Explora una variedad de talleres recreativos que puedes seguir desde la comodidad de tu hogar.
                </p>
            </div>
            <div class="row mt-4">
                <div class="activities__grid">
                    @foreach ($workshops as $activity)
                        <div class="activities__item">
                            <img src="{{ $activity->cover }}" alt="{{ $activity->name }}">
                            <div class="activities__overlay">
                                <a class="activities__text" href="{{ url('actividades/'. $activity->id) }}">
                                    {{ $activity->name }}
                                </a>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
@endsection