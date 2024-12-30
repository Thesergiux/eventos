@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('title', 'Agregar especialista')
@section('tab_title', 'Agregar especialista | ' . config('app.name'))
@section('description', 'Agregar especialista.')
@section('css_classes', 'dashboard')

@section('content')

<section class="mb-16">
    <div class="dashboard-heading">
        <h1 class="dashboard-heading__title">
            Agregar especialista
        </h1>
    </div>

    <div class="fluid-container mb-16">
        <p class="mb-12">
            @include('components.alert')
            <span class="color-link">«</span>
            <a href="{{ url('admin/especialistas/') }}">Ver todos los especialistas</a>
        </p>

            <base-form action="{{ url('admin/especialista/crear') }}"
                enctype="multipart/form-data"
                inline-template
                v-cloak
            >
                <form>
                    <section class="db-panel">
                        <h3 class="db-panel__title">
                            Datos de especialista
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
                                    <label for="speciality">Especialidad</label>
                                    <text-field name="speciality" v-model="fields.speciality" maxlength="80" initial=""></text-field>
                                    <field-errors name="speciality"></field-errors>
                                </div>
                            </div>
                        </div>
                        <div class="md:row">
                            <div class="md:col-1/2">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="phone">Teléfono</label>
                                    <text-field name="phone" v-model="fields.phone" maxlength="80" initial=""></text-field>
                                    <field-errors name="phone"></field-errors>

                                </div>
                            </div>
                            <div class="md:col-1/2">
                                <div class="form-control">
                                    <label for="email">Correo electrónico</label>
                                    <text-field name="email" v-model="fields.email" maxlength="80" initial=""></text-field>
                                    <field-errors name="email"></field-errors>
                                </div>
                            </div>  
                        </div> 
                        <div class="md:row"> 
                            <div class="md:col">
                                {{-- nombres --}}
                                <div class="form-control">
                                    <label for="description">Descripción</label>
                                    <text-area-tiny name="description" v-model="fields.description">
                                       
                                    </text-area-tiny>
                                    <field-errors name="description"></field-errors>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="db-panel mb-16">
                        <h3 class="db-panel__title">
                            Foto
                        </h3>
                        <div class="md:row">
                            <div class="preview-aside">
                                <figure class="preview-aside__box preview-box">
                                    <profile-gallery-card
                                        :link="$root.path + '/archivos/avatars/' + (hasAvatar ? avatar : 'default.png')"
                                        :thumb="$root.path + '/archivos/avatars/' + (hasAvatar ? avatar : 'default.png')"
                                        :images="[{
                                            src: $root.path + '/archivos/avatars/' + (hasAvatar ? avatar : 'default.png'),
                                            w: 68,
                                            h: 68
                                        }]"
                                        inline-template
                                    >
                                        <a target="_blank" :href="link" @click.prevent="onClick">
                                            <img class="preview-box__img" :src="thumb" alt="" ref="thumb">
                                        </a>
                                    </profile-gallery-card>

                                    <figcaption class="preview-box__caption">
                                        Imagen actual
                                    </figcaption>
                                </figure>
                            </div>

                            <div class="md:col-2/3">
                                {{-- Avatar --}}
                                <div class="form-control">
                                    <label for="photo" v-text="hasAvatar ? 'Reemplazar imagen' : 'Agregar imagen'"></label>

                                    <file-field name="photo" v-model="fields.photo"></file-field>

                                    <field-errors name="photo"></field-errors>
                                    <ul id="photo-specs" class="description color-gray-darken-1">
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
                    <section class="db-panel mb-16">
                        <h3 class="db-panel__title">
                            Portada
                        </h3>
                        <div class="md:row">
                            <div class="preview-aside">
                                <figure class="preview-aside__box preview-box">
                                    <profile-gallery-card
                                        :link="$root.path + '/archivos/avatars/' + (hasAvatar ? avatar : 'default.png')"
                                        :thumb="$root.path + '/archivos/avatars/' + (hasAvatar ? avatar : 'default.png')"
                                        :images="[{
                                            src: $root.path + '/archivos/avatars/' + (hasAvatar ? avatar : 'default.png'),
                                            w: 68,
                                            h: 68
                                        }]"
                                        inline-template
                                    >
                                        <a target="_blank" :href="link" @click.prevent="onClick">
                                            <img class="preview-box__img" :src="thumb" alt="" ref="thumb">
                                        </a>
                                    </profile-gallery-card>

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
                        <form-button class="btn--success btn--wide">
                            Crear
                        </form-button>
                    </div>
                </form>
            </base-form>
    </div>
</section>

@endsection
