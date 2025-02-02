@extends('teamplate.templating')

@section('content')

{{-- tabel --}}
<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h3>Tabel Categories</h3>
    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModalCategories">
      add Categories
    </div>
  </div>
    <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Categories</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $category->name }}</td>
              <td>
                  <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalCategories"><i class="bi bi-pencil-fill" ></i></button>
                  <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
{{-- end tabel --}}

{{-- modal add --}}
<div class="modal fade" id="addModalCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

{{-- modal edit --}}
<div class="modal fade" id="editModalCategories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




@endsection