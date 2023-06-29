@extends('layouts.app')

@section('style')
    @vite(['resources/scss/detail_blog.scss'])
@endsection

@section('content')
    @if (isset($blog) && $blog->count() > 0) 
        <div class="layout-detail">
            <div class="layout-detail-item info-blog">
                <div class="dashboard">
                    <a href="{{ route('blogs.home') }}">{{ __('blog.title_home') }}</a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <p>{{ __('blog.title_detail_blog') }}</p>
                </div>
                <div class="detail-blog">
                    <h3>{{ $blog->title }}</h3>
                    <div class="header-blog">
                        <div class="auth">
                            <img src="{{ Vite::asset('storage/app/public/images/' . $blog->user->avatar) }}" alt="">
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
                                        <div class="item-status not-approved">{{ __('blog.btn_not_approved') }}</div>
                                    @else
                                        <div class="item-status approved">{{ __('blog.btn_approved') }}</div>
                                    @endif
                                @endif
                                @can ('update', $blog)
                                    <a class="item-status update-blog" href="{{ route('view.update.blog', ['blog' => $blog]) }}">
                                        {{ __('blog.btn_update_blog') }}
                                    </a>
                                @endcan
                                @can('delete', $blog)
                                    <button class="item-status delete-blog">{{ __('blog.btn_delete_blog') }}</button>
                                @endcan
                            </div>
                        @endif
                    </div>
                    <div class="img-blog">
                        <img src="{{ asset('storage/'.$blog->image) }}" alt="">
                    </div>
                    <div class="content">
                        <p>{!! $blog->content !!}</p>
                    </div>
                </div>
            </div>
            <div class="layout-detail-item related">
                <div class="title">{{ __('blog.title_related') }}</div>
                <div class="line-title"></div>
                <div class="list-blog-related related-img">
                    @foreach ($relatedBlogs as $item)
                        <a href="{{ route('blog.detail', ['blog'=> $item]) }}" class="item-blog">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="">
                            <div class="title-blog">{{ $item->title }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="layout-detail-item comments">
                <div class="title">{{ __('blog.title_comments') }}</div>
                <div class="line-title"></div>
                @if (Auth::check())
                    <form method="POST" action="{{ route('blog.comment', ['blog' => $blog] )}}" class="send-comment">
                        @csrf
                        <img src="{{ Vite::asset('storage/app/public/images/' . Auth::user()->avatar) }}" alt="">
                        <input type="text" placeholder="Input your comment . . . . " name="content">
                        <button>{{ __('blog.btn_send_comment') }}</button>
                    </form>
                @endif
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
            </div>
        </div>
        <div class="box-delete">
            <div class="layout">
                <div class="header-box">
                    <p>{{ __('blog.title_box_delete') }}</p>
                    <i class="fa-solid fa-xmark cancel-box-delete"></i>
                </div>
                <div class="question-box">
                    <p>{{ __('blog.question_delete') }}</p>
                </div>
                <form class="form-request" action="{{ route('delete.blog', ['blog' => $blog]) }}" method="POST">
                    @method("DELETE")
                    @csrf
                    <div class="btn btn-cancel cancel-box-delete">{{ __('auth.btn_cancel') }}</div>
                    <button class="btn btn-delete" type="submit">{{ __('auth.btn_delete') }}</button>
                </form>
            </div>
        </div>   
    @else
        <div class="notify-no-blog">
            <h2>{{ __('blog.text_no_found_blog') }}</h2>
        </div>
    @endif
@endsection
