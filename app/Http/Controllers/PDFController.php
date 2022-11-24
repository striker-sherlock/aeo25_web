<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Dompdf\DomPDF;

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
                    'competitions.competition_init'
                )
                ->where('competition_slot_details.user_id', '=', $user->id)
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
                    'competitions.competition_init'
                )
                ->where('competition_slot_details.id' ,'=', $id)
                ->where('competition_slot_details.user_id', '=', $user->id)
                ->where('competition_slot_details.is_confirmed', '=', 1)
                ->where('competition_slot_details.payment_id', '=', null)
                ->orderby('updated_at', 'DESC')
                ->get();
        }
        

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
        $output .= '
                <style>
                @page{
                margin-top: 0;
                margin-left: 1.2cm;
                width: 21cm;
                height: 29.7cm;
                }

                @font-face {
                    font-family: "EuropaNuova";
                    font-style: normal;
                    font-weight: normal;
                    src: url("/storage/fonts/EuropaNuovaReg.ttf") format("ttf");
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
                font-family: "EuropaNuova";
                font-size: 13px;
                }

                header {
                width: 94%;
                }

                .signText{
                margin-top:10px;
                margin-right: 15%;
                text-align: center;
                }

                #logo
                float: left;
                }

                #logo img {
                width: 101%
                }

                #details {
                margin-bottom: 5px;
                }

                #client {
                padding-left: 3px;
                border-left: 5px solid #275DA3;
                float: left;
                }

                #client .to {
                color: #777777;
                }

                h2.name {
                font-size: 1em;
                font-weight: normal;
                font-family: "nuova-reguler";
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
                background: #9fcfe6;
                color: #FFFFFF;
                }

                table .total {
                background: #275DA3;
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
                <img src="https://aeo.mybnec.org/storage/assets/letterhead.png">
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

            if($slot->competition_init == "DB" || $slot->competition_init == "RD"){
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
                                        <td>: elen.novianti@binus.ac.id</td>
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
                                        <td>: Elen Novianti</td>
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
                <img src="https://dev-aeo.mybnec.org/storage/assets/pm_sign.jpg" height="80"><br>
                <b>Debora Irooth</b><br>
                Project Manager<br>
                The 2022 Asian English Olympics
                </div>';
        if ($user->country->name == 'Indonesia') {
        $output .= '
                <div id="notices">
                <h2 class="signText"><u>Payment Guideline</u></h2>
                <h3>General Rules</h3>
                <ol>
                    <li>The payment amount we receive must match the amount of total fees listed in the invoice.</li>
                    <li>You can make your payments using a bank transfer to the following bank account:
                    <ol>Bank Account: BCA (Bank Central Asia)<br>
                    Bank Account Name: Elen Novianti<br>
                    Bank Account Number: 5271848871<br>
                    Swift Code: CENAIDJA</ol></li>
                    <li>We only accept payment in <b>Indonesian Rupiahs (IDR).</b></li>
                    <li>Please be aware of how much additional fees will be charged to you by your bank when you<br> transfer it to our account.
                    <b>All additional costs are borne by the participants.</b></li>
                    <li>If you happen to transfer less than the expected amount, we will contact the PIC to get you<br> to make another payment to cover the shortfall. This also means that you should pay the<br> <b>additional fees twice</b>. To avoid this,please pay <b>extra attention</b> to pay all the listed fees<br> moderately.</li>
                    <li>The payment deadline for the SHORT STORY WRITING and RADIO DRAMA is on <b>February 17,<br> 2022, at 06:00 P.M. (GMT + 07:00).</b></li>
                    <li>The payment deadline for SPEECH, NEWSCASTING, STORYTELLING, DEBATE, and SPELLING<br> BEE is on <b>February 14, 2022, at 6:00 P.M. (GMT + 07:00).</b></li>
                    <li>We have the right to <b>disqualify</b> the participants who didn’t pay the right amount of registration<br> fee until the expected deadline. For all the fields making video submissions for the preliminary<br> round. We will not proceed with your submission if you didn’t complete the payment.</li>
                    <li>We will only proceed with your submission if we have confirmed your payment. Any problems<br> you have when making a payment is not our responsibility as long as the money has not<br> entered our account.
                    For example, if you put the wrong bank account number or bank account<br> name resulting in the money isn’t getting into our account, this will be entirely your<br> responsibility. We will only confirm your payment if we have already made sure that the money<br> has entered our account.</li>
                </ol>
                </div>
                <div id="notices" style="padding: 40px 100px 0px 35px">    
                <p><b>If you want to secure your slots, we highly suggest  you to do the payment 10 days after you do the registration at maximum, or else we will revoke your booking.</b>Please also be aware that international transfer using a few days to be done.</p>
                <p>After the payment is made, you will have to wait for a maximum of <b>7 working days to receive your payment confirmation.</b></p>
                <p><b>All the money that has been transferred into our account cannot be refunded for all reasons.</b></p>
                <p>If you have any question regarding payment or administration, kindly contact:<br>
                Elen Novianti (Secretary and Treasurer of The 2022 AEO)<br>
                Whatsapp: 081256255542<br>
                Line: elennovianti_<br></p>
                <p><b>Please see the details and instructions inside the invoice.</b></p>
                <h3>Winner Prize</h3>
                <p>Note: All prize winners do not include admin fees.</p>
                </div>
                ';
        } else if ($user->country->name != 'Indonesia') {
        $output .= '
                <div id="notices" style="padding: 0px 110px 50px 20px">
                <h2 class="signText"><u>Payment Guideline</u></h2>
                <h3>General Rules</h3>
                <ol>
                <li>The payment amount that we receive must match the amount of total fees listed in the invoice.</li>
                <li>For <b>Indonesian Teams</b>, you can make your payments using a bank transfer to the following bank account:
                <ol>Bank Account: BCA (Bank Central Asia)<br>
                Bank Account Name: Elen Novianti<br>
                Bank Account Number: 5271848871<br>
                Swift Code: CENAIDJA</ol></li>
                <li>For <b>Non-Indonesian Teams</b>, you are suggested to make your payments via <b>Wise</b><br> (<a href="https://wise.com/">https://wise.com/</a>).</li>
                <li><b>Do note that for Non-Indonesian Teams.</b> If you would like to make your payments using bank transfer, you are free to do it only if you agree to the additional fees charged by the bank (it is usually around USD 20-USD 35, depending on the policies of each correspondent bank).
                For example, if your listed fees are IDR 800.000 and the additional fees charged by the bank is USD 25 (around IDR 352.000), this means you have to transfer around IDR 1.152.000.</li>
                <li>During your transaction using <b>Wise</b>, they may ask you to <b>verify your identity</b> before completing the transfer. This process may take around <b>3 days</b>, so pay attention to this if you don’t want to exceed the payment deadline.</li>
                <li>We only accept payment in <b>Indonesian Rupiahs (IDR)</b>. Most payments will be automatically converted to> <b>IDR</b> in the International Bank or Wise.</li>
                <li>Please be aware of how much additional fees will be charged to you by your bank or Wise when you transfer it to our account.
                <b>All additional costs are borne by the participants.</b></li>
                <li>If you happen to transfer less than the expected amount, we will contact the PIC to get you to make another payment to cover the shortfall. This also means that you should pay the <b>additional fees twice</b>. To avoid this, please pay <b>extra attention</b> to pay all the listed fees moderately.</li>
                <li>The payment deadline for the SHORT STORY WRITING and RADIO DRAMA is on <b>February 17, 2022, at 06:00 P.M. (GMT + 07:00).</b></li>
                </ol>
                <div style="padding-top: 70px">
                <ol start = "10" >
                <li>The payment deadline for SPEECH, NEWSCASTING, STORYTELLING, DEBATE, and SPELLING BEE is on<b> February 14, 2022, at 6:00 P.M. (GMT + 07:00).</b></li>
                <li>We have the right to <b>disqualify</b> the participants who didn’t pay the right amount of registration fee until the expected deadline. For all the fields making video submissions for the preliminary round. We will not proceed with your submission if you didn’t complete the payment.</li>
                <li>We will only proceed with your submission if we have confirmed your payment. Any problems you have when making a payment is not our responsibility as long as the money has not entered our account.
                For example, if you put the wrong bank account number or bank account name resulting the money doesn’t get into our account, this will be entirely your responsibility. We will only confirm your payment if we have already made sure that the money has entered our account.</li>
                </ol>
                </div>
                <h3>Payment Steps</h3>
                <p>There are <b>2 types of payment</b> (National and International Participants Payment).</p>
                <p><b>If you want to secure your slots, we highly suggest you to do the payment within 10 days after you do the<br> registration at maximum, or else we will revoke your booking.</b> Please also be aware that international transfer<br> using Wise needs a few days to be done.</p>
                <p>After the payment is made, you will have to wait for a maximum of <b>7 working days to receive your payment<br> confirmation.</b></p>
                <p><b>All the money that has been transferred into our account cannot be refunded for all reasons.</b></p>            
                </div>
                <div id="notices" style="padding: 0px 110px 50px 20px">
                <h3>Steps to use Wise</h3>
                <ol>
                <li>Go to Wise: <a href="https://wise.com/">https://wise.com/</a> or download the Wise, ex TransferWise application application;</li>
                <li>Register a new account if you don’t have one, or log in if you already have an account;</li>
                <li>Click on “Send Money” on the top left corner of your screen;</li>
                <li>Enter the amount you have to pay. Make sure that the amount that the recipient will get is right and sufficient. Note that there are different rates of additional charges charged by Wise depending on the payment method you choose!</li>
                <li>Click “Continue”;</li>
                <li>Click “Someone else” as your recipient;</li>
                <li>Enter these details:<br>
                Email<t>:  elen.novianti@binus.ac.id<br>
                Bank Name: BCA (Bank Central Asia)<br>
                Bank Account Name: Elen Novianti<br>
                Bank Account Number: 5271848871<br></li>
                <li>Select “Pay for Goods and Services” as a reason for the transfer. Then click “Continue”;</li>
                <li>You will proceed to the review transfer page. Enter the reference in the following format: “AEO 2022” followed by your field and institution name.<br>Example: AEO 2022 Debate, Speech Binus University;</li>
                <li>Click “Continue”;</li>
                <li>On the last page, re-check the amount you wish to transfer and the details;</li>
                <li>Click “Continue to Payment”;</li>
                <li>Screenshot the last page and copy the tracking link;</li>
                <li>Make sure that you’ve transfered the money, especially if you pay using your bank account. If so, you should enter your bank account details.</li>
                </ol>
                <p>If <b>Wise is not available</b> in your country, you are suggested to make your payments via <b>Western Union</b>.</p>
                </div>
                <div id="notices" style="padding: 0px 110px 50px 20px">
                <h3>Steps to use Western Union</h3>
                <ol>
                <li>Go to Western Union:<a href="https://www.westernunion.com/us/en/send-to-bank-account.html">https://www.westernunion.com/us/en/send-to-bank-account.html</a> or download Western Union: Send Money Fast application;</li>
                <li>Register a new account if you don’t have one, or log in if you already have an account;</li>
                <li>Choose Indonesia as the receiver’s country;</li>
                <li>Enter the amount you have to pay on the receive amount. Make sure that the amount that the recipient will get is right and sufficient;</li>
                <li>Click “Bank Account”;</li>
                <li>Select the payment method;</li>
                <li>Click “Continue”;</li>
                <li>Click “Accept”;</li>
                <li>Enter these details:<br>
                Receiver’s First Name: Elen<br>
                Receiver’s Last Name: Novianti<br>
                Street Address: Jl Budi Utomo Komplek Surya Kencana II<br>
                City:  Pontianak<br>
                Province:  West Kalimantan<br>
                Postal Code:  78243<br>
                Email Address:  elen.novianti@binus.ac.id<br>
                Bank Name: BCA (Bank Central Asia)<br>
                Bank Account Number: 5271848871<br></li>
                <li>Complete the data on the payment information;</li>
                <li>Click “Continue to review”;</li>
                <li>Re-check the amount you wish to transfer and the details;</li>
                <li>Screenshot the last page and save the tracking number;</li>
                <li>Make sure that you’ve transferred the money <b>straight to our bank</b>. If you pay using your bank account, you should enter your bank account details.</li>
                </ol>
                </div>
                <div id="notices" style="padding: 0px 110px 50px 20px">
                <p>If you have any question regarding payment or administration, kindly contact:<br>
                Elen Novianti (Secretary and Treasurer of The 2022 AEO)<br>
                Whatsapp: 081256255542<br>
                Line: elennovianti_<br></p>
                <p><b>Please see the details and instructions inside the invoice.</b></p>
                <h3>Winner Prize</h3>
                <p>Note: All prize winners do not include admin fees.</p>
                </div>';
        }
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
