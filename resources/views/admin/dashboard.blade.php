@extends('layouts.master')
@section('homeLinkActive')
    active
@endsection
@section('title')
    Start
@endsection
@section('content')
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista dziennikarzy</h3>
              <td class="project-actions text-right">
                  <a class="btn btn-primary btn-sm ml-3" href="{{ route('dashboard.addJournalistPage') }}">
                      <i class="fas fa-user-plus"></i>
                      Dodaj dziennikarza
                  </a>
              </td>

              <div class="card-tools">
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped projects">
                  <thead>
                      <tr>
                          <th style="width: 1%">
                              id
                          </th>
                          <th style="width: 15%">
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
                          <th style="width: 25%">
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($journalists as $item)
                      <tr>
                         <td>
                            {{ $item['id'] }}
                         </td>
                          <td>
                              <a>
                                  {{ $item['name'] }}
                              </a>
                          </td>

                          <td class="project_progress">
                            {{ $item['description'] }}
                          </td>
                          <td>

                              <img alt="Avatar" class="table-avatar" src="{{  URL::asset('storage/images/profileImages/' . $item['image']) }}">

                          </td>
                          <td class="project_progress" id="counter{{ $item['id'] }}">
                            {{ $item['voters_count'] }}
                          </td>
                          <td class="project-actions text-right">
                              @if( isset( $item['voters_count'] ) && $item['voters_count'] > 0 )
                                <a class="btn btn-primary btn-sm  mt-1 mb-1" href="#" onclick="showVotes( event, {{ $item['id'] }})">
                                    <i class="fas fa-eye"></i>
                                    Pokaż głosy
                                </a>
                              @endif
                              <a class="btn btn-info btn-sm  mt-1 mb-1" href="{{ route('dashboard.editJournalistPage', $item['id'] ) }}">
                                  <i class="fas fa-pencil-alt ">
                                  </i>
                                  Edytuj
                              </a>
                              <form action="{{ route('dashboard.delJournalist') }}" method="POST">
                                  @csrf
                                <input type="text" name="id" style="display: none" value="{{ $item['id'] }}">
                                <label class="btn btn-danger btn-sm mt-1 mb-1">
                                    <i class="fas fa-trash">
                                    </i>
                                    Usuń
                                    <input type="submit" style="display: none">
                                </label>
                              </form>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <input type="hidden" name="" id="editUrl" value="{{ route('dashboard.showVotes') }}">
          <input type="hidden" name="" id="delVote" value="{{ route('dashboard.delVote')}}">

          <!-- /.card -->

@endsection
