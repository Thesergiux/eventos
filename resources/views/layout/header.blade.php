
<site-header
    :logo="'{{ url('img/eventcode1.png') }}'"
    :uri="'{{ url('/') }}'"
    :breakpoint="760"
>
    <template slot="button-session">
        <div class="menu__container">
            <site-menu
            :breakpoint="760"
            :links="{
                'Inicio': '{{ url('/') }}',
                'Eventos': '{{ url('deportes') }}',
                'Equipos': '{{ url('talleres') }}',
                'Iniciar Sesion': '{{ url('especialistas') }}',
            }"
            active-link="{{ $activeLink }}"
            >
                <template slot="close">
                    Cerrar X
                </template>
            </site-menu>
            @guest
                <a href="{{ url('iniciar-sesion') }}" class="btn btn--outline-primary btn-login-menu">
                    <img class="img-user-login" src="{{ url('img/header/users.svg') }}">
                    Ingresar
                </a>
            @endguest
        </div>
    </template>
</site-header>


