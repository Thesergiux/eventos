@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Actividades')
@section('tab_title', 'Actividades | ' . config('app.name'))
@section('description', 'Lista de actividades.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Actividades
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $activities->count() }} actividades registradas.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de actividades
            </h3>

            @if (! $activities->count())
                <p class="text-center py-1">
                    Por el momento no hay actividades registradas.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $activities }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Ubicacion</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Portada</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="activityItem in resourceList" class="table-resource__row" :key="activityItem.id">
                                <td data-label="Nombre:">
                                    @{{ activityItem.name }}
                                </td>
                                <td data-label="Descripción:">
                                    @{{ activityItem.description }}
                                </td>
                                <td data-label="Ubicación:">
                                    @{{ activityItem.location_name }}
                                </td>
                                <td data-label="Tipo:">
                                    @{{ activityItem.type }}
                                </td>
                                <td data-label="Fecha:">
                                    @{{ activityItem.date }}
                                </td>
                                <td data-label="Foto:">
                                    <img style="height:40px;" :src="$root.path +'/'+ activityItem.cover" v-if="activityItem.cover">
                                </td>
                                
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/actividad/' + activityItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/actividad/eliminar/' + activityItem.id"
                                        :resource-id="activityItem.id"
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
