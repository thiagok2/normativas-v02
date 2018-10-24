@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>101</h3>

            <p>Documentos</p>
        </div>
        <div class="icon">
            <i class="ion ion-document-text"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3>532</h3>

            <p>Palavras Chaves</p>
        </div>
        <div class="icon">
            <i class="ion ion-grid"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3>2</h3>

            <p>Colaboradores</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3>1982</h3>

            <p>Consultas realizadas</p>
        </div>
        <div class="icon">
            <i class="ion ion-search"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-lg-9 col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Documentos mais acessados</h3>
            </div>
                <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 50%">Título</th>
                            <th>Palavras-chave</th>
                            <th>Fonte</th>
                            <th style="width: 40px">Tipo</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Resolução n.° 11.336, DE 05 DE ABRIL DE 2018.</td>
                            <td>
                                <span class="badge bg-secondary">Reforma</span>
                            </td>
                            <td>
                                Ministério da Educação - MEC
                            </td>
                            <td><span class="badge bg-red">Resolução</span></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Normativa CFE N.°10.659, DE 10 DE JUNHO DE 2015.</td>
                            <td>
                                <span class="badge bg-secondary">Educação Inclusiva</span>
                            </td>
                            <td>
                                CFE
                            </td>
                            <td><span class="badge bg-yellow">Instrução Normativa</span></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Nota Técnica de 24 de maio de 1996.</td>
                            <td>
                                <span class="badge bg-secondary">EAD</span>
                            </td>
                            <td>
                                CEE - Distrito Federal
                            </td>
                            <td>
                                <span class="badge bg-light-blue">Nota Técnica</span>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Parecer Orientativo sobre a organização curricular do ensino fundamental nas escolas especiais do
                                    Sistema Estadual de Ensino de Mato Grosso do Sul</td>
                            <td>
                                <span class="badge bg-secondary">Língua Estrangeira</span>
                                <span class="badge bg-secondary">Inglês</span>
                            </td>
                            <td>
                                CEE - Matogrosso do Sul
                            </td>
                            <td><span class="badge bg-green">Parecer</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
                <!-- /.box-body -->
        </div>
    </div>
    <div class="col-lg-3 col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Termos mais pesquisados</h3>
            </div>

            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 70%">Termos</th>
                            <th style="width: 25%"></th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Reforma</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 35%"></div>
                                </div>        
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Educação a distância</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                                </div>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Educação a Inclusiva</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 15%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Ensino Religioso</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 8%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Progressão</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" style="width: 6%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Palavras chaves mais referências nos documentos</h3>
            </div>

            <div class="box-body no-padding">
                <div id="myCanvasContainer">
                    <canvas width="400px" height="250px" id="myCanvas">
                        <p>Anything in here will be replaced on browsers that support the canvas element</p>
                        <ul>
                            <li><a href="/ead" target="_blank" data-weight="7">EAD</a></li>
                            <li><a href="/fish" data-weight="20">Educação Inclusiva</a></li>
                            <li><a href="/chips" data-weight="10">Reforma</a></li>
                            <li><a href="/salt" data-weight="14">Ensino Religioso</a></li>
                            <li><a href="/vinegar" data-weight="15">Inglês</a></li>
                            <li><a href="/vinegar" data-weight="10" >Espanhol</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EJA</a></li>
                            <li><a href="/fish" data-weight="10">Ed. Jovens e Adultos</a></li>
                            <li><a href="/chips" data-weight="15">Gênero</a></li>
                            <li><a href="/salt" data-weight="8">Política</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="7">Ensino Médio</a></li>
                            <li><a href="/chips" data-weight="5">Ensino Superior</a></li>
                            <li><a href="/salt" data-weight="3">Educação Infantil</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="4">História</a></li>
                            <li><a href="/chips" data-weight="8">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Filosofia</a></li>
                            <li><a href="/vinegar" data-weight="3">Sociologia</a></li>
                            <li><a href="/vinegar" data-weight="10">Biologia</a></li>
                            <li><a href="/chips" data-weight="5">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Química</a></li>
                            <li><a href="/vinegar" data-weight="8">Física</a></li>
                            <li><a href="/vinegar" data-weight="8">Matemática</a></li>
                            <li><a href="/vinegar" data-weight="9">Português</a></li>
                            <li><a href="/vinegar" data-weight="4">Redação</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EAD</a></li>
                            <li><a href="/fish" data-weight="20">Educação Inclusiva</a></li>
                            <li><a href="/chips" data-weight="10">Reforma</a></li>
                            <li><a href="/salt" data-weight="14">Ensino Religioso</a></li>
                            <li><a href="/vinegar" data-weight="15">Inglês</a></li>
                            <li><a href="/vinegar" data-weight="10" >Espanhol</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EJA</a></li>
                            <li><a href="/fish" data-weight="10">Jovens e Adultos</a></li>
                            <li><a href="/chips" data-weight="15">Gênero</a></li>
                            <li><a href="/salt" data-weight="8">Política</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="7">Ensino Médio</a></li>
                            <li><a href="/chips" data-weight="5">Ensino Superior</a></li>
                            <li><a href="/salt" data-weight="3">Educação Infantil</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="4">História</a></li>
                            <li><a href="/chips" data-weight="8">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Filosofia</a></li>
                            <li><a href="/vinegar" data-weight="3">Sociologia</a></li>
                            <li><a href="/vinegar" data-weight="10">Biologia</a></li>
                            <li><a href="/chips" data-weight="5">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Química</a></li>
                            <li><a href="/vinegar" data-weight="8">Física</a></li>
                            <li><a href="/vinegar" data-weight="8">Matemática</a></li>
                            <li><a href="/vinegar" data-weight="9">Português</a></li>
                            <li><a href="/vinegar" data-weight="4">Redação</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EAD</a></li>
                            <li><a href="/fish" data-weight="20">Educação Inclusiva</a></li>
                            <li><a href="/chips" data-weight="10">Reforma</a></li>
                            <li><a href="/salt" data-weight="14">Ensino Religioso</a></li>
                            <li><a href="/vinegar" data-weight="15">Inglês</a></li>
                            <li><a href="/vinegar" data-weight="10" >Espanhol</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EJA</a></li>
                            <li><a href="/fish" data-weight="10">Jovens e Adultos</a></li>
                            <li><a href="/chips" data-weight="15">Gênero</a></li>
                            <li><a href="/salt" data-weight="8">Política</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="7">Ensino Médio</a></li>
                            <li><a href="/chips" data-weight="5">Ensino Superior</a></li>
                            <li><a href="/salt" data-weight="3">Educação Infantil</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="4">História</a></li>
                            <li><a href="/chips" data-weight="8">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Filosofia</a></li>
                            <li><a href="/vinegar" data-weight="3">Sociologia</a></li>
                            <li><a href="/vinegar" data-weight="10">Biologia</a></li>
                            <li><a href="/chips" data-weight="5">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Química</a></li>
                            <li><a href="/vinegar" data-weight="8">Física</a></li>
                            <li><a href="/vinegar" data-weight="8">Matemática</a></li>
                            <li><a href="/vinegar" data-weight="9">Português</a></li>
                            <li><a href="/vinegar" data-weight="4">Redação</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EAD</a></li>
                            <li><a href="/fish" data-weight="20">Educação Inclusiva</a></li>
                            <li><a href="/chips" data-weight="10">Reforma</a></li>
                            <li><a href="/salt" data-weight="14">Ensino Religioso</a></li>
                            <li><a href="/vinegar" data-weight="15">Inglês</a></li>
                            <li><a href="/vinegar" data-weight="10" >Espanhol</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EJA</a></li>
                            <li><a href="/fish" data-weight="10">Jovens e Adultos</a></li>
                            <li><a href="/chips" data-weight="15">Gênero</a></li>
                            <li><a href="/salt" data-weight="8">Política</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="7">Ensino Médio</a></li>
                            <li><a href="/chips" data-weight="5">Ensino Superior</a></li>
                            <li><a href="/salt" data-weight="3">Educação Infantil</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="4">História</a></li>
                            <li><a href="/chips" data-weight="8">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Filosofia</a></li>
                            <li><a href="/vinegar" data-weight="3">Sociologia</a></li>
                            <li><a href="/vinegar" data-weight="10">Biologia</a></li>
                            <li><a href="/chips" data-weight="5">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Química</a></li>
                            <li><a href="/vinegar" data-weight="8">Física</a></li>
                            <li><a href="/vinegar" data-weight="8">Matemática</a></li>
                            <li><a href="/vinegar" data-weight="9">Português</a></li>
                            <li><a href="/vinegar" data-weight="4">Redação</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EAD</a></li>
                            <li><a href="/fish" data-weight="20">Educação Inclusiva</a></li>
                            <li><a href="/chips" data-weight="10">Reforma</a></li>
                            <li><a href="/salt" data-weight="14">Ensino Religioso</a></li>
                            <li><a href="/vinegar" data-weight="15">Inglês</a></li>
                            <li><a href="/vinegar" data-weight="10" >Espanhol</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EJA</a></li>
                            <li><a href="/fish" data-weight="10">Jovens e Adultos</a></li>
                            <li><a href="/chips" data-weight="15">Gênero</a></li>
                            <li><a href="/salt" data-weight="8">Política</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="7">Ensino Médio</a></li>
                            <li><a href="/chips" data-weight="5">Ensino Superior</a></li>
                            <li><a href="/salt" data-weight="3">Educação Infantil</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="4">História</a></li>
                            <li><a href="/chips" data-weight="8">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Filosofia</a></li>
                            <li><a href="/vinegar" data-weight="3">Sociologia</a></li>
                            <li><a href="/vinegar" data-weight="10">Biologia</a></li>
                            <li><a href="/chips" data-weight="5">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Química</a></li>
                            <li><a href="/vinegar" data-weight="8">Física</a></li>
                            <li><a href="/vinegar" data-weight="8">Matemática</a></li>
                            <li><a href="/vinegar" data-weight="9">Português</a></li>
                            <li><a href="/vinegar" data-weight="4">Redação</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EAD</a></li>
                            <li><a href="/fish" data-weight="20">Educação Inclusiva</a></li>
                            <li><a href="/chips" data-weight="10">Reforma</a></li>
                            <li><a href="/salt" data-weight="14">Ensino Religioso</a></li>
                            <li><a href="/eee" data-weight="15">Inglês</a></li>
                            <li><a href="/vinegar" data-weight="10" >Espanhol</a></li>
                            <li><a href="/ead" target="_blank" data-weight="7">EJA</a></li>
                            <li><a href="/fish" data-weight="10">Jovens e Adultos</a></li>
                            <li><a href="/chips" data-weight="15">Gênero</a></li>
                            <li><a href="/salt" data-weight="8">Política2</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento2</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="7">Ensino Médio</a></li>
                            <li><a href="/chips" data-weight="5">Ensino Superior</a></li>
                            <li><a href="/salt" data-weight="3">Educação Infantil</a></li>
                            <li><a href="/vinegar" data-weight="10">Letramento</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização</a></li>
                            <li><a href="/fish" data-weight="4">História</a></li>
                            <li><a href="/chips" data-weight="8">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Filosofia</a></li>
                            <li><a href="/vinegar" data-weight="3">Sociologia</a></li>
                            <li><a href="/vinegar" data-weight="10">Biologia</a></li>
                            <li><a href="/chips" data-weight="5">Geografia</a></li>
                            <li><a href="/salt" data-weight="4">Química</a></li>
                            <li><a href="/vinegar" data-weight="8">Física</a></li>
                            <li><a href="/vinegar" data-weight="8">Matemática</a></li>
                            <li><a href="/vinegar" data-weight="9">Português</a></li>
                            <li><a href="/vinegar" data-weight="4">Redação</a></li>
                        </ul>
                    </canvas>
                </div>
            </div>
            <div class="box-footer">
                
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-6 -->


    <div class="col-lg-4">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Palavras chaves pesquisadas</h3>
            </div>

            <div class="box-body no-padding">
                <div id="myCanvasContainer2">
                    <canvas width="400px" height="250px" id="myCanvas2">
                        <ul>
                            <li><a href="/ea2d2 target="_blank" data-weight="7">EAD1</a></li>
                            <li><a href="/fi12sh" data-weight="20">Educação Inclusiva1</a></li>
                            <li><a href="/ch2ips" data-weight="10">Reforma1</a></li>
                            <li><a href="/sw2qalt" data-weight="14">Ensino Religioso1</a></li>
                            <li><a href="/vin1egar" data-weight="15">Inglês1</a></li>
                            <li><a href="/viqwnegar" data-weight="10" >Espanhol1</a></li>
                            <li><a href="/ea2d" target="_blank" data-weight="7">EJA1</a></li>
                            <li><a href="/f123ish" data-weight="10">Ed. Jovens e Adultos1</a></li>
                            <li><a href="/ch3ips" data-weight="15">Gênero2</a></li>
                            <li><a href="/sealt" data-weight="8">Política1</a></li>
                            <li><a href="/vi3qnegar" data-weight="10">Letramento1</a></li>
                            <li><a href="/vinegar" data-weight="10">Alfabetização1</a></li>
                            <li><a href="/f3iasdsh" data-weight="7">Ensino Médio1</a></li>
                            <li><a href="/chieps" data-weight="5">Ensino Superior1</a></li>
                            <li><a href="/sa13lt" data-weight="3">Educação Infantil1</a></li>
                            <li><a href="/viqwnegar" data-weight="10">Letramento1</a></li>
                            <li><a href="/vin2egar" data-weight="10">Alfabetização1</a></li>

                        </ul>
                    </canvas>
                </div>
            </div>
            <div class="box-footer">
                
            </div>
        </div> <!-- end box -->
    </div> <!-- end col-4 -->

    <div class="col-lg-4">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Normativas - Conselhos estaduais</h3>
            </div>

            <div class="box-body">
                <div id="uf-chart" style="height: 300px;"></div>
            </div>

        </div>
    </div>
</div> <!-- end row-->


@stop