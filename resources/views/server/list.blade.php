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
                {{ \App\Http\Controllers\ServerController::connect($server->ip, $server->port) }}
                    <tr id="status{{ $server->id }}">
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->ip }}</td>
                        <td>{{ $server->provider }}</td>
                        <td id="uptime{{ $server->id }}">0</td>
                        <td id="load{{ $server->id }}">0</td>

                        <td id="memory{{ $server->id }}">
                            <div class="progress progress-striped active">
                                <div class="progress-bar" role="progressbar"></div>
                            </div>
                        </td>

                        <td id="disk{{ $server->id }}">
                            <div class="progress progress-striped active">
                                <div class="progress-bar" role="progressbar"></div>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

@stop

@section('js')
<script type="text/javascript">
function uptime(){

    @foreach($servers as $server)
        make_call({{ $server->id }}, "{{ $server->ip }}", {{ ($server->port == null ? '80' : $server->port) }});
    @endforeach

}

function make_call(serverId, serverIp, serverPort){

    $.getJSON("serverinfo/" + serverIp + "/" + serverPort, function(result){

        // Status
        var status = $("#status" + serverId);
        status.removeClass();
        status.addClass(result.status);

        // Up time
        $("#uptime" + serverId).html(result.uptime);

        // Memory
        var memory = $("#memory" + serverId + " .progress-bar");
        memory.css({ width: result.memory + '%' });
        memory.html(result.memory + '%');
        update_progress(memory, result.memory);

        // Load
        $("#load" + serverId).html(result.load);

        // Disk
        var disk = $("#disk" + serverId + " .progress-bar");
        disk.css({ width: result.disk + '%' });
        disk.html(result.disk + '%');
        update_progress(disk, result.disk);

    });

}

function update_progress(element, percent){

    if (percent >= "51") {
        element.removeClass().addClass("progress-bar progress-bar-success");
    } else if (percent <= "30") {
        element.removeClass().addClass("progress-bar");
    } else {
        element.removeClass().addClass("progress-bar progress-bar-danger");
    }

}

uptime();
setInterval(uptime, 30000);
</script>
@stop
