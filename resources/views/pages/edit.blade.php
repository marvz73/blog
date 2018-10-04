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

 
		<form class="" method="POST" action="{{ route('saveEdit') }}" enctype="multipart/form-data">
				
			<input type="hidden" name="id" value="{{$blog->id}}" />

			{{ csrf_field() }}

			<div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}" required />
			</div>

			<div class="form-group">
			    <label for="content">Content</label>
			    <textarea rows="15" class="form-control" id="content" name="content" required >{{$blog->content}}</textarea>
			</div>		

			<div class="form-group">
				@if( !empty($blog->banner_img) )
					<div>
						<img src="{{ asset($blog->banner_img) }}" />
					</div>
				@endif
			    <label for="banner">Banner Image</label>
			    <input type="file" class="form-control" id="banner" name="banner"/>
			</div>		

			<div class="form-group">
			    <label for="author">Author</label>
			    <input type="text" class="form-control" id="author" value="{{$blog->author}}" name="author" required/>
			</div>

			<div class="form-group">
			    <label for="status">Status</label>
			    <select class="form-control" name="status">
			    	<option <?php echo ($blog->status == 'draft') ? "selected" : '' ?> value="draft">Draft</option>
			    	<option <?php echo ($blog->status == 'published') ? "selected" : '' ?> value="published">Published</option>
			    </select>
			</div>	

			<div class="form-group" style="position: absolute;z-index: 0;left: -999px;">
			    <input type="text" class="form-control" id="" name="honey" />
			</div>

		  	<button type="submit" class="btn btn-primary">Update</button>

		</form>


		<br/>
	</div>



@endsection