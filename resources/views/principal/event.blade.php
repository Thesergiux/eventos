@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '')
@section('canonical', config('app.url'))
@section('class', 'home')
@section('content')
<section class="hero">
    <hero
        background-image="{{ url($event->cover) }}"
        :is-parallax-active="false"
        hero-height="80vh"
    >
        <template slot="container">
            <h1 class="hero-title hero--black">{{ $event->name }}</h1>
        </template>
    </hero>
</section>

<section class="event-detail">
    <div class="container">
        <!-- Estado del evento -->
        <div class="event-detail__status {{ $event->status == 'active' ? 'active' : 'inactive' }}">
            {{ $event->status == 'active' ? 'Activo' : 'Inactivo' }}
        </div>

        <!-- Fechas del evento -->
        <div class="event-detail__dates">
            <div class="event-detail__date">
                <span class="event-detail__date-label">Fecha de Inicio:</span>
                <span class="event-detail__date-value">{{ $event->formated_start_date }}</span>
            </div>
            <div class="event-detail__date">
                <span class="event-detail__date-label">Fecha de Cierre:</span>
                <span class="event-detail__date-value">{{ $event->formated_finish_date }}</span>
            </div>
        </div>


        <!-- Descripción -->
        <div class="row">
            <div class="col">
                <div class="event-detail__description">
                    {!! $event->description !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col">
                @include('components.alert')
                @if($event->status == 'active')
                    <h2 class="h1 text-center">Registro</h2>
                    <div class="card-wrapper">
                        <project-registration-form 
                            action="{{ url('registrar-equipo/'.$event->id) }}"
                            :participants="6"
                            :min-participants="1"
                            :participants-data="[]"
                            :assigned-participants="[]"
                        >
                        </project-registration-form>
                    </div>
                    @else
                        <div class="form-closed">
                            <h3 class="form-closed__title">El registro está cerrado</h3>
                            <p class="form-closed__message">
                                Lamentamos informarte que este evento ya no acepta registros. Por favor, mantente atento para futuros eventos.
                            </p>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</section>


@endsection