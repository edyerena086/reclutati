@extends('layouts.front.app')

{{-- Page Title --}}
@section('pageTitle', 'Pagina no encontrada')

{{-- Content --}}
@section('content')
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<h2>
						Pagina no encontrada
					</h2>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="section-headline border-top margin-top-55 padding-top-45 margin-bottom-25">
					<h4>
						¡Haz llegado al nirvana!
					</h4>
				</div>

				<p>
					La pagina que estas buscando nuestros simios no la han podido encontrar =( pero no te preocupes puedes siempre regresar al camino amarillo sólo da clic <a href="{{ url('/') }}">aquí</a>.
				</p>

				<div class="section-headline border-top margin-top-55 padding-top-45 margin-bottom-25"></div>
			</div>
		</div>
	</div>
@stop