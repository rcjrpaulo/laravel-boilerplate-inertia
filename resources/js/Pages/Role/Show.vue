<template>
  <breeze-authenticated-layout>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Papéis</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">Ver papel</h3>
            </div>

            <form role="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input disabled="disabled" type="text" class="form-control" id="name" name="name" :value="role.name">
                    </div>

                    <div class="form-group">
                        <label for="email">Label</label>
                        <input disabled="disabled" type="text" class="form-control" id="email" name="email" :value="role.label">
                    </div>
                </div>

                <div class="card-footer">
                    <inertia-link :href="route('roles.index')" class="btn btn-primary">
                        Voltar
                    </inertia-link>
                </div>
            </form>
        </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        props: {
            role: Object,
        },
        data() {
            return {
                form: {
                    name: '',
                    role_id: '',
                    email: '',
                    password: ''
                }
            }
        },
        components: {
          BreezeAuthenticatedLayout,
        },
    }
</script>