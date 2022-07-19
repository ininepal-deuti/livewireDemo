<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    public $title, $body,$user_id,$post_id , $searchPost;
    public $updateMode = false;

    protected $queryString = ['searchPost'];

    use WithPagination;

    protected $rules = [
        'title' => 'required|min:6',
        'body' => 'required|string',
    ];

    public function index()
    {
        return view('livewire.posts.index');
    }

    public function render()
    {
        $userId = auth()->id();
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
    }

    public function store()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'body' => $this->body,
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
        $post->update([
            'title' => $this->title,
            'body' => $this->body,
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
}
