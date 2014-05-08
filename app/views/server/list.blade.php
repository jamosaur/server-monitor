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
                    <tr id="status{{ $server->id }}">
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
        make_call({{ $server->id }}, "{{ $server->ip }}", {{ ($server->port == null ? '80' : $server->port) }});
        @endforeach
    });

    function make_call(serverId, serverIp, serverPort = 80){

        $.getJSON("serverinfo/" + serverIp + "/" + serverPort, function(result){
            $("#status" + serverId).removeClass();
            $("#status" + serverId).addClass(result.status);
            $("#uptime" + serverId).html(result.uptime);
            $("#load" + serverId).html(result.load);
            $("#memory" + serverId).html(result.memory);
            $("#disk" + serverId).html(result.disk);

        });

    }
}
uptime();
setInterval(uptime, 10000);
</script>
@stop