<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
//    public $comments;
    public $newComment;
    public $image;
    public $ticketId = 1;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected'
    ];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

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
        $image = $this->storeImage();

        $createdComment = Comment::create([
            'body' => $this->newComment,
            'image' => $image,
            'support_ticket_id' => $this->ticketId,
            'user_id' => 1
        ]);
//        $this->comments->prepend($createdComment);
        $this->newComment = "";
        $this->image = "";
        session()->flash('message', 'Comment added successfully');
    }

    public function storeImage()
    {
        if (!$this->image) {
            return null;
        }
        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function remove($id)
    {
        $comment = Comment::find($id);
        Storage::disk('public')->delete($comment->image);
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
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2)
        ]);
    }
}
