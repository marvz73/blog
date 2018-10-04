<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use illuminate\html;
use App\Blog;
use Session;

class BlogController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

    }

	/**
     * Show top 5 newly created article
     **/
    public function topArticle(){

		return $blog = Blog::where('status', 'published')->orderBy('created_at', 'desc')->paginate(5);;	

    }

	/**
     * Show the list of blogs
     **/
	public function index(){

		if(Input::has('search') && !empty(Input::get('search'))){
			$queryString = Input::get('search');
        	$blog = Blog::where('title', 'LIKE', "%$queryString%")->orderBy('title')->paginate(10);
        }
        else if(Input::has('dates') && !empty(Input::get('dates'))){

        	$date = explode(" - ", urldecode($_GET['dates']));
        	$from = $date[0];
			$to = $date[1];

    		$blog = Blog::whereBetween('created_at', array($from, $to))->paginate();

        }
        else{
        	$blog = Blog::where('status', 'published')->paginate(10);	
        }


		return view('pages/list')->with('blogs', $blog)->with('topblog', $this->topArticle());
	}

	/**
     * Show the single blog
     **/
	public function single($id){
		$blog = Blog::where('status', 'published')->where('id', $id)->first();
		return view('pages/view')->with('blog', $blog)->with('topblog', $this->topArticle());
	}

	/**
     * Show blog add page
     **/
	public function add(){

		return view('pages/add');
	}

	public function uploadBanner($request){


	  $file = $request->file('banner');

	  //Move Uploaded File
	  $destinationPath = public_path('/banners');
	  $file->move($destinationPath,$file->getClientOriginalName());
	  return $file->getClientOriginalName();
	}


	/**
     * Save newly created blog
     **/
	public function saveAdd(Request $request){

		$this->validate($request, [
        	'title' => 'required',
        	'content' => 'required',
        	'author' => 'required',
        	'banner' => 'image',
        ]);

		if( ! empty($request->input('honey')) ){
			return redirect('add')->with('error', 'You are not human!');
		}


		$blog = new Blog();
		$blog->title = $request->input('title');
		$blog->content = $request->input('content');
		$blog->author = $request->input('author');
		$blog->status = $request->input('status');
		
		//Banner upload
        if( !empty($request->banner) ){
            $path = 'banners/';
            $banner = time().'.'.$request->banner->getClientOriginalExtension();
            $request->banner->move(public_path($path), $banner);
            $blog->banner_img = 'banners/'.$banner;
        }

		$blog->save();

		return redirect('add')->with('status', 'Article successfully save.');
	}

	/**
     * Show blog edit page
     **/
	public function edit($id){

		$blog = Blog::where('status', 'published')->where('id', $id)->first();
		return view('pages/edit')->with('blog', $blog);

	}

	/**
     * Update blog post
     **/
	public function saveEdit(Request $request){

		$this->validate($request, [
			'id' => 'required|numeric',
        	'title' => 'required',
        	'content' => 'required',
        	'author' => 'required',
        	'banner' => 'image',
        ]);

		if( ! empty($request->input('honey')) ){
			return redirect('edit')->with('error', 'You are not human!');
		}

		$id = $request->input('id');

		$blog = Blog::where('id', $id)->first();
		$blog->title = $request->input('title');
		$blog->content = $request->input('content');
		$blog->author = $request->input('author');
		$blog->status = $request->input('status');

        if( !empty($request->banner) ){
            $path = 'banners/';
            $banner = time().'.'.$request->banner->getClientOriginalExtension();
            $request->banner->move(public_path($path), $banner);
            $blog->banner_img = 'banners/'.$banner;
        }

        $blog->save();

		return redirect("edit/$id")->with('status', 'Article successfully updated.');

	}

	/**
     * Delete blog post
     **/
	public function delete($id){

		$blog = Blog::where('id', $id);
		$post = $blog->first();
	    $blog->delete();

		return redirect('/')->with('status', $post->title . ' post successfully deleted.');
	}

}