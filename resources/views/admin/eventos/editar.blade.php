@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Editar evento')
@section('tab_title', 'Editar evento | ' . config('app.name'))
@section('description', 'Editar evento.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Editar evento
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/eventos/') }}">Ver todos los eventos</a>
        </p>

            <base-form action="{{ url('admin/evento/'. $event->id .'/actualizar') }}"
                method="put"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Datos del evento
                        </h3>

                        <div class="md:row">
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="80" initial="{{ $event->name }}"></text-field>
                                    <field-errors name="name"></field-errors>

                                </div>
                            </div>
                        </div>
                        <div class="md:row"> 
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="start-date">Fecha de inicio</label>

                                    <date-field name="start_date"
                                        v-model="fields.start_date"
                                        initial="{{ $event->start_date }}"
                                        :aria-describedby="supportsDates ? '' : 'start-date-description'"
                                    ></date-field>

                                    <field-errors name="start_date"></field-errors>

                                    <p v-if="! supportsDates" id="start-date-description" class="description">
                                        Formato: dd/mm/aaaa
                                    </p>
                                </div>
                                
                            </div>
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="finish-date">Fecha de termino</label>

                                    <date-field name="finish_date"
                                        v-model="fields.finish_date"
                                        initial="{{ $event->finish_date }}"
                                        :aria-describedby="supportsDates ? '' : 'start-date-description'"
                                    ></date-field>

                                    <field-errors name="finish_date"></field-errors>

                                    <p v-if="! supportsDates" id="start-date-description" class="description">
                                        Formato: dd/mm/aaaa
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                        <div class="md:row"> 
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="description">Descripción</label>
                                    <text-area-tiny 
                                        name="description" 
                                        v-model="fields.description" 
                                        :initial-value="{{ json_encode($event->description) }}">
                                    </text-area-tiny>
                                    <field-errors name="description"></field-errors>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="db-panel mb-16">
                        <h3 class="db-panel__title">
                            Portada
                        </h3>
                        <div class="md:row">
                            <div class="preview-aside">
                                <figure class="preview-aside__box preview-box">

                                    <img class="preview-box__img" src="{{ url($event->cover) }}" alt="" ref="thumb">                                  
                                    <figcaption class="preview-box__caption">
                                        Imagen actual
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="md:col-2/3">
                                {{-- Avatar --}}
                                <div class="form-control">
                                    <label for="cover" v-text="hasAvatar ? 'Reemplazar imagen' : 'Agregar imagen'"></label>

                                    <file-field name="cover" v-model="fields.cover"></file-field>

                                    <field-errors name="cover"></field-errors>
                                    <ul id="cover-specs" class="description color-gray-darken-1">
                                        <li>
                                            Tamaño máximo: 1 MB.
                                        </li>
                                        <li>
                                            Sólo archivos con extensión jpeg, gif, png.
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <div class="text-center">
                        <form-button class="btn--blue--dashboard btn--wide">
                            Actualizar
                        </form-button>
                    </div>
                </form>
            </user-form>
    </div>
</section>

@endsection
