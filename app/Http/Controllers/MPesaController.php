<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Mpesa;
use App\Models\User;
use App\Models\Account;
use App\Models\Revenue;
use App\Models\Course;
use App\Models\Student;
use PAM\API\B2C;
use PAM\API\PayLoad;
use PAM\API\RegC2bUrl;
use PAM\API\ShortCode;
use PAM\API\App;
use PAM\API\STKPush;
use PAM\API\Balance;
use Note\Models\Notification;
//use App\Models\Notification;
use App\Http\Controllers\SystemController;
use LaravelMultipleGuards\Traits\FindGuard;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\MailJob;

class MpesaController extends Controller
{
    /**
     * push
     */
    public function stkPush(Request $request)
    {
        $response=  (new STKPush())->initiateSTK([
            "CallingCode" => "254", // 254 or 255
            "Secret" => env('PAM_APP_SHORTCODE_SECRET_KEY'),
            "TransactionType" => "CustomerPayBillOnline", // CustomerPayBillOnline or CustomerBuyGoodsOnline
            "PhoneNumber" => $this->phone,
            'Amount' => ceil($this->course->amount),
            "ResultUrl" => route('stk.push'),
            "Description" => "Testing Payment"
        ]);

        if ($response->success) {
            Mpesa::query()->create([
                'user_id' =>$this->user->id,
                'course_id' =>$this->course->id,
                'student_id' =>$this->course->student_id, 
                'reference_number' =>$response->data->ReferenceNumber,
                'phone_number' => $this->student->phone_number,
                'amount' => ceil($this->course->amount),
                'description'=>'Payments for Course'. $this->course->title,
                'attempts' => 1,
                'is_initiated' => true,
                'queued_at' => now()
            ]);
            Note::createSystemNotification(User::class, 'course', ' course Successfully Enrolled and awaiting for payments');
            $this->emit('noteAdded');
            $this->alert('success', 'Check Your Phone Number and Allow for Payment ');
            $this->reset();
            return redirect()->route('courses.index');

        }
        else{
            $this->alert('error', implode(",\n", $response->data[0]->errors));
        }
    }
    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }
    /**
     * Lipa na M-PESA password
     * */
    public function lipaNaMpesaCallBack(Request $request)
    {
        // decode the data here from the mpesa payload response
        $response = json_decode($request->getContent());

        SystemController::log([
            $response
        ], 'info', 'confirm_call_back');
        //get the reference number if exists
        $Mpesa = Mpesa::where('reference_number', $response->ReferenceNumber)->first();
        if ($Mpesa) {
            // update if request becomes true
            if ($response->Success) {
                // sync mpesa here
                Mpesa::query()->where('reference_number', $response->ReferenceNumber)->update([
                    'transaction_number' => $response->MpesaReceiptNumber,
                    'is_paid' => true,
                    'is_successful' => true,
                    'payload' => $response,
                    'callback_received_at' => now()
                ]);
                // write statements
                Revenue::query()->updateOrCreate([
                    'transaction_number' => $response->MpesaReceiptNumber,
                ],                                         [
                    'user_id' => $Mpesa->user_id,
                    'student_id'=>$Mpesa->student_id,
                    'transaction_type' => 'Order Payment',
                    'reference_number' => $Mpesa->reference_number,
                    'amount' => $response->Amount,
                    'description' => $Mpesa->course_id . ' course payment.',
                    'is_debit' => true
                ]);
                $wallet = Account::query()->where('student_id', $Mpesa->student_id)->first()->balance;
                $balance = $wallet + $Mpesa->amount;
                $wallet = Account::where('student_id', $Mpesa->student_id)->update(['balance' => $balance, 'available' => $balance]);
                // grand Access to enrolledments statements
                Enroll::query()
                    ->create(
                        [
                            'course_id' => $Mpesa->course_id,
                            'user_id' => $Mpesa->user_id,
                            'student_id' =>$Mpesa->student_id, 
                        ]
                    );
                // send notifications here 
                dispatch((new MailJob(
                    "Student" . " " . User::query()->where('id', $Mpesa->user_id)->first()->name,
                    User::query()->where('id', $Mpesa->user_id)->first()->email,
                    'Congratulatiuons!! You have been enroll a course',
                    'course. #' . Course::query()->where('id',  $Mpesa->course_id)->first()->title . ' has been assigned to you Thank you for using our service',
                    true,
                    route('courses.show, $course->id'),
                    '<<< Visit here for more details >>>'
                )))->onQueue('emails')->delay(2);
                return redirect()->route('courses.show, $course->id');
            } else {
                // sync mpesa here
                $Mpesa->update([
                    'transaction_number' => $response->MpesaReceiptNumber,
                    'is_paid' => false,
                    'is_successful' => true,
                    'payload' => $response,
                    'callback_received_at' => now()
                ]);
            }
        }
    }
}
