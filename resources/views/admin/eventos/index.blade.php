@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'eventos')
@section('tab_title', 'eventos | ' . config('app.name'))
@section('description', 'Lista de eventos.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Eventos
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $events->count() }} eventos registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de eventos
            </h3>

            @if (! $events->count())
                <p class="text-center py-1">
                    Por el momento no hay eventos registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $events }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
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
                            
                                <td data-label="Fecha:">
                                    @{{ activityItem.date }}
                                </td>
                    
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/evento/' + activityItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/evento/eliminar/' + activityItem.id"
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
