<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU UTAMA</li>
      <li class="active"><a href="{{url('main')}}" route="menu"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-archive"></i> <span>Kategori</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('category')}}" route="menu"><i class="fa fa-circle-o"></i>List Kategori</a></li>
          <li><a href="{{url('category/create')}}" route="menu"><i class="fa fa-circle-o"></i>Tambah Kategori</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('transaction')}}" route="menu"><i class="fa fa-circle-o"></i>List Transaksi</a></li>
          <li><a href="{{url('transaction/create')}}" route="menu"><i class="fa fa-circle-o"></i>Tambah Transaksi</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
