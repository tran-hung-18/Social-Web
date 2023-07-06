@extends('layouts.app')

@section('content')
    <div class="img-title">
        <img src="{{ Vite::asset('resources/images/laptop-in-modern-office 1.png') }}" alt="">
    </div>
    <div class="list-blog">
        <div class="title">
            <h1>{{ __('blog.title_list_blog') }}</h1>
            <select type="text" name="category_id" class="select-category item-input">
                <option value="0">{{ __('blog.title_select_category')}}</option>
                @foreach ($categories as $item)
<<<<<<< HEAD
                    <option value="{{ route('blog.category', ['id' => $item->id]) }}"
                        @if (request()->id == $item->id) selected @endif
=======
                    <option value="{{ route('blog.category', ['id' => $item['id']]) }}"
                        @if ($request->has('id') && $request->id == $item['id']) selected @endif
>>>>>>> 06bbb67efc3bb6fa43ae736c377b1f7d2f0839a7
                    >
                        {{ $item['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        @if ($blogs->count() == 0)
            <h2>{{ __('blog.text_no_found_blog') }}</h2>
        @else
            <div class="all-item">
                @foreach($blogs as $item)
                    <div class="item-blog">
                        <div class="item-blog-img">     
<<<<<<< HEAD
                            <img src="{{ asset('storage/'.$item->image) }}" alt="">
=======
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="">
>>>>>>> 06bbb67efc3bb6fa43ae736c377b1f7d2f0839a7
                        </div>
                        <div class="item-blog-content">
                            <div class="info">
                                <div class="author">
                                    <img src="{{ Vite::asset('resources/images/Group 25.svg') }}" alt="">
<<<<<<< HEAD
                                    <p>{{ $item->user->user_name }}</p>
=======
                                    <p>{{ $item['user']['user_name'] }}</p>
>>>>>>> 06bbb67efc3bb6fa43ae736c377b1f7d2f0839a7
                                </div>
                                <div class="time">
                                    <img src="{{ Vite::asset('resources/images/Group 38.svg') }}" alt="">
                                    <p>{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-detail">
<<<<<<< HEAD
                                <p>{{ $item['title'] }}</p>
                                <p>{!! Str::limit($item->content, 100) !!}</p>
=======
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
>>>>>>> 06bbb67efc3bb6fa43ae736c377b1f7d2f0839a7
                            </div>
                            <div class="text-link">
                                <button class="btn btn-details">
                                    <a href="{{ route('blog.detail', ['blog' => $item]) }}">{{ __('blog.btn_detail_blog') }}</a> 
                                    <svg width="18" height="8" viewBox="0 0 20 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 5H1M19 5L15 9M19 5L15 1" stroke="#C40000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('layouts.paginate')
        @endif
    </div>
@endsection
