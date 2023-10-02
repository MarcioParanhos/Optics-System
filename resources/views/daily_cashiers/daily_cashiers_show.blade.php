@extends('layouts.main')

@section('title', 'Optics System - Caixa Diário')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    <?php echo date('d/m/Y'); ?>
                </div>
                <h2 class="page-title UperCase">
                    CAIXA DIÁRIO
                </h2>
            </div>
            <!-- Page title actions -->
            <!-- <div class="container">
                <div class="btn-list d-flex justify-content-end">
                    <a id="btn_open_cashier" class="btn btn-green d-sm-inline-block">
                        ABRIR CAIXA
                    </a>
                </div>
            </div> -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="d-flex justify-content-end">
                        <a href="#" title="Informações Adicionais" class="btn btn-md" data-bs-toggle="modal" data-bs-target="#information_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path>
                                <path d="M12 19l0 .01"></path>
                            </svg>
                        </a>
                    </div>
                    <a id="btn_cashier" href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#new_moviment_modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        <span>NOVO LANÇAMENTO</span>
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
        <div id="daily_cashier" class="row row-deck row-cards ">
            <div class="col-sm-6 col-lg-4">
                <div class="border_top_success card card-link card-link-pop shadow">
                    <div class="card-body">
                        <div class="ribbon ribbon-top bg-green">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 11l5 -5l5 5"></path>
                                <path d="M7 17l5 -5l5 5"></path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-green subheader">ENTRADA</div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2 text-green">R$ 0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="border_top_danger card card-link card-link-pop shadow">
                    <div class="card-body">
                        <div class="ribbon ribbon-top bg-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7l5 5l5 -5"></path>
                                <path d="M7 13l5 5l5 -5"></path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-danger subheader">SAÍDA</div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2 text-danger">R$ 0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="border_top_cyan card card-link card-link-pop shadow">
                    <div class="card-body">
                        <div class="ribbon ribbon-top bg-cyan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                            </svg>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="text-cyan subheader">SALDO</div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2 text-cyan">R$ 0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title UperCase">Movimento Diário</h6>
                    </div>
                    <div class="table-responsive shadow">
                        <table id="basicTable" class="table table-sm card-table table-vcenter text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">DIA</th>
                                    <th class="text-center">DESCRIÇÃO</th>
                                    <th class="text-center">TIPO DE MOVIMENTO</th>
                                    <th class="text-center">VALOR</th>
                                    <th class="text-center">AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="text-center table_subheader"><span class="text-muted">002</span></td>
                                    <td class="text-center table_subheader">22/09/2023</td>
                                    <td class="text-center table_subheader">ABERTURA DE CAIXA</td>
                                    <td class="text-center table_subheader">
                                        <span class="text-green"><strong>ENTRADA</strong></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-up-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M11.293 7.293a1 1 0 0 1 1.32 -.083l.094 .083l6 6l.083 .094l.054 .077l.054 .096l.017 .036l.027 .067l.032 .108l.01 .053l.01 .06l.004 .057l.002 .059l-.002 .059l-.005 .058l-.009 .06l-.01 .052l-.032 .108l-.027 .067l-.07 .132l-.065 .09l-.073 .081l-.094 .083l-.077 .054l-.096 .054l-.036 .017l-.067 .027l-.108 .032l-.053 .01l-.06 .01l-.057 .004l-.059 .002h-12c-.852 0 -1.297 -.986 -.783 -1.623l.076 -.084l6 -6z" stroke-width="0" fill="#2fb344"></path>
                                        </svg>
                                    </td>
                                    <td class="text-center table_subheader">R$ 500,00</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                    <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                    <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="#" class="dropdown-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                        <path d="M9 14v.01"></path>
                                                        <path d="M12 14v.01"></path>
                                                        <path d="M15 14v.01"></path>
                                                    </svg>
                                                    <span>&nbsp;Editar</span>
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                    <span>&nbsp;Deletar</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- New Moviment Modal -->
<div class="modal modal-blur fade" id="new_moviment_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title UperCase">Novo Lançamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="IMFORME A DESCRIÇÃO DO MOVIMENTO">
                </div>
                <label class="form-label">Tipo de Movimento</label>
                <div class="form-selectgroup-boxes row mb-3">
                    <div class="col-lg-6">
                        <label class="border_top_success form-selectgroup-item">
                            <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">
                                        Entrada
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-up-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M11.293 7.293a1 1 0 0 1 1.32 -.083l.094 .083l6 6l.083 .094l.054 .077l.054 .096l.017 .036l.027 .067l.032 .108l.01 .053l.01 .06l.004 .057l.002 .059l-.002 .059l-.005 .058l-.009 .06l-.01 .052l-.032 .108l-.027 .067l-.07 .132l-.065 .09l-.073 .081l-.094 .083l-.077 .054l-.096 .054l-.036 .017l-.067 .027l-.108 .032l-.053 .01l-.06 .01l-.057 .004l-.059 .002h-12c-.852 0 -1.297 -.986 -.783 -1.623l.076 -.084l6 -6z" stroke-width="0" fill="#2fb344"></path>
                                        </svg>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="border_top_danger form-selectgroup-item">
                            <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">
                                        Saída
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-caret-down-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 9c.852 0 1.297 .986 .783 1.623l-.076 .084l-6 6a1 1 0 0 1 -1.32 .083l-.094 -.083l-6 -6l-.083 -.094l-.054 -.077l-.054 -.096l-.017 -.036l-.027 -.067l-.032 -.108l-.01 -.053l-.01 -.06l-.004 -.057v-.118l.005 -.058l.009 -.06l.01 -.052l.032 -.108l.027 -.067l.07 -.132l.065 -.09l.073 -.081l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01l.057 -.004l12.059 -.002z" stroke-width="0" fill="#d63939"></path>
                                        </svg>
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Valor da movimentação</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Visibility</label>
                            <select class="form-select">
                                <option value="1" selected>Private</option>
                                <option value="2">Public</option>
                                <option value="3">Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Usuário</label>
                            <input value="Marcio Paranhos" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Data</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <label class="form-label">Informações Adicionais</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    <span class="text-danger">CANCELAR</span>
                </a>
                <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    NOVO LANÇAMENTO
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal modal-blur fade" id="delete_modal_daily_cashiers" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->

                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 7h16"></path>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                    <path d="M10 12l4 4m0 -4l-4 4"></path>
                </svg>
                <h3 class="subheader">Deseja excluir ?</h3>
                <div class="subheader text-muted">Atenção! O registro será excluido permanentemente.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="subheader btn w-100" data-bs-dismiss="modal">Cancelar</a></div>
                        <!-- <div class="col"><a href="/logout" class="btn btn-danger w-100">Sair</a></div> -->
                        <div class="col">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="btn btn-danger w-100" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    <i class="ti-power-off text-primary"></i>
                                    <span class="subheader text-white">Excluir</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let activeDailyCashiers = document.getElementById("activeDailyCashiers")
    activeDailyCashiers.classList.add('active')
</script>
@endsection