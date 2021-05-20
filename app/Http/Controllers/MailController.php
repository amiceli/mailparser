<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PhpMimeMailParser;
use Illuminate\Support\Facades\Validator;
use Hfig\MAPI;
use Hfig\MAPI\OLE\Pear;
use Hfig\MAPI\Mime\Swiftmailer;

class MailController extends Controller {

    public function index (Request $request) {

        $validator = $this->getValidator($request);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('mail')->isValid()) {
            $type = $request->input('type');
            $path= $request->file('mail')->getRealPath();

            if ($type === 'MSG') {
                $body = $this->extractMSG($path);
            } else {
                $body = $this->extractEML($path);
            }

            return view('mail', array( "content" => $body ));
        }

        return redirect('/');
    }

    private function getValidator (Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'mail' => 'required',
        ], array(
            'type.required' => 'You have to specify a file type',
            'mail.required' => 'You have to select your mail file',
        ));

        return $validator;
    }

    private function extractMSG (string $path) : string {
        $messageFactory = new MAPI\MapiMessageFactory(new Swiftmailer\Factory());
        $documentFactory = new Pear\DocumentFactory(); 

        $ole = $documentFactory->createFromStream(fopen($path, 'r'));
        $message = @$messageFactory->parseMessage($ole);

        $mime = $message->toMime();

        $content = $mime->toString();

        return $content;
    }
    
    private function extractEML (string $path) : string {
        $content = file_get_contents($path);
        $parser = new PhpMimeMailParser\Parser();
        $parser->setText($content);
        $body = $parser->getMessageBody('htmlEmbedded');

        return $body;
    }

}