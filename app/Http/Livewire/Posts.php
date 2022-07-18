<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts, $title, $body,$user_id, $post_id;
    public $updateMode = false;

    protected $rules = [
        'title' => 'required|min:6',
        'body' => 'required|string',
    ];

    public function render()
    {
        $this->posts = Post::latest()->get();
        return view('livewire.posts.index');
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
