@extends('layouts.app')

@section('style')
    @vite(['resources/scss/home.scss'])
@endsection

@section('content')
    <div class="img-title">
        <img src="{{ Vite::asset('resources/images/laptop-in-modern-office 1.png') }}" alt="">
    </div>
    <div class="list-blog">
        <div class="title">
            <h1>List Blog</h1>
            <select type="text" id="select-category" name="category_id" class="item-input">
                <option value="0">Categories</option>
                @foreach ($categories as $item)
                    <option @if (isset($categorySelected) && $item['id'] == $categorySelected) selected @endif value="{{ route('my-blogs-category', ['id' => $item['id']]) }}">
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        @if ($blogs->count() == 0)
            <h2>{{ __('auth.text_no_found_blog') }}</h2>
        @else
            <div class="all-item">
                @foreach($blogs as $item)
                    <div class="item-blog">
                        <div class="item-blog-img">
                            <img src="{{ Vite::asset('storage/app/public/images/' . $item['image']) }}" alt="">
                        </div>
                        <div class="item-blog-content">
                            <div class="info">
                                <div class="author">
                                    <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
                                    <p>{{ $item['user']['user_name'] }}</p>
                                </div>
                                <div class="time">
                                    <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                    @php
                                        $timeMinutes = now()->diffInMinutes($item['created_at'], true);
                                        if ($timeMinutes > 1440) {
                                            $timeMinutes = (int)($timeMinutes/1440)." days ago";
                                        } elseif ($timeMinutes > 60) {
                                            $timeMinutes = (int)($timeMinutes/60)." hours ago";
                                        } else {
                                            $timeMinutes = $timeMinutes." minutes ago";
                                        }
                                    @endphp
                                    <p>{{ $timeMinutes }}</p>
                                </div>
                            </div>
                            <div class="text-detail">
                                @php
                                    $lengthContent = strlen($item['content']);
                                    if ($lengthContent > 150) {
                                        $content = substr($item['content'], 0, 150).'.....';
                                    } else {
                                        $content = $item['content'];
                                    }
                                @endphp
                                <p>{{ $item['title'] }}</p>
                                <p>{!! $content !!}</p>
                            </div>
                            <div class="text-link">
                                <button class="btn btn-details">
                                    <a href="{{ route('blog-detail', ['id' => $item['id']]) }}">Read more</a> 
                                    <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @php
                $numberPage = ceil($countBlog/(\App\Models\Post::LIMIT_BLOG_PAGE_MY_BLOG));
            @endphp
            @include('layouts.paginate')
        @endif
    </div>
@endsection
