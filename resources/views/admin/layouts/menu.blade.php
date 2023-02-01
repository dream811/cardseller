<!-- Sidebar -->
<div class="sidebar">
			<!-- SidebarSearch Form -->
			<div class="form-inline" style="margin-top: 5px;">
				<div class="input-group">
					<input class="form-control form-control-sidebar" style="text-align: center;" ng-model="strServerTime" readonly disabled>
				</div>
			</div>
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					
					<li class="nav-item {{ (request()->routeIs('admin.user*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.user*')) ? 'active' : '' }}"> <i class="fas fa-address-card"></i>
							<p> Users <i class="right fas fa-angle-left"></i> </p>
						</a>
						{{-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.new_list') }}" class="nav-link {{ (request()->routeIs('admin.user.new_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>New User List</p>
								</a>
							</li>
						</ul> --}}
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.list') }}" class="nav-link {{ (request()->routeIs('admin.user.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>User list</p>
								</a>
							</li>
						</ul>
					</li>				
					<li class="nav-item {{ (request()->routeIs('admin.credit*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link  {{ (request()->routeIs('admin.credit*')) ? 'active' : '' }}"> <i class="fas fa-hand-holding-usd"></i>
							<p> Credit Management <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.credit.list') }}" class="nav-link {{ (request()->routeIs('admin.credit.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>Credit list</p>
								</a>
							</li>
						</ul>
						
					</li>
                    <li class="nav-item {{ (request()->routeIs('admin.card*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.card*')) ? 'active' : '' }}"> <i class="fas fa-coins"></i>
							<p> Card Management <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/card/list" class="nav-link {{ (request()->routeIs('admin.card.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>Card List</p>
								</a>
							</li>
						</ul>
                        
					</li>
                    <li class="nav-item {{ (request()->routeIs('admin.calculate*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.calculate*')) ? 'active' : '' }}"> <i class="fas fa-calculator"></i>
							<p> Sale Management <i class="right fas fa-angle-left"></i> </p>
						</a>
						
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/trading" class="nav-link {{ (request()->routeIs('admin.calculate.trading_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>구매목록</p>
								</a>
							</li>
						</ul>
						
					</li>
					<li class="nav-item {{ (request()->is('admin/contact*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->is('admin/contact*')) ? 'active' : '' }}"> <i class="fas fa-user-astronaut"></i>
							<p> Customer Center <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.faq.list') }}" class="nav-link {{ (request()->routeIs('admin.faq.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>FAQs</p>
								</a>
							</li>
							{{-- <li class="nav-item">
								<a href="{{ route('admin.qna.list') }}" class="nav-link {{ (request()->routeIs('admin.qna.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>1:1문의관리</p>
								</a>
							</li> --}}
							{{-- <li class="nav-item">
								<a href="{{ route('admin.qna.acc_list') }}" class="nav-link {{ (request()->routeIs('admin.qna.acc_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>계좌문의관리</p>
								</a>
							</li> --}}
							<li class="nav-item">
								<a href="{{ route('admin.notice.list') }}" class="nav-link {{ (request()->routeIs('admin.notice.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>News</p>
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item  {{ (request()->routeIs('admin.setting*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.setting*')) ? 'active' : '' }}"> <i class="fas fa-cogs"></i>
							<p> Setting Management <i class="right fas fa-angle-left"></i> </p>
						</a>
						
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.setting.bank') }}" class="nav-link {{ (request()->routeIs('admin.setting.bank')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>Payment API</p>
								</a>
							</li>
						</ul>
						
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->