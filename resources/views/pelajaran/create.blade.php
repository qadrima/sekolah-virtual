@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('create_subject') }}">
                        @csrf

                            <!--  title -->
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Judul') }}</label>

                                <div class="col-md-6">

                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                        name="title"
                                        value="{{ old('title') }}"
                                        required
                                        autocomplete="title"
                                        autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- description -->
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>

                                <div class="col-md-6">

                                    <textarea
                                        id="description"
                                        type="text"
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        name="description"
                                        value="{{ old('description') }}"
                                        required>
                                    </textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
