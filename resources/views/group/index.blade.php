@extends('templates.master')

@section('css-view')

@endsection

@section('js-view')

@endsection

@section('conteudo-view')

    {!! Form::open(['route' => 'group.store', 'method' => 'post', 'class' => 'form-padrao']) !!}

        @include('templates.formulario.input', ['label' => 'Nome do Grupo', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome do Grupo']])
        @include('templates.formulario.select', ['label' => 'Usuario', 'select' => 'user_id', 'data' => $user_list, 'attributes' => ['placeholder' => 'Usuário']])
        @include('templates.formulario.select', ['label' => 'Instituição', 'select' => 'instituition_id', 'data' => $instituition_list, 'attributes' => ['placeholder' => 'Instituição']])
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])

    {!! Form::close() !!}

    @include('group.list', ['group_list' => $groups])

@endsection