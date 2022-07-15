<ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
    <li class="nav-item"><a class="nav-link" href="{{ url('/crud/builder')}}"> All </a></li>
    <li class="nav-item"><a class="nav-link @if($active == 'config') active @endif" href="{{ URL::to('crud/builder/config/'.$name)}}"> Info</a></li>
    <li class="nav-item">
        @if(isset($type) && $type =='blank')
        @else
        <a class="nav-link @if($active == 'sql') active @endif" href="{{ URL::to('crud/builder/sql/'.$name)}}"> SQL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active == 'table') active @endif" href="{{ URL::to('crud/builder/table/'.$name)}}"> Table</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active == 'form' or $active == 'subform') active @endif" href="{{ URL::to('crud/builder/form/'.$name)}}"> Form</a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link @if($active == 'permission') active @endif" href="{{ URL::to('crud/builder/permission/'.$name)}}"> Permission</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active == 'template') active @endif" href="{{ URL::to('crud/builder/template/'.$name)}}"> Template </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($active == 'rebuild') active @endif"href="javascript://ajax" onclick="SximoModal('{{ URL::to('crud/builder/build/'.$name)}}','Rebuild Module ')"> Rebuild</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Switch</a>
        <ul class="dropdown-menu">
            <?php $md = DB::table('crud')->where('type','!=','core')->get();
            foreach($md as $m) { ?>
            <li><a class="dropdown-item" href="{{ url('builder/'.$active.'/'.$m->name)}}">{{ $m->title}}</a></li>
            <?php } ?>
        </ul>
    </li>
</ul>