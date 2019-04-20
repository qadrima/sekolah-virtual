@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card card-block card-outline-primary">
                <div class="card-header">
                    <p class="card-text">
                        <ul class="list-inline">
                            @if(Auth::user()->type == 2)
                                <li class="list-inline-item">
                                    <a class="navbar-link" href="{{ url('/pelajaran/edit/'. $subject->id) }}">Edit</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="navbar-link" href="" data-toggle="modal" data-target="#modal_delete_subject">Hapus</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="navbar-link" href="" data-toggle="modal" data-target="#modal_list_followers_subject">{{ count($subjectFollowers) }} Followers</a>
                                </li>
                            @else
                                @if($isAuthFollow == 0)
                                    <li class="list-inline-item">
                                        <form method="POST" action="{{ route('follow_subject') }}">
                                            @csrf

                                            <input
                                                type="number"
                                                name="id"
                                                value="{{ $subject->id }}"
                                                hidden>

                                            <button type="submit" class="btn btn-primary btn-small">Follow</button>

                                        </form>
                                    </li>
                                @else
                                    <li class="list-inline-item">
                                        <form method="POST" action="{{ route('unfollow_subject') }}">
                                            @csrf

                                            <input
                                                type="number"
                                                name="id"
                                                value="{{ $subject->id }}"
                                                hidden>

                                            <button type="submit" class="btn btn-primary btn-small">Unfollow</button>
                                        </form>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </p>
                </div>

                <div class="card-body">
                    <h3>{{ $subject->title }}</h3>
                    {!! nl2br(e($subject->description)) !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <br>
            <div class="card card-block card-outline-primary">
                <div class="card-body">
                    <h4>Komentar</h4>

                    @if(Auth::user()->type == 1)
                        <form method="POST" action="{{ route('create_comment_subject') }}">
                            @csrf

                            <input
                                type="number"
                                name="subject_id"
                                value="{{ $subject->id }}"
                                hidden>

                            <input
                                type="number"
                                name="user_id"
                                value="{{ Auth::user()->id }}"
                                hidden>

                            <!-- comment -->
                            <div class="form-group">
                                <textarea
                                    id="comment"
                                    type="text"
                                    class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                    name="comment"
                                    required>{!! old('comment') == '' ? $subject->comment : old('comment') !!}</textarea>

                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    @endif

                    @forelse ($subjectComments as $comment)
                        <br>
                        <div class="card card-block card-outline-primary">
                            <div class="card-header">{{$comment->user->name}}</div>
                            <div class="card-body">{!! nl2br(e($comment->comment)) !!}</div>
                        </div>
                    @empty
                        <p>Belum ada komentar..</p>
                    @endforelse

                </div>
            </div>
        </div>

    </div>

    @if(Auth::user()->type == 2)
        <div id="modal_delete_subject" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Mata pelajaran {{ $subject->title }} akan dihapus ?</p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('delete_subject') }}">
                            @csrf

                            <input
                                type="number"
                                name="id"
                                value="{{ $subject->id }}"
                                hidden>

                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div id="modal_list_followers_subject" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Followers</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        @forelse ($subjectFollowers as $follower)
                            <li>{{$follower->user->name}}</li>
                        @empty
                            <p>Belum ada yang follow.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    @endif

</div>
@endsection
