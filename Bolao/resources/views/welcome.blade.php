@extends('layouts.site')

@section('content')
        
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Seja bem-vindo(a)!</div>
            <div class="masthead-heading text-uppercase">Bolão Familiar</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#portfolio">Participar</a>
        </div>
    </header>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Bolões</h2>
                <h3 class="section-subheading text-muted">participe do bolão familiar você também.</h3>
            </div>
            <div class="row">

                @foreach($lista_apostas as $key => $value)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{ $value->id }}">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="img/portfolio/01-thumbnail.jpg" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $value->title }}</div>
                                <div class="portfolio-caption-subheading text-muted">{{ $value->nameUser($value->user_id) }}</div>

                                <form method="POST" action="{{ route('sign', $value->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />                        
                                        <a href="{{ route('rounds', $value->id) }}" class="btn btn-info">Ver Rodada</a>
                                    @if($value->subscriber)
                                        <button class="btn btn-danger">Sair Bolão</button>
                                    @else
                                        <button class="btn btn-success">Participar</button>
                                    @endif
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
        </div>
    </section>

    @foreach($lista_apostas as $key => $value)

    <!-- Modal 1-->
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $value->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal"><img src="img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project Details Go Here-->
                                <h2 class="text-uppercase">{{ $value->title }}</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <ul class="list-inline">
                                    <li>Rodada atual: {{ $value->current_value }}</li>
                                    <li>Valor resultado: {{ $value->value_result }}</li>
                                    <li>Taxa extra: {{ $value->extra_value }}</li>
                                    <li>Valor da taxa: {{ $value->value_fee }}</li>
                                </ul>
                                <form method="POST" action="{{ route('sign', $value->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
                                    <button class="btn btn-info">Ver Rodada</button>
                                    @if($value->subscriber)
                                        <button class="btn btn-danger">Sair Bolão</button>
                                    @else
                                        <button class="btn btn-success">Participar</button>
                                    @endif
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    
    
@endsection