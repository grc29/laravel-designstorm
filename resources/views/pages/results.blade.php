@extends('layouts/main')

@section('title')
Design Storm - Inspiration for Developers
@endsection

@section('content')
<div id="site-section">
  <div class="container">
    <div id="results">
      <div>
        <div class="search-container">
          <form action="/results" method="POST">
            {{ csrf_field() }}
            <input class="search" type="text" value="{{$keyword}}" placeholder="Search" name="search">
          </form>
        </div>
        <div class="boxes">
          <div class="row">
            @if(count($filteredData) >= 1)
              @foreach($filteredData as $inspiration)
              <div class="col-md-3">
                <div class="box" style="margin-bottom: 50px;">
                <div style="position: relative; background: url('{{ $inspiration->covers->{'202'} }}') no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; height: 200px;">
                  @php
                  $codedUrl = urlencode($inspiration->covers->{'202'})
                  @endphp
                  <a href="/projects/inspiration/{{$inspiration->id}}/add?image_url={{$codedUrl}}">
                    <div class="add-btn @if(in_array($inspiration->id, $imageInfoArray)) active @endif">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                  </a>
                  </div>
                </div>
              </div>
              @endforeach
            @else
              <h1>Sorry, no results found.</h1>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection