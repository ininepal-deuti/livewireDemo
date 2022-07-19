<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination,WithFileUploads;

    public $title, $status,$photo,$body,$user_id,$post_id , $searchPost , $postStatus , $iteration;

    public $updateMode = false;

    protected $listeners = ['updateStatus' => 'changePostStatus'];

    protected $queryString = ['searchPost'];

    protected $rules = [
        'title' => 'required|min:6',
        'body' => 'required|string',
        'photo' => 'required',
    ];

    public function index()
    {
        return view('livewire.posts.index');
    }

    public function render()
    {
        $userId = auth()->user()->role;
        if($this->searchPost !== null){
            $posts = Post::userPost($userId)->where('title', 'like', '%'.$this->searchPost.'%')->paginate(10);
        }else{
            $posts = Post::userPost($userId)->paginate(10);
        }
        return view('livewire.posts.list', ['posts' =>$posts]);
    }

    private function resetInputFields(){
        $this->title = '';
        $this->body = '';
        $this->photo = '';
        $this->iteration++;
    }

    public function store()
    {
        $this->validate();
        $filename = $this->photo->store('photos','public');
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'photo' => $filename,
            'user_id' => auth()->id(),
        ]);
        session()->flash('message', 'Post Created Successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->photo = $post->photo;
        $this->user_id = auth()->id();
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate();
        $post = Post::find($this->post_id);
        $filename = $this->photo->store('photos','public');
        $post->update([
            'title' => $this->title,
            'body' => $this->body,
            'photo' => $filename,
            'user_id' => auth()->id(),
        ]);
        $this->updateMode = false;
        session()->flash('message', 'Post Updated Successfully.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

    public function changePostStatus($id)
    {
        $post = Post::find($id);
        if($post->status == 1){
            $this->postStatus = $post->update(['status' =>0]);
        }else{
            $this->postStatus = $post->update(['status' =>1]);
        }
        session()->flash('message', 'Post Status Change Successfully.');
    }

}
