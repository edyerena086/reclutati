			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="{{ url('/') }}/limitless/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold">{{ ucwords(Auth::user()->name) }}</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;FLDM
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Menú</span> <i class="icon-menu" title="Main pages"></i></li>
								<li>
									<a href="{{ url('admin/dashboard/candidates') }}"><i class="icon-home"></i> <span>Candidatos</span></a>
								</li>

								<li>
									<a href="#"><i class="icon-stack2"></i> <span>Catalogos</span></a>

									<ul>
										<li><a href="{{ url('back/dashboard/catalogs/languages') }}">Idiomas</a></li>
									</ul>
								</li>
								<!-- /page kits -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->