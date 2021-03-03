@extends('layouts.master')
@section('title')
    Edycja dziennikarza
@endsection
@section('content')
<form action="{{ route('dashboard.editJournalistPage.editData') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $journalistInfo['id'] }}">
    <div class="row">
        <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">General</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label for="inputName">Nazwa dziennikarza</label>
                <input type="text" name="name" id="inputName" class="form-control" value="{{ $journalistInfo['name'] }}">
            </div>
            <div class="form-group">
                <label for="inputDescription">Opis dziennikarza</label>
                <textarea id="inputDescription"  name="description" class="form-control" rows="4">{{ $journalistInfo['description'] }}</textarea>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <div class="col-md-6">

        <!-- /.card -->
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Zdjęcie dziennikarza</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
            </div>
            </div>
            <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th>File Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>{{ $journalistInfo['image'] }}</td>
                    <td></td>
                    <td class="text-right py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                        <label><a target="_blank" href="{{  URL::asset('storage/images/profileImages/' . $journalistInfo['image'])  }}" class="btn btn-info"><i class="fas fa-eye"></i></a></label>
                        <label for="imageInput"><a  class="btn btn-info" for="imageInput"><i class="fas fa-edit"></i></a></label>
                        <input type="file" name="image" class="form-control-file" id="imageInput" style="display: none">

                    </div>
                    </td>
                </tr></tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Save Changes" class="btn btn-success float-right" accept="image/*">
        </div>
    </div>
</form>
@endsection
