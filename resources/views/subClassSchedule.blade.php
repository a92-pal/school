<div class="mx-2">
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead style="background:#00d499;">
                <th style="min-width:120px;">Date</th>
                <th style="min-width:70px;">Day</th>
                <th style="min-width:110px;">Period 1</th>
                <th style="min-width:110px;">Period 2</th>
                <th style="min-width:110px;">Period 3</th>
                <th style="min-width:110px;">Period 4</th>
                <th style="min-width:110px;">Break</th>
                <th style="min-width:110px;">Period 5</th>
                <th style="min-width:110px;">Period 6</th>
                <th style="min-width:110px;">Period 7</th>
                <th style="min-width:110px;">Period 8</th>
            </thead>
            <tbody>
            <?php $routinDay=$res['routin_day']['days']; ?>
                @while(strtotime($firstDay)<=strtotime($lastDay))
                    <tr>
                        <?php 
                            $date=date('d F, Y',strtotime($firstDay));
                            $day=date('l',strtotime($firstDay));
                            $firstDay=date('d-m-Y',strtotime("+1 day",strtotime($firstDay))); 
                        ?>
                        <td style="background:#beffed;"><strong>{{$date}}<br><span class="">{{$day}}</span></strong></td>
                        @if($day=='Sunday' || $day=='Saturday')
                            <td style="background:#1bccbb;">--</td>
                            @for($p=0;$p<9;$p++)
                                <td style="background:#1bccbb;"><strong>Offday</strong></td>
                            @endfor
                        @else
                            @if(strtotime($date)<strtotime($res['start_date']))
                                <td style="background:#1bccbb;">--</td>
                                @for($s=0;$s<9;$s++)
                                    <td style="background:#1bccbb;"><strong>Offday</strong></td>                            @endfor
                            @else
                                <td>Day-{{$routinDay}}</td>
                                @if($routin['day-'.$routinDay]!=null)
                                    @for($p=1;$p<=4;$p++)
                                            <?php $count=1; ?>
                                            @foreach($routin['day-'.$routinDay] as $r)
                                                @if($r['period']==$p)
                                                    <td>
                                                        <strong>{{$r['subject']}}</strong><br>({{$r['teacher']}})
                                                    </td>
                                                @break
                                                @else
                                                    @if($count==sizeof($routin['day-'.$routinDay]))
                                                    <td class="text-muted">No Class</td>
                                                    @endif
                                                @endif
                                                <?php $count++; ?>
                                            @endforeach
                                    @endfor
                                @else
                                    @for($blnk=1; $blnk<=4; $blnk++)
                                        <td class="text-muted">No Class</td>
                                    @endfor
                                @endif    
                                <td style="background:#bcfcff;"><h6 style="margin: 12px 0;">Break </h6></td>
                                @if($routin['day-'.$routinDay]!=null)
                                    @for($p=5;$p<=8;$p++)
                                        <?php $count=1; ?>
                                        @foreach($routin['day-'.$routinDay] as $r)
                                            @if($r['period']==$p)
                                                <td>
                                                    <strong>{{$r['subject']}}</strong><br>({{$r['teacher']}})
                                                </td>
                                            @break
                                            @else
                                                @if($count==sizeof($routin['day-'.$routinDay]))
                                                <td class="text-muted">No Class</td>
                                                @endif
                                            @endif
                                            <?php $count++; ?>
                                        @endforeach
                                    @endfor
                                @else
                                    @for($blnk=5; $blnk<=8; $blnk++)
                                        <td class="text-muted">No Class</td>
                                    @endfor
                                @endif
                                <?php 
                                    if($routinDay==5) $routinDay=1;
                                    else $routinDay++;
                                ?>
                            @endif
                        @endif
                    </tr>
                @endwhile
            </tbody>
        </table>
    </div>
    </div>