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
                <h3 class="card-title">Criar papel</h3>
            </div>

            <form role="form" @submit.prevent="createRole">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="form.name" required>
                    </div>
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" class="form-control" id="label" name="label" v-model="form.label" required>
                    </div>
                </div>

                <div class="card-footer">
                    <inertia-link :href="route('roles.index')" class="btn btn-primary">
                        Voltar
                    </inertia-link>

                    <button type="submit" class="btn btn-success mx-2">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
      </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        props: {
            roles: Array,
        },
        data() {
            return {
                form: {
                    name: '',
                    label:''
                },
                photo: '',
            }
        },
        components: {
          BreezeAuthenticatedLayout,
        },
        methods: {
            createRole: function() {
              return this.$inertia.post(route('roles.store'), this.form)
            }
        }
    }
</script>