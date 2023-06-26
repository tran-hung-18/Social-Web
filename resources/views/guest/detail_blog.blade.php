@extends('layouts.app')

@section('style')
    @vite(['resources/scss/detail_blog.scss'])
@endsection

@section('content')
    <div class="layout-detail">
        <div class="layout-detail-item info-blog">
            <div class="dashboard">
                <a href="{{ route('blogs-home') }}">Home</a>
                <i class="fa-solid fa-chevron-right"></i>
                <p>{{ __('auth.title_detail_blog') }}</p>
            </div>
            <div class="detail-blog">
                <h3>{{ $blog->title }}</h3>
                <div class="header-blog">
                    <div class="auth">
                        <img src="{{ Vite::asset('resources/images/Ellipse 18.png') }}" alt="">
                        <div class="info">
                            <p class="name">{{ $blog->user->user_name }}</p>
                            @php
                                $created = date('d-m-Y', strtotime($blog->created_at));
                            @endphp
                            <p>{{ $created }}</p>
                        </div>
                    </div>
                    @if (Auth::check())
                        <div class="control">
                            @if (Auth::user()->role == \App\Models\User::ROLE_ADMIN || Auth::id() == $blog->user_id)
                                @if($blog->status == \App\Models\Post::STATUS_NOT_APPROVED)
                                    <div class="item-status not-approved">{{ __('auth.btn_not_approved') }}</div>
                                @else
                                    <div class="item-status approved">{{ __('auth.btn_approved') }}</div>
                                @endif
                                <a class="item-status update-blog" href="{{ route('view-update-blog', ['id' => $blog->id]) }}">{{ __('auth.btn_update_blog') }}</a>
                                <button class="item-status delete-blog">{{ __('auth.btn_delete_blog') }}</button>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="img-blog">
                    <img src="{{ Vite::asset('storage/app/public/images/' . $blog->image) }}" alt="Img Blog">
                </div>
                <div class="content">
                    <p>{!! $blog->content !!}</p>
                </div>
            </div>
        </div>
        <div class="layout-detail-item related">
            <div class="title">{{ __('auth.title_related') }}</div>
            <div class="line-title"></div>
            @if ($blogs->count() > 0)
                <div class="list-blog-related related-img">
                    @foreach ($blogs as $item)
                        <div class="item-blog">
                            <img src="{{ Vite::asset('storage/app/public/images/' . $item->image) }}" alt="Img Blog">
                            <div class="title-blog">{{ $item->title }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="title">{{ __('auth.text_no_found_related') }}</div>
            @endif
        </div>
        <div class="layout-detail-item comments">
            <div class="title">{{ __('auth.title_comments') }}</div>
            <div class="line-title"></div>
            @if (Auth::check())
                <form method="POST" action="{{ route('post-comment-blog', ['idBlog' => $blog->id]) }}" class="send-comment">
                    @csrf
                    <img src="{{ Vite::asset('storage/app/public/images/' . Auth::user()->avatar) }}" alt="">
                    <input type="text" placeholder="Input your comment . . . . " name="comment">
                    <button>{{ __('auth.btn_send_comment') }}</button>
                </form>
            @endif
            @if (isset($comments) && $comments->count() > 0)
                @foreach ($comments as $comment)
                    <div class="item-comment">
                        <img src="{{ Vite::asset('storage/app/public/images/' . $comment->user->avatar) }}" alt="">
                        <div class="info-comment">
                            <h3>{{ $comment->user->user_name }}</h3>
                            <p class="content">{{ $comment->content }}</p>
                            @php
                                $timeMinutes = now()->diffInMinutes($comment['created_at'], true);
                                if ($timeMinutes > 1440) {
                                    $timeMinutes = (int)($timeMinutes/1440)." days ago";
                                } elseif ($timeMinutes > 60) {
                                    $timeMinutes = (int)($timeMinutes/60)." hours ago";
                                } else {
                                    $timeMinutes = $timeMinutes." minutes ago";
                                }
                            @endphp
                            <p class="time">{{ $timeMinutes }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="item-comment">
                    <div class="notify-no-comment">{{ __('auth.text_no_found_comment') }}</div>
                </div>
            @endif
        </div>
    </div>
    <div class="box-delete">
        <div class="modal"></div>
        <div class="layout">
            <div class="header-box">
                <p>{{ __('auth.title_box_delete') }}</p>
                <i class="fa-solid fa-xmark cancel-box-delete"></i>
            </div>
            <div class="question-box">
                <p>{{ __('auth.question_delete_blog') }}</p>
            </div>
            <form class="form-request" action="{{ route('delete-blog', ['id' => $blog->id, 'auth' => $blog->user_id]) }}" method="POST">
                @method("DELETE")
                @csrf
                <div class="btn btn-cancel cancel-box-delete">{{ __('auth.btn_cancel') }}</div>
                <button class="btn btn-delete" type="submit">{{ __('auth.btn_delete') }}</button>
            </form>
        </div>
    </div>    
@endsection
