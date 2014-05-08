@extends('layout.base')
@section('title')
    
@stop
@section('content')

        <h1>Servers</h1>
        
        
        
        <div class="row">
            <div class="col-md-4 success">
                <div class="alert alert-success">
                    <p class="text-center">Server is up.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-warning">
                    <p class="text-center">Server is up, but info can't be retreived.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-danger">
                    <p class="text-center">Server is down.</p>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>Server Name</td>
                        <td>Server IP</td>
                        <td>Provider</td>
                        <td>Uptime</td>
                        <td width="15%">Load</td>
                        <td width="15%">Memory Free</td>
                        <td width="15%">Disk Free</td>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($servers as $server)
                {{ ServerHelper::connect($server->ip, $server->port) }}
                    <tr>
                    
                    <tr id="status{{ $server->id }}" class="kek">
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->ip }}</td>
                        <td>{{ $server->provider }}</td>
                        <td id="uptime{{ $server->id }}">0</td>
                        <td id="load{{ $server->id }}">0</td>
                        <td id="memory{{ $server->id }}">0</td>
                        <td id="disk{{ $server->id }}">0</td>
                    </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>

@stop

@section('js')
<script type="text/javascript">
function uptime(){
    $(function(){
        @foreach($servers as $server)
        $.getJSON("serverinfo/{{ $server->ip }}/{{ ($server->port == null ? '80' : $server->port) }}",function(result){
            $("#status{{ $server->id }}").removeClass();
            $("#status{{ $server->id }}").addClass(result.status);
            $("#uptime{{ $server->id }}").html(result.uptime);
            $("#load{{ $server->id }}").html(result.load);
            $("#memory{{ $server->id }}").html(result.memory);
            $("#disk{{ $server->id }}").html(result.disk);
            
        })
        @endforeach
    });
}
uptime();
setInterval(uptime, 10000);
</script>
@stop