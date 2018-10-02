<div class="site-sidebar">
	<div class="custom-scroll custom-scroll-light">
		<ul class="sidebar-menu">
			<li class="menu-title">Dashboard</li>
			<li>
				<a href="{{ route('coinadmin.home') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">Dashboard</span>
				</a>
			</li>
			<li class="menu-title">Users</li>
			<li>
				<a href="{{ route('coinadmin.user.index') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-anchor"></i></span>
					<span class="s-text">List Users</span>
				</a>
			</li>

			<li class="menu-title">Contacts</li>
			<li>
				<a href="{{ route('coinadmin.contact.index') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-comment"></i></span>
					<span class="s-text">Contacts</span>
				</a>
			</li>

			<li class="menu-title">Service</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Coin Type</span>
				</a>
				<ul>
					<li><a href="{{ route('coinadmin.cointype.index') }}">List Coin Type</a></li>
					<li><a href="{{ route('coinadmin.cointype.create') }}">Add Coin Type</a></li>
				</ul>
			</li>

			<!-- <li class="menu-title">Bonus</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Bonus</span>
				</a>
				<ul>
					<li><a href="{{ route('coinadmin.bonus.index') }}">List Bonus</a></li>
					<li><a href="{{ route('coinadmin.bonus.create') }}">Add Bonus</a></li>
				</ul>
			</li> -->

			<li class="menu-title">KYC Documents</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Documents</span>
				</a>
				<ul>
					<li><a href="{{ route('coinadmin.document.index') }}">List Documents</a></li>
					<li><a href="{{ route('coinadmin.document.create') }}">Add Documents</a></li>
				</ul>
			</li>

			<!-- <li class="menu-title">Promocode</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Promocodes</span>
				</a>
				<ul>
					<li><a href="{{ route('coinadmin.promocode.index') }}">List Promocodes</a></li>
					<li><a href="{{ route('coinadmin.promocode.create') }}">Add Promocode</a></li>
				</ul>
			</li> -->

			<li class="menu-title">History</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Transactions</span>
				</a>
				<ul>
					<li><a href="{{ route('coinadmin.history') }}">List History</a></li>

				</ul>
			</li>

			<li class="menu-title">others</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-view-grid"></i></span>
					<span class="s-text">Settings</span>
				</a>
				<ul>
					<li><a href="{{ route('coinadmin.settings.index') }}"> Site Settings </a></li>

				</ul>
			</li>
			<li>
				<a href="{{route('coinadmin.translation') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-smallcap"></i></span>
					<span class="s-text">Translations</span>
				</a>
			</li>
			<li class="menu-title">Account</li>
			<li>
				<a href="{{ route('coinadmin.profile') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-user"></i></span>
					<span class="s-text">Account Settings</span>
				</a>
			</li>
			<li>
				<a href="{{ route('coinadmin.password') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-exchange-vertical"></i></span>
					<span class="s-text">Change Password</span>
				</a>
			</li>

			<li class="compact-hide">


				<a href="{{ route('logout') }}"
				onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
				<span class="s-icon"><i class="ti-power-off"></i></span>Logout
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>


		</li>

	</ul>
</div>
</div>
