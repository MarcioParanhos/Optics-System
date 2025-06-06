@extends('layouts.main')

@section('title', 'Optics System - Home')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Visão geral
                </div>
                <h2 class="page-title UperCase">
                    {{ $loggedInUser->profile->company }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="d-flex justify-content-end">
                        <a href="#" title="Informações Adicionais" class="btn btn-md " data-bs-toggle="modal" data-bs-target="#information_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path>
                                <path d="M12 19l0 .01"></path>
                            </svg>
                        </a>
                    </div>
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        <span>NOVA VENDA</span>
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Balanço do caixa</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">R$ 1.200</div>
                            <div class="me-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 17l6 -6l4 4l8 -8" />
                                        <path d="M14 7l7 0l0 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div id="chart-new-clients" class="chart-sm"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Armações Ativas Cadastradas</div>
                        </div>
                        <div class="h1 mb-3">{{ $frames_qty_active }}</div>
                        <div class="d-flex mb-2">
                            <div>
                                <h5>ESTOQUE</h5>
                            </div>
                        </div>
                        @php
                        $percentage = ($frames_qty_active / ($frames_qty_active+$frames_qty_inative)) * 100;
                        @endphp
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style='width: {{ $percentage }}%' role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                <span class="visually-hidden">75% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Clientes ativos</div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-0 me-2">4,300</div>
                        </div>
                    </div>
                    <div id="chart-revenue-bg" class="chart-sm"></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Crediarios Ativos</div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">2,986</div>
                        </div>
                        <div id="chart-active-users" class="chart-sm"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                                <path d="M12 3v3m0 12v3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium subheader">
                                            SALDO NO CAIXA - <?php echo date('d/m/Y'); ?>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted subheader">
                                            <span id="balance_value">R$ ****</span>
                                            <button id="show_balance" title="Mostrar" data-bs-toggle="tooltip" class="btn ocult-info-btn">
                                                <i id="balance_icon" class="text-danger far fa-eye-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M17 17h-11v-14h-2" />
                                                <path d="M6 5l14 1l-1 7h-13" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium subheader">
                                            Vendas totais - <?php echo date('d/m/Y'); ?>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center text-muted subheader">
                                            <span>132 VENDAS - R$ <span id="sales_value">****</span></span>
                                            <button id="show_sales_value" title="Mostrar" data-bs-toggle="tooltip" class="btn ocult-info-btn">
                                                <i id="sales_icon" class="text-danger far fa-eye-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            623 Shares
                                        </div>
                                        <div class="text-muted">
                                            16 today
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            132 Likes
                                        </div>
                                        <div class="text-muted">
                                            21 today
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="card-title">ULTIMAS VENDAS</h6>
                        <a title="Visão Geral" data-bs-toggle="tooltip" class="btn btn-md btn-info" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M11 17h-5v-14h-2"></path>
                                <path d="M6 5l14 1l-.718 5.023m-6.282 1.977h-7"></path>
                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M20.2 20.2l1.8 1.8"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="table-responsive shadow">
                        <table id="table" class="table card-table table-vcenter text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">OS</th>
                                    <th class="text-center">ARMAÇÃO</th>
                                    <th class="text-center">LENTE</th>
                                    <th class="text-center">CLIENTE</th>
                                    <th class="text-center">DATA</th>
                                    <th class="text-center">VALOR</th>
                                    <th class="text-center">FORMA DE PAGAMENTO</th>
                                    <th class="text-center">VENDEDOR(A)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table_subheader">
                                    <td class="text-center"><span class="text-muted">001408</span></td>
                                    <td class="text-center"><a href="invoice.html" class="text-reset" tabindex="-1">RF3528JY</a></td>
                                    <td class="text-center">Transition</td>
                                    <td class="text-center">Araci Padrosa</td>
                                    <td class="text-center">20/09/2023</td>
                                    <td class="text-center">R$ 1.500</td>
                                    <td class="text-center">Crediario</td>
                                    <td class="text-center">Marcio Paranhos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let activeHome = document.getElementById("activeHome")
    activeHome.classList.add('active')
</script>
<script>

</script>

@endsection