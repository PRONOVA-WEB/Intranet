<style type="text/css">

.menu {
    display: none;
}

figure:active .menu,
figure:focus .menu {
    display: visible;
}
</style>

<style type="text/css">

	.seeBtn {
		color:blue;
	}
	.seeBtn:hover  {
		color:lightblue;
	}

</style>

<div wire:init="init">
   <div wire:loading>
              <i class="fas fa-spinner fa-pulse"></i>
        </div>

    @php
        $mInit = \Carbon\Carbon::createFromFormat('Y-m-d',  $actuallyYear."-".$actuallyMonth."-01");
        $mInit = explode(" ",$mInit);

        $mEnd = \Carbon\Carbon::createFromFormat('Y-m-d',  $actuallyYear."-".$actuallyMonth."-31");
        $mEnd = explode(" ",$mEnd);

    @endphp

    @livewire( 'rrhh.delete-shift',['startdate'=>$mInit[0],'enddate'=> $mEnd[0] ] )
    @livewire('rrhh.add-day-of-shift-modal')


    @if(isset($staffInShift) && count($staffInShift)>0 && $staffInShift!="" )
        @foreach($staffInShift->sortBy(function($staffInShift) {
            return $staffInShift->user->fathers_family;
          }) as $sis)
        @if( $sis->days()->whereBetween('day',[$mInit[0],$mEnd[0]])->count() > 0  || $actuallyShift->id == 99 )

            <tr>
                <td class="br cellbutton">

                    @livewire( 'rrhh.delete-shift-button',['actuallyShiftUserDay'=>$sis,'actuallyYear'=>$actuallyYear,'actuallyMonth'=>$actuallyMonth])

                    {{$sis->user->name}} {{$sis->user->fathers_family}} {{ $sis->user->runFormat()}}
                    <small>
                        @if( $sis->esSuplencia() == "Suplente" )
                            {{$sis->esSuplencia()}}
                        @else
                        <form method="POST" action="{{ route('rrhh.shiftManag.shiftupdate') }}">
                            @csrf
                            @method('POST')
                            <select class="form-control form-control-sm"  name="commentary" onchange="this.form.submit()">
                                <option value="titular" {{( $sis->esSuplencia() == "titular" )?"selected":""}} >Titular</option>
                                <option value="contrata" {{( $sis->esSuplencia() == "contrata" )?"selected":$sis->esSuplencia()}} >Contrata</option>
                                <option value="honorario" {{( $sis->esSuplencia() == "honorario" )?"selected":""}} >Honorario</option>
                            </select>
                            <input name="id" hidden value="{{$sis->id}}">
                        </form>
                        @endif
                    </small>
                </td>
                @for($j = 1; $j <= $days; $j++)
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d',  $actuallyYear."-".$actuallyMonth."-".$j);
                        $date =explode(" ",$date);
                        $d = $sis->days()->where('day',$date[0])->get();
                        $fontColor = '#fff';
                    @endphp
                    <td class="bbd day"  style="text-align:center;">
                            @if(isset($d))
                                @foreach($d as $dd)
                                    @php
                                        $iconDay = '';
                                        if (isset($dd->closeStatus))
                                        {
                                            switch ($dd->closeStatus->status) {
                                                case 1:
                                                    $iconDay = '<i class="	far fa-calendar-check"></i>';
                                                    break;
                                                case 2:
                                                    $iconDay = '<i class="far fa-calendar-times"></i>';
                                                    break;
                                                default:
                                                    $iconDay = '';
                                                    break;
                                            }
                                        }
                                    @endphp
                                    <a type="button" href="{{ route('rrhh.shiftManag.change-shift-day-status-form',['shiftUserDay'=>$dd,'monthYearFilter'=>$actuallyYear."-".$actuallyMonth]) }}" style="color:white;font-weight: bold;height: {{ ($d->count() > 1 ) ? '35px' : '70px' }};background-color:{{ $statusColors[$dd->status] }}" class="btnShiftDay btn btn-sm {{ ($loop->index==1 )?  'd-block' : 'btn btn-sm' }}">
                                        @if($dd->working_day!="F")
                                            {{$dd->working_day}}
                                        @else
                                            -
                                        @endif
                                    </a>
                                    {{-- <div wire:loading wire:target="editShiftDay">
                                          <i class="fas fa-spinner fa-pulse"></i>
                                    </div>
                                    <div wire:loading wire:target="actuallyColor">
                                          <i class="fas fa-spinner fa-pulse"></i>
                                    </div>
                                    @livewire('rrhh.change-shift-day-status',['shiftDay'=>$dd,'loop'=>$loop->index],key($dd->id) ) --}}
                                    {!! $iconDay !!}
                                @endforeach
                            @else
                                @livewire('rrhh.add-day-of-shift-button',['shiftUser'=>$sis,'day'=>$date])
                            @endif
                    </td>
                @endfor
            </tr>
        @endif
        @endforeach

        @else
            <td style="text-align:  center;" colspan="{{$days}}">SIN PERSONAL ASIGNADO </td>
        @endif

</div>
