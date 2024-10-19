<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadMessageRequest;
use App\Http\Requests\SendMessageRequest;
use App\Mail\SendDecryptKey;
use App\Services\Crypt\CryptInterface;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function __construct(
        private readonly CryptInterface $cryptInterface,
        private readonly MessageService $messageService,
    ) {
    }

    public function writeForm(Request $request): View
    {
        return view('message.write', [
            'user' => $request->user(),
        ]);
    }

    public function readForm(Request $request, ?string $decryptKey = null): View
    {
        return view('message.read', [
            'user' => $request->user(),
            'decryptKey' => $decryptKey
        ]);
    }

    public function send(SendMessageRequest $request): RedirectResponse
    {
        $requestData = $request->validated();

        $decryptionKey = $this->cryptInterface->generateDecryptionKey();
        $encryptedMessage = $this->cryptInterface->encryptMessage($requestData['message'], $decryptionKey);

        $this->messageService->create(
            $encryptedMessage,
            $requestData['recipient'],
            $decryptionKey,
            $requestData['expiry_option']
        );

        Mail::to($requestData['recipient'])->send(new SendDecryptKey($decryptionKey));

        return redirect()->back()->with('status', 'ok');
    }

    public function read(ReadMessageRequest $request): RedirectResponse
    {
        $decryptionKey = $request->decryption_key;

        try {
            $messageHash = $this->messageService->getMessageHash($decryptionKey, Auth::user()->email);
            $message = $this->cryptInterface->decryptMessage($messageHash, $decryptionKey);
        } catch (\Exception $exception) {
            return redirect()->back()
                ->withInput($request->input())
                ->with(['error' => $exception->getMessage()]);
        }
        return redirect()->back()->with(['message' => $message]);
    }
}
