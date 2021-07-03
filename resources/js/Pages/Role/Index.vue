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
                <li class="breadcrumb-item active">Papéis</li>
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
                      <label for="filter_name">Label</label>
                      <input
                        name="filter_name"
                        id="filter_name"
                        type="text"
                        class="form-control"
                        v-model="filters.label"
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
                <h3 class="card-title">Papéis</h3>

                <div class="card-tools">
                  <inertia-link
                    :href="route('roles.create')"
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
                      <th>Label</th>
                      <th>Data Criação</th>
                      <th style="width: 150px">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="role in roles.data">
                      <td>{{ role.id }}</td>
                      <td>
                        {{ role.name }}
                      </td>
                      <td>{{ role.label }}</td>
                      <td>{{ role.created_at_label }}</td>
                      <td>
                        <inertia-link
                          :href="route('roles.show', role.id)"
                          class="btn btn-sm btn-outline-primary"
                          title="Ver"
                        >
                          <i class="fa fa-eye"></i>
                        </inertia-link>
                        <inertia-link
                          :href="route('roles.edit', role.id)"
                          class="btn btn-sm btn-outline-warning"
                          title="Editar"
                        >
                          <i class="fa fa-edit"></i>
                        </inertia-link>
                        <a
                          @click="deleteRole(role.id)"
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
              <pagination :links="roles.links"/>
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
    roles: Object,
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
    deleteRole: function (roleId) {
      this.$inertia.delete(route('roles.destroy', roleId));

      // this.$swal({
      //   title: "Você está prestes a deletar um usuário, tem certeza disso?",
      //   showDenyButton: true,
      //   confirmButtonText: `Sim`,
      //   denyButtonText: `Não`,
      // }).then((result) => {
      //   if (result.isConfirmed) {
      //     this.$inertia.post(`/roles/destroy/${roleId}`);
      //   }
      // });
    },
    filterSearch: function () {
      this.$inertia.get(route('roles.index'), this.filters);
    },
  },
};
</script>
