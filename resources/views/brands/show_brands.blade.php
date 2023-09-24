@extends('layouts.main')

@section('title', 'Optics System - Marcas')

@section('content')

@if(session('msg'))
<input id="session_message" value="{{ session('msg')}}" type="text" hidden>
@endif
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h3 class="page-title">
                    MARCAS CADASTRADAS
                </h3>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#new_brand_modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        ADICIONAR MARCA
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#new_brand_modal" aria-label="Create new report">
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
                    <table id="basicTable" class="table table-sm nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">MARCA</th>
                                <th class="text-center">CATEGORIA</th>
                                <th class="text-center">ARMAÇÕES NO ESTOQUE</th>
                                <th class="text-center">SITUAÇÃO</th>
                                <th class="text-center">DATA DE LANÇAMENTO</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach ($brands as $brand)
                            <tr class="table_subheader">
                                <td class="text-center">{{ $brand->id }}</td>
                                <td class="text-center">{{ $brand->brand }}</td>
                                <td class="text-center">{{ $brand->category }}</td>
                                <td class="text-center"><span class="badge bg-teal">25</span></td>
                                <td class="text-center"><span class="badge bg-green">{{ $brand->situation }}</span></td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($brand->release_date)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a title="Editar" data-bs-toggle="tooltip" class="btn btn-primary btn-sm rounded p-1" onclick="update('<?php echo $brand->id; ?>', 'brand')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a title="Excluir" data-bs-toggle="tooltip" class="btn btn-danger btn-sm rounded p-1" onclick="destroy('<?php echo $brand->id; ?>', 'brand')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
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
<!-- Update Modal Brand-->
<div class="modal modal-blur fade" id="update_modal_brand" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_update_brand_name" class="modal-title UperCase"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update_form" method="POST">
                <input id="update_brand_id" name="id" type="number" class="form-control" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="brand">MARCA</label>
                        <input id="brand_upate" name="brand" type="text" class="form-control" placeholder="INFORME O NOME DA MARCA" required>
                    </div>
                    <label class="form-label">CATEGORIA</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <div class="ribbon ribbon-top bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-male" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                                        <path d="M19 5l-5.4 5.4"></path>
                                        <path d="M19 5h-5"></path>
                                        <path d="M19 5v5"></path>
                                    </svg>
                                </div>
                                <input type="radio" name="category" value="Masculino" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Masculino</span>
                                        <span class="d-block text-muted"></span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <div class="ribbon ribbon-top bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-female" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                                        <path d="M12 14v7"></path>
                                        <path d="M9 18h6"></path>
                                    </svg>
                                </div>
                                <input type="radio" name="category" value="Feminino" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Feminino</span>
                                        <span class="d-block text-muted"></span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <div class="ribbon ribbon-top bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-agender" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0"></path>
                                        <path d="M7 12h11"></path>
                                    </svg>
                                </div>
                                <input type="radio" name="category" value="Unissex" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Unissex</span>
                                        <span class="d-block text-muted"></span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="situation">SITUAÇÃO</label>
                                <select id="situation" name="situation" class="form-select" required>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="user">USUARIO</label>
                                <input value="{{ $loggedInUser->name }}" type="text" class="form-control" readonly>
                                <input id="user" value="{{ $loggedInUser->id }}" name="user_id" type="text" class="form-control" hidden>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="release_date">DATA DE LANÇAMENTO</label>
                                <input id="update_release_date" name="release_date" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label" for="additional_information">INFORMAÇÕES ADICIONAIS</label>
                                <textarea id="update_additional_information" name="additional_information" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        <span class="text-danger">CANCELAR</span>
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                        </svg>
                        ATUALIZAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- New Modal Brand -->
<div class="modal modal-blur fade" id="new_brand_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NOVA MARCA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('brands.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="brand">MARCA</label>
                        <input id="brand" name="brand" type="text" class="form-control" name="example-text-input" placeholder="INFORME O NOME DA MARCA" required>
                    </div>
                    <label class="form-label">CATEGORIA</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <div class="ribbon ribbon-top bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-male" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                                        <path d="M19 5l-5.4 5.4"></path>
                                        <path d="M19 5h-5"></path>
                                        <path d="M19 5v5"></path>
                                    </svg>
                                </div>
                                <input type="radio" name="category" value="Masculino" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Masculino</span>
                                        <span class="d-block text-muted"></span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <div class="ribbon ribbon-top bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-female" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                                        <path d="M12 14v7"></path>
                                        <path d="M9 18h6"></path>
                                    </svg>
                                </div>
                                <input type="radio" name="category" value="Feminino" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Feminino</span>
                                        <span class="d-block text-muted"></span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-selectgroup-item">
                                <div class="ribbon ribbon-top bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gender-agender" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0"></path>
                                        <path d="M7 12h11"></path>
                                    </svg>
                                </div>
                                <input type="radio" name="category" value="Unissex" class="form-selectgroup-input" checked>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Unissex</span>
                                        <span class="d-block text-muted"></span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Report url</label>
                                <div class="input-group input-group-flat">
                                    <span class="input-group-text">
                                        https://tabler.io/reports/
                                    </span>
                                    <input type="text" class="form-control ps-0" value="report-01" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="situation">SITUAÇÃO</label>
                                <select id="situation" name="situation" class="form-select" required>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="user">USUARIO</label>
                                <input value="{{ $loggedInUser->name }}" type="text" class="form-control" readonly>
                                <input id="user" value="{{ $loggedInUser->id }}" name="user_id" type="text" class="form-control" hidden>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="release_date">DATA DE LANÇAMENTO</label>
                                <input id="release_date" name="release_date" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label" for="additional_information">INFORMAÇÕES ADICIONAIS</label>
                                <textarea id="additional_information" name="additional_information" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        <span class="text-danger">CANCELAR</span>
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        CADASTRAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal modal-blur fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <a class="btn btn-danger w-100"><i class="ti-power-off text-primary"></i><span class="subheader text-white">Excluir</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let activeBrand = document.getElementById("activeBrand")
    activeBrand.classList.add('active')

    document.addEventListener("DOMContentLoaded", function() {
        const session_message = document.getElementById("session_message");

        function showToast(icon, title) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: title
            })
        }

        if (session_message) {
            if (session_message.value === "deleted") {
                showToast('success', 'Marca excluída com sucesso!');
            } else if (session_message.value === "success") {
                showToast('success', 'Marca adicionada com sucesso!');
            } else if (session_message.value === "updated") {
                showToast('success', 'Marca atualizada com sucesso!');
            }
        }

    });
</script>
@endsection