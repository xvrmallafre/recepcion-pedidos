@php
    $fecha = $recepcion->created_at->format('d-m-Y');
    $hora = $recepcion->created_at->format('H:i');
    $hasMaterial = $recepcion->has_material ? 'Si' : 'No';
    $phone = $recepcion->phone ?? ' ';
    $address = $recepcion->address ?? ' ';
    $material = $recepcion->material ?? ' ';
    $description = $recepcion->description ?? ' ';
    $observations = $recepcion->observations ?? ' ';
    $email = $recepcion->email ?? ' ';
@endphp

<head>
    <style>
        .main {
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            display: flex;
            margin-bottom: 10px;
            background-color: lightgrey;
            padding: 10px;
            height: 63px;
        }

        .logo {
            width: 75px;
            height: 63px;
            float: left;
            margin-right: 30px;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .title {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            float: left;
            padding-top: 8px;
        }

        .title h1 {
            font-size: 1.1em;
            font-weight: 700;
        }

        .info {
            display: flex;
            float: right;
            margin-top: 15px;
            text-align: right;
        }

        .info p {
            font-size: 12px;
            margin: 0;
        }

        .content {
            display: flex;
            margin-top: -10px;
        }

        .row {
            display: flex;
            min-width: 100%;
            margin-bottom: 10px;
        }

        .form-group {
            display: flex;
        }

        .form-group label {
            font-size: 12px;
            font-weight: bold;
        }

        .form-group input {
            font-size: 12px;
            font-weight: bold;
            border: none;
            border-bottom: 1px solid black;
            outline: none;
        }

        .form-group textarea {
            font-size: 12px;
            font-weight: bold;
            border: 1px solid black;
            outline: none;
            border-radius: 5px;
            min-height: 80px;
        }

        .form-group #observations {
            min-height: 30px;
        }

        .codigo-trabajo {
            width: 100%;
            margin-bottom: 0px;
        }

        .codigo-trabajo p {
            font-size: 12px;
            font-weight: unset;
        }

        label {
            width: 100%;
        }

        input {
            width: 100%;
            margin-bottom: -5px;
        }

        .name {
            width: 50%;
            float: left;
        }

        .phone {
            width: 50%;
            float: left;
        }

        .address {
            width: 50%;
            float: left;
        }

        .email {
            width: 50%;
            float: left;
        }

        .has_material {
            width: 20%;
            float: left;
        }

        .material {
            width: 80%;
            float: left;
        }

        .desc {
            width: 100%;
        }

        .obs {
            width: 100%;
        }

        .content-wrapper {
            margin-top: -10px;
        }

        .first {
            margin-bottom: 79px;
        }

        input[type="text"] {
            font-size: 12px;
            font-weight: unset;
        }

        textarea {
            font-size: 12px;
            font-weight: unset !important;
            font-family: Arial, Helvetica, sans-serif;
        }

        .ct {
            font-weight: bold;
        }

        input, textarea {
            min-height: 20px;
        }

        .row.h {
            height: 40px;
        }
    </style>
</head>
<body>
<div class="main first">
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('img/logo-lt.jpg') }}" alt="Logo">
        </div>
        <div class="title">
            <h1>RECEPCIÓ DE FEINA</h1>
        </div>
        <div class="info">
            <div class="fecha">
                <p>{{ $fecha }}</p>
            </div>
            <div class="hora">
                <p>{{ $hora }}</p>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="codigo-trabajo">
                <p><span class="ct">Codi de treball:</span> {{ $recepcion->code_id }}</p>
            </div>
        </div>
        <div class="row content-wrapper h">
            <div class="name">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" value="{{ $recepcion->full_name }}">
                </div>
            </div>
            <div class="phone">
                <div class="form-group">
                    <label for="phone">Telèfon</label>
                    <input type="text" value="{{ $phone }}">
                </div>
            </div>
        </div>
        <div class="row h">
            <div class="address">
                <div class="form-group">
                    <label for="address">Adreça</label>
                    <input type="text" value="{{ $address }}">
                </div>
            </div>
            <div class="email">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" value="{{ $email }}">
                </div>
            </div>
        </div>
        <div class="row h">
            <div class="has_material">
                <div class="form-group">
                    <label for="has_material">¿Deixa material?</label>
                    <input type="text" value="{{ $hasMaterial }}">
                </div>
            </div>
            <div class="material">
                <div class="form-group">
                    <label for="material">Material</label>
                    <input type="text" value="{{ $material }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="desc">
                <div class="form-group">
                    <label for="description">Descripció de la feina</label>
                    <textarea name="description" id="description">{{ $description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="obs">
                <div class="form-group">
                    <label for="observations">Observacions</label>
                    <textarea name="observations" id="observations">{{ $observations }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('img/logo-lt.jpg') }}" alt="Logo">
        </div>
        <div class="title">
            <h1>RECEPCIÓ DE FEINA</h1>
        </div>
        <div class="info">
            <div class="fecha">
                <p>{{ $fecha }}</p>
            </div>
            <div class="hora">
                <p>{{ $hora }}</p>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="codigo-trabajo">
                <p><span class="ct">Codi de treball:</span> {{ $recepcion->code_id }}</p>
            </div>
        </div>
        <div class="row content-wrapper h">
            <div class="name">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" value="{{ $recepcion->full_name }}">
                </div>
            </div>
            <div class="phone">
                <div class="form-group">
                    <label for="phone">Telèfon</label>
                    <input type="text" value="{{ $phone }}">
                </div>
            </div>
        </div>
        <div class="row h">
            <div class="address">
                <div class="form-group">
                    <label for="address">Adreça</label>
                    <input type="text" value="{{ $address }}">
                </div>
            </div>
            <div class="email">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" value="{{ $email }}">
                </div>
            </div>
        </div>
        <div class="row h">
            <div class="has_material">
                <div class="form-group">
                    <label for="has_material">¿Deixa material?</label>
                    <input type="text" value="{{ $hasMaterial }}">
                </div>
            </div>
            <div class="material">
                <div class="form-group">
                    <label for="material">Material</label>
                    <input type="text" value="{{ $material }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="desc">
                <div class="form-group">
                    <label for="description">Descripció de la feina</label>
                    <textarea name="description" id="description">{{ $description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="obs">
                <div class="form-group">
                    <label for="observations">Observacions</label>
                    <textarea name="observations" id="observations">{{ $observations }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
</body>