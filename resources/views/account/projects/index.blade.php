@extends('layouts/account')

@section('title')
  Account - Projects
@endsection

@section('content')
<h1>Projects</h1>
<h6>This is the where all of your projects are located</h6>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="row">
        <div class="col-md-10">
          All of our projects
        </div>
        <div class="col-md-2">
          <a href="/account/projects/create">Add New Project</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10">
          <table id="project-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $project)
              <tr>
                <td>{{$project->id}}</td>
                <td><a href="/account/projects/{{$project->id}}">{{$project->title}}</a></td>
                <td><a href="/account/projects/{{$project->id}}/edit" class="edit-btn">Edit</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection