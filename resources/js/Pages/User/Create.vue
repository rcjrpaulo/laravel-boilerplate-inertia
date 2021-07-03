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
                <h3 class="card-title">Criar usuário</h3>
            </div>

            <form role="form" @submit.prevent="createUser">
                <div class="card-body">
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
                        <input type="password" class="form-control" id="password" name="password" v-model="form.password" required>
                    </div>

                    <div class="form-group">
                        <label for="role_id">Papel</label>
                        <select class="form-control" id="role_id" name="role_id" v-model="form.role_id" required>
                            <option v-for="(role, index) in roles" :value="role.id" :key="index">{{role.label}}</option>
                        </select>
                    </div>

                  <div class="form-group">
                    <label for="photo">Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input ref="photo" @change="handleFileUpload()" type="file" class="custom-file-input" id="photo">
                        <label class="custom-file-label" for="photo">Escolha uma foto</label>
                      </div>
                    </div>

                  <div class="preview mt-3">
                      <label  v-if="form.url" for="">Foto selecionada</label>
                      <img v-if="form.url" :src="form.url" class="w-20 mb-3 rounded-lg"/>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                    <inertia-link href="route('users.index')" class="btn btn-primary">
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
                    role_id: '',
                    email: '',
                    password: '',
                    url:''
                },
                photo: '',
            }
        },
        components: {
          BreezeAuthenticatedLayout,
        },
        methods: {
            createUser: function() {
                if (!this.photo) {
                  return this.$inertia.post(route('users.store'), this.form)
                }

                let formData = new FormData();
                formData.append('photo', this.photo)
                formData.append('name', this.form.name)
                formData.append('email', this.form.email)
                formData.append('role_id', this.form.role_id)
                formData.append('password', this.form.password)

              this.$inertia.post(route('users.store'), formData)
            },
            handleFileUpload: function() {
              this.photo = this.$refs.photo.files[0];
              this.form.url = URL.createObjectURL(this.photo);
            }
        }
    }
</script>