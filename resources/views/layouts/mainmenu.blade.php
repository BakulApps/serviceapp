<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item"><a href="{{route('admin.home')}}" class="nav-link @if($title == 'Dashboard') active @endif"><i class="icon-display"></i> Dashboard</a></li>
        <li class="nav-item nav-item-submenu @if(in_array($title, ['Data Unit', 'Data Bengkel', 'Data Pengguna'])) nav-item-expanded nav-item-open @endif">
            <a href="#" class="nav-link"><i class="icon-box"></i> <span> Master Data</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                <li class="nav-item"><a href="{{route('admin.master.unit')}}" class="nav-link @if($title == 'Data Unit') active @endif">Data Unit</a></li>
                <li class="nav-item"><a href="{{route('admin.master.garage')}}" class="nav-link @if($title == 'Data Bengkel') active @endif">Data Bengkel</a></li>
                <li class="nav-item"><a href="{{route('admin.master.user')}}" class="nav-link @if($title == 'Data Pengguna') active @endif">Data Pengguna</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="{{route('admin.monitor')}}" class="nav-link @if($title == 'Monitoring') active @endif"><i class="icon-car"></i> Monitoring</a></li>
        <li class="nav-item nav-item-submenu @if(in_array($title, ['Laporan Unit', 'Laporan Transaksi'])) nav-item-expanded nav-item-open @endif">
            <a href="#" class="nav-link"><i class="icon-file-empty"></i> <span> Laporan</span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                <li class="nav-item"><a href="{{route('admin.report.unit')}}" class="nav-link @if($title == 'Laporan Unit') active @endif">Unit</a></li>
                <li class="nav-item"><a href="{{route('admin.report.transaction')}}" class="nav-link @if($title == 'Laporan Transaksi') active @endif">Transaksi</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="{{route('admin.setting')}}" class="nav-link @if($title == 'Pengaturan') active @endif"><i class="icon-cog"></i> Pengaturan</a></li>
    </ul>
</div>
