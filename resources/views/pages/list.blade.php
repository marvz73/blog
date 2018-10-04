@extends('layout')

@section('title', 'Home Page')

@section('content')

          <h1 class="my-4">Blogs</h1>

          @if (session('status'))
              <div class="alert alert-success">
                  {!! session('status') !!}
              </div>
          @endif

          @if( empty($blogs) )
            <div class="alert alert-info">
              No blog post yet!
            </div>
          @endif

           @foreach ($blogs as $blog)

            <div class="card mb-4">
              @if(!empty($blog->banner_img))
                <div class="blog-banner">
                  <img class="card-img-top" src="{{ asset($blog->banner_img) }}" alt="Card image cap" />
                </div>
              @endif

              <div class="card-body">
                <a href="/view/{{$blog->id}}"><h2 class="card-title">{{$blog->title}}</h2></a>
                <p class="card-text">{{substr(strip_tags($blog->content), 0, 500) }}</p>
                <a href="/view/{{$blog->id}}" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on {{$blog->created_at}} {{$blog->author}}

                <a class="btn btn-link float-right" data-toggle="confirmation" data-title="Open Google?" href="/delete/{{$blog->id}}">Delete</a>

                <a href="/edit/{{$blog->id}}" class="btn btn-link float-right">Edit</a>

              </div>
            </div>

          @endforeach
       
          <div class="text-center">
            {{ $blogs->links() }}
          </div>
          


@endsection


@section('sidebar')

          <!-- Search Widget -->
          <div class="card my-4">
            <form method="get">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for..." value={{ (!empty($_GET['search'])) ? $_GET['search'] : ''}}>
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </div>
            </div>
            </form>
          </div>

            <div class="card my-4">
            <h5 class="card-header">Filter by Month </h5>
            <div class="card-body"> 
              <form method="get" action="/">
              <div class="form-group">
                <input type="text" name="dates" class="form-control" value={{ (!empty($_GET['dates'])) ? urldecode($_GET['dates']) : ''}} />
              </div>
              <input type="submit" class="btn btn-primary" value="Filter">
              </form>
            </div>
            </div>

          <div class="card my-4">
            <h5 class="card-header">Latest Articles </h5>
            <div class="card-body"> 

              @foreach($topblog as $article)

              <div>
                <a href="/view/{{$article->id}}" class="btn btn-link">{{$article->title}}</a>
              </div>


              @endforeach
            </div>
          </div>


@endsection