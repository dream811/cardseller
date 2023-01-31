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
					
					<li class="nav-item {{ (request()->routeIs('partner.user*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('partner.user*')) ? 'active' : '' }}"> <i class="fas fa-address-card"></i>
							<p> 회원관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						{{-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.new_list') }}" class="nav-link {{ (request()->routeIs('admin.user.new_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>신규회원목록</p>
								</a>
							</li>
						</ul> --}}
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('partner.user.list') }}" class="nav-link {{ (request()->routeIs('partner.user.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>회원목록</p>
								</a>
							</li>
						</ul>
						{{-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.levelup_list') }}" class="nav-link {{ (request()->routeIs('admin.user.levelup_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>레벨업회원목록</p>
								</a>
							</li>
						</ul> --}}
						{{-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="javascript:goto_login_users();"  class="nav-link {{ (request()->routeIs('user.user.login_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>실시간접속자</p>
								</a>
							</li>
						</ul>
						 --}}
					</li>
					
					<li class="nav-item {{ (request()->routeIs('partner.cash.cash_list')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link  {{ (request()->routeIs('user.cash.cash_list')) ? 'active' : '' }}"> <i class="fas fa-hand-holding-usd"></i>
							<p> 입출금관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('partner.cash.cash_list', 0) }}" class="nav-link {{ (request()->is('partner/cash/cash/0')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>입금관리</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('partner.cash.cash_list', 1) }}" class="nav-link {{ (request()->is('partner/cash/cash/1')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>출금관리</p>
								</a>
							</li>
						</ul>
					</li>
                    
                    <li class="nav-item {{ (request()->routeIs('partner.calculate*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('partner.calculate*')) ? 'active' : '' }}"> <i class="fas fa-calculator"></i>
							<p> 정산관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{route('partner.calculate.trading_list')}}" class="nav-link {{ (request()->routeIs('partner.calculate.trading_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>구매목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{route('partner.calculate.result_list')}}" class="nav-link {{ (request()->routeIs('partner.calculate.result_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>배당금지급내역</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{route('partner.calculate.history_list')}}" class="nav-link {{ (request()->routeIs('partner.calculate.history_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>일/월별 입출금</p>
								</a>
							</li>
						</ul>
					</li>
					
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->