<?php

namespace App\Exports;

use App\Models\Shedule;
use App\Models\Group;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ScheduleExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */



    public function collection()
    {
        return Shedule::select('id','lecture_hall','couple_number','group','teacher','item','parity_week','day','type_occupation')->get();
    }



    public function headings(): array
    {
        return [
            'ID',
            'Аудитория',
            'Номер пары',
            'Группа',
            'Преподаватель',
            'Предмет',
            'Четность недели',
            'День недели',
            'Тип занятий',
        ];
    }
}
