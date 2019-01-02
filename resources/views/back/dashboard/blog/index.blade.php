@extends('layouts.back.dashboard')

{{-- Page Title --}}
@section('pageTitle', 'Entradas del blog')


{{-- Page Content --}}
@section('content')
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">
				Entradas del blog
			</h5>
		</div>

		{{-- Panel body --}}
		<div class="panel-body">
			{{--<table class="table datatable-basic">
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
								$candidate->created_at->format('d/m/Y')
							</td>
						</tr>
					@endforeach
				</tbody>
			</table> --}}
		</div>
	</div>
@stop