@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Editar ubicación')
@section('tab_title', 'Editar ubicación | ' . config('app.name'))
@section('description', 'Editar ubicación.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Editar ubicación
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/ubicaciones/') }}">Ver todas las ubicaciones</a>
        </p>

            <base-form action="{{ url('admin/ubicacion/'. $location->id .'/actualizar') }}"
                method="put"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Datos de la ubicación
                        </h3>

                        <div class="md:row">
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="80" initial="{{ $location->name }}"></text-field>
                                    <field-errors name="name"></field-errors>

                                </div>
                            </div>
                            <div class="md:col">
                                <div class="form-control">
                                    <label for="address">Dirección</label>
                                    <text-field name="address" v-model="fields.address" maxlength="80" initial="{{ $location->address }}"></text-field>
                                    <field-errors name="address"></field-errors>
                                </div>
                            </div>
                        </div>
                        <div class="md:row">
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="latitude">Latitud</label>
                                    <text-field name="latitude" v-model="fields.latitude" maxlength="80" initial="{{ $location->latitude }}"></text-field>
                                    <field-errors name="latitude"></field-errors>

                                </div>
                            </div>
                            <div class="md:col-1/2">
                                <div class="form-control">
                                    <label for="longitude">Longitud</label>
                                    <text-field name="longitude" v-model="fields.longitude" maxlength="80" initial="{{ $location->longitude }}"></text-field>
                                    <field-errors name="longitude"></field-errors>
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
                                        :initial-value="{{ json_encode($location->description) }}">
                                    </text-area-tiny>
                                    <field-errors name="description"></field-errors>

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
