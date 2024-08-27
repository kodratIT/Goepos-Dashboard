<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;
use App\Models\bankShortCodeModel;
use App\Helpers\Utils;
use App\Helpers\HelpersUtils;

class BankAccountForm extends Component
{
    public $submission_id;
    public $bankType;
    public $nameAccount;
    public $bankNumber;
    public $bankShortCode;
    public $tgl_pengajuan;
    public $status_pengajuan;
    public $namaRekening;
    public $phone;
    public $paymentId;

    public $isSaving = false;
    public $ownerUid;
    public $bank_code = [];
    public $submission =[];
    public $submissionHistory=[];

    protected $rules = [
        'bankType' => 'required',
        'nameAccount' => 'required',
        'bankNumber' => 'required',
    ];

    public function mount($ownerUid){
        $this->ownerUid = $ownerUid;
        $this->getShortCodeBank();
        $this->getSubmissionByOwnerUid();
    }

    protected function getShortCodeBank(){
        $this->bank_code = bankShortCodeModel::all();
    }

    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function saveBankAccount(){
        $this->validate();

        $data = [
            'bankShortCode' => $this->bankShortCode,
            'nameAccount' => $this->nameAccount,
            'bankNumber' => $this->bankNumber,
        ];

        $requestApi = $this->firestore()->checkValidatedBankAccount($data);

        if($requestApi){
            $result = $this->firestore()->createBankAccount($this->ownerUid,$data,$this->paymentId,$this->submission_id);

            sleep(5);

            return redirect()->route('businesses.detail', ['id' => $this->ownerUid]);
        } else {
            toastr()->error('Data Bank Tidak Terdaftar!');
        }
    }

    public function getSubmissionByOwnerUid()
    {
        $query = $this->firestore()->getSubmissionByOwnerUid($this->ownerUid);
        foreach ($query as $submission) {
            if ($submission->data->status === 'verifying') {
                $this->submission = $submission;
            }
        }
        $this->submissionHistory =  $query;

        if(isset($this->submission->data) && $this->submission->data !== []){
            $this->submission_id = $this->submission->id;
            $this->paymentId = $this->submission->data->paymentId;
            $this->nameAccount = $this->submission->data->bankAccountName ;
            $this->bankType = $this->submission->data->bankName;
            $this->bankShortCode = $this->submission->data->bankShortCode;
            $this->tgl_pengajuan = HelpersUtils::convertTimestampToDateTrx($this->submission->data->createdAt);
            $this->bankNumber = aes256Decrypt($this->submission->data->bankNumber,config('services.secretKeyBank.secretKey'));
            $this->status_pengajuan = $this->submission->data->status;
            $this->namaRekening=$this->submission->data->bankAccountName;
            $this->phone =$this->submission->data->phone;
        }


    }

    public function tolakPengajuan(){
        $reject = $this->firestore()->rejectSubmission($this->ownerUid, $this->submission_id);

        toastr()->success('Pengajuan QRIS Di Tolak!');

        return redirect()->route('businesses.detail', ['id' => $this->ownerUid]);
    }



    public function render()
    {
        return view('livewire.backend.components.bank-account-form');
    }
}
