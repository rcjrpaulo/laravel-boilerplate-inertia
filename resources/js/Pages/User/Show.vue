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
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">Ver usuário</h3>
            </div>

            <form role="form">
                <div class="card-body">
                  <center>
                    <img
                        :src="user.photo ? `/${user.photo}` : '/images/profile.png'"
                        class="img-circle elevation-2"
                        alt="User Image"
                        width="150"
                        height="150"
                    >
                  </center>

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input disabled="disabled" type="text" class="form-control" id="name" name="name" :value="user.name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input disabled="disabled" type="text" class="form-control" id="email" name="email" :value="user.email">
                    </div>

                    <div class="form-group">
                        <label for="role_id">Papel</label>
                        <input disabled="disabled" class="form-control" id="role_id" name="role_id" :value="user.role.label">
                    </div>
                </div>

                <div class="card-footer">
                    <inertia-link :href="route('users.index')" class="btn btn-primary">
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
            user: Object,
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