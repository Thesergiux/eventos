@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Agregar ubicación')
@section('tab_title', 'Agregar ubicación | ' . config('app.name'))
@section('description', 'Agregar ubicación.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Agregar ubicación
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/ubicaciones/') }}">Ver todas las ubicaciones</a>
        </p>

            <base-form action="{{ url('admin/ubicacion/crear') }}"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Datos de ubicación
                        </h3>

                        <div class="md:row">
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="name">Nombre</label>
                                    <text-field name="name" v-model="fields.name" maxlength="80" initial=""></text-field>
                                    <field-errors name="name"></field-errors>

                                </div>
                            </div>
                            <div class="md:col">
                                <div class="form-control">
                                    <label for="address">Dirección</label>
                                    <text-field name="address" v-model="fields.address" maxlength="80" initial=""></text-field>
                                    <field-errors name="address"></field-errors>
                                </div>
                            </div>
                        </div>
                        <div class="md:row">
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="latitude">Latitud</label>
                                    <text-field name="latitude" v-model="fields.latitude" maxlength="80" initial=""></text-field>
                                    <field-errors name="latitude"></field-errors>

                                </div>
                            </div>
                            <div class="md:col-1/2">
                                <div class="form-control">
                                    <label for="longitude">Longitud</label>
                                    <text-field name="longitude" v-model="fields.longitude" maxlength="80" initial=""></text-field>
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
                                        v-model="fields.description">
                                    </text-area-tiny>
                                    <field-errors name="description"></field-errors>

                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="text-center">
                        <form-button class="btn--success btn--wide">
                            Crear
                        </form-button>
                    </div>
                </form>
            </base-form>
    </div>
</section>

@endsection
