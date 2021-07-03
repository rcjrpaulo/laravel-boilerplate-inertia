<template>
    <breeze-authenticated-layout>
        <template #header>
          <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">
                  <breeze-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                  </breeze-nav-link>
                </li>
              </ol>
            </div>
          </div>
        </template>

      <div class="row">
        <div class="col-12">
          <div class="card p-4">
            <div class="card-header">
              <h3 class="card-title">Dashboard</h3>
            </div>
            <div class="card-body">
              dashboard
            </div>
          </div>
        </div>
      </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },
    }
</script>
