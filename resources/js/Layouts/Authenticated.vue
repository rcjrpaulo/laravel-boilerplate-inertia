<template>
    <div>
      <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item"><a data-widget="pushmenu" href="javascript:void(0)" role="button" class="nav-link"><i class="fas fa-bars"></i></a></li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li>
<!--              <form action="/logout" method="POST"><input type="hidden" name="_token" value="ELZ8FmQWcdMb731AiZu6LRuUPCv2500hA1MCL2xO"> <button type="submit" class="btn btn-white">Sair</button></form>-->
              <breeze-dropdown-link :href="route('logout')" method="post" as="button">
                Sair
              </breeze-dropdown-link>
            </li>
          </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <a href="javascript:void(0)" class="brand-link"><span class="brand-text font-weight-light"><img loading="lazy" width="50" src="/dist/img/AdminLTELogo.png"></span></a>
          <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image"><img :src="$page.props.auth.user.photo || '/images/profile.png'" alt="User Image" class="img-circle elevation-2"></div>
              <div class="info"><a href="#" class="d-block">
                {{ $page.props.auth.user.name }}
              </a>
              </div>
            </div>
            <nav class="mt-2">
              <ul data-widget="treeview" role="menu" data-accordion="false" class="nav nav-pills nav-sidebar flex-column pt-2">
                <li class="nav-item">
                  <inertia-link :href="route('dashboard')" :class="'nav-link my-2 text-white'">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    Dashboard
                  </inertia-link>
                </li>
                <li class="nav-item">
                  <inertia-link :href="route('users.index')" :class="'nav-link my-2 text-white'">
                    <i class="nav-icon fas fa-user-alt"></i>
                    Usuários
                  </inertia-link>
                </li>
                <li class="nav-item">
                  <inertia-link :href="route('dashboard')" :class="'nav-link my-2 text-white'">
                    <i class="nav-icon fas fa-plus-square"></i>
                    Papéis
                  </inertia-link>
                </li>
              </ul>
            </nav>
          </div>
        </aside>
        <div class="content-wrapper" style="min-height: 565.493px;">
          <section class="content">
            <div class="content-header" v-if="$slots.header">
              <div class="container-fluid">
                <slot name="header" />
              </div>
            </div>

            <div class="container-fluid">
              <div v-if="$page.props.errors" class="alert alert-danger" :key="error" v-for="error in $page.props.errors">
                {{ error }}
              </div>

              <div v-if="$page.props.flash.success" class="alert alert-success">
                {{ $page.props.flash.success }}
              </div>

              <div v-if="$page.props.flash.warning" class="alert alert-warning">
                {{ $page.props.flash.warning }}
              </div>

              <div v-if="$page.props.flash.error" class="alert alert-danger">
                {{ $page.props.flash.error }}
              </div>

              <slot />
            </div>
          </section>
        </div>
        <footer class="main-footer text-center"><span class="text-muted"><span>Feito com muito</span> <span><i class="fa fa-heart text-danger"></i></span> <span>pela <a href="http://www.agily.com.br" target="_blank">Agily Tecnologia</a></span></span></footer>
        <div id="sidebar-overlay"></div>
      </div>
    </div>
</template>

<script>
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'
    import BreezeDropdown from '@/Components/Dropdown'
    import BreezeDropdownLink from '@/Components/DropdownLink'
    import BreezeNavLink from '@/Components/NavLink'
    import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        components: {
            BreezeApplicationLogo,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeNavLink,
            BreezeResponsiveNavLink,
            BreezeValidationErrors,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
    }
</script>
