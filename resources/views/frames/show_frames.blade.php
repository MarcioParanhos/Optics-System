@extends('layouts.main')

@section('title', 'Optics System - Armações')

@section('content')

@if(session('msg'))
<input id="session_message" value="{{ session('msg')}}" type="text" hidden>
@endif
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title UperCase">
                    Controle de estoque de armações
                </h2>
            </div>
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
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#new_frame_modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        <span></span>
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#new_frame_modal" aria-label="Create new report">
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
        <div class="card">
            <div class="card-body shadow">
                <div id="table-default" class="table-responsive">
                    <table id="basicTable" class="table nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">OS</th>
                                <th class="text-center">REF. ARMAÇÃO</th>
                                <th class="text-center">MARCA</th>
                                <th class="text-center">PREÇO</th>
                                <th class="text-center">DATA DE LANÇAMENTO</th>
                                <th class="text-center">SITUAÇÃO</th>
                                <th class="text-center">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach ($frames as $frame)
                            <tr class="">
                                <td class="text-center table_subheader">{{ $frame->os }}</td>
                                <td class="text-center table_subheader">{{ $frame->frame_ref }}</td>
                                <td class="text-center table_subheader">{{ $frame->brand->name }}</td>
                                <td class="text-center table_subheader">R$ {{ $frame->price }}</td>
                                <td class="text-center table_subheader">{{ \Carbon\Carbon::parse($frame->created_at)->format('d/m/Y') }}</td>
                                @if ( $frame->situation_id === 1)
                                <td class="text-center table_subheader"><span class="badge bg-green">Ativo</span></td>
                                @else
                                <td class="text-center table_subheader"><span class="badge bg-danger">Inativo</span></td>
                                @endif
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
                                            <a href="#" onclick="update('<?php echo $frame->id; ?>', 'frame')" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal Frame-->
<div class="modal modal-blur fade" id="update_modal_frame" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title UperCase">Armação - <span id="modal_update_frame_ref"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_form" method="POST">
                <input id="update_frame_id" name="id" type="number" class="form-control" hidden>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="os_update" name="os" autocomplete="off" readonly>
                                    <label for="os" class="text-dark">OS</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="frame_ref_update" name="frame_ref" autocomplete="off">
                                    <label for="frame_ref" class="text-dark">REF. ARMAÇÃO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="promotion" id="promotion" aria-label="Floating label select example">
                                        <option id="frame_selected" selected></option>
                                        <option value="0">SIM</option>
                                        <option value="1">NÃO</option>
                                    </select>
                                    <label for="situation" class="text-dark">Marca</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="price_upate" name="price" autocomplete="off">
                                    <label for="price_upate" class="text-dark">PREÇO</label>
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-currency-real">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M21 6h-4a3 3 0 0 0 0 6h1a3 3 0 0 1 0 6h-4" />
                                            <path d="M4 18v-12h3a3 3 0 1 1 0 6h-3c5.5 0 5 4 6 6" />
                                            <path d="M18 6v-2" />
                                            <path d="M17 20v-2" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="brand_upate" name="name" autocomplete="off" readonly>
                                    <label for="brand" class="text-dark">USUÁRIO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="brand_upate" name="name" autocomplete="off" readonly>
                                    <label for="brand" class="text-dark">DATA DE LANÇAMENTO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="promotion" id="promotion" aria-label="Floating label select example">
                                        <option id="promotion_selected" selected></option>
                                        <option value="0">ATIVO</option>
                                        <option value="1">INATIVO</option>
                                    </select>
                                    <label for="situation" class="text-dark">Situação</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <label class="form-label" for="additional_information">INFORMAÇÕES ADICIONAIS</label>
                            <textarea id="update_additional_information" name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" title="Fechar" data-bs-toggle="tooltip" data-bs-dismiss="modal">
                        <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-minimize">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 9l4 0l0 -4" />
                                <path d="M3 3l6 6" />
                                <path d="M5 15l4 0l0 4" />
                                <path d="M3 21l6 -6" />
                                <path d="M19 9l-4 0l0 -4" />
                                <path d="M15 9l6 -6" />
                                <path d="M19 15l-4 0l0 4" />
                                <path d="M15 15l6 6" />
                            </svg>
                        </span>
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" title="Atualizar" data-bs-toggle="tooltip">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- New Frames Modal -->
<div class="modal modal-blur fade" id="new_frame_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NOVA ARMAÇÃO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('frames.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <div class="form-floating">
                                <select class="form-select" name="brand_id" id="brand_id" aria-label="Floating label select example">
                                    <option>Selecione...</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <label for="brand_id" class="text-dark">MARCA</label>
                            </div>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <div class="form-floating">
                                <input type="text" name="frame_ref" class="form-control" id="floating-input" value="" autocomplete="off">
                                <label for="floating-input" class="text-dark">Referência da armação</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="price" class="form-control" id="price-input" value="" autocomplete="off">
                                    <label for="price" class="text-dark">Valor da armação</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select" name="situation_id" id="situation_id" aria-label="Floating label select example" required>
                                        <option id="situation_selected" selected></option>
                                        <option value="1">ATIVO</option>
                                        <option value="2">INATIVO</option>
                                    </select>
                                    <label for="situation" class="text-dark">SITUAÇÃO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="os" class="form-control" id="os-input" value="" autocomplete="off">
                                    <label for="os" class="text-dark">OS</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input value="{{ $loggedInUser->name }}" type="text" class="form-control" readonly>
                                    <input id="user_id" value="{{ $loggedInUser->id }}" name="user_id" type="text" class="form-control" hidden>
                                    <label for="price" class="text-dark">USUÁRIO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 ">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="release_date_of" id="release_date_of" autocomplete="off">
                                    <label for="release_date_of" class="text-dark"> DATA DE LANÇAMENTO</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label" for="description">INFORMAÇÕES ADICIONAIS</label>
                                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" title="Fechar" data-bs-toggle="tooltip" data-bs-dismiss="modal">
                        <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-minimize">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 9l4 0l0 -4" />
                                <path d="M3 3l6 6" />
                                <path d="M5 15l4 0l0 4" />
                                <path d="M3 21l6 -6" />
                                <path d="M19 9l-4 0l0 -4" />
                                <path d="M15 9l6 -6" />
                                <path d="M19 15l-4 0l0 4" />
                                <path d="M15 15l6 6" />
                            </svg></span>
                    </a>
                    <button type="submit" title="Salvar" data-bs-toggle="tooltip" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- js files for this page -->
<script src="{{ asset('dist/js/frames.js') }}"></script>

@endsection