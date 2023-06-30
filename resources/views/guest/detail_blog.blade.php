@extends('layouts.app')

@section('content')
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
                                <a class="item-status update-blog" href="{{ route('edit.blog', ['blog' => $blog]) }}">
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
                <form method="POST" action="{{ route('comment.store', ['blog' => $blog] )}}" class="send-comment">
                    @csrf
                    <img src="{{ Vite::asset('storage/app/public/images/' . Auth::user()->avatar) }}" alt="">
                    <textarea name="content" id="" placeholder="Input your comment . . . . "></textarea>
                    <button>{{ __('comment.btn_send_comment') }}</button>
                </form>
            @endif
            @foreach ($comments as $comment)
                <div class="item-comment">
                    <img src="{{ Vite::asset('storage/app/public/images/' . $comment->user->avatar) }}" alt="">
                    <div class="info-comment">
                        <h3>{{ $comment->user->user_name }}</h3>
                        @can ('update', $comment)
                            <form action="{{ route('update.comment', ['comment' => $comment]) }}" method="POST" class="form-edit-comment">
                                @method("PUT")
                                @csrf
                                <textarea name="content" id="" class="textarea-update item-form-edit">{{ $comment->content }}</textarea>
                                <button class="item-form-edit">{{ __('comment.btn_save') }}</button>
                            </form>
                            <p class="content-my-comment">{{ $comment->content }}</p>
                        @else
                            <p class="content-comment">{{ $comment->content }}</p>
                        @endcan
                        <p class="time-comment">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    @canany(['update', 'delete'], $comment)
                        <i class="fa-solid fa-ellipsis-vertical icon-option-comment"></i>
                        <form action="{{ route('delete.comment', ['comment' => $comment]) }}" method="POST" class="box-option-comment">
                            @method("DELETE")
                            @csrf
                            <p class="item-option-comment option-edit">{{ __('comment.option_edit') }}</p>
                            <button type='submit' class="item-option-comment" >{{ __('comment.option_delete') }}</button>
                        </form>
                    @endcan
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
    <script>
        const boxOptionComment = document.querySelectorAll('.box-option-comment');
        const formEditComment = document.querySelectorAll('.form-edit-comment');

        document.querySelectorAll('.icon-option-comment').forEach((item, index) => {
            item.onclick = function() {
                boxOptionComment[index].style.display = 'flex';
                item.classList.toggle('hidden');
            };
        });
        document.querySelectorAll('.option-edit').forEach((item, index) => {
            item.onclick = function() {
                formEditComment[index].style.display = 'flex';
                document.querySelectorAll('.content-my-comment')[index].style.display = 'none';
                boxOptionComment[index].style.display = 'none';
            };
        });
    </script>
@endsection
