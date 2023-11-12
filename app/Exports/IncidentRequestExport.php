<?php

namespace App\Exports;

use App\Models\IncidentRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncidentRequestExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $incidentRequests = IncidentRequest::all();
        return $incidentRequests->map(function ($incident) {
            return [
                'NUMBER' => $incident->number,
                'CALLER' => $incident->caller,
                'OPENED' => $incident->opened,
                'OPENED BY' => $incident->opened_by,
                'LOCATION' => $incident->location,
                'IMPACTED ITEM' => $incident->impacted_item,
                'CATEGORY' => $incident->category,
                'PRIORITY' => $incident->priority,
                'SHORT DESCRIPTION' => $incident->short_description,
                'DESCRIPTION' => $incident->description,
                'INCIDENT STATE' => $incident->incident_state,
                'ASSIGNED TO' => $incident->it_personnel_id ? \App\Models\User::whereId($incident->it_personnel_id)->value('name'): 'Not Assigned',
                'REMARKS' => $incident->remarks
            ];
        });
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['NUMBER', 'CALLER',	'OPENED', 'OPENED BY', 'LOCATION', 'IMPACTED ITEM',	'CATEGORY',	'PRIORITY',	'SHORT DESCRIPTION', 'DESCRIPTION',	'INCIDENT STATE', 'ASSIGNED  TO', 'REMARKS'];
    }
}
