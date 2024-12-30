@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Posts')
@section('tab_title', 'Posts | ' . config('app.name'))
@section('description', 'Lista de posts.')
@section('css_classes', 'dashboard')

@section('content')
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Posts
        </h1>

        <p class="dashboard-heading__caption">
            Hay {{ $posts->count() }} posts registrados.
        </p>
    </div>

    <div class="fluid-container mb-16">
        @include('components.alert')
        <section class="db-panel">
            <h3 class="db-panel__title">
                Lista de posts
            </h3>

            @if (! $posts->count())
                <p class="text-center py-1">
                    Por el momento no hay posts registrados.
                </p>
            @else

                <resource-table :breakpoint="800" :model="{{ $posts }}" inline-template>
                    <table class="table size-caption mx-auto mb-16 md:table--responsive">
                        <thead>
                            <tr class="table-resource__headings">
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Portada</th>
                                <th class="pr-4">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="postItem in resourceList" class="table-resource__row" :key="postItem.id">
                                <td data-label="Titulo:">
                                    @{{ postItem.title }}
                                </td>
                                <td data-label="Descripción:">
                                    @{{ postItem.description }}
                                </td>
                                <td data-label="Portada:">
                                    <img style="height:40px;" :src="$root.path +'/'+ postItem.cover" v-if="postItem.cover">
                                </td>
                                
                                <td class="table-resource__actions" data-label="Acciones:">
                                    <a class="btn btn-nowrap btn--sm btn--blue table-resource__button mr-2" :href="$root.path + '/admin/post/' + postItem.id + '/editar' ">
                                        <img class="svg-icon" src="{{ url('img/svg/edit.svg')}}">
                                        Editar
                                    </a>
                                    <delete-button class="btn--danger table-resource__button" :url="$root.path + '/admin/post/eliminar/' + postItem.id"
                                        :resource-id="postItem.id"
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
