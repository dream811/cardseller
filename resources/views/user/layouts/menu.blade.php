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
					
					<li class="nav-item {{ (request()->routeIs('user.notice')) ? 'menu-open' : '' }}">
						<a href="{{ route('user.notice') }}" class="nav-link {{ (request()->routeIs('user.notice')) ? 'active' : '' }}">
							<i class="fas fa-globe-americas"></i>
							<p>News</p>
						</a>						

					</li>				
					<li class="nav-item {{ (request()->routeIs('user.card')) ? 'menu-open' : '' }}">
						<a href="{{route('user.card')}}" class="nav-link  {{ (request()->routeIs('user.card')) ? 'active' : '' }}"> 
							<i class="fab fa-cc-visa"></i>
							<p>Buy Cards</p>
						</a>
						
						
					</li>
                    <li class="nav-item {{ (request()->routeIs('user.my_card')) ? 'menu-open' : '' }}">
						<a href="{{route('user.my_card')}}" class="nav-link {{ (request()->routeIs('user.my_card')) ? 'active' : '' }}"> 
							<i class="fab fa-cc-mastercard"></i>
							<p>My Cards</p>
						</a>
					</li>                    
					<li class="nav-item {{ (request()->routeIs('user.credit')) ? 'menu-open' : '' }}">
						<a href="{{ route('user.credit')}}" class="nav-link {{ (request()->routeIs('user.credit')) ? 'active' : '' }}"> 
							<i class="fab fa-cc-visa"></i>
							<p>Get Credits</p>
						</a>
					</li>
					<li class="nav-item {{ (request()->is('user.faq')) ? 'menu-open' : '' }}">
						<a href="{{ route('user.faq') }}" class="nav-link {{ (request()->is('user.faq')) ? 'active' : '' }}">
							<i class="fas fa-question-circle"></i>
							<p>FAQ</p>
						</a>
					</li>
                    
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->