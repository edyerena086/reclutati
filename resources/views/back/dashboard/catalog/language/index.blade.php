@extends('layouts.back.dashboard')

{{-- Page Title --}}
@section('pageTitle', 'Catálogo de idiomas')

{{-- Body title --}}
@section('bodyPageTitle', 'Catálogo de idiomas')

{{-- Add new language button --}}
@section('headerPageButton')
	<a href="{{ url('back/dashboard/catalogs/languages/create') }}" class="btn btn-primary">
		Crear nuevo lenguaje
	</a>
@stop

{{-- Page Content --}}
@section('content')
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">
				Idiomas registrados en el sistema
			</h5>
		</div>

		{{-- Panel body --}}
		<div class="panel-body">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="45%">Idioma</th>
						<th width="45%">Acciones</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($languages as $language)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ ucwords($language->name) }}</td>
							<td align="right">
								{{-- $candidate->created_at->format('d/m/Y') --}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop