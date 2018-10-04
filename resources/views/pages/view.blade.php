@extends('layout')

@section('title', 'Home Page')

@section('content')
	
	<h1 class="my-4">{{$blog->title}}</h1>

	<p><small>Posted on {{$blog->created_at}}  by {{$blog->author}}</small></p>

	@if( !empty($blog->banner_img) )
		<p class="blog-banner">
			<img src="{{ asset($blog->banner_img)}}" width="100%" />
		</p>
	@endif 

	<p>{{$blog->content}}</p>

  	<p><a href="/" class="btn btn-link">Return to list</a></p>
@endsection



@section('sidebar')

 		<!-- Search Widget -->
       <div class="card my-4">
            <form method="get" action="/">
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