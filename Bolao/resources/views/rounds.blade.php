@extends('layouts.interno')

@section('content')

    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
            <br/>
                <h2 class="section-heading text-uppercase">Rodadas</h2>
                <h3 class="section-subheading text-muted">{{ $title_aposta->title }}</h3>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Aposta</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rodadas as $key => $value)
                                <tr>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->bettingTitle($value->betting_id) }}</td>
                                    <td>{{ $value->date_start_format }}</td>
                                    <td>{{ $value->date_end_format }}</td>
                                    <td>
                                    <a href="{{ route('matches', $value->id) }}" class="btn btn-success btn-xs">Visualizar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
 
            </div>
        </div>
    </section>

    
@endsection