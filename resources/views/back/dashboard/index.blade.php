@extends('layouts.back.dashboard')

{{-- Page Title --}}
@section('pageTitle', 'Dashboard')

{{-- Page Content --}}
@section('content')
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">
				Últimos candidatos registrados
			</h5>
		</div>

		{{-- Panel body --}}
		<div class="panel-body">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="30%">Nombre</th>
						<th width="30%">Email</th>
						<th width="30%">Fecha de registro</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($candidates as $candidate)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ ucwords($candidate->name.' '.$candidate->candidate->last_name) }}</td>
							<td>{{ $candidate->email }}</td>
							<td align="right">
								{{ $candidate->created_at->format('d/m/Y') }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	{{-- Recruiters --}}
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">
				Últimos reclutadores registrados
			</h5>
		</div>

		{{-- Panel body --}}
		<div class="panel-body">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="30%">Nombre</th>
						<th width="30%">Email</th>
						<th width="30%">Fecha de registro</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($recruiters as $recruiter)
						<tr>
							<td>{{ $x++ }}</td>
							<td>{{ ucwords($recruiter->user->name.' '.$recruiter->last_name) }}</td>
							<td>{{ $recruiter->user->email }}</td>
							<td align="right">
								{{ $recruiter->created_at->format('d/m/Y') }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	{{-- Vacancies --}}
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">
				Últimas vacantes públicadas
			</h5>
		</div>

		{{-- Panel body --}}
		<div class="panel-body">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="30%">Titulo</th>
						<th width="30%">Empresa</th>
						<th width="30%">Estado</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($vacancies as $vacancy)
						<tr>
							<td>{{ $z++ }}</td>
							<td>{{ $vacancy->job_title }}</td>
							<td>{{ $vacancy->recruiter->companyContact->companies->name }}</td>
							<td>
								{{ $vacancy->state->name }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop