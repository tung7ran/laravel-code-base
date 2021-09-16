<li class="header">TRANG QUẢN TRỊ</li>

<li class="{{ \Request::segment(2) == 'home' ? 'active' : null  }}">
    <a href="#">
        <i class="fa fa-home"></i> <span>Trang chủ</span>
    </a>
</li>
<li class="{{ \Request::segment(2) == 'users' ? 'active' : null  }}">
    <a href="#">
        <i class="fa fa-user"></i> <span>Tài khoản</span>
    </a>
</li>

<li class="treeview {{ \Request::segment(2) === 'category' || Request::segment(2) === 'products' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Sản phẩm</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ \Request::segment(2) === 'products' ? 'active' : null }}">
            <a href="#"><i class="fa fa-circle-o"></i> Danh sách sản phẩm</a>
        </li>
        <li class="{{ \Request::segment(2) === 'category' ? 'active' : null }}">
            <a href="#"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a>
        </li>
    </ul>
</li>

<li class="{{ \Request::segment(2) == 'banks' ? 'active' : null  }}">

    <a href="{{ route('banks.index') }}">

        <i class="fa fa-building" aria-hidden="true"></i> <span>Tài khoản ngân hàng</span>

    </a>

</li>

<li class="{{ \Request::segment(2) == 'orders' ? 'active' : null  }}">

    <a href="{{ route('orders.index') }}">

        <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Đơn hàng</span>

    </a>

</li>

<li class="treeview {{ \Request::segment(2) === 'category-post' || Request::segment(2) === 'posts' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Bài viết</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ \Request::segment(2) === 'posts' ? 'active' : null }}">
            <a href="{{ route('posts.index', ['type'=> 'blog']) }}"><i class="fa fa-circle-o"></i> Danh sách bài viết</a>
        </li>
        <li class="{{ \Request::segment(2) === 'category-post' ? 'active' : null }}">
            <a href="#"><i class="fa fa-circle-o"></i> Danh mục bài viết</a>
        </li>
    </ul>
</li>


<li class="{{ \Request::segment(2) == 'policy' ? 'active' : null  }}">
    <a href="{{ route('policy.index') }}">
        <i class="fa fa-tags" aria-hidden="true"></i> <span>Chính sách hỗ trợ</span>
    </a>
</li>


<li class="{{ \Request::segment(2) == 'pages' ? 'active' : null  }}">
    <a href="#">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Cài đặt trang</span>
    </a>
</li>

<li class="{{ \Request::segment(2) == 'contact' ? 'active' : null  }}">
    <?php //$number = \App\Models\Contact::where('status', 0)->count() ?>
    <a href="#">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Liên hệ (0)
        </span>
    </a>
</li>


<li class="header">Cấu hình hệ thống</li>
<li class="treeview {{ \Request::segment(2) === 'options' || \Request::segment(2) === 'image' || \Request::segment(2) === 'menu' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Cấu hình</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

         <li class="{{ \Request::segment(3) === 'general' ? 'active' : null }}">
            <a href="#"><i class="fa fa-circle-o"></i> Cấu hình chung</a>
        </li>

        <li class="{{ request()->get('type') == 'slider' ? 'active' : null }}">
            <a href="#"><i class="fa fa-circle-o"></i> Slider</a>
        </li>

        <li class="{{ \Request::segment(2) === 'menu' ? 'active' : null }}">
            <a href="#"><i class="fa fa-circle-o"></i> Menu</a>
        </li>

    </ul>
</li>
<div style="display: none;">
	<li class="header">Cấu hình hệ thống</li>
	<li class="treeview {{ \Request::segment(2) == 'options' ? 'active' : null  }}">
		<a href="#">
			<i class="fa fa-folder"></i> <span>Setting (Developer)</span>
			<span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ \Request::segment(3) == 'developer-config' ? 'active' : null  }}">
				<a href="#"><i class="fa fa-circle-o"></i> Developer - Config</a>
			</li>
		</ul>
	</li>
</div>
