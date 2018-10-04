@extends('layout')

@section('title', 'Add Article Page')

@section('content')

      	<h1 class="my-4">Page Heading</h1>

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

      	@if (session('error'))
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        @endif

      	@if (session('status'))
            <div class="alert alert-success">
                {!! session('status') !!}
            </div>
        @endif

 
		<form class="" method="POST" action="{{ route('saveAdd') }}" enctype="multipart/form-data">
           
			{{ csrf_field() }}

			<div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required />
			</div>

			<div class="form-group">
			    <label for="content">Content</label>
			    <textarea rows="15" class="form-control" id="content" name="content" required >{{ old('content') }}</textarea>
			</div>		

			<div class="form-group">
			    <label for="banner">Banner Image</label>
			    <input type="file" class="form-control" id="banner" name="banner"/>
			</div>		

			<div class="form-group">
			    <label for="author">Author</label>
			    <input type="text" class="form-control" id="author" value="{{ old('author') }}" name="author" required/>
			</div>

			<div class="form-group">
			    <label for="status">Status</label>
			    <select class="form-control" name="status">
			    	<option selected value="draft">Draft</option>
			    	<option value="published">Published</option>
			    </select>
			</div>	

			<div class="form-group" style="position: absolute;z-index: 0;left: -999px;">
			    <input type="text" class="form-control" id="" name="honey" />
			</div>

		  	<button type="submit" class="btn btn-primary">Save</button>

		</form>


		<br/>
	</div>



@endsection