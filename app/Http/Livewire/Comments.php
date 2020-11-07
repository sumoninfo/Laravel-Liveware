<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    public function updated($filed)
    {
        $this->validateOnly($filed, [
            'newComment' => 'required|max:255'
        ]);
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|max:255'
        ]);
        $createdComment = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1
        ]);
        $this->comments->prepend($createdComment);
        $this->newComment = "";
        session()->flash('message', 'Comment added successfully');
    }

    public function remove($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        $this->comments = $this->comments->except($id);
        session()->flash('message', 'Comment Deleted successfully');
    }

    public function mount()
    {
        $initialComments = \App\Comment::latest()->get();
        $this->comments = $initialComments;
    }


    public function render()
    {
        return view('livewire.comments', ['comments' => $this->comments]);
    }
}
