<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\SideAchievement;
use Illuminate\Support\Facades\Crypt;
use App\Models\CompetitionParticipant;

class CertificateController extends Controller
{
    public function __construct(){

    }

    public function show($participant){
        $participant = Crypt::decrypt($participant);  
        $participant = CompetitionParticipant::find($participant);
        $claimableCertificate = CompetitionParticipant::join('competition_slot_details','competition_slot_details.id', 'competition_participants.competition_slot_id')
            ->join('competitions', 'competitions.id','competition_slot_details.competition_id') 
            ->join('competition_scores', 'competition_scores.participant_id','competition_participants.id')
            ->join('score_types', 'score_types.id','competition_scores.score_type_id')
            // ->join('participant_ranks', 'participant_ranks.id', 'competition_participants.rank_id')
            ->where('competition_participants.id',$participant->id)
            ->select(
                'competition_participants.id as id',
                'competition_participants.name as participant_name',
                'competition_participants.rank_id',
                'competition_scores.score_type_id',
                'competitions.name as competition_name',
                'competitions.logo as logo',
                // 'score_types.score_type as score_type',
                
                // 'participant_ranks.rank_name as rank_name',
        )
        ->orderBy('competition_scores.score_type_id','DESC')
        ->get();
        $claimableCertificate = $claimableCertificate[0];
        return view('certificates.show',[
            'certificate' => $claimableCertificate,
            'sideAchievements'=> SideAchievement::where('participant_id',$claimableCertificate->id)->get(),
        ]);
    }



    public function generate($type, $participant, $achievement = NULL){
        $participant = Crypt::decrypt($participant);
        if($achievement) $achievement = Crypt::decrypt($achievement);  
        $achievement = SideAchievement::find($achievement);
        $participant = CompetitionParticipant::find($participant);
        if($type == 'participant') { 
          if ($participant->rank->id == 0) {
            if ($participant->is_adjudicator)$title = "Adjudicator";
            else $title = "Participant";
          }
          else $title = $participant->rank->rank_name;

          if($participant->is_novice_debater) $title ="Novice ".$title;
        }

        elseif ($type == 'achievement') $title = $achievement->name;

        $output = '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>'. $title .' Certificate - ' . $participant->name . '</title>
            <link rel="icon" type="image/png" href="https://aeo.mybnec.org/storage/assets/icon_web.webp" sizes="32x32 100x100"  />
            <style>
              @import url("https://fonts.bunny.net/css?family=roboto:500");
        
              
              @page{
                margin: 0 !important;
              }
      
              .clearfix:after {
                content: "";
                display: table;
                clear: both;
              }

      

              body {
                position: relative;
                color: black;
                background: #F4F6F7;
                font-size: 12px;
                position: relative;
                font-family: "Roboto", sans-serif;
              }

              header {
                width: 100%;
              }

              .signText{
                margin-top:10px;
                margin-right: 15%;
                text-align: center;
              }

              #logo img {
                width: 100%
              }

          

              .text-center {
                
                text-align:center;
                margin-left: 0.5%
                color: black !important;
              }

          

              .name {
                position: absolute;
                top: 255px;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;    
                justify-content: center; 
                font-size: 33px;
                font-family: "Roboto", sans-serif;
                text-transform:capitalize;
                letter-spacing:1.5px;
                  
              }

              .sub-title{
                position: absolute;
                top: 393px;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;    
                justify-content: center; 
                font-family: "Roboto", sans-serif;
              }
              
              .rank {
                font-family: "Roboto", sans-serif;
                font-weight:bold;
              }

              .title {
                  margin-top: -42px;
                  font-size: 20px;
                  font-family: "Roboto", sans-serif;
                  margin-bottom: 3px;
                  letter-spacing:1.5px;
              }

              #thanks{
                font-size: 2em;
                margin-bottom: 50px;
              }

              #notices{
                page-break-before: always;
                margin-top: 40px;
                padding-left: 5px;
                border-left: 5px solid #1A8AAB;
              }

              #notices .notice {
                font-size: 1.2em;
              }
            </style>';

        $output .= '
          </head>
          <header class="clearfix">
            <div id="logo">
              <img src="https://aeo.mybnec.org/storage/assets/certif.jpg">
            </div>
          </header>

          <body>
            <main>
                <div class="text-center">
                    <p class="name">'.$participant->name.'
                    </p>
                    <div class="sub-title">
                        <p class="title">as the <span class="rank">' . $title . ' of ' . $participant->competition->name . '</span> in</p>
                    </div>
                </div>
            </main>
           
          </body>
        </html>';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream($title . " Certificate - " . $participant->name . ".pdf", array('Attachment' => 0));
    }
}
