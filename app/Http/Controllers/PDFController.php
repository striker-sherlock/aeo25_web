<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CompetitionPayment;
use Illuminate\Support\Facades\DB;
use App\Models\AccommodationPayment;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function viewInvoice(User $user, $id)
    {
        if($id == 0){
            $slots = DB::table('competition_slot_details')
                ->join('competitions', 'competition_slot_details.competition_id', '=', 'competitions.id')
                ->select(
                    'competition_slot_details.*',
                    'competitions.name',
                    'competitions.price',
                    'competitions.id',
                )
                ->where('competition_slot_details.pic_id', '=', $user->id)
                ->where('competition_slot_details.is_confirmed', '=', 1)
                ->where('competition_slot_details.payment_id', '=', null)
                ->orderby('updated_at', 'DESC')
                ->get();
        } else {
            $slots = DB::table('competition_slot_details')
                ->join('competitions', 'competition_slot_details.competition_id', '=', 'competitions.id')
                ->select(
                    'competition_slot_details.*',
                    'competitions.name',
                    'competitions.price',
                    'competitions.id'
                )
                ->where('competition_slot_details.id' ,'=', $id)
                ->where('competition_slot_details.pic_id', '=', $user->id)
                ->where('competition_slot_details.is_confirmed', '=', 1)
                ->where('competition_slot_details.payment_id', '=', null)
                ->orderby('updated_at', 'DESC')
                ->get();
        }
        

        if(count( $slots ) == 0){
            return redirect()->back()->with('error', 'Confirmed Slot Not Found');
        }

        $latestUpdate = $slots[0]->updated_at;
        $invoiceCode = date('mdhi',strtotime($slots[0]->updated_at));

        $output = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
            ';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 01' . '</title>';
        } else {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 02' . '</title>';
        }
        $output .= '
                <style>
                @import url(https://fonts.bunny.net/css?family=roboto:500);

                @page{
                margin-top: 0;
                margin-left: 1.2cm;
                width: 21cm;
                height: 29.7cm;
                }
                
                .clearfix:after {
                content: "";
                display: table;
                clear: both;
                }

                a {
                color: #0087C3;
                text-decoration: none;
                }

                body {
                position: relative;
                width: 21cm;
                height: 29.7cm;
                margin: 0 1px 0 1px;
                color: #555555;
                background: #FFFFFF;
                font-family: "Roboto", sans-serif;
                font-size: 13px;
                }

                header {
                width: 94%;
                }

                .signText{
                margin-top: 50px;
                margin-right: 15%;
                text-align: center;
                }

                #logo
                float: left;
                }

                #logo img {
                width: 100%
                }

                #details {
                margin-bottom: 20px;
                }

                #client {
                padding-left: 3px;
                border-left: 5px solid #F175AD;
                float: left;
                }

                #client .to {
                color: #777777;
                }

                h2.name {
                font-size: 1em;
                font-weight: normal;
                font-family: "Roboto";
                margin: 0;
                }

                #invoice {
                float: right;
                text-align: right;
                }

                #invoice h1 {
                color: #0087C3;
                font-size: 1.6em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 8px 0;
                }

                #invoice .date {
                font-size: 1em;
                color: #777777;
                }

                table {
                width: 90%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 1px;
                }

                table th,
                table td {
                padding: 3px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
                }

                table th {
                font-weight: normal;
                }

                table td {
                text-align: left;
                }

                table td h3{
                color: #777777;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
                }

                table .no {
                color: #FFFFFF;
                font-size: 1em;
                background: #DDDDDD;
                }

                table .desc {
                text-align: left;
                }

                table .unit {
                background: #7FBCD2;
                color: #FFFFFF;
                }

                table .total {
                background: #80679e;
                color: #FFFFFF;
                }

                table td.unit,
                table td.qty,
                table td.total {
                font-size: 1em;
                }

                table tbody tr:last-child td {
                border: none;
                }

                #signature {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    width: 50%;
                    height: 70px;
                }

                table tfoot td {
                padding: 2px 5px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1em;
                white-space: nowrap;
                border-top: 1px solid #9fcfe6;
                }

                footer {
                    color: #777777;
                    width: 90%;
                    height: 20px;
                    position: absolute;
                    bottom: 0;
                    padding: 5px 0;
                    text-align: center;
                }

                table tfoot tr:first-child td {
                border-top: none;
                }

                table tfoot tr:last-child td {
                color: #0095CC;
                font-size: 1.2em;
                border-top: 1px solid #275DA3

                }

                table tfoot tr td:first-child {
                border: none;
                }

                #thanks{
                font-size: 2em;
                margin-bottom: 50px;
                }

                #notices{
                page-break-before: always;
                margin-top: 40px;
                padding-left: 5px;
                }

                #notices {
                font-size: 1.1em;
                }
                #notices li{
                margin: 8px 0px;
                }
                </style>';


        $output .= ' 
            </head>
            <header class="clearfix">
                <div id="logo">
                <img src="https://aeo.mybnec.org/storage/assets/letterhead-aeo-fixed.png">
                </div>
            </header>
            <body>
                <main>
                <div id="details" class="clearfix" style="margin-top:20px">
                    <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name">' . $user->institution_name . '</h2>
                    <div class="address">' . $user->pic_name . '</div>
                    <div class="address">' . $user->country->name . '</div>';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <div class="email">Invoice ID - 01' . $invoiceCode . '</div>';
        } else {
        $output .= '
                    <div class="email">Invoice ID - 02' . $invoiceCode . '</div>';
        }
        $output .= '
                    <div class="email">Time: '. $latestUpdate .' (GMT +7)</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="desc" colspan="2" style="text-align:center;">FIELD</th>
                        <th class="unit">PRICE</th>
                        <th class="qty">QUANTITY</th>
                        <th class="total">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>';
        $grandTotal = 0;
        foreach($slots as $slot){

            if($slot->id == "DB" || $slot->id == "RD"){
                $participant = "Team(s)";
            } else {
                $participant = "Person(s)";
            }

            $output .= '
                         <tr>
                             <td class="desc" colspan="2"><h3>'.$slot->name.'</h3></td>
                             <td class="unit"> IDR ' . $slot->price . '</td>
                             <td class="qty">' . $slot->quantity .' '. $participant .' </td>
                             <td class="total"> IDR ' . ($slot->quantity * $slot->price) . '</td>
                         </tr>';
             $grandTotal += ($slot->quantity * $slot->price);
        }

        $output .= '
                    </tbody>
                    <tfoot>
                    <tr>
                    <td style="padding-bottom: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2"><h3>GRAND TOTAL</h3></td>
                        <td>IDR ' . $grandTotal . '</td>
                    </tr>';
                    
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <tr>
                    <td colspan="2"></td>
                    <td colspan="2">ADDITIONAL CHARGES</td>
                    <td>USD 20 - USD 35*</td>
                    </tr>';
        }
        $output .= '
                    </tfoot>
                </table>';
        if ($user->country->name != 'Indonesia') {
        $output  .= '
                <p>The payment will be transferred via International Bank or TransferWise to our Bank Account</p>';
        } else {
        $output  .= '
                    <p>The payment will be transferred via National Bank to our Bank Account</p>';
        }
        $output .= '
                        <table class="border="1" cellspacing="0" cellpadding="0"">
                            <tbody>';
        if ($user->country->name != 'INDONESIA') {
        $output .= '
                                    <tr>
                                        <td>Email</td>
                                        <td>: rahmadira.herdiningtyas@binus.ac.id</td>
                                    </tr>
                                    ';
        }
        $output .= '
                                    <tr>
                                        <td>Bank Name</td>
                                        <td>: Bank Central Asia</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Account Number</td>
                                        <td>: 5271 848 871</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Account Name</td>
                                        <td>: Rahmadira Febi Herdiningtyas</td>
                                    </tr>';
        if ($user->country->name != 'INDONESIA') {
        $output .= '
                                        <tr>
                                        <td>Swift Code</td>
                                        <td>: CENAIDJA</td>
                                        </tr>
                                        ';
        }
        $output .= '
                            </tbody>
                        </table>
                        ';

        $output .= '
                <div class="signText">
                Approved By, <br>
                <img id="signature" src="https://aeo.mybnec.org/storage/assets/pm-signature.jpg" ><br>
                <b>Michelle Natasya</b><br>
                Project Manager<br>
                The 2023 Asian English Olympics
                </div>';
    
        $output .= '
                </main>
            </body>
            </html>';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        if ($user->country->name != 'Indonesia') {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 01.pdf", array('Attachment' => false));
        } else {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 02.pdf", array('Attachment' => false));
        }
        
    }

    public function paidInvoice(CompetitionPayment $payment)
    {
        $user = User::where('id' ,$payment->pic_id)->first();

        $slots = DB::table('competition_slot_details')
                ->join('competitions', 'competition_slot_details.competition_id', '=', 'competitions.id')
                ->select(
                    'competition_slot_details.*',
                    'competitions.name',
                    'competitions.price',
                    'competitions.id'
                )
                ->where('competition_slot_details.payment_id', '=', $payment->id)
                ->where('competition_slot_details.pic_id', '=', $payment->pic_id)
                ->orderby('updated_at', 'DESC')
                ->get();
        

        if(count($slots) == 0){
            return redirect()->back()->with('error', 'Confirmed Slot Not Found');
        }

        $latestUpdate = $slots[0]->updated_at;
        $invoiceCode = date('mdhi',strtotime($slots[0]->updated_at));

        $output = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
            ';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 01' . '</title>';
        } else {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 02' . '</title>';
        }
        '<link rel="preconnect" href="https://fonts.googleapis.com">';
        '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
         '<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">';

        $output .= '
        <style>
        @import url(https://fonts.bunny.net/css?family=roboto:500);

        @page{
        margin-top: 0;
        margin-left: 1.2cm;
        width: 21cm;
        height: 29.7cm;
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #0087C3;
        text-decoration: none;
        }

        body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 1px 0 1px;
        color: #555555;
        background: #FFFFFF;
        font-family: "Roboto", sans-serif;
        font-size: 13px;
        }

        header {
        width: 94%;
        }

        .signText{
        margin-top:50px;
        margin-right: 15%;
        text-align: center;
        }

        #logo
        float: left;
        }

        #logo img {
        width: 100%
        }

        #details {
        margin-bottom: 20px;
        }

        #client {
        padding-left: 3px;
        border-left: 5px solid #F175AD;
        float: left;
        }

        #client .to {
        color: #777777;
        }

        h2.name {
        font-size: 1em;
        font-weight: normal;
        font-family: "Roboto";
        margin: 0;
        }

        #invoice {
        float: right;
        text-align: right;
        }

        #invoice h1 {
        color: #0087C3;
        font-size: 1.6em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 8px 0;
        }

        #invoice .date {
        font-size: 1em;
        color: #777777;
        }

        table {
        width: 90%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 1px;
        }

        table th,
        table td {
        padding: 3px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        table th {
        font-weight: normal;
        }

        table td {
        text-align: left;
        }

        table td h3{
        color: #777777;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }

        table .no {
        color: #FFFFFF;
        font-size: 1em;
        background: #DDDDDD;
        }

        table .desc {
        text-align: left;
        }

        table .unit {
        background: #7FBCD2;
        color: #FFFFFF;
        }

        table .total {
        background: #80679e;
        color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1em;
        }

        table tbody tr:last-child td {
        border: none;
        }

        #signature {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            height: 70px;
        }

        table tfoot td {
        padding: 2px 5px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1em;
        white-space: nowrap;
        border-top: 1px solid #9fcfe6;
        }

        footer {
            color: #777777;
            width: 90%;
            height: 20px;
            position: absolute;
            bottom: 0;
            padding: 5px 0;
            text-align: center;
        }

        table tfoot tr:first-child td {
        border-top: none;
        }

        table tfoot tr:last-child td {
        color: #0095CC;
        font-size: 1.2em;
        border-top: 1px solid #275DA3

        }

        table tfoot tr td:first-child {
        border: none;
        }

        #thanks{
        font-size: 2em;
        margin-bottom: 50px;
        }

        #notices{
        page-break-before: always;
        margin-top: 40px;
        padding-left: 5px;
        }

        #notices {
        font-size: 1.1em;
        }
        #notices li{
        margin: 8px 0px;
        }
        </style>';

        $output .= '
            </head>
            <header class="clearfix">
                <div id="logo"> 
                <img src="https://aeo.mybnec.org/storage/assets/letterhead-aeo-fixed.png">
                </div>
            </header>
            <body>
                <main>
                <div id="details" class="clearfix" style="margin-top:20px">
                    <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name">' . $user->institution_name . '</h2>
                    <div class="address">' . $user->pic_name . '</div>
                    <div class="address">' . $user->country->name . '</div>';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <div class="email">Invoice ID - 01' . $invoiceCode . '</div>';
        } else {
        $output .= '
                    <div class="email">Invoice ID - 02' . $invoiceCode . '</div>';
        }
        $output .= '
                    <div class="email">Time: '. $latestUpdate .' (GMT +7)</div>
                    <br>
                    </div>
                </div>
                <br>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="desc" colspan="2" style="text-align:center;">FIELD</th>
                        <th class="unit">PRICE</th>
                        <th class="qty">QUANTITY</th>
                        <th class="total">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>';
        $grandTotal = 0;
        foreach($slots as $slot){
            if($slot->id == "DB" || $slot->id == "RD"){
                $participant = "Team(s)";
            } else {
                $participant = "Person(s)";
            }

            $output .= '
                         <tr>
                             <td class="desc" colspan="2"><h3>'.$slot->name.'</h3></td>
                             <td class="unit"> IDR ' . $slot->price . '</td>
                             <td class="qty">' . $slot->quantity .' '. $participant .' </td>
                             <td class="total"> IDR ' . ($slot->quantity * $slot->price) . '</td>
                         </tr>';
             $grandTotal += ($slot->quantity * $slot->price);
        }

        $output .= '
                    </tbody>
                    <tfoot>
                    <tr>
                    <td style="padding-bottom: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2"><h3>GRAND TOTAL</h3></td>
                        <td>IDR ' . $grandTotal . '</td>
                    </tr>';
                    
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <tr>
                    <td colspan="2"></td>
                    <td colspan="2">ADDITIONAL CHARGES</td>
                    <td>USD 20 - USD 35*</td>
                    </tr>';
        }
        $output .= '
                    </tfoot>
                </table>';
                $output  .= '<p>This payment proof has been approved on ' . date("F j, Y H:i", strtotime($payment->updated_at)) . ' (GMT+7).</p>';
  
      
                    

        $output .= '
                <div class="signText">
                Approved By, <br>
                <img id="signature" src="https://aeo.mybnec.org/storage/assets/pm-signature.jpg" height="80"><br>
                <b>Michelle Natasya</b><br>
                Project Manager<br>
                The 2023 Asian English Olympics
                </div>';
     
        $output .= '
                </main>
            </body>
            </html>';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        if ($user->country->name != 'Indonesia') {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 01.pdf", array('Attachment' => false));
        } else {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 02.pdf", array('Attachment' => false));
        }
    }

    public function accommodationInvoice(User $user, $id )
    {

        if($id == 0){
            $slots = DB::table('accommodation_slot_details')
                ->join('accommodations', 'accommodation_slot_details.accommodation_id', '=', 'accommodations.id')
                ->select(
                    'accommodation_slot_details.*',
                    'accommodations.room_type',
                    'accommodations.price',
                    'accommodations.id',
                )
                ->where('accommodation_slot_details.pic_id', '=', $user->id)
                ->where('accommodation_slot_details.is_confirmed', '=', 1)
                ->where('accommodation_slot_details.payment_id', '=', null)
                ->orderby('updated_at', 'DESC')
                ->get();
        } else {
            $slots = DB::table('accommodation_slot_details')
                ->join('accommodations', 'accommodation_slot_details.accommodation_id', '=', 'accommodations.id')
                ->select(
                    'accommodation_slot_details.*',
                    'accommodations.room_type',
                    'accommodations.price',
                    'accommodations.id'
                )
                ->where('accommodation_slot_details.id' ,'=', $id)
                ->where('accommodation_slot_details.pic_id', '=', $user->id)
                ->where('accommodation_slot_details.is_confirmed', '=', 1)
                ->where('accommodation_slot_details.payment_id', '=', null)
                ->orderby('updated_at', 'DESC')
                ->get();
        }
        

        if(count( $slots ) == 0){
            return redirect()->back()->with('error', 'Confirmed Slot Not Found');
        }

        $latestUpdate = $slots[0]->updated_at;
        $invoiceCode = date('mdhi',strtotime($slots[0]->updated_at));

        $output = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
            ';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 01' . '</title>';
        } else {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 02' . '</title>';
        }
        $output .= '
                <style>
                @import url(https://fonts.bunny.net/css?family=roboto:500);

                @page{
                margin-top: 0;
                margin-left: 1.2cm;
                width: 21cm;
                height: 29.7cm;
                }

                .clearfix:after {
                content: "";
                display: table;
                clear: both;
                }

                a {
                color: #0087C3;
                text-decoration: none;
                }

                body {
                position: relative;
                width: 21cm;
                height: 29.7cm;
                margin: 0 1px 0 1px;
                color: #555555;
                background: #FFFFFF;
                font-family: "Roboto",sans-serif;
                font-size: 13px;
                }

                header {
                width: 94%;
                }

                .signText{
                margin-top: 50px;
                margin-right: 15%;
                text-align: center;
                }

                #logo
                float: left;
                }

                #logo img {
                width: 100%
                }

                #details {
                margin-bottom: 20px;
                }

                #client {
                padding-left: 3px;
                border-left: 5px solid #F175AD;
                float: left;
                }

                #client .to {
                color: #777777;
                }

                h2.name {
                font-size: 1em;
                font-weight: normal;
                font-family: "Roboto";
                margin: 0;
                }

                #invoice {
                float: right;
                text-align: right;
                }

                #invoice h1 {
                color: #0087C3;
                font-size: 1.6em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 8px 0;
                }

                #invoice .date {
                font-size: 1em;
                color: #777777;
                }

                table {
                width: 90%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 1px;
                }

                table th,
                table td {
                padding: 3px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
                }

                table th {
                font-weight: normal;
                }

                table td {
                text-align: left;
                }

                table td h3{
                color: #777777;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
                }

                table .no {
                color: #FFFFFF;
                font-size: 1em;
                background: #DDDDDD;
                }

                table .desc {
                text-align: left;
                }

                table .unit {
                background: #7FBCD2;
                color: #FFFFFF;
                }

                table .total {
                background: #80679e;
                color: #FFFFFF;
                }

                table td.unit,
                table td.date,
                table td.total {
                font-size: 1em;
                }

                table td.date {
                    colspan: 1;
                }

                table tbody tr:last-child td {
                border: none;
                }

                #signature {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    width: 50%;
                    height: 70px;
                }

                table tfoot td {
                padding: 2px 5px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1em;
                white-space: nowrap;
                border-top: 1px solid #9fcfe6;
                }

                footer {
                    color: #777777;
                    width: 90%;
                    height: 20px;
                    position: absolute;
                    bottom: 0;
                    padding: 5px 0;
                    text-align: center;
                }

                table tfoot tr:first-child td {
                border-top: none;
                }

                table tfoot tr:last-child td {
                color: #0095CC;
                font-size: 1.2em;
                border-top: 1px solid #275DA3

                }

                table tfoot tr td:first-child {
                border: none;
                }

                #thanks{
                font-size: 2em;
                margin-bottom: 50px;
                }

                #notices{
                page-break-before: always;
                margin-top: 40px;
                padding-left: 5px;
                }

                #notices {
                font-size: 1.1em;
                }
                #notices li{
                margin: 8px 0px;
                }
                </style>';


        $output .= ' 
            </head>
            <header class="clearfix">
                <div id="logo">
                <img src="https://aeo.mybnec.org/storage/assets/letterhead-aeo-fixed.png">
                </div>
            </header>
            <body>
                <main>
                <div id="details" class="clearfix" style="margin-top:20px">
                    <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name">' . $user->institution_name . '</h2>
                    <div class="address">' . $user->pic_name . '</div>
                    <div class="address">' . $user->country->name . '</div>';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <div class="email">Invoice ID - 01' . $invoiceCode . '</div>';
        } else {
        $output .= '
                    <div class="email">Invoice ID - 02' . $invoiceCode . '</div>';
        }
        $output .= '
                    <div class="email">Time: '. $latestUpdate .' (GMT +7)</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="desc" colspan="2" style="text-align:center;">ROOM TYPE</th>
                        <th class="unit" >PRICE</th>
                        <th class="date">CHECK-IN DATE</th>
                        <th class="date">CHECK-OUT DATE</th>
                        <th class="total" colspan="2">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>';
        $grandTotal = 0;
        foreach($slots as $slot){

            

            $output .= '
                         <tr>
                             <td class="desc" colspan="2"><h3>'.$slot->room_type.'</h3></td>
                             <td class="unit" > IDR ' . $slot->price . '</td>
                             <td class="date">' . Carbon::parse($slot->check_in_date)->format('d-m-Y H:i').' '.'</td>
                             <td class="date">' . Carbon::parse($slot->check_out_date)->format('d-m-Y H:i').' '.'</td>
                             <td class="total" colspan="2"> IDR ' . ($slot->quantity * $slot->price) . '</td>
                         </tr>';
             $grandTotal += ($slot->quantity * $slot->price);
        }

        $output .= '
                    </tbody>
                    <tfoot>
                    <tr>
                    <td style="padding-bottom: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><h3>GRAND TOTAL</h3></td>
                        <td >IDR ' . $grandTotal . '</td>
                    </tr>';
                    
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <tr>
                    <td colspan="3"></td>
                    <td colspan="2">ADDITIONAL CHARGES</td>
                    <td>USD 20 - USD 35*</td>
                    </tr>';
        }
        $output .= '
                    </tfoot>
                </table>';
        if ($user->country->name != 'Indonesia') {
        $output  .= '
                <p>The payment will be transferred via International Bank or TransferWise to our Bank Account</p>';
        } else {
        $output  .= '
                    <p>The payment will be transferred via National Bank to our Bank Account</p>';
        }
        $output .= '
                        <table class="border="1" cellspacing="0" cellpadding="0"">
                            <tbody>';
        if ($user->country->name != 'INDONESIA') {
        $output .= '
                                    <tr>
                                        <td>Email</td>
                                        <td>: rahmadira.herdiningtyas@binus.ac.id</td>
                                    </tr>
                                    ';
        }
        $output .= '
                                    <tr>
                                        <td>Bank Name</td>
                                        <td>: Bank Central Asia</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Account Number</td>
                                        <td>: 5271 848 871</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Account Name</td>
                                        <td>: Rahmadira Febi Herdiningtyas</td>
                                    </tr>';
        if ($user->country->name != 'INDONESIA') {
        $output .= '
                                        <tr>
                                        <td>Swift Code</td>
                                        <td>: CENAIDJA</td>
                                        </tr>
                                        ';
        }
        $output .= '
                            </tbody>
                        </table>
                        ';

        $output .= '
                <div class="signText">
                Approved By, <br>
                <img id="signature" src="https://aeo.mybnec.org/storage/assets/pm-signature.jpg" ><br>
                <b>Michelle Natasya</b><br>
                Project Manager<br>
                The 2023 Asian English Olympics
                </div>';
        
        
        $output .= '
                </main>
            </body>
            </html>';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        if ($user->country->name != 'Indonesia') {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 01.pdf", array('Attachment' => false));
        } else {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 02.pdf", array('Attachment' => false));
        }

    }

    public function paidAccommodationInvoice(AccommodationPayment $payment)
    {
        $user = User::where('id' ,$payment->pic_id)->first();

        $slots = DB::table('accommodation_slot_details')
                ->join('accommodations', 'accommodation_slot_details.accommodation_id', '=', 'accommodations.id')
                ->select(
                    'accommodation_slot_details.*',
                    'accommodations.room_type',
                    'accommodations.price',
                    'accommodations.id'
                )
                ->where('accommodation_slot_details.payment_id', '=', $payment->id)
                ->where('accommodation_slot_details.pic_id', '=', $payment->pic_id)
                ->orderby('updated_at', 'DESC')
                ->get();
        

        if(count($slots) == 0){
            return redirect()->back()->with('error', 'Confirmed Slot Not Found');
        }

        $latestUpdate = $slots[0]->updated_at;
        $invoiceCode = date('mdhi',strtotime($slots[0]->updated_at));

        $output = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
            ';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 01' . '</title>';
        } else {
        $output .= '
                <title>Invoice - ' . $user->institution_name . ' - 02' . '</title>';
        }
        '<link rel="preconnect" href="https://fonts.googleapis.com">';
        '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
         '<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">';

        $output .= '
        <style>

        @import url(https://fonts.bunny.net/css?family=roboto:500);

        @page{
        margin-top: 0;
        margin-left: 1.2cm;
        width: 21cm;
        height: 29.7cm;
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #0087C3;
        text-decoration: none;
        }

        body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 1px 0 1px;
        color: #555555;
        background: #FFFFFF;
        font-family: "Roboto", sans-serif;
        font-size: 13px;
        }

        header {
        width: 94%;
        }

        .signText{
        margin-top:50px;
        margin-right: 15%;
        text-align: center;
        }

        #logo
        float: left;
        }

        #logo img {
        width: 100%
        }

        #details {
        margin-bottom: 20px;
        }

        #client {
        padding-left: 3px;
        border-left: 5px solid #F175AD;
        float: left;
        }

        #client .to {
        color: #777777;
        }

        h2.name {
        font-size: 1em;
        font-weight: normal;
        font-family: "Roboto";
        margin: 0;
        }

        #invoice {
        float: right;
        text-align: right;
        }

        #invoice h1 {
        color: #0087C3;
        font-size: 1.6em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 8px 0;
        }

        #invoice .date {
        font-size: 1em;
        color: #777777;
        }

        table {
        width: 90%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 1px;
        }

        table th,
        table td {
        padding: 3px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        table th {
        font-weight: normal;
        }

        table td {
        text-align: left;
        }

        table td h3{
        color: #777777;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }

        table .no {
        color: #FFFFFF;
        font-size: 1em;
        background: #DDDDDD;
        }

        table .desc {
        text-align: left;
        }

        table .unit {
        background: #7FBCD2;
        color: #FFFFFF;
        }

        table .total {
        background: #80679e;
        color: #FFFFFF;
        }

        table td.unit,
        table td.date,
        table td.total {
        font-size: 1em;
        }

        table tbody tr:last-child td {
        border: none;
        }

        #signature {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            height: 70px;
        }

        table tfoot td {
        padding: 2px 5px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1em;
        white-space: nowrap;
        border-top: 1px solid #9fcfe6;
        }

        footer {
            color: #777777;
            width: 90%;
            height: 20px;
            position: absolute;
            bottom: 0;
            padding: 5px 0;
            text-align: center;
        }

        table tfoot tr:first-child td {
        border-top: none;
        }

        table tfoot tr:last-child td {
        color: #0095CC;
        font-size: 1.2em;
        border-top: 1px solid #275DA3

        }

        table tfoot tr td:first-child {
        border: none;
        }

        #thanks{
        font-size: 2em;
        margin-bottom: 50px;
        }

        #notices{
        page-break-before: always;
        margin-top: 40px;
        padding-left: 5px;
        }

        #notices {
        font-size: 1.1em;
        }
        #notices li{
        margin: 8px 0px;
        }
        </style>';

        $output .= '
            </head>
            <header class="clearfix">
                <div id="logo"> 
                <img src="https://aeo.mybnec.org/storage/assets/letterhead-aeo-fixed.png">
                </div>
            </header>
            <body>
                <main>
                <div id="details" class="clearfix" style="margin-top:20px">
                    <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name">' . $user->institution_name . '</h2>
                    <div class="address">' . $user->pic_name . '</div>
                    <div class="address">' . $user->country->name . '</div>';
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <div class="email">Invoice ID - 01' . $invoiceCode . '</div>';
        } else {
        $output .= '
                    <div class="email">Invoice ID - 02' . $invoiceCode . '</div>';
        }
        $output .= '
                    <div class="email">Time: '. $latestUpdate .' (GMT +7)</div>
                    <br>
                    </div>
                </div>
                <br>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="desc" colspan="2" style="text-align:center;">ROOM TYPE</th>
                        <th class="unit">PRICE</th>
                        <th class="date">CHECK-IN DATE</th>
                        <th class="date">CHECK-OUT DATE</th>
                        <th class="total">TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>';
        $grandTotal = 0;
        foreach($slots as $slot){
            if($slot->id == "DB" || $slot->id == "RD"){
                $participant = "Team(s)";
            } else {
                $participant = "Person(s)";
            }

            $output .= '
                         <tr>
                             <td class="desc" colspan="2"><h3>'.$slot->room_type.'</h3></td>
                             <td class="unit"> IDR ' . $slot->price . '</td>
                             <td class="date">' . Carbon::parse($slot->check_in_date)->format('d-m-Y H:i').' '.'</td>
                             <td class="date">' . Carbon::parse($slot->check_out_date)->format('d-m-Y H:i').' '.'</td>
                             <td class="total"> IDR ' . ($slot->quantity * $slot->price) . '</td>
                         </tr>';
             $grandTotal += ($slot->quantity * $slot->price);
        }

        $output .= '
                    </tbody>
                    <tfoot>
                    <tr>
                    <td style="padding-bottom: 10px;"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2"><h3>GRAND TOTAL</h3></td>
                        <td>IDR ' . $grandTotal . '</td>
                    </tr>';
                    
        if ($user->country->name != 'Indonesia') {
        $output .= '
                    <tr>
                    <td colspan="3"></td>
                    <td colspan="2">ADDITIONAL CHARGES</td>
                    <td>USD 20 - USD 35*</td>
                    </tr>';
        }
        $output .= '
                    </tfoot>
                </table>';
                $output  .= '<p>This payment proof has been approved on ' . date("F j, Y H:i", strtotime($payment->updated_at)) . ' (GMT+7).</p>';
  
      
                    

        $output .= '
                <div class="signText">
                Approved By, <br>
                <img id="signature" src="https://aeo.mybnec.org/storage/assets/pm-signature.jpg" height="80"><br>
                <b>Michelle Natasya</b><br>
                Project Manager<br>
                The 2023 Asian English Olympics
                </div>';
     
        $output .= '
                </main>
            </body>
            </html>';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        if ($user->country->name != 'Indonesia') {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 01.pdf", array('Attachment' => false));
        } else {
            $dompdf->stream("Invoice - " . $user->institution_name . " - " . $invoiceCode . " - 02.pdf", array('Attachment' => false));
        }
    }



}
