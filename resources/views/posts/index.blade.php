@extends('teamplate.templating')

@section('content')

{{-- tabel --}}
<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h3>Tabel Post</h3>
    <div class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addModalPost">
      add post
    </div>
  </div>
    <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Name User</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $post->user_name }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->content }}</td>
              <td>
                  <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalPost"><i class="bi bi-pencil-fill"></i></button>
                  <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
{{-- end tabel --}}

{{-- modal add --}}
<div class="modal fade" id="addModalPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('posts.store') }}" method="post">
          @csrf
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>

{{-- modal edit --}}
<div class="modal fade" id="editModalPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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