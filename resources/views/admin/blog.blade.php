@extends('admin.layouts.components')

@section('title_page')
  <h1>{{ __('admin.title_page_blog') }}</h1>
@endsection

@section('content')
    <section class="content layout-blogs">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('admin.title_all_blog')}} ({{ $dataTotal['totalBlog'] }})</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table border='1px' class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class='col-2'>Image</th>
                            <th class='col-2'>Title</th>
                            <th class='col-4'>Content</th>
                            <th class='header-status'>Status</th>
                            <th class='col-1'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td class='image-blog'>
                                    <img alt="Avatar" class="table-avatar" src="{{ asset('storage/'.$blog->image) }}">
                                </td>
                                <td>
                                    {{ Str::limit($blog->title, 50) }}
                                </td>
                                <td>
                                    {{ Str::limit($blog->content, 80) }}
                                </td>
                                <td class="project-state status-blog">
                                    <form action="{{ route('admin.blog.update.status', ['blog' => $blog]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        @if ($blog->status === App\Models\Post::STATUS_APPROVED)
                                            <button class="btn badge-success btn-sm btn-update-status-blog">
                                                {{ __('admin.btn_approved')}}
                                            </button>    
                                        @else
                                            <button class="btn badge-warning btn-sm btn-update-status-blog" >
                                                {{ __('admin.btn_unapproved')}}
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td class="options-blog-item">
                                    <form action="{{ route('admin.blog.delete', ['blog' => $blog]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <a class="btn btn-primary btn-sm" href="{{ route('blog.detail', ['blog' => $blog]) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('blog.edit', ['blog' => $blog]) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm icon-delete-blog">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('admin.title_blog_not_approved')}} ({{ $dataTotal['totalBlogNotApproved'] }})</h3>
                <div class="card-tools">
                    <form action="{{ route('admin.blog.approved.all')}}" method="POST">
                        @csrf
                        @method("PUT")
                        <button class="btn btn-primary btn-approved-all">
                            {{ __('admin.btn_approved_all') }}
                        </button>
                    </form>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table border='1px' class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class='col-2'>Image</th>
                            <th class='col-2'>Title</th>
                            <th class='col-4'>Content</th>
                            <th class='header-status'>Status</th>
                            <th class='col-1'>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            @if ($blog->status === App\Models\Post::STATUS_NOT_APPROVED)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td class='image-blog'>
                                        <img alt="Avatar" class="table-avatar" src="{{ asset('storage/'.$blog->image) }}">
                                    </td>
                                    <td>{{ Str::limit($blog->title, 50) }}</td>
                                    <td>{{ Str::limit($blog->content, 80) }}</td>
                                    <td class="project-state status-blog">
                                        <form action="{{ route('admin.blog.update.status', ['blog' => $blog]) }}" method="POST">
                                            @csrf
                                            @method("PUT")
                                            <button class="btn badge-warning btn-sm btn-update-status-blog" >
                                                {{ __('admin.btn_unapproved')}}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="options-blog-item">
                                        <form action="{{ route('admin.blog.delete', ['blog' => $blog]) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <a class="btn btn-primary btn-sm" href="{{ route('blog.detail', ['blog' => $blog]) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ route('blog.edit', ['blog' => $blog]) }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm icon-delete-blog">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
