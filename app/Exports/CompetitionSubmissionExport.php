<?php

namespace App\Exports;

use App\Models\Competition;
use App\Models\CompetitionSubmissions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CompetitionSubmissionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
   public function __construct($competition)
    {
        $this->competition = $competition;
    }

    public function getCompetition()
    {
        $competition = Competition::where('id', $this->competition)->first();
        return $competition;
    }
    
    
    public function collection()
    {
        if ($this->getCompetition()->need_team) {
            $result = CompetitionSubmissions::join('competition_teams', 'competition_teams.id', 'competition_submissions.submitter_id')
                ->join('competition_participants', 'competition_participants.team_id', 'competition_teams.id')
                ->join('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                ->join('users', 'users.id', 'competition_slot_details.pic_id')
                ->where('competition_submissions.competition_id', $this->getCompetition()->id)
                ->whereNull('competition_submissions.deleted_at')
                ->select(
                    'competition_submissions.submitter_id',
                    'competition_teams.name as team_name',
                    'users.institution_name',
                    'competition_participants.name as participant_name',
                    'competition_submissions.title',
                    'competition_submissions.submission_link',
                    'competition_submissions.created_at'
                )
                ->orderBy('submitter_id')
                ->get();
        }else {
            $result = CompetitionSubmissions::join('competition_participants', 'competition_participants.id', 'competition_submissions.submitter_id')
                ->join('competition_slot_details', 'competition_slot_details.id', 'competition_participants.competition_slot_id')
                ->join('users', 'users.id', 'competition_slot_details.pic_id')
                ->where('competition_submissions.competition_id', $this->getCompetition()->id)
                ->select(
                    'competition_submissions.submitter_id',
                    'users.institution_name',
                    'competition_participants.name as participant_name',
                    'competition_submissions.title',
                    'competition_submissions.submission_link',
                    'competition_submissions.created_at'
                )
                ->orderBy('submitter_id')
                ->get();
        }
        foreach($result as $res) {
            $res->created_at = date('Y-m-d H:i:s', strtotime($res->created_at));
        }
        return $result;

        
    }

    public function headings(): array
    {
        if ($this->getCompetition()->need_team) {
            return ["Team ID", "Team Name", "Institution Name", "Member Name", "Submission Title", "Submission Link", "Submitted At"];
        }else {
            return ["Participant ID", "Institution Name", "Participant Name", "Submission Title", "Submission Link", "Submitted At"];
        }
    }

    public function registerEvents(): array 
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:G1')->ApplyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ]
                ]);
                $event->sheet->getStyle('A')->ApplyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ]
                ]);
            }
        ];
    }
}
