@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Especialistas')
@section('tab_title', 'Especialistas | ' . config('app.name'))
@section('description', 'Lista de especialistas.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Especialistas
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $specialists->count() }} especialistas registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de especialistas
            </h3>

            @if (! $specialists->count())
                <p class="text-center py-1">
                    Por el momento no hay especialistas registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $specialists }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Teléfono</th>
                                <th>Correo electrónico</th>
                                <th>Foto</th>
                                <th>Portada</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="specialistItem in resourceList" class="table-resource__row" :key="specialistItem.id">
                                <td data-label="Nombre:">
                                    @{{ specialistItem.name }}
                                </td>
                                <td data-label="Especialidad:">
                                    @{{ specialistItem.speciality }}
                                </td>
                                <td data-label="Teléfono:">
                                    @{{ specialistItem.phone }}
                                </td>
                                <td data-label="Correo electrónico:">
                                    @{{ specialistItem.email }}
                                </td>
                                <td data-label="Foto:">
                                    <img style="height:40px;" :src="$root.path +'/'+ specialistItem.photo" v-if="specialistItem.cover">
                                </td>
                                <td data-label="Portada:">
                                    <img style="height:40px;" :src="$root.path +'/'+ specialistItem.cover" v-if="specialistItem.cover">
                                </td>
                                
                                
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/especialista/' + specialistItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/especialista/eliminar/' + specialistItem.id"
                                        :resource-id="specialistItem.id"
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
