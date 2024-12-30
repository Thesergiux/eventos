@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Ubicaciones')
@section('tab_title', 'Ubicaciones | ' . config('app.name'))
@section('description', 'Lista de ubicaciones.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Ubicaciones
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $locations->count() }} ubicaciones registradas.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de ubicaciones
            </h3>

            @if (! $locations->count())
                <p class="text-center py-1">
                    Por el momento no hay ubicaciones registradas.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $locations }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Descripción</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="locationItem in resourceList" class="table-resource__row" :key="locationItem.id">
                                <td data-label="Nombre:">
                                    @{{ locationItem.name }}
                                </td>
                                <td data-label="Dirección:">
                                    @{{ locationItem.address }}
                                </td>
                                <td data-label="Descripción:">
                                    @{{ locationItem.description }}
                                </td>
                                <td data-label="Latitud:">
                                    @{{ locationItem.latitude }}
                                </td>
                                <td data-label="Longitud:">
                                    @{{ locationItem.longitude }}
                                </td>
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/ubicacion/' + locationItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/ubicacion/eliminar/' + locationItem.id"
                                        :resource-id="locationItem.id"
                                        :options="{ onDelete: onResourceDelete }"
                                    >
                                        <img class="svg-icon" src="{{ url('img/svg/trash.svg')}}">
                                        Eliminar
                                    </delete-button>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </resource-table>

            @endif

        </section>
    </div>
@endsection
