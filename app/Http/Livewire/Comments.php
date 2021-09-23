<?php

namespace App\Http\Livewire;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
//    public array $comments = [
//        [
//            'id' => 1,
//            'creator' => 'name',
//            'created_at' => 'time',
//            'body' => 'contents',
//        ]
//    ];
    public string $newComment = '';

//    public function mount($initialComments)
//    {
//        dd($initialComments);
//        $this->comments = $initialComments;
//    }

    public function render()
    {
//        'id', 'creator', 'created_at', 'body'
//        $comments = Comment::select('id', 'creator', 'created_at', 'body')
////        $comments = Comment::select('*')
//            ->where('id', 6)
//            ->orderByDesc('id')
//            ->limit(5)
//            ->get();

        DB::enableQueryLog();
        $comments = DB::table('comments')->get();
        dump(DB::getQueryLog());

//        $comments = collect([
//            [
//                'id' => 111,
//                'creator' => 'name1',
//                'created_at' => 'time1',
//                'body' => 'contents1',
//            ],
//        ]);

        $this->comments = $comments;

//        array_unshift($this->comments, array(
//            'id' => 22,
//            'creator' => 'name',
//            'created_at' => Carbon::now(),
////            'created_at' => Carbon::now()->diffForHumans(),
//            'body' => $this->newComment,
//        ));

//        $this->comments = CommentResource::collection($comments);
//dd($this->comments);
//        $this->comments = Comment::all()->toArray();
//        dump(gettype($this->comments));
//        echo "<xmp>";
//        print_r($this->comments);
//        echo "</xmp>";

        return view('livewire.comments');
//        $data = [
//            'comments' => $this->comments,
//            'newComment' => $this->newComment,
//        ];
//        return view('livewire.comments', $data);
    }

    public function addComment()
    {
        array_unshift($this->comments, array(
            'id' => 22,
            'creator' => 'name',
            'created_at' => Carbon::now(),
//            'created_at' => Carbon::now()->diffForHumans(),
            'body' => $this->newComment,
        ));

//        $newCommentInfo = array(array(
//            'id' => 2,
//            'creator' => 'name',
//            'created_at' => Carbon::now()->diffForHumans(),
//            'body' => $this->newComment,
//        ));
//        $newCommentCollect = collect($newCommentInfo);
//        $newCommentMerged = $newCommentCollect->merge($this->comments);
//
////        dump($newCommentMerged);
//
//        $this->comments = $newCommentMerged;
//        dump($this->comments);

//        $this->comments = (array) $this->comments;
//        array_unshift($this->comments, array(
//            'id' => 22,
//            'creator' => 'name',
//            'created_at' => Carbon::now(),
////            'created_at' => Carbon::now()->diffForHumans(),
//            'body' => $this->newComment,
//        ));

//        $this->comments[] = array(
//            'id' => 555,
//            'creator' => 'name5',
//            'created_at' => Carbon::now(),
////            'created_at' => Carbon::now()->diffForHumans(),
//            'body' => $this->newComment,
//        );

//        $this->comments = Comment::select('id', 'creator', 'created_at', 'body')
//            ->inRandomOrder()
//            ->limit(5)
//            ->get()->toArray();
//        return view('livewire.comments');
//        $refresh;
//
//        array_unshift($this->comments,
//            [
//                'id' => 22,
//                'creator' => 'name',
//                'created_at' => 'aa',  //'2021-09-10T05:16:05.000000Z',     //Carbon::now()->diffForHumans(),
//                'body' => 'aaaaaaaaa',       //$this->newComment,
//            ]
//        );
//        return view('livewire.comments', ['comments' => $this->comments]);

//        $this->newComment = 'gggggg';
//        $this->comments;

//        $this->comments = array(
//            0 => array(
//                'id' => 22,
//                'creator' => 'name',
//                'created_at' => 'aa',
//                'body' => 'aaaaaaaaa',
//            ),
//            1 => array(
//                'id' => 6,
//                'creator' => '배유리',
//                'created_at' => '2021-09-10T05:16:05.000000Z',
//                'body' => 'B호텔로 이스보스치카라는 마차를 몰았다. 죽음과.',
//            )
//        );

//        $this->comments = collect([
//            [
//                'id' => 111,
//                'creator' => 'name1',
//                'created_at' => 'time1',
//                'body' => 'contents1',
//            ],
//            [
//                'id' => 222,
//                'creator' => 'name2',
//                'created_at' => 'time2',
//                'body' => 'contents2',
//            ],
//        ]);

//        echo "<xmp>";
//        print_r($this->comments);
//        echo "</xmp>";
//        dump($this->comments);

    }

//    public function updated()
//    {
//        $refresh;
//    }
}
