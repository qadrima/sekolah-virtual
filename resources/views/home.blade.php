@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{Auth::user()->phone}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{Auth::user()->type == 1 ? 'Siswa' : 'Guru'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Mata Pelajaran</div>

                <div class="card-body">

                    @if(Auth::user()->type == 2)
                        <a class="navbar-link" href="{{ url('/pelajaran/create') }}">
                            Buat Mata Pelajaran
                        </a>
                        <hr>
                    @endif

                    <ul>
                        @forelse ($subjects as $subject)
                            <li>
                                <a class="navbar-link" href="{{ url('/pelajaran/details/' . $subject->id) }}">
                                    {{ $subject->title }}
                                </a>
                            </li>
                        @empty
                            <p>Belum ada mata pelajaran.</p>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
