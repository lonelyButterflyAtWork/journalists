@extends('layouts.master')

@section('content')


        <!-- Default box -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista dziennikarzy</h3>
              <td class="project-actions text-right">
                  <a class="btn btn-primary btn-sm ml-3" href="#">
                      <i class="fas fa-user-plus"></i>
                      Dodaj dziennikarza
                  </a>
              </td>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped projects">
                  <thead>
                      <tr>
                          <th style="width: 1%">
                              #
                          </th>
                          <th style="width: 20%">
                              Nazwa
                          </th>
                          <th style="width: 30%">
                              Opis
                          </th>
                          <th>
                              Wizerunek
                          </th>
                          <th>
                              Liczba głosów
                          </th>
                          <th style="width: 20%">
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>
                              #
                          </td>
                          <td>
                              <a>
                                  AdminLTE v3
                              </a>
                              <br>
                              <small>
                                  Created 01.01.2019
                              </small>
                          </td>

                          <td class="project_progress">
                              desc
                          </td>
                          <td>

                              <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">

                          </td>
                          <td class="project_progress">
                              20
                          </td>
                          <td class="project-actions text-right">
                              <a class="btn btn-primary btn-sm  mt-1 mb-1" href="#">
                                  <i class="fas fa-eye"></i>
                                  Pokaż głosy
                              </a>
                              <a class="btn btn-info btn-sm  mt-1 mb-1" href="#">
                                  <i class="fas fa-pencil-alt ">
                                  </i>
                                  Edytuj
                              </a>
                              <a class="btn btn-danger btn-sm mt-1 mb-1" href="#">
                                  <i class="fas fa-trash">
                                  </i>
                                  Usuń
                              </a>
                          </td>
                      </tr>
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

@endsection
