{{-- <div style=" display: inline;">
    @if (isset($usr) && $usr != '')
        <button class="btn btn-sm btn-info mt-2" data-toggle="modal" data-target="#shiftcontrolformmodal{{ $usr->id }}"
            data-backdrop="static">
            <i class="fa fa-eye " wire:click.prevent="setValues({{ $usr->id }})"></i> Ver
        </button>
    @endif
</div> --}}
<div wire:ignore.self class="modal fade1" id="shiftcontrolformmodal{{ $usr->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#006cb7;color:white   ">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-clock"></i> Planilla de control de
                    Turnos <small><b>#ID Cierre {{ $cierreDelMes->id }}</b> </small></h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table tblShiftControlForm table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: left;">RUT</th>
                            <td>
                                @if (isset($usr))
                                    {{ strtoupper($usr->runFormat()) }}
                                @else
                                    <i class="fas fa-spinner fa-pulse"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Nombre y Apellido </th>
                            <td>
                                @if (isset($usr))
                                    {{ strtoupper($usr->full_name_upper) }}
                                @else
                                    <i class="fas fa-spinner fa-pulse"></i>
                                @endif
                            </td>
                        <tr>
                            <th style="text-align: left;">Rango de Cierre</th>
                            <td>
                                @if (isset($usr))
                                    {{ dateCustomFormat($cierreDelMes->init_date).' AL '.dateCustomFormat($cierreDelMes->close_date) }}
                                @else
                                    <i class="fas fa-spinner fa-pulse"></i>
                                @endif
                            </td>
                        </tr>
                    </thead>
                </table>
                <div class="table-responsive table-wrapper">
                    <table class="table tblShiftControlForm">
                        <thead>
                            <tr>
                                <th>TURNO</th>
                                <th>FECHA</th>
                                <th>DÍA</th>
                                <th colspan="2">HORARIO</th>
                                <th>OBSERVACION DE DATOS OBLIGATORIOS</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th></th>
                            </tr>
                        </thead>
                        @php
                            $total = 0;
                        @endphp
                        <tbody>
                            @if ($close != 0)
                                @php
                                    $ranges = \Carbon\CarbonPeriod::create($cierreDelMes->init_date, $cierreDelMes->close_date);
                                @endphp
                                @foreach ($ranges as $date)
                                    @php
                                        $d = $daysForClose->where('day', $date->format('Y-m-d'));
                                    @endphp
                                    @foreach ($d as $dd)
                                        @php
                                            // $userDay = App\Models\Rrhh\ShiftUserDay::where('day',$dd->day)
                                            //                                         ->whereHas('ShiftUser', function($q) use($usr) {
                                            //                                             $q->where('user_id',$usr->id);
                                            //                                         })
                                            //                                         ->first();
                                            $turno = \DB::table('rrhh_shift_user_days')
                                                        ->select('rrhh_shift_types.shortname')
                                                        ->join('rrhh_shift_users', 'shift_user_id', '=', 'rrhh_shift_users.id')
                                                        ->join('rrhh_shift_types', 'rrhh_shift_types.id', '=', 'rrhh_shift_users.shift_types_id')
                                                        ->where('rrhh_shift_user_days.day', $dd->day)
                                                        ->where('rrhh_shift_users.user_id',$usr->id)
                                                        ->first();
                                            // dd($turno->shortname);
                                        @endphp
                                        <tr>
                                            <td>{{ $turno->shortname }}</td>
                                            <td>{{ $date->format('d/m') }} </td>
                                            <td> {{ $dd->working_day != 'F' ? $dd->working_day : '-' }} </td>
                                            @if ($date->isPast())
                                                <td>{{ isset($timePerDay[$dd->working_day]) ? $timePerDay[$dd->working_day]['from'] : '' }}
                                                </td>
                                                <td>{{ isset($timePerDay[$dd->working_day]) ? $timePerDay[$dd->working_day]['to'] : '' }}
                                                </td>
                                                <td>{{ isset($timePerDay[$dd->working_day])? ($dd->status == 1? 'Completado': ucfirst($shiftStatus[$dd->status])): '' }}
                                                    - <small
                                                        style="color:{{ $dd->confirmationStatus() == 1 ? 'green;' : 'red;' }}">
                                                        {{ $dd->confirmationStatus() == 1 ? 'Confirmado' : 'Sin Confirmar' }}</small>
                                                </td>
                                                @if ($dd->confirmationStatus() == 1)
                                                    @php
                                                        if (substr($dd->working_day, 0, 1) != '+') {
                                                            $total += isset($timePerDay[$dd->working_day]) ? $timePerDay[$dd->working_day]['time'] : 0;
                                                        } else {
                                                            $total += intval(substr($dd->working_day, 1, 2));
                                                        }
                                                    @endphp
                                                @endif
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                @if (isset($days) && $days > 0)
                                    @for ($i = 1; $i < $days + 1; $i++)
                                        @php
                                            $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $actuallyYears . '-' . $actuallyMonth . '-' . $i);
                                            $date = explode(' ', $date2);

                                            if (isset($shifsUsr) && isset($shifsUsr->days)) {
                                                $d = $shifsUsr
                                                    ->days()
                                                    ->where('day', $date[0])
                                                    ->get();
                                            } else {
                                                $d = [];
                                            }
                                        @endphp
                                        @foreach ($d as $dd)
                                            <tr>
                                                <td>{{ $i }} </td>
                                                <td>
                                                    {{ $dd['working_day'] != 'F' ? $dd['working_day'] : '-' }}
                                                </td>
                                                @if ($date2->isPast())
                                                    <td>{{ isset($timePerDay[$dd['working_day']]) ? $timePerDay[$dd['working_day']]['from'] : '' }}
                                                    </td>
                                                    <td>{{ isset($timePerDay[$dd['working_day']]) ? $timePerDay[$dd['working_day']]['to'] : '' }}
                                                    </td>
                                                    <td>{{ isset($timePerDay[$dd['working_day']])? ($shiftStatus[$dd['status']] == 'asignado'? 'Completado': ucfirst($shiftStatus[$dd['status']])): '' }}
                                                        - <small
                                                            style="color:{{ $dd->confirmationStatus() == 1 ? 'green;' : 'red;' }}">
                                                            {{ $dd->confirmationStatus() == 1 ? 'Confirmado' : 'Sin Confirmar' }}</small>
                                                    </td>
                                                    @if ($dd->confirmationStatus() == 1)
                                                        @php
                                                            if (substr($dd['working_day'], 0, 1) != '+') {
                                                                $total += isset($timePerDay[$dd['working_day']]) ? $timePerDay[$dd['working_day']]['time'] : 0;
                                                            } else {
                                                                $total += intval(substr($dd['working_day'], 1, 2));
                                                            }
                                                        @endphp
                                                    @endif
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endfor
                                @else
                                    <tr>
                                        <td>
                                            <i class="fas fa-spinner fa-pulse"></i>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            <tr>
                                <th>TOTAL</th>
                                <td>{{ $total }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn"
                    data-dismiss="modal">Cerrar</button>
                <form method="post" action="{{ route('rrhh.shiftManag.downloadform') }}" target="_blank">
                    @csrf
                    <input style=" display:none;" name="days" value="{{ $days }}">
                    <input style=" display:none;" name="actuallyMonth" value="{{ $actuallyMonth }}">
                    <input style=" display:none;" name="actuallyYears" value="{{ $actuallyYears }}">
                    <input style=" display:none;" name="shifsUsr" value="{{ $shifsUsr }}">
                    <input style=" display:none;" name="close" value="{{ $close }}">
                    <input style=" display:none;" name="actuallyUser" value="{{ $usr->id }}">
                    <button class="btn btn-success " target="_blank">Planilla <i class="fas fa-file-download"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
