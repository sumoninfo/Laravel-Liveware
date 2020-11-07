<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
//    public $comments;
    public $newComment;
    public $image;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

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
//        $this->comments->prepend($createdComment);
        $this->newComment = "";
        session()->flash('message', 'Comment added successfully');
    }

    public function remove($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
//        $this->comments = $this->comments->except($id);
        session()->flash('message', 'Comment Deleted successfully');
    }

//    public function mount()
//    {
////        $initialComments = Comment::latest()->pagenate(2);
////        $this->comments = $initialComments;
//    }
//

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
