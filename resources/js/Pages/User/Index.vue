<template>
  <breeze-authenticated-layout>
    <template #header>
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6"></div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Usuários</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    </template>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header"><h3 class="card-title">Filtros</h3></div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="filter_name">Nome</label>
                      <input
                        name="filter_name"
                        id="filter_name"
                        type="text"
                        class="form-control"
                        v-model="filters.name"
                      />
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <a
                  @click="filterSearch"
                  href="javascript:void(0)"
                  class="btn btn-info text-center"
                  >Filtrar</a
                >
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card p-4">
              <div class="card-header">
                <h3 class="card-title">Usuários</h3>

                <div class="card-tools">
                  <inertia-link
                    href="/admin/users/create"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-plus"></i>
                    Adicionar
                  </inertia-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Papel</th>
                      <th>Data Criação</th>
                      <th style="width: 150px">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data">
                      <td>{{ user.id }}</td>
                      <td>
                        {{ user.name }}
                      </td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.role.name }}</td>
                      <td>{{ user.created_at_label }}</td>
                      <td>
                        <inertia-link
                          :href="`/admin/users/show/${user.id}`"
                          class="btn btn-sm btn-outline-primary"
                          title="Ver"
                        >
                          <i class="fa fa-eye"></i>
                        </inertia-link>
                        <inertia-link
                          :href="`/admin/users/edit/${user.id}`"
                          class="btn btn-sm btn-outline-warning"
                          title="Editar"
                        >
                          <i class="fa fa-edit"></i>
                        </inertia-link>
                        <a
                          v-if="$page.props.auth.user.id != user.id"
                          @click="deleteUser(user.id)"
                          href="javascript:void(0)"
                          class="btn btn-sm btn-outline-danger"
                          title="Deletar"
                        >
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <pagination :links="users.links"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    </breeze-authenticated-layout>
</template>

<script>
import Pagination from "@/Shared/Pagination";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

export default {
  props: {
    users: Object,
  },
  data() {
    return {
      filters: {
        name: "",
        email: "",
      },
    };
  },
  components: {
    BreezeAuthenticatedLayout,
    Pagination,
  },
  methods: {
    deleteUser: function (userId) {
      this.$inertia.delete(route('users.destroy', userId));

      // this.$swal({
      //   title: "Você está prestes a deletar um usuário, tem certeza disso?",
      //   showDenyButton: true,
      //   confirmButtonText: `Sim`,
      //   denyButtonText: `Não`,
      // }).then((result) => {
      //   if (result.isConfirmed) {
      //     this.$inertia.post(`/users/destroy/${userId}`);
      //   }
      // });
    },
    filterSearch: function () {
      this.$inertia.get(route('users.index'), this.filters);
    },
  },
};
</script>
