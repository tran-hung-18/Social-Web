@extends('admin.layouts.components')

@section('title_page')
  <h1>{{ __('admin.title_page_user') }}</h1>
@endsection

@section('content')
  <section class="content layout-users">
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">
          @foreach ($users as $user)
            <div class="col-12 col-sm-12 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  {{ __('admin.title_item_user') }}
                </div>
                <div class="card-body pt-0">
                  <div class="row box-info-user">
                    <div class="col-3 text-center avatar-user">
                      <img src="{{ asset('storage/'.$user->avatar) }}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    <div class="col-9 info">
                      <h2 class="lead user-name"><b>{{ $user->user_name }}</b></h2>
                      <div class="item-info">
                        <i class="fa-solid fa-envelope"></i>
                        <p>{{ $user->email }}</p>
                      </div>
                      <div class="item-info">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <p>{{ $user->created_at }}</p>
                      </div>
                      <div class="item-info status-user">
                        @if ($user->status === App\Models\User::STATUS_ACTIVE)
                          <i class="fa-solid fa-user-check"></i>{{ __('admin.text_user_active')}}
                        @else 
                          <i class="fa-solid fa-user-xmark"></i>{{ __('admin.text_user_inactive')}}
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="card-footer-option text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.user.profile', ['user' => $user]) }}">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.user.profile', ['user' => $user]) }}">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                      <i class="fa-solid fa-trash-can"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
