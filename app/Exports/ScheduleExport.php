<?php

namespace App\Exports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScheduleExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return Schedule::select('id','lecture_hall','couple_number','group_id','teacher_id','item_id','parity_week','day','type')->get();
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
