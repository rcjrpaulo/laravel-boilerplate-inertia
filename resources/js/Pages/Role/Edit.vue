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
                <h3 class="card-title">Editar papel</h3>
            </div>

            <form role="form" @submit.prevent="updateRole">
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

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Permissões</h3> </div>
      <form role="form" @submit.prevent="updatePermissions">
        <div class="row card-body" :key="groupPermission" v-for="groupPermission in Object.keys(this.groupPermissions)">
          <p>{{ groupPermission }}</p>
          <div class="col-12" :key="permission.id" v-for="(permission) in this.groupPermissions[groupPermission]">
            <div class="form-check">
              <input v-model="permissions" class="form-check-input" type="checkbox" :name="permission.label" :value="permission.id" :id="permission.label">
              <label class="form-check-label" :for="permission.label">{{ permission.label }}</label>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success"> Salvar </button>
        </div>
      </form>
    </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

export default {
    props: {
        groupPermissions: Object,
        role: Object,
    },
    data() {
        return {
            form: {
                name: '',
                password: '',
                _method: 'PUT'
            },
            permissions: [],
        }
    },
    components: {
        BreezeAuthenticatedLayout,
    },
    mounted() {
        this.form.name = this.role.name
        this.form.label = this.role.label
        this.permissions = this.role.array_permissions
    },
    methods: {
        updateRole: function () {
            this.$inertia.post(route('roles.update', this.role.id), this.form)
        },
        updatePermissions: function () {
            const data = {
              permissions: this.permissions
            }

            this.$inertia.post(route('roles.update.permissions', this.role.id), data)
        },
    }
}
</script>