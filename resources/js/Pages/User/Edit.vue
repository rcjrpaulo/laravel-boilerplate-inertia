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
                <h3 class="card-title">Editar usuário</h3>
            </div>

            <form role="form" @submit.prevent="updateUser">
                <div class="card-body">
                    <div class="w-100 flex flex-column justify-center items-center m-2">
                        <div class="rounded-full w-40 h-40">
                            <img
                                v-if="!url"
                                :src="user.photo ? '/' + user.photo : '/images/profile.png'"
                                class="img-circle elevation-2 object-cover"
                                alt="User Image"
                                width="150"
                                height="150"
                            >
                            <img
                                v-if="url"
                                :src="url"
                                class="img-circle elevation-2 object-cover"
                                alt="User Image"
                                width="150"
                                height="150"
                            >

                        </div>
                        <div class="form-group flex justify-center items-center">
                            <input type="file" id="photo" name="photo" ref="photo" @change="handleFileUpload()">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="form.name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" v-model="form.email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input placeholder="Insira uma nova senha caso queira alterar" type="password"
                               class="form-control" id="password" name="password" v-model="form.password">
                    </div>

                    <div class="form-group">
                        <label for="role_id">Papel</label>
                        <select class="form-control" id="role_id" name="role_id" v-model="form.role_id" required>
                            <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.label }}
                            </option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <inertia-link :href="route('users.index')" class="btn btn-primary">
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
        user: Object,
        roles: Array,
    },
    data() {
        return {
            form: {
                name: '',
                role_id: '',
                email: '',
                password: '',
            },
            photo: '',
            url: '',
        }
    },
    components: {
        BreezeAuthenticatedLayout,
    },
    mounted() {
        this.form.name = this.user.name
        this.form.role_id = this.user.role_id
        this.form.email = this.user.email
    },
    methods: {
        updateUser: function () {
            let formData = new FormData();
            formData.append('photo', this.photo)
            formData.append('name', this.form.name)
            formData.append('email', this.form.email)
            formData.append('role_id', this.form.role_id)
            formData.append('password', this.form.password)
            formData.append('_method', 'PUT')

            this.$inertia.post(route('users.update', this.user.id), formData)
        },
        handleFileUpload: function () {
            this.photo = this.$refs.photo.files[0];
            this.url = URL.createObjectURL(this.photo);
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },
    }
}
</script>