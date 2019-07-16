@extends('adminlte::page')

@section('title', 'Normativas')

@section('content_header')
    
@stop

@section('content')
    <ol class="breadcrumb">
    <li><a href="{{route('home')}}">Painel</a></li>
        <li> <a href="#" class="active"><a href="#">Status</a></li>
    </ol>
    <div class="page-header">
        <h1>Status do Servidor ElasticSearch</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-lg btn-info" href="{{route('etl-comandos')}}">Logs ETL</a>
                <a class="btn btn-lg btn-primary" href="{{route('getenv')}}">Ambiente (ENV)</a><br/><br/>
            </div>            
        </div>

        <div class="box box-info">
            <div class="box-header with-border">                
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#health">Health</a></li>
                    <li><a data-toggle="tab" href="#nodes">Nodes</a></li>
                    <li><a data-toggle="tab" href="#indices">Indices</a></li>
                    <li><a data-toggle="tab" href="#allocation">Allocation</a></li>
                    <li><a data-toggle="tab" href="#shards">Shards</a></li>                    
                </ul>                   
            </div><!-- end box-header -->
            
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">            
                        <div class="tab-content">
                            <div id="health" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr>                                    
                                                    <td>EPOCH</td>
                                                    <td>{{$health[0]["epoch"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>TIMESTAMP</td>
                                                    <td>{{$health[0]["timestamp"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>CLUSTER</td>
                                                    <td>{{$health[0]["cluster"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>STATUS</td>
                                                    <td>{{$health[0]["status"]}}</td>
                                                </tr>   
                                                <tr>                                    
                                                    <td>TOTAL NODE</td>
                                                    <td>{{$health[0]["node.total"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>NODE DATA</td>
                                                    <td>{{$health[0]["node.data"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>SHARDS</td>
                                                    <td>{{$health[0]["shards"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>PRI</td>
                                                    <td>{{$health[0]["pri"]}}</td>
                                                </tr>           
                                                <tr>                                    
                                                    <td>RELO</td>
                                                    <td>{{$health[0]["relo"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>INIT</td>
                                                    <td>{{$health[0]["init"]}}</td>
                                                </tr>   
                                                <tr>                                    
                                                    <td>UNASSIGN</td>
                                                    <td>{{$health[0]["unassign"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>PENDING TASKS</td>
                                                    <td>{{$health[0]["pending_tasks"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>MAX TASK WAIT TIME</td>
                                                    <td>{{$health[0]["max_task_wait_time"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>ACTIVE SHARDS PERCENT</td>
                                                    <td>{{$health[0]["active_shards_percent"]}}</td>
                                                </tr>                                                                                 
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!--end row -->                                                      
                            </div><!--end tab-pane -->
        
                            <div id="nodes" class="tab-pane fade">                                
                                <div class="row">
                                    <div class="col-sm-12">                                                 
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr>                                    
                                                    <td>IP</td>
                                                    <td>{{$nodes[0]["ip"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>HEAP PERCENT</td>
                                                    <td>{{$nodes[0]["heap.percent"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>RAM PERCENT</td>
                                                    <td>{{$nodes[0]["ram.percent"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>CPU</td>
                                                    <td>{{$nodes[0]["cpu"]}}</td>
                                                </tr>   
                                                <tr>                                    
                                                    <td>LOAD 1M</td>
                                                    <td>{{$nodes[0]["load_1m"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>LOAD 5M</td>
                                                    <td>{{$nodes[0]["load_5m"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>LOAD 15M</td>
                                                    <td>{{$nodes[0]["load_15m"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>NODE ROLE</td>
                                                    <td>{{$nodes[0]["node.role"]}}</td>
                                                </tr>           
                                                <tr>                                    
                                                    <td>MASTER</td>
                                                    <td>{{$nodes[0]["master"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>NAME</td>
                                                    <td>{{$nodes[0]["name"]}}</td>
                                                </tr>                                                                                                                                   
                                            </tbody>
                                        </table>
                                    </div>                                        
                                </div><!--end row -->                                                                                                                           
                            </div><!--end tab-pane -->

                            <div id="indices" class="tab-pane fade">                                
                                <div class="row">
                                    <div class="col-sm-12"> 
                                        @foreach ($indices as $indice)
                                            @if ($indice['index']=='normativas')
                                            <table class="table table-striped table-hover">
                                                    <tbody>                                                                                    
                                                        <tr>                                    
                                                            <td>HEALTH</td>
                                                            <td>{{$indices[0]["health"]}}</td>
                                                        </tr>                                
                                                        <tr>                                    
                                                            <td>STATUS</td>
                                                            <td>{{$indices[0]["status"]}}</td>
                                                        </tr>                             
                                                        <tr>                                    
                                                            <td>INDEX</td>
                                                            <td>{{$indices[0]["index"]}}</td>
                                                        </tr>                                
                                                        <tr>                                    
                                                            <td>UUID</td>
                                                            <td>{{$indices[0]["uuid"]}}</td>
                                                        </tr>   
                                                        <tr>                                    
                                                            <td>PRI</td>
                                                            <td>{{$indices[0]["pri"]}}</td>
                                                        </tr>                                
                                                        <tr>                                    
                                                            <td>REP</td>
                                                            <td>{{$indices[0]["rep"]}}</td>
                                                        </tr>                             
                                                        <tr>                                    
                                                            <td>DOCS COUNT</td>
                                                            <td>{{$indices[0]["docs.count"]}}</td>
                                                        </tr>                                
                                                        <tr>                                    
                                                            <td>DOCS DELETED</td>
                                                            <td>{{$indices[0]["docs.deleted"]}}</td>
                                                        </tr>           
                                                        <tr>                                    
                                                            <td>STORE SIZE</td>
                                                            <td>{{$indices[0]["store.size"]}}</td>
                                                        </tr>                                
                                                        <tr>                                    
                                                            <td>PRI STORE SIZE</td>
                                                            <td>{{$indices[0]["pri.store.size"]}}</td>
                                                        </tr>                                                                                                                                   
                                                    </tbody>
                                                </table>
                                            @endif
                                        @endforeach                                                                                        
                                    </div>                                        
                                </div><!--end row -->                                                                                                                           
                            </div><!--end tab-pane -->

                            <div id="allocation" class="tab-pane fade">                                
                                <div class="row">
                                    <div class="col-sm-12">                                                 
                                        <table class="table table-striped table-hover">                                                            
                                            <tbody>
                                                <tr>                                    
                                                    <td>SHARDS</td>
                                                    <td>{{$allocation[0]["shards"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>DISK INDICES</td>
                                                    <td>{{$allocation[0]["disk.indices"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>DISK USED</td>
                                                    <td>{{$allocation[0]["disk.used"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>DISK AVAILABLE</td>
                                                    <td>{{$allocation[0]["disk.avail"]}}</td>
                                                </tr>   
                                                <tr>                                    
                                                    <td>DISK TOTAL</td>
                                                    <td>{{$allocation[0]["disk.total"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>DISK PERCENT</td>
                                                    <td>{{$allocation[0]["disk.percent"]}}</td>
                                                </tr>                             
                                                <tr>                                    
                                                    <td>HOST</td>
                                                    <td>{{$allocation[0]["host"]}}</td>
                                                </tr>                                
                                                <tr>                                    
                                                    <td>IP</td>
                                                    <td>{{$allocation[0]["ip"]}}</td>
                                                </tr>           
                                                <tr>                                    
                                                    <td>NODE</td>
                                                    <td>{{$allocation[0]["node"]}}</td>
                                                </tr>                                                                                                                                                                                                                
                                            </tbody>
                                        </table>
                                    </div>                                        
                                </div><!--end row -->                                                                                                                           
                            </div><!--end tab-pane -->

                            <div id="shards" class="tab-pane fade">                                
                                <div class="row">                                        
                                    <div class="col-sm-12">                                                 
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                @foreach ($shards as $shard)
                                                    <tr>                                    
                                                        <th>INDEX</th>
                                                        <th>SHARD</th>
                                                        <th>PRIREP</th>
                                                        <th>STATE</th>
                                                        <th>DOCS</th>
                                                        <th>STORE</th>
                                                        <th>IP</th>
                                                        <th>NODE</th>                                                        
                                                    </tr>                                
                                                    <tr>                                                                                            
                                                        <td>{{$shard["index"]}}</td>
                                                        <td>{{$shard["shard"]}}</td>
                                                        <td>{{$shard["prirep"]}}</td>
                                                        <td>{{$shard["state"]}}</td>
                                                        <td>{{$shard["docs"]}}</td>
                                                        <td>{{$shard["store"]}}</td>
                                                        <td>{{$shard["ip"]}}</td>
                                                        <td>{{$shard["node"]}}</td>
                                                    </tr>                                                        
                                                @endforeach                                                
                                                                                                
                                            </tbody>
                                        </table>
                                    </div>                                        
                                </div><!--end row -->                                                                                                                           
                            </div><!--end tab-pane -->
                        </div><!--end tab-content -->                                                                                                                                                                                                
                    </div><!--end col -->
                </div><!--end row -->
            </div><!-- end box-body -->  
        </div><!-- end box-->   
@stop