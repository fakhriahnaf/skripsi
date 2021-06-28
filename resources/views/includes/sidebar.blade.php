<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.html"><i class
                        ="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">Scan QrCode</li><!-- /.menu-title -->
                <li class="">
                    <a href="#"> <i class="menu-icon fa fa-eye"></i>Scan Qr-code</a>
                </li>
                <li class="menu-title">Qr Code Barang</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('qr.index') }}"> <i class="menu-icon fa fa-list"></i>List data Qrcode</a>
                </li>
                <li class="">
                    <a href="{{ route('qr.create') }}"> <i class="menu-icon fa fa-plus"></i>Tambah Qrcode</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>

